<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

class ProfileController extends Controller
{
    public function index($id) {
        if ($id == "me") {
            $user = User::where('id', Auth::user()->id);
        } else {
            $user = User::where('id', $id);
        }


        if (!$user->exists()) {
            return redirect()->route('home');
        }

        return view('profile.profile', ['user' => $user->first()]);
    }
}
