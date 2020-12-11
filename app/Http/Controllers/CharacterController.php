<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Character;

class CharacterController extends Controller
{
    public function getMyCharacters(Request $request)
    {
        $token = $request->header('Authorization');        
        $user = User::where('id', $token)->first();

        if ($user == null)
            return response('Invalid token', 401);
        
        $characters = Character::where('user_id', $user->id)->get();

        return $characters;
    }
}
