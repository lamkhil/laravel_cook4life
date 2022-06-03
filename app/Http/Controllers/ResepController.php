<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Http\Requests\StoreResepRequest;
use App\Http\Requests\UpdateResepRequest;
use App\Http\Resources\ResepResource;
use App\Models\Bahan;
use App\Models\Langkah;
use Illuminate\Http\Request;
use App\Models\Favorit;
use App\Models\Like;
use App\Models\Rating;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $resep = Resep::latest();

        return ResepResource::collection(
            $resep->filter(
                request(['search', 'kategori_id', 'kategori']))
                ->with(['kategori', 'user', 'bahan', 'langkah'])
                ->withCount(['like', 'favorit', 'like_me','favorit_me'])
            ->get());
    }

    public function rekomendasi()
    {

        $resep = Resep::latest();

        return ResepResource::collection(
            $resep->filter(
                request(['search', 'kategori_id', 'kategori']))
            ->with(['kategori', 'user', 'bahan', 'langkah'])
            ->withCount(['like', 'favorit', 'like_me','favorit_me'])
            ->paginate(5))->sortBy('like');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResepRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResepRequest $request)
    {
        $user = $request->user();
        $request->validate([
            'nama_resep' => 'required',
            'kategori_id' => 'required',
            'deskripsi' => 'required',
            'foto' =>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'bahan' => 'required',
            'langkah' => 'required'
        ]);
        $path = str_replace('public','', $request->file('foto')->store('public/reseps'));
        $resep = Resep::create(
            [
                'nama_resep' => $request->nama_resep,
                'kategori_id' => $request->kategori_id,
                'deskripsi' => $request->deskripsi,
                'foto' => $path,
                'user_id' => $user->id
            ]
        );
        $arrayBahan = $request->bahan;
        $arrayLangkah = $request->langkah;
        foreach ($arrayBahan as $bahan) {
            Bahan::create(
                [
                'resep_id'=>$resep->id,
                'toko_id'=>$bahan['toko_id'],
                'nama_bahan'=>$bahan['nama_bahan'],
                'harga'=>$bahan['harga']
                ]
            );
        }

        foreach ($arrayLangkah as $langkah) {
            Langkah::create(
                [
                'resep_id'=>$resep->id,
                'deskripsi'=>$langkah['deskripsi'],
                'waktu'=>$langkah['waktu'],
                ]
            );
        }

        return ResepResource::make($resep)->additional([
                'message' => 'success'
            ]);
    }

    public function show($id)
    {
        $resep = Resep::findOrFail($id);
        return ResepResource::make(
            $resep->with(['kategori', 'user', 'bahan', 'langkah', 'komentar', 'rating'])
                ->withCount(['like', 'favorit', 'like_me','favorit_me'])
            ->get());
    }

    public function like(Request $request)
    {
        $user = $request->user();
        if (Like::where([
            'user_id'=>$user->id,
            'resep_id'=>$request->resep_id
        ])->exists()) {
            Like::where([
                'user_id', '=',$user->id,
                'resep_id', '=',$request->resep_id
            ])->delete();
         }else{
             Like::create([
                'user_id' =>$user->id,
                'resep_id' =>$request->resep_id
             ]);
         }
        $resep = Resep::findOrFail($request->resep_id);
        return ResepResource::make(
            $resep->with(['kategori', 'user', 'bahan', 'langkah', 'komentar', 'rating'])
                ->withCount(['like', 'favorit', 'like_me','favorit_me'])
            ->get());
    }

    public function favorite(Request $request)
    {
        $user = $request->user();
        if (Favorit::where([
            'user_id', '=',$user->id,
            'resep_id', '=',$request->resep_id
        ])->exists()) {
            Favorit::where([
                'user_id', '=',$user->id,
                'resep_id', '=',$request->resep_id
            ])->delete();
         }else{
            Favorit::create([
                'user_id'=>$user->id,
                'resep_id'=>$request->resep_id
             ]);
         }
        $resep = Resep::findOrFail($request->resep_id);
        return ResepResource::make(
            $resep->with(['kategori', 'user', 'bahan', 'langkah', 'komentar', 'rating'])
                ->withCount(['like', 'favorit', 'like_me','favorit_me'])
            ->get());
    }

    public function rating(Request $request)
    {
        $user = $request->user();
        if (Rating::where([
            'user_id', '=',$user->id,
            'resep_id', '=',$request->resep_id
        ])->exists()) {
            Rating::where([
                'user_id', '=',$user->id,
                'resep_id', '=',$request->resep_id
            ])->update([
                'rating'=>$request->rating
            ]);
         }else{
            Rating::create([
                'user_id'=>$user->id,
                'resep_id'=>$request->resep_id,
                'rating'=>$request->rating
             ]);
         }
        $resep = Resep::findOrFail($request->resep_id);
        return ResepResource::make(
            $resep->with(['kategori', 'user', 'bahan', 'langkah', 'komentar', 'rating'])
                ->withCount(['like', 'favorit', 'like_me','favorit_me'])
            ->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function edit(Resep $resep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResepRequest  $request
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResepRequest $request, Resep $resep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resep $resep)
    {
        //
    }
}
