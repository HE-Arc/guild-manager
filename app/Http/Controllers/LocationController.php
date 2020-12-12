<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function getLocations(Request $request)
    {   
        $locations = Location::get();

        return $locations;
    }
}
