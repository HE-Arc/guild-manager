<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\GmUser;
use App\Models\Character;
use App\Models\Subscription;
use App\Models\Event;
use App\Models\Location;

class EventController extends Controller
{
    public function getEvent(Request $request, $eventId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $event = Event::find($eventId);
        $location = Location::find($event->location_id);
        $subscriptionCount = Subscription::where('event_id', $event->id)->where('absent', false)->count();

        $event->location = $location;
        $event->formated_date = date('d-m-Y', strtotime($event->date));
        $event->formated_subscription_delay = date('d-m-Y', strtotime($event->subscription_delay));
        $event->subscription_count = $subscriptionCount;

        return $event;
    }

    public function run(Request $request, $eventId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            //return response('Invalid token', 401);

        
        
        try {
            if ($event = Event::find($eventId)) {
                $event->status = 'running';
                $event->save();
            } else
                return response('Event does not exist', 500);

            return response($eventId, 200);
        } catch (Exception $e) {
            return response("Delete failed: " + $e, 500);
        }
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
                $event->delete();
            } else
                return response('Event does not exist', 500);

            return response($eventName, 200);
        } catch (Exception $e) {
            return response("Delete failed: " + $e, 500);
        }
    }

    public function getCharacterSubscriptions(Request $request, $characterId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $character = Character::find($characterId);
        // The character must belong to the user
        if ($character->gm_user_id != $user->id)
            return response('Invalid character id', 500);

        $events = Event::where('guild_id', $character->guild_id)->get();

        foreach ($events as $event) {
            $location = Location::find($event->location_id);
            $subscribtion = Subscription::where('event_id', $event->id)->where('character_id', $character->id)->first();
            $subscriptionCount = Subscription::where('event_id', $event->id)->where('absent', false)->count();

            $event->location = $location;
            $event->formated_date = date('d-m-Y', strtotime($event->date));
            $event->formated_subscription_delay = date('d-m-Y', strtotime($event->subscription_delay));
            $event->subscription_count = $subscriptionCount;
            $event->subscribed = $subscribtion ? true : false;
            $event->skipped = $subscribtion ? $subscribtion->absent : false;
        }

        return $events;
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
            'date' => 'required',
            'subscription_delay' => 'required',
            'player_count' => 'required',
            'auto_bench' => 'required',
            'status' => 'required',
            'password' => 'nullable',
            'guild_id' => 'required',
            'location_id' => 'required',
        ]);

        Event::create($request->all());
    }
}
