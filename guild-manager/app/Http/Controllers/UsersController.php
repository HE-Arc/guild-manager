<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller {

        public function getUsers(Request $request) {
        $users = Users::all();

        return $users;
    }
}