<?php

namespace App\Http\Controllers;

use App\Buddy;
use App\User;

use Illuminate\Http\Request;
use Session;
use Validator;
use Auth;

class BuddyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buddies = Buddy::latest()->get();

        return view('buddies.buddies', ['buddies' => $buddies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buddies.create');
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
            'user_id.exists' => 'De opgegeven gebruiker bestaat niet!',
            'buddy_id.exists' => 'De opgegeven gebruiker bestaat niet!',
            'relation.required' => 'Je moet een relatie ingeven!'
        ];

        $v = Validator::make($request->all(), [
            'user_id' => 'exists:users,id',
            'buddy_id' => 'exists:users,id',
            'relation' => 'required'
        ], $messages);

        $v->after(function ($v) use ($request) {
            $buddies = User::find($request->user_id)->allBuddies();
            if ($buddies->where('user_id', $request->user_id)->count() > 0
                || $buddies->where('buddy_id', $request->buddy_id)->count() > 0) {
                $v->errors()->add('duplicate', 'Deze twee zijn al drinking buddies!');
            }
            if ($request->buddy_id == $request->user_id) {
                $v->errors()->add('same_user', 'Je kan iemand niet als drinking buddy met zichzelf instellen!');
            }
        });

        if ($v->fails()) {
            return redirect('buddies/create')
                    ->withErrors($v->errors())
                    ->withInput();
        }

        $buddies = new Buddy;
        $buddies->user_id = $request->user_id;
        $buddies->buddy_id = $request->buddy_id;
        $buddies->relation = $request->relation;
        $buddies->save();

        return redirect()->route('buddies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buddie  $buddie
     * @return \Illuminate\Http\Response
     */
    public function show(Buddie $buddie)
    {
        return view('buddies.show', ['buddie' => $buddie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buddie  $buddie
     * @return \Illuminate\Http\Response
     */
    public function edit(Buddie $buddie)
    {
        return view('buddies.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buddie  $buddie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buddie $buddie)
    {
        return redirect()->route('buddies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buddie  $buddie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buddie $buddie)
    {
        $buddie->delete();

        return redirect()->route('buddies.index');
    }
}
