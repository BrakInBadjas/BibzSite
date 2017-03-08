<?php

namespace App\Http\Controllers;

use App\Adtje;
use App\AdtjeValidation;
use Auth;
use Illuminate\Http\Request;
use Session;
use Validator;

class AdtjeValidationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(adtje $adtje)
    {
        //unsupported
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
        Validator::make($request->all(), [
            'status' => 'in:'.AdtjeValidation::APPROVE.','.AdtjeValidation::NULL.','.AdtjeValidation::DENY,
        ])->validate();

        $av = new AdtjeValidation();
        $av->validator()->associate(Auth::user());
        $av->status = $request->status == 'null' ? null : $request->status;
        $av->adtje()->associate($adtje);
        $av->save();

        $status_locale = null;
        if($request->status == AdtjeValidation::APPROVE) {
            $status_locale = 'Je hebt dit adtje nu goedgekeurd!';
        } else if($request->status == AdtjeValidation::NULL) {
            $status_locale = 'Jouw status van dit adtje wordt niet meer meegeteld.';
        } else if($request->status == AdtjeValidation::DENY) {
            $status_locale = 'Je hebt dit adtje nu afgekeurd!';
        }
        Session::flash('adtje_validation', $status_locale);

        return redirect()->route('adtjes.show', ['adtje' => $adtje->id]);
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
        Validator::make($request->all(), [
            'status' => 'in:'.AdtjeValidation::APPROVE.','.AdtjeValidation::NULL.','.AdtjeValidation::DENY,
        ])->validate();

        $validation->status = $request->status == 'null' ? null : $request->status;
        $validation->save();

        if($adtje->denied){
            $adtje->delete();
            Session::flash('adtje_deleted', 'Dit adtje is nu verwijderd door een te groot aantal afwijzingen!');
            return redirect()->route('adtjes.index');
        }

        $status_locale = null;
        if($request->status == AdtjeValidation::APPROVE) {
            $status_locale = 'Je hebt dit adtje nu goedgekeurd!';
        } else if($request->status == AdtjeValidation::NULL) {
            $status_locale = 'Jouw status van dit adtje wordt niet meer meegeteld.';
        } else if($request->status == AdtjeValidation::DENY) {
            $status_locale = 'Je hebt dit adtje nu afgekeurd!';
        }
        Session::flash('adtje_validation', $status_locale);

        return redirect()->route('adtjes.show', ['adtje' => $adtje->id]);
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
