<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Http\Requests\StoreResepRequest;
use App\Http\Requests\StoreTokoRequest;
use App\Http\Requests\UpdateResepRequest;
use App\Http\Resources\KategoriResource;
use App\Http\Resources\NotifikasiResource;
use App\Http\Resources\ResepResource;
use App\Http\Resources\TokoResource;
use App\Models\Bahan;
use App\Models\Langkah;
use Illuminate\Http\Request;
use App\Models\Favorit;
use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Rating;
use App\Models\Like;
use App\Models\Notifikasi;
use App\Models\Toko;
use App\Models\User;

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

        if (request('rekomendasi') ?? false) {
            return ResepResource::collection(
                $resep->with(['kategori', 'user', 'bahan', 'langkah', 'komentar', 'rating', 'allrating'])
                    ->withCount(['like', 'favorit', 'like_me', 'favorit_me'])
                    ->paginate(5)
            )->sortByDesc('like');
        }
        return ResepResource::collection(
            $resep->filter(
                request(['search', 'kategori_id', 'kategori'])
            )
                ->with(['kategori', 'user', 'bahan', 'langkah', 'komentar', 'rating', 'allrating'])
                ->withCount(['like', 'favorit', 'like_me', 'favorit_me'])
                ->get()
        );
    }

    public function notifikasi()
    {

        $notifikasi = Notifikasi::latest();

        return NotifikasiResource::collection(
            $notifikasi->with('resep')->where('user_id', request()->user()->id)->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kategori()
    {
        return KategoriResource::make(Kategori::all());
    }
    
    public function toko(Request $request)
    {
        $toko = Toko::latest();

        return TokoResource::collection(
            $toko->filter(
                request(['search']))
            ->with(['user'])
            ->where('user_id', $request->user()->id)
            ->get());
    }

    public function storetoko(StoreTokoRequest $request)
    {
        $user = $request->user();
        $request->validate([
            'nama_toko' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' =>'required',
            'no_telp' =>'required'
        ]);
        $toko = Toko::create(
            [
                'nama_toko' => $request->nama_toko,
                'alamat' => $request->alamat,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'no_telp' => $request->no_telp,
                'user_id' => $user->id
            ]
        );
        return TokoResource::make($toko)->additional([
                'message' => 'success'
            ]);
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
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'bahan' => 'required',
            'langkah' => 'required'
        ]);
        $path = str_replace('public', '', $request->file('foto')->store('public/reseps'));
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
                    'resep_id' => $resep->id,
                    'toko_id' => $bahan['toko_id'],
                    'nama_bahan' => $bahan['nama_bahan'],
                    'harga' => $bahan['harga']
                ]
            );
        }

        foreach ($arrayLangkah as $langkah) {
            Langkah::create(
                [
                    'resep_id' => $resep->id,
                    'deskripsi' => $langkah['deskripsi'],
                    'waktu' => $langkah['waktu'],
                ]
            );
        }

        return ResepResource::make($resep)->additional([
            'message' => 'success'
        ]);
    }

    public function show($id)
    {
        return Resep::with(['kategori', 'user', 'bahan', 'langkah', 'komentar', 'rating'])
            ->withCount(['like', 'favorit', 'like_me', 'favorit_me'])
            ->where('id', '=', $id)
            ->get()[0];
    }

    public function like(Request $request)
    {
        $user = $request->user();
        $resep = Resep::findOrFail($request->resep_id);
        if (Like::where('user_id', $user->id)->where('resep_id', $request->resep_id)->exists()) {
            Like::where('user_id', $user->id)->where('resep_id', $request->resep_id)->delete();
        } else {
            Like::create([
                'user_id' => $user->id,
                'resep_id' => $request->resep_id
            ]);
            Notifikasi::sendFcm(
                $resep,
                $user->name . " menyukai resep anda",
                User::find($resep->user_id)
            );
        }
        return Resep::with(['kategori', 'user', 'bahan', 'langkah', 'komentar', 'rating'])
        ->withCount(['like', 'favorit', 'like_me', 'favorit_me'])
        ->where('id', '=', $request->resep_id)
        ->get()[0];;
    }

    public function favorite(Request $request)
    {
        $user = $request->user();
        
        $resep = Resep::findOrFail($request->resep_id);
        if (Favorit::where('user_id', $user->id)->where('resep_id', $request->resep_id)->exists()) {
            Favorit::where('user_id', $user->id)->where('resep_id', $request->resep_id)->delete();
        } else {
            Favorit::create([
                'user_id' => $user->id,
                'resep_id' => $request->resep_id
            ]);
            
        Notifikasi::sendFcm(
            $resep,
            $user->name . " memfavoritkan resep anda",
            User::find($resep->user_id)
        );
        }


        return Resep::with(['kategori', 'user', 'bahan', 'langkah', 'komentar', 'rating'])
            ->withCount(['like', 'favorit', 'like_me', 'favorit_me'])
            ->where('id', '=', $request->resep_id)
            ->get()[0];
    }

    public function rating(Request $request)
    {
        $user = $request->user();
        
        $resep = Resep::findOrFail($request->resep_id);
        if (Rating::where('user_id', $user->id)->where('resep_id', $request->resep_id)->exists()) {
            Rating::where('user_id', $user->id)->where('resep_id', $request->resep_id)->update([
                'rating' => $request->rating
            ]);
        } else {
            Rating::create([
                'user_id' => $user->id,
                'resep_id' => $request->resep_id,
                'rating' => $request->rating
            ]);
            Notifikasi::sendFcm(
                $resep,
                $user->name . " memberi rating " . $request->rating . " bintang pada resep anda",
                User::find($resep->user_id)
            );
        }

        

        return Resep::with(['kategori', 'user', 'bahan', 'langkah', 'komentar', 'rating'])
            ->withCount(['like', 'favorit', 'like_me', 'favorit_me'])
            ->where('id', '=', $request->resep_id)
            ->get()[0];
    }

    public function komentar(Request $request)
    {
        $user = $request->user();
        
        $user = $request->user();
        Komentar::create([
           'resep_id'=> $request->resep_id,
           'user_id'=>$user->id,
           'komentar'=>$request->komentar
        ]);
        $resep = Resep::find($request->resep_id);
        Notifikasi::sendFcm(
            $resep,
            $user->name.' mengomentari resep '.$resep->nama_resep.' anda "'.$request->komentar.'"',
            User::find(Resep::find($request->resep_id)->user_id)
        );

        return Resep::with(['kategori', 'user', 'bahan', 'langkah', 'komentar', 'rating'])
            ->withCount(['like', 'favorit', 'like_me', 'favorit_me'])
            ->where('id', '=', $request->resep_id)
            ->get()[0];
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
