<?php

namespace App\Http\Controllers;

use App\Http\Requests\KuryeCreateRequest;
use App\Kurye;
use Illuminate\Http\Request;

class KuryeController extends Controller
{
    public function create(KuryeCreateRequest $request)
    {
        $kurye = Kurye::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'username' => $request['username'],
            'date' => time(),
            'password' => password_hash($request['password'], PASSWORD_DEFAULT)
        ]);

        return response()->json(['status' => 'ok']);
    }

    public function delete(Request $request)
    {
        $kurye = Kurye::where('id', $request['id'])->update(['active' => 0]);

        return response()->json(['status' => 'ok']);
    }
}
