<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Character;
use App\Models\Item;
use App\Models\History;

class HistoryController extends Controller
{
    public function getHistories(Request $request, $eventId)
    {
        $token = $request->header('Authorization');
        $user = User::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $histories = History::where('event_id', $eventId)->get();

        foreach ($histories as $history) {
            $character = Character::find($history->character_id);
            $item = Item::find($history->item_id);

            $history->character = $character;
            $history->item = $item;
        }

        return $histories;
    }
}
