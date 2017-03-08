<?php

namespace App\Http\Controllers;

use App\Quote;
use Auth;
use Illuminate\Http\Request;
use Session;
use Validator;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::latest()->paginate(15);

        return view('quotes.quotes', ['quotes' => $quotes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quotes.create');
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
            'quote.required' => 'Je moet een quote ingeven!',
        ];

        $v = Validator::make($request->all(), [
            'id' => 'exists:users',
            'quote' => 'required',
        ], $messages);

        $v->after(function ($v) use ($request) {
            if (Auth::user()->id == $request->id) {
                $v->errors()->add('id', 'Je kan geen Quote van jezelf toevoegen!');
            }
        });

        if ($v->fails()) {
            return redirect('quotes/create')
                    ->withErrors($v->errors())
                    ->withInput();
        }

        $quote = new Quote;
        $quote->user_id = $request->id;
        $quote->quote = $request->quote;
        $quote->save();

        Session::flash('quote_added->name', $quote->user->name);
        Session::flash('quote_added->quote', $quote->quote);

        return redirect()->route('quotes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        return view('quotes.show', ['quote' => $quote]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit(Quote $quote)
    {
        return view('quotes.show', ['quote' => $quote]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quote $quote)
    {
        $quote->quote = $request->quote;
        $quote->save();

        return redirect()->route('quotes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        Session::flash('quote_deleted->name', $quote->user->name);
        Session::flash('quote_deleted->quote', $quote->quote);

        $quote->delete();

        return redirect()->route('quotes.index');
    }
}
