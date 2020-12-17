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
use Exception;

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

    public function delete(Request $request, $historyId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::where('id', $token)->first();

        if ($user == null)
            return response('Invalid token', 401);

        try {
            if (History::where('id', $historyId)->exists()) {
                $event = History::find($historyId);
                $event->delete();
            } else
                return response('History entry does not exist', 500);

            return response(200);
        } catch (Exception $e) {
            return response("Delete failed: " + $e, 500);
        }
    }
}
