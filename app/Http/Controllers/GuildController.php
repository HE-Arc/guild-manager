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
            $gm_user = GmUser::find($member->gm_user_id);
            $role = Role::find($member->role_id);
            $character_class = CharacterClass::find($member->character_class_id);
            $guild = Guild::find($member->guild_id);
            $guild_role = GuildRole::find($member->guild_role_id);
            $faction = Faction::find($member->faction_id);
            $server = Server::find($member->server_id);

            $member->gm_user = $gm_user;
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

                $faction = Faction::find($guild->faction_id);
                $server = Server::find($guild->server_id);
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

    public function update(Request $request)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'actor_id' => 'required',
            'faction_id' => 'required',
            'server_id' => 'required',
        ]);

        $guild = Guild::find($request->id);
        // The guild must exist
        if (is_null($guild))
            return response('Invalid guild id', 500);

        // Check creator id
        $actor_id = $request->input('actor_id');
        $character = Character::find($actor_id);
        // The character must belong to the user and have a master role within the guild
        if (is_null($character) || $character->gm_user_id != $user->id || $character->guild_id != $guild->id || $character->guild_role_id != 1)
            return response('Invalid character', 500);

        $guild->update($request->all());
    }

    public function delete(Request $request, $guildId, $actorId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $actor = Character::find($actorId);
        // The actor must belong to the user and to the guild
        if (is_null($actor) || $actor->gm_user_id != $user->id || $actor->guild_id != $guildId)
            return response('Invalid actor id', 500);

        // The actor must have enough rights
        if ($actor->guild_role_id != 1)
            return response('Not enough rights', 500);

        // Delete
        try {
            if (Guild::where('id', $guildId)->exists()) {
                $guild  = Guild::find($guildId);
                $guildName = $guild->name;
                $guild->delete();
                return response($guildName, 200);
            } else
                return response('Guild does not exist', 500);
        } catch (Exception $e) {
            return response("Delete failed: " + $e, 500);
        }
    }

    public function join(Request $request, $guildId, $characterId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $character = Character::find($characterId);
        // The character must belong to the user
        if ($character->gm_user_id != $user->id)
            return response('Invalid character id', 500);

        // The character must belong to no guild
        if (!is_null($character->guild_id))
            return response('Invalid character', 500);

        $guild = Guild::find($guildId);
        if (is_null($guild))
            return response('Invalid guild id', 401);

        // Join guild
        $character->guild_id = $guild->id;
        $character->guild_role_id = 3;
        $character->save();
    }

    public function quit(Request $request, $guildId, $characterId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $character = Character::find($characterId);
        // The character must belong to the user
        if ($character->gm_user_id != $user->id)
            return response('Invalid character id', 500);

        // The character must belong to the guild
        if ($character->guild_id != $guildId)
            return response('Invalid character', 500);

        $guild = Guild::find($guildId);
        if (is_null($guild))
            return response('Invalid guild id', 401);

        // Quit guild
        $character->guild_id = null;
        $character->guild_role_id = null;
        $character->save();
    }

    public function kick(Request $request, $guildId, $actorId, $targetId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $kicker = Character::find($actorId);
        // The kicker must belong to the user and to the guild
        if (is_null($kicker) || $kicker->gm_user_id != $user->id || $kicker->guild_id != $guildId)
            return response('Invalid kicker id', 500);

        $kicked = Character::find($targetId);
        // The kicked must belong to the guild
        if (is_null($kicked) || $kicked->guild_id != $guildId)
            return response('Invalid kicked id', 500);

        // The kicker must have enough rights
        if ($kicker->guild_role_id > 1 && $kicker->guild_role_id >= $kicked->guild_role_id)
            return response('Not enough rights', 500);

        $guild = Guild::find($guildId);
        if (is_null($guild))
            return response('Invalid guild id', 401);

        // Kick from guild
        $kicked->guild_id = null;
        $kicked->guild_role_id = null;
        $kicked->save();
    }

    public function promote(Request $request, $guildId, $actorId, $targetId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $promoter = Character::find($actorId);
        // The promoter must belong to the user and to the guild
        if (is_null($promoter) || $promoter->gm_user_id != $user->id || $promoter->guild_id != $guildId)
            return response('Invalid promoter id', 500);

        $promoted = Character::find($targetId);
        // The promoted must belong to the guild and be promotable
        if (is_null($promoted) || $promoted->guild_id != $guildId || $promoted->guild_role_id == 1)
            return response('Invalid promoted id', 500);

        // The promoter must have enough rights
        if ($promoter->guild_role_id > 1 && $promoter->guild_role_id >= $promoted->guild_role_id)
            return response('Not enough rights', 500);

        $guild = Guild::find($guildId);
        if (is_null($guild))
            return response('Invalid guild id', 401);

        // Promote
        $promoted->guild_role_id = $promoted->guild_role_id - 1;
        $promoted->save();
    }

    public function demote(Request $request, $guildId, $actorId, $targetId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $demoter = Character::find($actorId);
        // The demoter must belong to the user and to the guild
        if (is_null($demoter) || $demoter->gm_user_id != $user->id || $demoter->guild_id != $guildId)
            return response('Invalid demoter id', 500);

        $demoted = Character::find($targetId);
        // The demoted must belong to the guild and be demotable
        if (is_null($demoted) || $demoted->guild_id != $guildId || $demoted->guild_role_id == 3)
            return response('Invalid demoted id', 500);

        // The demoter must have enough rights
        if ($demoter->guild_role_id > 1 && $demoter->guild_role_id >= $demoted->guild_role_id)
            return response('Not enough rights', 500);

        $guild = Guild::find($guildId);
        if (is_null($guild))
            return response('Invalid guild id', 401);

        // Promote
        $demoted->guild_role_id = $demoted->guild_role_id + 1;
        $demoted->save();
    }
}
