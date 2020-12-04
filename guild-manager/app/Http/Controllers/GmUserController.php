<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\GmUser;

class GmUserController extends Controller {

        public function getGmUsers(Request $request, $id) {
        $gm_users = GmUser::all();

        print($id);

        return $gm_users;
    }
}