<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        $users = User::all();

        return $users;
    }

    public function getUser(Request $request, $id)
    {
        $user = User::find($id);

        return $user;
    }

    public function login(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');

        $user = User::where('name', $name)->where('password', $password)->first();

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
