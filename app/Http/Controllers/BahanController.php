<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Http\Requests\StoreBahanRequest;
use App\Http\Requests\UpdateBahanRequest;
use App\Http\Resources\BahanResource;

class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreBahanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBahanRequest $request)
    {
        $request->validate([
            'resep_id' => 'required',
            'toko_id' => 'required',
            'nama_bahan' => 'required',
            'harga' =>'required'
        ]);
        $bahan = Bahan::create(
            [
                'resep_id' => $request->resep_id,
                'toko_id' => $request->toko_id,
                'nama_bahan' => $request->nama_bahan,
                'harga' => $request->harga,
            ]
        );
        return BahanResource::make($bahan)->additional([
                'message' => 'success'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function show(Bahan $bahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function edit(Bahan $bahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBahanRequest  $request
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBahanRequest $request, Bahan $bahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bahan $bahan)
    {
        //
    }
}
