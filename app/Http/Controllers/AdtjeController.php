<?php

namespace App\Http\Controllers;

use App\Adtje;

use Illuminate\Http\Request;

class AdtjeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adtjes = Adtje::latest()->get();

        return view('adtjes.adtjes', ['adtjes' => $adtjes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adtjes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Adtje  $adtje
     * @return \Illuminate\Http\Response
     */
    public function show(Adtje $adtje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Adtje  $adtje
     * @return \Illuminate\Http\Response
     */
    public function edit(Adtje $adtje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Adtje  $adtje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adtje $adtje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Adtje  $adtje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adtje $adtje)
    {
        //
    }
}
