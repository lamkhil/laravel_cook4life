<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Http\Requests\StoreNotifikasiRequest;
use App\Http\Requests\UpdateNotifikasiRequest;

class NotifikasiController extends Controller
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
     * @param  \App\Http\Requests\StoreNotifikasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotifikasiRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Notifikasi $notifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Notifikasi $notifikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNotifikasiRequest  $request
     * @param  \App\Models\Notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotifikasiRequest $request, Notifikasi $notifikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notifikasi $notifikasi)
    {
        //
    }
}
