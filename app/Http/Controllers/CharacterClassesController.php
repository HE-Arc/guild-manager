<?php

namespace App\Http\Controllers;

use App\Models\CharacterClass;
use Illuminate\Http\Request;

class CharacterClassesController extends Controller
{
    public function getCharacterClasses(Request $request)
    {   
        $characterClasses = CharacterClass::get();

        return $characterClasses;
    }
}
