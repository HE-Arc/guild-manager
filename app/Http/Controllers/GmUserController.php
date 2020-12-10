<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\GmUser;

class GmUserController extends Controller
{
    public function getGmUsers(Request $request)
    {
        $users = GmUser::all();

        return $users;
    }

    public function getGmUser(Request $request, $id)
    {
        $user = GmUser::where('id', $id)->first();

        return $user;
    }

    public function login(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');

        $user = GmUser::where('name', $name)->where('password', $password)->first();

        if ($user == null)
            return response('Wrong credentials', 401);
        else
            return array(
                "token" => strval($user->id),
                "user" => $user
            );
    }

    public function register(Request $request)
    {
        return "WIP";
    }
}
