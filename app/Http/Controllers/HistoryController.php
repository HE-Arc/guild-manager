<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GmUser;
use App\Models\Character;
use App\Models\Event;
use App\Models\Item;
use App\Models\History;
use App\Models\Location;
use App\Models\Subscription;

class HistoryController extends Controller
{
    public function getEventHistories(Request $request, $eventId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $histories = History::where('event_id', $eventId)->get();

        foreach ($histories as $history) {
            $event = Event::find($history->event_id);
            $location = Location::find($event->location_id);
            $subscriptionCount = Subscription::where('event_id', $event->id)->where('absent', false)->count();
    
            $event->location = $location;
            $event->formated_date = date('d-m-Y', strtotime($event->date));
            $event->formated_subscription_delay = date('d-m-Y', strtotime($event->subscription_delay));
            $event->subscription_count = $subscriptionCount;

            $character = Character::find($history->character_id);
            $item = Item::find($history->item_id);

            $history->event = $event;
            $history->character = $character;
            $history->item = $item;
        }

        return $histories;
    }

    public function getCharacterHistories(Request $request, $characterId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $histories = History::where('character_id', $characterId)->get();

        foreach ($histories as $history) {
            $event = Event::find($history->event_id);
            $location = Location::find($event->location_id);
            $subscriptionCount = Subscription::where('event_id', $event->id)->where('absent', false)->count();
    
            $event->location = $location;
            $event->formated_date = date('d-m-Y', strtotime($event->date));
            $event->formated_subscription_delay = date('d-m-Y', strtotime($event->subscription_delay));
            $event->subscription_count = $subscriptionCount;
            
            $character = Character::find($history->character_id);
            $item = Item::find($history->item_id);

            $history->event = $event;
            $history->character = $character;
            $history->item = $item;
        }

        return $histories;
    }
}
