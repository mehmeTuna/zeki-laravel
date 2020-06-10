<?php

namespace App\Http\Controllers;

use App\Address;
use App\Category;
use App\Http\Requests\RezervasyonRegisterRequest;
use App\Http\Requests\UserPaymentRequest;
use App\Kurye;
use App\OrderItems;
use App\Rezervasyon;
use App\Store;
use App\UserAddress;
use App\Users;
use App\Cupon;

use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

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
                //$item['options'] = $dataItem['option']['content'];
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
                $orders = OrderItems::where('adress', 'adress')->where('user_id', $user->id)->get();
                if(count($orders) > 0){
                    foreach ($orders as $key => $value){
                        $value->update(['adress' => $address->id]);
                    }
                }
            }
            if($user->adress_2 != null){
                $address = UserAddress::create([
                    'user_id' => $user->id,
                    'title' => $user->adress_2['title'],
                    'content' => $user->adress_2['content']
                ]);
                $orders = OrderItems::where('adress', 'adress_2')->where('user_id', $user->id)->get();
                if(count($orders) > 0){
                    foreach ($orders as $key => $value){
                        $value->update(['adress' => $address->id]);
                    }
                }
            }
            if($user->adress_3 != null){
                $address = UserAddress::create([
                    'user_id' => $user->id,
                    'title' => $user->adress_3['title'],
                    'content' => $user->adress_3['content']
                ]);
                $orders = OrderItems::where('adress', 'adress_3')->where('user_id', $user->id)->get();
                if(count($orders) > 0){
                    foreach ($orders as $key => $value){
                        $value->update(['adress' => $address->id]);
                    }
                }
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
        $address = '';
        if(isset($request['adress'])){
            $address = UserAddress::where('id', $request['adress'])->where('user_id', session('userId'))->first();
            if($address == null){
                return  response()->json(['status' => false, 'text' => 'gecersiz adres']);
            }
            if($address->address_id == null){
                return  response()->json(['status' => false, 'text' => 'Lokasyon seciniz Siparis vermeden once']);
            }
            $orderData['adress'] = $request['adress'];
        }
        if(isset($request['cardNumber']) && isset($request['cvv']) && isset($request['month']) && isset($request['year']) && isset($request['name'])){
            //return response()->json(['status' => 'Kart ile odeme aktif degil']);
        }
        if(isset($request['content'])){
            $orderData['icerik'] = $request['content'];
        }

        $orderData['m_status'] = 0;
        $orderData['address_id'] = $address->address_id;
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
        session()->put('cart', []);
        session()->put('cartTotal', 0);

        return response()->json([
            'status' => true,
            'code' => $orders->order_id
        ]);
    }

    public function getCupon()
    {
        $site = Cupon::where('id', 1)->first();
        return response()->json(['cupon' => $site->cart_cupon]);
    }

    public function zrapor()
    {
        $date = Carbon::now()->startOfDay()->timestamp;
        $storeList = [];
        $kuryeList = [];
        $allOrders = [];
        $totalPrice = 0;
        $orders = OrderItems::where('m_status', 5)->where('m_date', '>=', $date)->get();
        $orderIptal = OrderItems::where('m_status', 2)->where('m_date', '>=', $date)->count();
        $store = Store::with('locations.ordersData')->get();
        $kurye = Kurye::where('active', 1)->get();

        foreach ($store as $key => $value){
            $data = [];
            $data['name'] = $value['name'];
            $data['count'] = 0;
            if($value->locations !== null ){
                foreach ($value->locations as $locationId => $location){
                    if($location->ordersData != null && count($location->ordersData)){
                        $data['count'] = count($location->ordersData);
                    }
                }
            }
            $storeList[] = $data;
        }

        foreach ($kurye as $key => $value){
            $data = [];
            $data['name'] = $value['firstname'].' '.$value['lastname'];
            $data['count'] = $value->dayOrderCount()->count();
            if($data['count'] > 0)
               $kuryeList[] = $data;
        }

        foreach ($orders as $key => $value){
            if(!is_array($value['orders']))
                $value['orders'] = json_decode($value['orders'], true);
            foreach ($value['orders'] as $itemQueue => $item){
                $haveOrder = false ;
                foreach ($allOrders as $orderId => $orderItem){
                    if($orderItem['id'] == $item['id']){
                        $haveOrder = true;
                        $allOrders[$orderId]['day'] += $item['count'];
                        $totalPrice += $value['order_amount'];
                    }
                }
                if(!$haveOrder){
                    $totalPrice += $value['order_amount'];
                    $allOrders[] = [
                        'id' => $item['id'],
                        'name' => $item['name'],
                        'day' => $item['count'],
                    ];
                }
            }
        }
        $data = [
            'totalCount' => $orders->count(),
            'totalIptal' => $orderIptal,
            'store' => $storeList,
            'kurye' => $kuryeList,
            'order' => $allOrders,
            'totalPrice' => round($totalPrice, 2)
        ];

        $pdf = PDF::loadView('pdfTemplate.zrapor', $data,[], [
            'mode' => 'utf-8',
            "default_font_size"=>8,
        ]);
        return $pdf->stream('z-rapor.pdf');
    }

    public function dayzrapor()
    {
        //0 = kapida odeme
        //1= kartla kapida odeme
        //2 = kredi karti ile odeme
        $date = Carbon::now()->startOfDay()->timestamp;
        $data = [
            'kredi' => OrderItems::where('m_status', 5)->where('m_date', '>=', $date)->where('order_status', 2)->sum('order_amount'),
            'nakit' => OrderItems::where('m_status', 5)->where('m_date', '>=', $date)->where('order_status', 0)->sum('order_amount'),
            'kapidaPos' => OrderItems::where('m_status', 5)->where('m_date', '>=', $date)->where('order_status', 1)->sum('order_amount')
        ];
        $data['toplam'] = $data['kredi'] + $data['nakit'] + $data['kapidaPos'] ;

        $pdf = PDF::loadView('pdfTemplate.fiszrapor', $data, [], [
            'mode' => 'utf-8',
            'format' => [1200, 75],
            "default_font_size"=>10,
            "margin_top"=>10,
            "margin_left"=>3,
            "margin_right"=>4,
            "margin_bottom"=>3,
            'orientation' => 'L'
        ]);
        return $pdf->stream('Fis.pdf');
    }
}
