<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\GmUser;
use App\Models\Character;
use App\Models\EventCharacter;
use App\Models\Event;

class EventCharacterController extends Controller
{
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
}
