<?php

namespace App\Http\Controllers;

use App\Models\Langkah;
use App\Http\Requests\StoreLangkahRequest;
use App\Http\Requests\UpdateLangkahRequest;

class LangkahController extends Controller
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
     * @param  \App\Http\Requests\StoreLangkahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLangkahRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Langkah  $langkah
     * @return \Illuminate\Http\Response
     */
    public function show(Langkah $langkah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Langkah  $langkah
     * @return \Illuminate\Http\Response
     */
    public function edit(Langkah $langkah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLangkahRequest  $request
     * @param  \App\Models\Langkah  $langkah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLangkahRequest $request, Langkah $langkah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Langkah  $langkah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Langkah $langkah)
    {
        //
    }
}
