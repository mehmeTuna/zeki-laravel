<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\OrderItems;
use App\Products;
use App\Users;
use App\UserAddress;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me()
    {
        $userId = session()->get('userId', '');
        if($userId == ''){
            return response()->json(['status' => 'login değil']);
        }
        $user = Users::where('id', $userId)->with(['address', 'address.address'])->first();
        $response = [
            'username' => $user->id,
            'firstname' => $user->firstname,
            'lastname' =>$user->lastname,
            'email' => $user->email,
            'address' => $user->address,
            'phone' => $user->phone,
            'product' => session()->get('cart', []),
            'cardTotal' => session()->get('cartTotal', 0),
            'orderCount' => $user->orderCount()
        ];

        return response()->json($response);
    }

    public function sepet(Request $request)
    {
        if(!session()->has('userId')){
            return response()->json(['status' => 'login degil']);
        }
        $requestId = $request['id'];
        $requestCount = $request['count'] > 0 ? $request['count'] : 1;
        $requestItems = is_array($request['options']) ? $request['options'] : [];
        $product = Products::where('id', $requestId)->first();
        if($product == null){
            return response()->json(['status' => false ]);
        }

        $cart = session()->get('cart', []);
        $cartTotal = 0;

        $oldItem = true ;
        foreach ($cart as $key =>$data){
            if($data['id'] == $requestId){
                if(isset($data['features'])){
                    $cart[$key]['features'][] = [
                        'count' => $requestCount,
                        'items' => $requestItems
                    ];
                }
                $cart[$key]['count'] += $requestCount;
                $cart[$key]['price'] += round(($product->price * $requestCount), 2);
                $oldItem = false;
            }
        }

        if($oldItem){
            $cart[] = [
                'id' => $product->id,
                'name' => $product->name,
                'count' => $requestCount,
                'price' => round(($product->price * $requestCount), 2),
                'features' => [
                    0 => [
                        'count' => $requestCount,
                        'items' => $requestItems
                    ]
                ]
            ];
        }

        foreach ($cart as $key => $value){
            $cartTotal += $value['price'];
        }

        session()->forget(['cart', 'cartTotal']);
        session()->put('cart', $cart);
        session()->put('cartTotal', $cartTotal);

        return response()->json(['status' => true]);
    }

    public function sepetDeleteItem(Request $request)
    {
        if(!session()->has('userId')){
            return response()->json(['status' => 'login degil']);
        }
        $requestId = $request['id'];
        $cart = session()->get('cart', []);
        $cartTotal = 0;

        $itemId= -1;
        foreach ($cart as $key =>$data){
            if($data['id'] == $requestId){
                $itemId = $key;
            }
        }
        if($itemId != -1){
            array_splice($cart, $itemId, 1);
        }

        foreach ($cart as $key => $value){
            $cartTotal += $value['price'];
        }

        session()->forget(['cart', 'cartTotal']);
        session()->put('cart', $cart);
        session()->put('cartTotal', $cartTotal);

        return response()->json(['status' => true]);
    }

    public function login(Request $request)
    {
        $username = $request['username'];
        $password = $request['password'];

        $user = Users::where('email', $username)->first();
        if($user == null){
            return response()->json(['status' => false]);
        }
        if(password_verify($password, $user->password)){
            session()->put('userId', $user->id);
            return response()->json([
                'firstname' => $user->firstname,
                'lastname' => $user->lastname
            ]);
        }

        return response()->json(['status' => false ]);
    }

    public function orders()
    {
        $userId= session()->get('userId');
        $result = [];
        $orders = OrderItems::where('user_id', $userId)->whereIn('m_status', [0,1,3,5])->orderBy('m_date', 'DESC')->get();

        foreach ($orders as $key => $value){
            $data = [];
            switch ($value['m_status']){
                case 0:
                    $data['m_status'] = 'Sipariş alındı' ;
                    break;
                case 1:
                    $data['m_status'] = 'Siparişiniz onaylandı';
                    break;
                case 2:
                    $data['m_status'] = 'Siparişiniz iptal edildi';
                    break;
                case 3:
                    $data['m_status'] = 'Siparişiniz hazırlandı' ;
                    break;
                case 5:
                    $data['m_status'] = 'Siparişiniz kuryeye verildi' ;
                    break;
                default:
                    $data['m_status'] = '';
            }
            $data['totalPrice'] = $value['order_amount'];
            $data['orders'] = json_decode($value['orders'], true);
            $data['id'] = $value['order_id'];
            $result[] = $data;
        }

        return response()->json($result);
    }

    public function register(UserRegisterRequest $request)
    {
        $user = Users::where('email', $request['username'])->first();
        if($user != null) return response()->json(['status' => 'emailfailed']);

        if($request['password'] != $request['rePassword']){
            return response()->json(['status' => false]);
        }

        $user = Users::create([
            'email' => $request['username'],
            'password' => password_hash($request['password'], PASSWORD_DEFAULT),
            'firstname' => $request['name'],
            'lastname' => $request['surname'],
            'registration_date' => time(),
            'ip' => $request->ip(),
            'phone' => $request['phone'],
            'birthday' => isset($request['date']) ? $request['date'] : '' ,
        ]);

        $address = UserAddress::create([
            'user_id' => $user->id,
            'content' => $request['adress'],
            'address_id' => $request['selectedAddress']
        ]);

        session()->put('userId', $user->id);

        return response()->json(['status' => 'registered']);
    }

    public  function logout()
    {
        session()->forget('userId');
        return redirect('/');
    }

    public function update(UserUpdateRequest $request)
    {
        $user = Users::where('id', session('userId'))->first();
        if(isset($request['date'])){
            $user->birthday = $request['date'];
        }
        if(isset($request['firstname'])){
            $user->firstname = $request['firstname'];
        }
        if (isset($request['oldPassword']) && isset($request['newPassword'])){
            if (password_verify($request['oldPassword'], $user->password)){
                $user->password = password_hash($request['newPassword'], PASSWORD_DEFAULT);
            }
        }
        if(isset($request['phone'])){
            $user->phone = $request['phone'];
        }
        if(isset($request['lastname'])){
            $user->lastname = $request['lastname'];
        }
        if(isset($request['email'])){
            $user->email = $request['email'];
        }

        if(isset($request['address']) && isset($request['address']['address'])){
            $adress = UserAddress::where('id', $request['address']['id'])->first();
            if($adress == null){
                return response()->json(['status' => false, 'text' => 'gecerli adres idsi giriniz']);
            }

            if(isset($request['address']['address']['id']))
            $adress->address_id = $request['address']['address']['id'];

            if(isset($request['address']['content']) && strlen($request['address']['content']) > 0)
             $adress->content = $request['address']['content'];

             if(isset($request['address']['title']) && strlen($request['address']['title']) > 0 )
             $adress->title = $request['address']['title'];
             $adress->save();

        }else if(isset($request['address'])){
            $updateLocation = [];
            $updateLocation['user_id'] = session('userId');
            if(isset($request['address']['id']))
            $updateLocation['address_id'] = $request['address']['id'];

            if(isset($request['content']) && strlen($request['content']) > 0)
             $updateLocation['content'] = $request['content'];

             if(isset($request['title']) && strlen($request['title']) > 0 )
             $updateLocation['title'] = $request['title'];

             $address = UserAddress::create($updateLocation);
        }

        $user->save();

        return response()->json(['status' => 'ok']);
    }
}
