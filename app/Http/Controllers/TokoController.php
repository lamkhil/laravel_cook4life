<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Http\Requests\StoreTokoRequest;
use App\Http\Requests\UpdateTokoRequest;
use App\Http\Resources\TokoResource;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toko = Toko::latest();

        return TokoResource::collection(
            $toko->filter(
                request(['search']))
            ->with(['user'])
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
     * @param  \App\Http\Requests\StoreTokoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTokoRequest $request)
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
        return TokoResource::make($toko->with(['user']))->additional([
                'message' => 'success'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function show(Toko $toko)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function edit(Toko $toko)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTokoRequest  $request
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTokoRequest $request, Toko $toko)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function destroy(Toko $toko)
    {
        //
    }
}
