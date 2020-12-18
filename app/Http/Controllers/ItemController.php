<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\GmUser;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function getItemsByBoss(Request $request, $boss_id)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $items = Item::where('boss_id', $boss_id)->get();

        return $items;
    }
}
