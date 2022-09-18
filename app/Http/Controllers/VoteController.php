<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggest;
use Auth;
use Illuminate\Support\Facades\Redirect;

class VoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Suggest $suggest)
    {
        Auth::user()->removeVote();

        Auth::user()->vote()->create([
            'suggest_id' => $suggest->id
        ]);

        return Redirect::route('suggest.index')->with('success', 'Your vote has been submitted...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vote  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Auth::user()->removeVote();

        return redirect()->route('suggest.index')->with('error', 'Your vote has been deleted...');
    }
}
