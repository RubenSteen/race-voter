<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cars = Car::orderBy('name')
        ->get()
        ->map(fn ($car) => [
            'id' => $car->id,
            'name' => $car->name,
            'image' => $car->getImage(),
            'source' => $car->source,
        ]);

        return Inertia::render('Car/Index', [
            'cars' => $cars,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Car/Create');
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
            'source' => ['nullable', 'url'],
        ]);

        car::create($validatedData);

        return Redirect::route('car.index')->with('success', 'car has been created...');
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        $car = [
            'id' => $car->id,
            'name' => $car->name,
            'image' => $car->image,
            'source' => $car->source,
        ];

        return Inertia::render('Car/Edit', [
            'car' => $car,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'image' => ['nullable', 'image'],
            'source' => ['nullable', 'url'],
        ]);

        $car->update($validatedData);

        return Redirect::route('car.index')->with('success', 'car updated...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('car.index')->with('error', 'car deleted...');
    }
}
