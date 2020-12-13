<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GmUser;
use App\Models\Character;

class CharacterController extends Controller
{
    public function getMyCharacters(Request $request)
    {
        $token = $request->header('Authorization');
        
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $characters = Character::where('gm_user_id', $user->id)->get();

        return $characters;
    }
}
