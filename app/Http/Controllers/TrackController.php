<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tracks = Track::orderBy('name')
        ->get()
        ->map(fn ($track) => [
            'id' => $track->id,
            'name' => $track->name,
            'image' => $track->image,
            'source' => $track->source,
        ]);

        return Inertia::render('Track/Index', [
            'tracks' => $tracks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Track/Create');
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
            'name' => ['required', 'string'],
            'image' => ['nullable', 'image'],
            'source' => ['nullable', 'string'],
        ]);

        Track::create($validatedData);

        return Redirect::route('track.index')->with('success', 'Track has been created...');
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        $track = [
            'name' => $track->name,
            'image' => $track->image,
            'source' => $track->source,
        ];

        return Inertia::render('Track/Edit', [
            'track' => $track,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Track $track)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'image' => ['nullable', 'image'],
            'source' => ['nullable', 'string'],
        ]);

        $track->update($validatedData);

        return Redirect::route('track.index')->with('success', 'Track updated...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function destroy(Track $track)
    {
        $track->delete();

        return redirect()->route('track.index')->with('error', 'Track deleted...');
    }
}
