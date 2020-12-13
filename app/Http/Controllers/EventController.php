<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\GmUser;
use App\Models\Character;
use App\Models\EventCharacter;
use App\Models\Event;
use App\Models\Location;

class EventController extends Controller
{
    public function getEvent(Request $request, $id)
    {
        $token = $request->header('Authorization');
        $user = GmUser::where('id', $token)->first();

        if ($user == null)
            return response('Invalid token', 401);

        $eventRaw = Event::where('id', $id)->first();

        $event = array();

        $location = Location::find($eventRaw->location_id);
        $nbSubscribed = EventCharacter::where('event_id', $eventRaw->id)
                            ->where('absent', 0)->count();

        $event = array(
            "id" => $eventRaw->id,
            "name" => $eventRaw->name,
            "location" => $location->name,
            "date" => date('d-m-Y', strtotime($eventRaw->date)),
            "deadline" => date('d-m-Y', strtotime($eventRaw->deadline)),
            "nbSubscribed" => $nbSubscribed,
            "maxSubscribed" => $eventRaw->player_count
        );
       
        return $event;
    }

    public function deleteEvent(Request $request, $eventId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::where('id', $token)->first();

        if ($user == null)
            return response('Invalid token', 401);
        
        // TODO check if the character who created the event belongs to the users
        $eventName = "";
        
        try {
            if (Event::where('id', $eventId)->exists()) {
                $eventName  = Event::find($eventId)['name'];
                $event = Event::find($eventId);                           
                Schema::disableForeignKeyConstraints();
                //$event->delete();
                Schema::enableForeignKeyConstraints();                
            } else
                return response('Event does not exist', 500);

            return response($eventName, 200);
        } catch (Exception $e) {
            return response("Delete failed: " + $e, 500);
        }
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
