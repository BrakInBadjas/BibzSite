<?php

namespace App\Http\Controllers;

use Adtje;
use Carbon\Carbon;
use Quote;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newAdtjes = Adtje::where('created_at', '>=', Carbon::today())->count();
        $newQuotes = Quote::where('created_at', '>=', Carbon::today())->count();

        return view('home')->with([
            'new_adtjes'=> $newAdtjes,
            'new_quotes'=> $newQuotes,
        ]);
    }
}
