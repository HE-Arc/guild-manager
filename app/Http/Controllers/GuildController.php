<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Character;
use App\Models\Guild;

class GuildController extends Controller
{
    public function getMyGuilds(Request $request)
    {
        $token = $request->header('Authorization');
        $user = User::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $characters = Character::where('user_id', $user->id)->get();
        $guilds = array();
        $guildIds = array();

        foreach ($characters as $character) {
            if (!in_array($character->guild_id, $guildIds)) {
                array_push($guildIds, $character->guild_id);

                $guild = Guild::find($character->guild_id);
                array_push($guilds, $guild);
            }
        }

        return $guilds;
    }
}
