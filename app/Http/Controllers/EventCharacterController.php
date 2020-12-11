<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\GmUser;
use App\Models\Character;
use App\Models\EventCharacter;
use App\Models\Event;
use App\Models\Role;
use App\Models\CharacterClass;

class EventCharacterController extends Controller
{
    public function getCharactersByEvent(Request $request, $eventId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::where('id', $token)->first();

        if ($user == null)
            return response('Invalid token', 401);

        $eventCharacters = EventCharacter::where('event_id', $eventId)->get();

        $characters = array();
        $rosterCharacters = array();
        $benchCharacters = array();

        foreach ($eventCharacters as $eventCharacter) {
            $characterRaw = Character::where('id', $eventCharacter->character_id)->first();
            $role = Role::where('id', $characterRaw->role_id)->first();
            $class = CharacterClass::where('id', $characterRaw->class_id)->first();

            $character = array(
                "id" => $characterRaw->id,
                "name" => $characterRaw->name,
                "role" => $role->name,
                "class" => $class->name
            );

            if ($eventCharacter->bench)
                array_push($benchCharacters, $character);
            else
                array_push($rosterCharacters, $character);

            array_push($characters, $character);
        }

        $characters = array(
            'roster' => $rosterCharacters,
            'bench' => $benchCharacters,
        );

        return $characters;
    }

    public function subscribe(Request $request, $characterId, $eventId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $character = Character::find($characterId);
        // The character must belong to the user
        if ($character->user_id != $user->id)
            return response('Invalid character id', 500);

        $event = Event::find($eventId);
        // The character must belong to the guild which hosts the event
        if ($event->guild_id != $character->guild_id)
            return response('Invalid event id', 500);

        // Create subscription or update it
        try {
            if (!EventCharacter::where('event_id', $event->id)->where('character_id', $character->id)->exists()) {
                $subscribtion = new EventCharacter();
                $subscribtion->event_id = $event->id;
                $subscribtion->character_id = $character->id;
                $subscribtion->bench = 0;
                $subscribtion->absent = 0;
                $subscribtion->save();
            } else
                EventCharacter::where('event_id', $event->id)->where('character_id', $character->id)->update(['absent' => 0]);

            return response("Subscribed successfully", 200);
        } catch (Exception $e) {
            return response("Subscribtion failed: " + $e, 500);
        }
    }

    public function skip(Request $request, $characterId, $eventId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $character = Character::find($characterId);
        // The character must belong to the user
        if ($character->user_id != $user->id)
            return response('Invalid character id', 500);

        $event = Event::find($eventId);
        // The character must belong to the guild which hosts the event
        if ($event->guild_id != $character->guild_id)
            return response('Invalid event id', 500);

        // Create subscription or update it
        try {
            if (!EventCharacter::where('event_id', $event->id)->where('character_id', $character->id)->exists()) {
                $subscribtion = new EventCharacter();
                $subscribtion->event_id = $event->id;
                $subscribtion->character_id = $character->id;
                $subscribtion->bench = 0;
                $subscribtion->absent = 1;
                $subscribtion->save();
            } else
                EventCharacter::where('event_id', $event->id)->where('character_id', $character->id)->update(['absent' => 1]);

            return response("Skipped successfully", 200);
        } catch (Exception $e) {
            return response("Skip failed: " + $e, 500);
        }
    }

    public function bench(Request $request, $characterId, $eventId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $character = Character::find($characterId);
        // The character must belong to the user
        if ($character->user_id != $user->id)
            return response('Invalid character id', 500);

        //TODO check if character is subscribed to the event


        // Update bench
        try {
            if (EventCharacter::where('event_id', $eventId)->where('character_id', $characterId)->exists()) {
                EventCharacter::where('event_id', $eventId)->where('character_id', $characterId)->update(['bench' => 1]);
            } else
                return response('Character does not exist', 500);

            return response("Benched successfully", 200);
        } catch (Exception $e) {
            return response("Bench failed: " + $e, 500);
        }
    }

    public function unbench(Request $request, $characterId, $eventId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $character = Character::find($characterId);
        // The character must belong to the user
        if ($character->user_id != $user->id)
            return response('Invalid character id', 500);

        //TODO check if character is subscribed to the event

        // Update bench
        try {
            if (EventCharacter::where('event_id', $eventId)->where('character_id', $characterId)->exists()) {
                EventCharacter::where('event_id', $eventId)->where('character_id', $characterId)->update(['bench' => 0]);
            } else
                return response('Character does not exist', 500);

            return response("Unbenched successfully", 200);
        } catch (Exception $e) {
            return response("Unbench failed: " + $e, 500);
        }
    }
}
