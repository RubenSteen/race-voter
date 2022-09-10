<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use App\Models\Car;
use App\Models\Suggest;
use Inertia\Inertia;
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
        $suggests = Suggest::orderBy('car_id')
        ->with('car', 'track')
        ->get()
        ->map(fn ($suggest) => [
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
        ]);
    }
}
