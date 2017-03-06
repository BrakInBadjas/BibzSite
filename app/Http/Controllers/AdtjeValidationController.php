<?php

namespace App\Http\Controllers;

use App\Adtje;
use App\AdtjeValidation;
use Illuminate\Http\Request;

class AdtjeValidationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(adtje $adtje)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Adtje $adtje)
    {
        //unsupported
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Adtje $adtje, Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdtjeValidation  $validation
     * @return \Illuminate\Http\Response
     */
    public function show(Adtje $adtje, AdtjeValidation $validation)
    {
        //unsupported
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdtjeValidation  $validation
     * @return \Illuminate\Http\Response
     */
    public function edit(Adtje $adtje, AdtjeValidation $validation)
    {
        //unsupported
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdtjeValidation  $validation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adtje $adtje, AdtjeValidation $validation)
    {
        //TODO - change the 'status' of your approval
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdtjeValidation  $validation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adtje $adtje, AdtjeValidation $validation)
    {
        //unsupported
    }
}
