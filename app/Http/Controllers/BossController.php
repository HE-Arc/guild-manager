<?php

namespace App\Http\Controllers;

use App\Models\Boss;
use App\Models\Location;
use App\Models\GmUser;
use Illuminate\Http\Request;

class BossController extends Controller
{
    public function getBoss(Request $request, $bossId)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $boss = Boss::find($bossId);
 
        return $boss;
    }

    public function getBossesByLocation(Request $request, $location_id)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $bosses = Boss::where('location_id', $location_id)->get();

        foreach ($bosses as $boss) {

            $boss->location_id = "He";
        }

        return $bosses;
    }
}
