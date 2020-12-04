<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Server;

class ServerController extends Controller {

        public function postServers(Request $request, $id) {
        $servers = Server::all();

        print($id);

        return $servers;
    }
}