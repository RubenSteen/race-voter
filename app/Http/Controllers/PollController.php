<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $polls = Poll::orderBy('created_at')
        ->get()
        ->map(fn ($poll) => [
            'id' => $poll->id,
            'name' => $poll->name,
            'race_at' => $poll->race_at ? $poll->race_at->format('F j\\, Y H:i:s') : null,
            'open_at' => $poll->open_at->format('F j\\, Y H:i:s'),
            'close_at' => $poll->close_at->format('F j\\, Y H:i:s'),
            'created_at' => $poll->created_at->format('F j\\, Y H:i:s'),
            'updated_at' => $poll->updated_at->format('F j\\, Y H:i:s'),
        ]);

        return Inertia::render('Poll/Index', [
            'polls' => $polls,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return Inertia::render('Poll/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'car.id' => ['required', 'exists:cars,id'],
            'track.id' => ['required', 'exists:tracks,id'],
        ]);

        Auth::user()->suggest()->create([
            'car_id' => $request->car['id'],
            'track_id' => $request->track['id'],
        ]);

        return Redirect::route('poll.index')->with('success', 'Poll has been created...');
    }

    /**
     * Display a specified resource.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        $poll->map(fn ($poll) => [
            'id' => $poll->id,
            'name' => $poll->name,
            'race_at' => $poll->race_at,
            'open_at' => $poll->open_at,
            'close_at' => $poll->close_at,
            'created_at' => $poll->created_at,
            'updated_at' => $poll->updated_at,
        ]);

        return Inertia::render('Poll/Index', [
            'poll' => $poll,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poll  $poll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll)
    {
        $poll->delete();

        return redirect()->route('poll.index')->with('error', 'Poll deleted...');
    }
}
