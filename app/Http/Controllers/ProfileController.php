<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;
use Validator;

class ProfileController extends Controller
{
    public function show($id)
    {
        if ($id == "me") {
            $user = User::where('id', Auth::user()->id);
        } else {
            $user = User::where('id', $id);
        }


        if (! $user->exists()) {
            return redirect()->route('home');
        }

        return view('profile.profile', ['user' => $user->first()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->show($id);
    }

    public function update(Request $request, $id){
        $user = User::where('id', $id)->firstOrFail();
        if(Auth::user() != $user){
            Session::flash('error', 'Je hebt geen toestemming om dit profiel aan te passen!');
            return redirect()->route('profile.show', $user->id);
        }
        $messages = [
            'mobile_number.regex' => "Je nummer moet beginnen met 06 en in totaal 10 tekens lang zijn."
        ];

        Validator::make($request->all(), [
            'mobile_number' => 'nullable|regex:/06-?\d{8}/',
        ], $messages)->validate();

        if($request->has('mobile_number')){
            Session::flash('success', 'De wijzigingen zijn opgeslagen!');
            $user->mobile_number = str_replace('-', '',$request->mobile_number);
        } else {
            $user->mobile_number = null;
        }

        if($request->has('address')){
            Session::flash('success', 'De wijzigingen zijn opgeslagen!');
            $user->address = $request->address;
        } else {
            $user->address = null;
        }

        $user->save();

        return redirect()->route('profile.show', $user->id);
    }           
}
