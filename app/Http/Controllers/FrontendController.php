<?php

namespace App\Http\Controllers;

use App\Address;
use App\Category;
use App\Http\Requests\RezervasyonRegisterRequest;
use App\Http\Requests\UserPaymentRequest;
use App\OrderItems;
use App\Rezervasyon;
use App\UserAddress;
use App\Users;
use App\Cupon;
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

    public function tasi()
    {
        $users = Users::all();

        foreach ($users as $key => $user){
            if($user->adress != null){
                $address = UserAddress::create([
                    'user_id' => $user->id,
                    'title' => $user->adress['title'],
                    'content' => $user->adress['content']
                ]);
            }
            if($user->adress_2 != null){
                $address = UserAddress::create([
                    'user_id' => $user->id,
                    'title' => $user->adress_2['title'],
                    'content' => $user->adress_2['content']
                ]);
            }
            if($user->adress_3 != null){
                $address = UserAddress::create([
                    'user_id' => $user->id,
                    'title' => $user->adress_3['title'],
                    'content' => $user->adress_3['content']
                ]);
            }
        }
    }

   public function cartCupon()
   {
       $cupon = Cupon::where('id', 1)->first();

       return response()->json([
           'cartCupon' => $cupon->cart_cupon
       ]);
   }

    public function payment(UserPaymentRequest $request)
    {
        //odeme yontemi tipi
        //0 = kapida odeme
        //1= kartla kapida odeme
        //2 = kredi karti ile odeme
        $paymentType = [0, 1, 2];
        if(!in_array($request['picked'], $paymentType)){
            return response('odeme tıpı belırt');
        }
        $orderData = [];
        if(isset($request['adress'])){
            $orderData['adress'] = $request['adress'];
        }
        if(isset($request['cardNumber']) && isset($request['cvv']) && isset($request['month']) && isset($request['year']) && isset($request['name'])){
            //return response()->json(['status' => 'Kart ile odeme aktif degil']);
        }
        if(isset($request['content'])){
            $orderData['icerik'] = $request['content'];
        }

        $orderData['m_status'] = 0;
        $orderData['address_id'] = $request['adress'];
        $orderData['user_id'] = session('userId');
        $orderData['order_status'] = $request['picked'];
        $orderData['order_amount'] = session('cartTotal');
        $orderData['orders'] = json_encode(session('cart'));

        $orderData['ip'] = $request->ip();
        $orderData['m_date'] = time();
        if(count(session('cart', [])) == 0){
            return response()->json(['status' => 'sepet bos']);
        }
        $orders = OrderItems::create($orderData);

        session()->forget(['cart', 'cartTotal']);
        session()->push('cart', []);
        session()->push('cartTotal', 0);

        return response()->json([
            'status' => true,
            'code' => $orders->order_id
        ]);
    }
}
