<?php

namespace App\Http\Controllers;

use App\User;
use Auth;

class ProfileController extends Controller
{
    public function index($id)
    {
        if ($id == "me") {
            $user = User::where('id', Auth::user()->id)->firstOrFail();
        } else {
            $user = User::where('id', $id)->firstOrFail();
        }


        if (! $user->exists()) {
            return redirect()->route('home');
        }

        return view('profile.profile', ['user' => $user]);
    }
}
