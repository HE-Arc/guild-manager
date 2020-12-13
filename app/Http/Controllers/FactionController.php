<?php

namespace App\Http\Controllers;

use App\Models\Faction;
use Illuminate\Http\Request;

class FactionController extends Controller
{
    public function getFactions(Request $request)
    {   
        $factions = Faction::get();

        return $factions;
    }
}
