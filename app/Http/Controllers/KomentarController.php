<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Http\Requests\StoreKomentarRequest;
use App\Http\Requests\UpdateKomentarRequest;
use App\Http\Resources\KomentarResource;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return KomentarResource::collection(
            Komentar::latest()->where('resep_id', '=', $id)->get());
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
     * @param  \App\Http\Requests\StoreKomentarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKomentarRequest $request)
    {
        $user = $request->user();
        Komentar::create([
           'resep_id'=> $request->resep_id,
           'user_id'=>$user->id,
           'komentar'=>$request->komentar
        ]);


        return KomentarResource::collection(
            Komentar::latest()->where(['resep_id','=',$request->resep_id])->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Komentar  $komentar
     * @return \Illuminate\Http\Response
     */
    public function show(Komentar $komentar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Komentar  $komentar
     * @return \Illuminate\Http\Response
     */
    public function edit(Komentar $komentar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKomentarRequest  $request
     * @param  \App\Models\Komentar  $komentar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKomentarRequest $request, Komentar $komentar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Komentar  $komentar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Komentar $komentar)
    {
        $komentar->delete();
        return KomentarResource::collection(
            Komentar::latest()->where('resep_id','=',$komentar->resep_id)->get()
        );
    }
}
