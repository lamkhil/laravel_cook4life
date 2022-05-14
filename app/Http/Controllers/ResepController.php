<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Http\Requests\StoreResepRequest;
use App\Http\Requests\UpdateResepRequest;
use App\Http\Resources\ResepResource;

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
            ->with(['kategori', 'user'])
            ->get());
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
            'foto' =>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        $path = str_replace('public','storage', $request->file('foto')->store('public/reseps'));
        $resep = Resep::create(
            [
                'nama_resep' => $request->nama_resep,
                'kategori_id' => $request->kategori_id,
                'deskripsi' => $request->deskripsi,
                'foto' => $path,
                'user_id' => $user->id
            ]
        );
        return ResepResource::make($resep)->additional([
                'message' => 'success'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function show(Resep $resep)
    {
        //
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
