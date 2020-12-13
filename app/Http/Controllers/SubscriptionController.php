<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Character;
use App\Models\Subscription;
use App\Models\Event;
use App\Models\Role;
use App\Models\CharacterClass;

class SubscriptionController extends Controller
{
    public function getSubscriptions(Request $request, $eventId)
    {
        $token = $request->header('Authorization');
        $user = User::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $subscriptions = Subscription::where('event_id', $eventId)->get();

        $rosterCharacters = array();
        $benchCharacters = array();
        $absentCharacters = array();

        foreach ($subscriptions as $subscription) {
            $character = Character::find($subscription->character_id);
            $role = Role::find($character->role_id);
            $class = CharacterClass::find($character->character_class_id);

            $character->role = $role;
            $character->class = $class;

            if ($subscription->absent)
                array_push($absentCharacters, $character);
            else {
                if ($subscription->bench)
                    array_push($benchCharacters, $character);
                else
                    array_push($rosterCharacters, $character);
            }
        }

        $characters = array(
            'roster' => $rosterCharacters,
            'bench' => $benchCharacters,
            'absent' => $absentCharacters,
        );

        return $characters;
    }

    public function subscribe(Request $request, $characterId, $eventId)
    {
        $token = $request->header('Authorization');
        $user = User::find($token);
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
            if (!Subscription::where('event_id', $event->id)->where('character_id', $character->id)->exists()) {
                $subscribtion = new Subscription();
                $subscribtion->event_id = $event->id;
                $subscribtion->character_id = $character->id;
                $subscribtion->bench = 0;
                $subscribtion->absent = 0;
                $subscribtion->save();
            } else
                Subscription::where('event_id', $event->id)->where('character_id', $character->id)->update(['absent' => 0]);

            return response("Subscribed successfully", 200);
        } catch (Exception $e) {
            return response("Subscribtion failed: " + $e, 500);
        }
    }

    public function skip(Request $request, $characterId, $eventId)
    {
        $token = $request->header('Authorization');
        $user = User::find($token);
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
            if (!Subscription::where('event_id', $event->id)->where('character_id', $character->id)->exists()) {
                $subscribtion = new Subscription();
                $subscribtion->event_id = $event->id;
                $subscribtion->character_id = $character->id;
                $subscribtion->bench = 0;
                $subscribtion->absent = 1;
                $subscribtion->save();
            } else
                Subscription::where('event_id', $event->id)->where('character_id', $character->id)->update(['absent' => 1]);

            return response("Skipped successfully", 200);
        } catch (Exception $e) {
            return response("Skip failed: " + $e, 500);
        }
    }
}
