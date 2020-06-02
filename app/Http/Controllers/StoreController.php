<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreateRequest;
use App\Http\Requests\StoreUpdateRequest;
use App\StoreAddress;
use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{
    public function list()
    {
        $stores = Store::where('active', 1)->with('locations.address')->get();
        return response()->json($stores);
    }

    public function create(StoreCreateRequest $request)
    {
        $store = Store::create([
            'name' => $request['name']
        ]);


        foreach ($request['address'] as $key => $value){
            $address = StoreAddress::create([
                'store_id' => $store->id,
                'address_id' => $value
            ]);
        }

        return response()->json(['status' => true]);
    }

    public function delete(Request $request)
    {
        $store = Store::where('id', $request['id'])->update(['active', 0]);
        return response()->json(['status' => true]);
    }

    public function update(StoreUpdateRequest $request)
    {
        $store = Store::where('id', $request['id'])->first();
        if($store == null){
            return response()->json(['status' => 'gezersiz id']);
        }

        if(isset($request['name'])){
            $store->name = $request['name'];
        }

        if(isset($request['address'])){
            if(isset($request['address']['add'])){
                foreach ($request['address']['add'] as $key => $value){
                    $address = StoreAddress::create([
                        'store_id' => $store->id,
                        'address_id' => $value
                    ]);
                }
            }
            if(isset($request['address']['delete'])){
                foreach ($request['address']['delete'] as $key => $value){
                    $address = StoreAddress::where('id', $value)->update(['active', 1]);
                }
            }
        }

        $store->save();

        return response()->json(['status' => true]);
    }
}
