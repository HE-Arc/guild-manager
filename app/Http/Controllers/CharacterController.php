<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\GmUser;
use App\Models\Character;
use App\Models\CharacterClass;
use App\Models\Faction;
use App\Models\Guild;
use App\Models\GuildRole;
use App\Models\Role;
use App\Models\Server;

class CharacterController extends Controller
{
    public function getCharacter(Request $request, $characterId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $character = Character::find($characterId);

        $role = Role::find($character->role_id);
        $character_class = CharacterClass::find($character->character_class_id);
        $user = GmUser::find($character->gm_user_id);
        $guild = Guild::find($character->guild_id);
        $guild_role = GuildRole::find($character->guild_role_id);
        $faction = Faction::find($character->faction_id);
        $server = Server::find($character->server_id);

        $character->role = $role;
        $character->character_class = $character_class;
        $character->user = $user;
        $character->guild = $guild;
        $character->guild_role = $guild_role;
        $character->faction = $faction;
        $character->server = $server;

        return $character;
    }

    public function getMyCharacters(Request $request)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $characters = Character::where('gm_user_id', $user->id)->get();

        foreach ($characters as $character) {
            $role = Role::find($character->role_id);
            $character_class = CharacterClass::find($character->character_class_id);
            $guild = Guild::find($character->guild_id);
            $guild_role = GuildRole::find($character->guild_role_id);
            $faction = Faction::find($character->faction_id);
            $server = Server::find($character->server_id);

            $character->role = $role;
            $character->character_class = $character_class;
            $character->guild = $guild;
            $character->guild_role = $guild_role;
            $character->faction = $faction;
            $character->server = $server;
        }

        return $characters;
    }

    public function create(Request $request)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $request->merge([
            'gm_user_id' => $user->id,
        ]);

        $request->validate([
            'name' => 'required',
            'role_id' => 'required',
            'character_class_id' => 'required',
            'guild_id' => 'nullable',
            'guild_role_id' => 'nullable',
            'faction_id' => 'required',
            'server_id' => 'required',
        ]);

        Character::create($request->all());
    }

    public function update(Request $request)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'role_id' => 'required',
            'character_class_id' => 'required',
            'faction_id' => 'required',
            'server_id' => 'required'
        ]);

        $character = Character::find($request->id);
        // The character must exist and belong to the user
        if (is_null($character) || $character->gm_user_id != $user->id)
            return response('Invalid character', 500);

        $character->update($request->all());
    }

    public function delete(Request $request, $characterId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $character = Character::find($characterId);
        // The character must belong to the user
        if ($character->gm_user_id != $user->id)
            return response('Invalid character id', 500);

        try {
            if (Character::where('id', $characterId)->exists()) {
                $character  = Character::find($characterId);
                $characterName = $character->name;
                $character->delete();
                return response($characterName, 200);
            } else
                return response('Character does not exist', 500);
        } catch (Exception $e) {
            return response("Delete failed: " + $e, 500);
        }
    }
}
