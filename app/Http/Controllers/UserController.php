<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\GmUser;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        $users = GmUser::all();

        return $users;
    }

    public function getUser(Request $request, $id)
    {
        $user = GmUser::find($id);

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
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $userEgo = GmUser::where('email', $request->input('email'))->first();
        if (!is_null($userEgo))
            return response('Email already used', 500);

        GmUser::create($request->all());
    }

    public function delete(Request $request)
    {
        $token = $request->header('Authorization');
        $user = GmUser::find($token);
        if ($user == null)
            return response('Invalid token', 401);

        $userName = $user->name;
        $user->delete();

        return response($userName, 200);
    }
}
