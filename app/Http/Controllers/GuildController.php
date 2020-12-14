<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GmUser;
use App\Models\Character;
use App\Models\CharacterClass;
use App\Models\Faction;
use App\Models\Guild;
use App\Models\GuildRole;
use App\Models\Role;
use App\Models\Server;

class GuildController extends Controller
{
    public function getGuild(Request $request, $guildId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $guild = Guild::find($guildId);

        $faction = Faction::find($guild->faction_id);
        $server = Server::find($guild->server_id);
        $player_count = Character::where('guild_id', $guild->id)->count();

        $guild->faction = $faction;
        $guild->server = $server;
        $guild->player_count = $player_count;

        return $guild;
    }

    public function getGuildMembers(Request $request, $guildId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $members = Character::where('guild_id', $guildId)->get();

        foreach ($members as $member) {
            $role = Role::find($member->role_id);
            $character_class = CharacterClass::find($member->character_class_id);
            $guild = Guild::find($member->guild_id);
            $guild_role = GuildRole::find($member->guild_role_id);
            $faction = Faction::find($member->faction_id);
            $server = Server::find($member->server_id);

            $member->role = $role;
            $member->character_class = $character_class;
            $member->guild = $guild;
            $member->guild_role = $guild_role;
            $member->faction = $faction;
            $member->server = $server;
        }

        return $members;
    }

    public function getMyGuilds(Request $request)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $characters = Character::where('gm_user_id', $user->id)->get();
        $guilds = array();
        $guildIds = array();

        foreach ($characters as $character) {
            if ($character->guild_id && !in_array($character->guild_id, $guildIds)) {
                array_push($guildIds, $character->guild_id);

                $guild = Guild::find($character->guild_id);

                $faction = Faction::find($character->faction_id);
                $server = Server::find($character->server_id);
                $player_count = Character::where('guild_id', $guild->id)->count();

                $guild->faction = $faction;
                $guild->server = $server;
                $guild->player_count = $player_count;

                array_push($guilds, $guild);
            }
        }

        return $guilds;
    }

    public function create(Request $request)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $request->validate([
            'name' => 'required',
            'creator_id' => 'required',
            'faction_id' => 'required',
            'server_id' => 'required',
        ]);

        // Check creator id
        $creator_id = $request->input('creator_id');
        $character = Character::find($creator_id);
        // The character must belong to the user and have no guild
        if (is_null($character) || $character->gm_user_id != $user->id || !is_null($character->guild_id))
            return response('Invalid character id', 500);

        $new_guild = Guild::create($request->all());
        Character::where('id', $creator_id)->update(['guild_id' => $new_guild->id, 'guild_role_id' => 1]);
    }
}
