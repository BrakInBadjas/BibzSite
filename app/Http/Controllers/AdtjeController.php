<?php

namespace App\Http\Controllers;

use App\Adtje;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;
use Validator;

class AdtjeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adtjes = Adtje::approved()->latest()->paginate(15);

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
        $messages = [
            'id.exists' => 'De opgegeven gebruiker bestaat niet!',
            'reason.required' => 'Je moet een reden ingeven!',
        ];

        $v = Validator::make($request->all(), [
            'id' => 'exists:users',
            'reason' => 'required',
        ], $messages);

        $v->after(function ($v) use ($request) {
            if (Auth::user()->id == $request->id) {
                $v->errors()->add('id', 'Je kan geen adtje uitdelen aan jezelf!');
            }
        });

        if ($v->fails()) {
            return redirect('adtjes/create')
                    ->withErrors($v->errors())
                    ->withInput();
        }

        $adtje = new Adtje;
        $adtje->user_id = $request->id;
        $adtje->added_by = auth()->user()->id;
        $adtje->reason = $request->reason;
        $adtje->save();

        $buddies = User::find($request->id)->buddies();
        foreach ($buddies as $buddy) {
            $adtje = new Adtje;
            if ($buddy->user->id == $request->id) {
                $adtje->user_id = $buddy->buddy->id;
            } else {
                $adtje->user_id = $buddy->user->id;
            }
            $adtje->added_by = auth()->user()->id;
            $adtje->reason = 'Fucked by '.User::find($request->id)->name;
            $adtje->save();
        }

        Session::flash('adtje_added->name', $adtje->user->name);
        Session::flash('adtje_added->reason', $adtje->reason);

        return redirect()->route('adtjes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Adtje  $adtje
     * @return \Illuminate\Http\Response
     */
    public function show(Adtje $adtje)
    {
        return view('adtjes.show', ['adtje' => $adtje, 'user_validation' => $adtje->validations->where('user_id', Auth::user()->id)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Adtje  $adtje
     * @return \Illuminate\Http\Response
     */
    public function edit(Adtje $adtje)
    {
        return $this->show($adtje);
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
        $adtje->reason = $request->reason;
        $adtje->save();

        return redirect()->route('adtjes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Adtje  $adtje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adtje $adtje)
    {
        $adtje->delete();

        Session::flash('adtje_deleted->name', $adtje->user->name);
        Session::flash('adtje_deleted->reason', $adtje->reason);

        return redirect()->route('adtjes.index');
    }

    public function collect(Request $request)
    {
        $adtje = Auth::user()->adtjes()->approved()->open()->oldest()->first();

        $adtje->collected = true;
        $adtje->save();

        Session::flash('adtje_collected->date', $adtje->created_at->toFormattedDateString());
        Session::flash('adtje_collected->reason', $adtje->reason);

        return redirect()->route('adtjes.index');
    }

    public function validation()
    {
        $adtjes = Adtje::shouldVote()->oldest()->paginate(15);

        return view('adtjes.validate', ['adtjes' => $adtjes]);
    }
}
