<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GmUser;
use App\Models\Character;
use App\Models\EventCharacter;
use App\Models\Event;
use App\Models\Location;

class EventController extends Controller
{
    public function getEvent(Request $request, $id)
    {
        $event = Event::where('id', $id)->first();

        return $event;
    }

    public function getCharacterEvents(Request $request, $characterId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::where('id', $token)->first();

        if ($user == null)
            return response('Invalid token', 401);

        $character = Character::where('id', $characterId)->first();

        // The character must belong to the user
        if ($character->user_id != $user->id)
            return response('Invalid character id', 500);

        $eventsRaw = Event::where('guild_id', $character->guild_id)->get();
        $events = array();

        foreach ($eventsRaw as $eventRaw) {
            $location = Location::where('id', $eventRaw->location_id)->first();
            $subscribtion = EventCharacter::where('event_id', $eventRaw->id)->where('character_id', $character->id)->first();

            $event = array(
                "id" => $eventRaw->id,
                "name" => $eventRaw->name,
                "location" => $location,
                "date" => date('d-m-Y', strtotime($eventRaw->date)),
                "subscribed" => $subscribtion ? true : false,
                "skipped" => $subscribtion ? $subscribtion->absent : false,
            );
            array_push($events, $event);
        }

        return $events;
    }
}
