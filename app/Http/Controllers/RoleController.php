<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getRoles(Request $request)
    {   
        $roles = Role::get();

        return $roles;
    }
}
