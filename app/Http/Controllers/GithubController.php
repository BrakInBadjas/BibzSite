<?php

namespace App\Http\Controllers;

use Auth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Session;
use Validator;

class GithubController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $previousUrl = app('url')->previous();
        $v = Validator::make($request->all(), [
            'bugUrl' => 'required',
            'bugTitle' => 'required',
            'bugText' => 'required',
        ]);

        if ($v->fails()) {
            Session::flash('open-bug-modal', true);

            return redirect()
                ->back()
                ->withErrors($v->errors())
                ->withInput();
        }

        $parameters = [
            'headers' => ['Accept' => 'application/vnd.github.v3+json'],
            'json' => [
                'title' => $request->bugTitle,
                'body' => ' <h1>Bug</h1>
                            <table>
                                <tr><th>Page</th><td><a href="'.$request->bugUrl.'">'.$request->bugUrl.'</a></td></tr>
                                <tr><th>Authenticated</th><td>'.(Auth::check() ? 'True' : 'False').'</td></tr>'
                                .(Auth::check() ? '<tr><th>User</th><td>'.Auth::user()->name.'</td></tr>' : '').
                            '</table>                            
                            <h3>Description</h3>'.$request->bugText,
                'labels' => [
                    'bug',
                ],
            ],
        ];

        $client = new Client();
        //dd(json_encode($parameters));
        $res = null;
        try {
            $res = $client->post('https://api.github.com/repos/'.env('GITHUB_URL').'/issues?access_token='.env('GITHUB_TOKEN'), $parameters);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Session::flash('bug-submission', ['status' => 'error', 'message' => 'There was an error posting your submission!']);
        }

        if (isset($res) && $res->getStatusCode() == 201) {
            Session::flash('bug-submission', ['status' => 'success', 'message' => 'Your bug has been submitted!']);
        } else {
            Session::flash('bug-submission', ['status' => 'error', 'message' => 'There was an error posting your submission!']);
        }

        return redirect()
                ->back();
    }
}
