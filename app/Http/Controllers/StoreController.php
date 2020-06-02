<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{
    public function list()
    {
        $stores = Store::where('active', 1)->get();

        return response()->json($stores);
    }
}
