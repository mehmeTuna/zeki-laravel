<?php

namespace App\Http\Controllers;

use App\Address;
use App\Category;
use App\Http\Requests\RezervasyonRegisterRequest;
use App\Rezervasyon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend');
    }

    public function menu()
    {
        $result = [];
        $menu = Category::with(['menuItems', 'menuItems.option'])->orderBy('category.queue', 'ASC')->get();
        foreach ($menu as $data){
            $menuItem['id'] = $data['id'];
            $menuItem['name'] = $data['name'];
            $menuItem['position'] = $data['queue'];
            $menuItem['categoryImage'] = $data['img'];
            $items = [];
            foreach ($data->menuItems as $dataItem){
                $item = [];
                $item['id'] = $dataItem['id'];
                $item['name'] = $dataItem['name'];
                $item['position'] = $dataItem['queue'];
                $item['price'] = $dataItem['price'];
                $item['category_name'] = $data['name'];
                $item['quantity'] = 1;
                $item['options'] = $dataItem['option']['content'];
                $item['description'] = $dataItem['card_text'];
                $item['img'] = $dataItem['img'];
                $items[] = $item;
            }
            $menuItem['menuItems'] = $items ;
            $result[] = $menuItem;
        }
        return response()->json($result);
    }

    public function getAddress()
    {
        $address = Address::where('active', 1)->get();
        return response()->json($address);
    }

    public function registerRezervasyon(RezervasyonRegisterRequest $request)
    {
        $rezervasyon = Rezervasyon::create([
            'time' => time(),
            'name' => $request['name'],
            'e_mail' => $request['email'],
            'phone' => $request['phone'],
            'kisi_sayisi' => $request['attendents'],
            'message' => $request['message'],
            'ip' => $request->ip(),
            'rez_date' => $request['date']
        ]);

        return response('ok');
    }
}
