<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Character;
use App\Models\Subscription;
use App\Models\Event;
use App\Models\Location;

class EventController extends Controller
{
    public function getCharacterSubscriptions(Request $request, $characterId)
    {
        $token = $request->header('Authorization');
        $user = User::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $character = Character::find($characterId);
        // The character must belong to the user
        if ($character->user_id != $user->id)
            return response('Invalid character id', 500);

        $eventsRaw = Event::where('guild_id', $character->guild_id)->get();
        $events = array();

        foreach ($eventsRaw as $eventRaw) {
            $location = Location::where('id', $eventRaw->location_id)->first();
            $subscribtion = Subscription::where('event_id', $eventRaw->id)->where('character_id', $character->id)->first();

            // Subscriptions count
            $subscribedList = Subscription::where('event_id', $eventRaw->id)->where('absent', false)->get();
            $subscribedCount = $subscribedList->count();

            $event = array(
                "id" => $eventRaw->id,
                "name" => $eventRaw->name,
                "location" => $location,
                "date" => date('d-m-Y', strtotime($eventRaw->date)),
                "delay" => date('d-m-Y', strtotime($eventRaw->subscription_delay)),
                "playerCount" => array("subscribed" => $subscribedCount, "size" => $eventRaw->player_count),
                "subscribed" => $subscribtion ? true : false,
                "skipped" => $subscribtion ? $subscribtion->absent : false,
            );
            array_push($events, $event);
        }

        return $events;
    }

    public function create(Request $request)
    {
        $token = $request->header('Authorization');
        $user = User::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'subscription_delay' => 'required',
            'player_count' => 'required',
            'auto_bench' => 'required',
            'password' => 'required',
            'guild_id' => 'required',
            'location_id' => 'required',
        ]);

        Event::create($request->all());
    }
}
