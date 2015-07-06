<?php

namespace App\Http\Controllers;

use App\Places;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlacesController extends Controller
{

    /**
     * Defining the constructor
     */
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['getMyPlaceJSON'],
        ]);
    }

    /**
     * Get the user's places page where he can add new places
     * and view his current list of places.
     *
     * @return view
     */
    public function getMyPlacesList()
    {
        return view('places.add-place');
    }

    public function getMapIframe()
    {
        return view('places.map-partial');
    }

    public function saveUserLocation(Request $request)
    {
        Places::create([
            'user_id' => Auth::user()->id,
            'name' => $request->input('address'),
            'type' => $request->input('location_type'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);
    }

    public function getMyPlaceJSON()
    {
        return Places::get();
    }
}
