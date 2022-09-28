<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use App\Models\Car;
use App\Models\Suggest;
use Inertia\Inertia;
use Auth;
use Illuminate\Support\Facades\Redirect;

class SuggestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $suggests = Suggest::orderBy('car_id')
        ->with('car', 'track')
        ->get()
        ->map(fn ($suggest) => [
            'id' => $suggest->id,
            'car' => [
                'name' => $suggest->car->name,
                'image' => $suggest->car->image,
                'source' => $suggest->car->source,
            ],
            'track' => [
                'name' => $suggest->track->name,
                'image' => $suggest->track->image,
                'source' => $suggest->track->source,
            ],
        ]);

        return Inertia::render('Suggest/Index', [
            'suggests' => $suggests,
            'vote' => $user->vote()->exists() ? $user->vote : null,
            'my_suggest' => $user->suggest()->exists() ? $user->suggest : null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->suggest()->exists()) {
            redirect()->route('suggest.index');
        }

        $tracks = Track::orderBy('name')
        ->get()
        ->map(fn ($track) => [
            'id' => $track->id,
            'name' => $track->name,
            'image' => $track->image,
            'source' => $track->source,
            'dlc' => $track->dlc,
            'mod' => $track->mod,
        ]);

        $cars = Car::orderBy('name')
        ->get()
        ->map(fn ($car) => [
            'id' => $car->id,
            'name' => $car->name,
            'image' => $car->image,
            'source' => $car->source,
            'dlc' => $car->dlc,
            'mod' => $car->mod,
        ]);
        

        return Inertia::render('Suggest/Create', [
            'tracks' => $tracks,
            'cars' => $cars,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->suggest()->exists()) {
            redirect()->route('suggest.index');
        }

        $validatedData = $request->validate([
            'car.id' => ['required', 'exists:cars,id'],
            'track.id' => ['required', 'exists:tracks,id'],
        ]);

        Auth::user()->suggest()->create([
            'car_id' => $request->car['id'],
            'track_id' => $request->track['id'],
        ]);

        return Redirect::route('suggest.index')->with('success', 'Suggestion has been created...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suggest  $track
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Auth::user()->suggest()->delete();

        return redirect()->route('suggest.index')->with('error', 'Suggestion deleted...');
    }
}
