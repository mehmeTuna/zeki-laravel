<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Category;
use App\Http\Requests\AdminLogin;
use App\Http\Requests\SiteUpdateRequest;
use App\Kurye;
use App\OrderItems;
use App\Rezervasyon;
use App\Site;
use App\Users;
use App\Cupon ;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class AdminController extends Controller
{

    public function loginPage()
    {
        return view('admin.login');
    }

    public function adminData(Request $request)
    {
        $id = session()->get('adminId');
        return response()->json([
            'status' => true,
            'username' => [
                'username' => $id[0]
            ]
        ]);
    }

    public function login(AdminLogin $request)
    {
        $admin = Admin::where('username', $request['email'])->first();
        
        if($admin == null){
            return redirect('admin/giris');
        }

        if(!password_verify($request->password, $admin->password)){
            return redirect('/admin/giris');
        }

        session()->push('adminId', $admin->id);
        return redirect('admin');
    }

    public function logout(Request $request)
    {
        session()->forget('adminId');
        return redirect('admin/giris');
    }

    public function home()
    {
        return view('admin.admin');
    }

    public function getAllUser(Request $request)
    {
        $users = Users::with(['address'])->get();

        foreach ($users as $key => $user ){
            try {
                $address = $user->adress != null ? $user->adress['content'] : '';
                $users[$key]['addressContent'] = $address;
            }catch (\Exception $exception){
                dd($user->adress['content']);
            }
            $user['ordersPriceTotal'] = round($user->ordersSum(), 2);
        }
        return response()->json($users);
    }


    public function getAllUserExcel(Request $request)
    {
        $users = Users::with(['address'])->get();

        $resultUsers = [];
        foreach ($users as $key => $user ){
            $data = [];
            $data['ad'] = $user->firstname .' '. $user->lastname ;
            $data['adres'] = $user->adress != null ? $user->adress['content'] : '';
            $data['ToplamHarcama'] = round($user->ordersSum(), 2);
            $resultUsers[] = $data;
        }

        return (new FastExcel($resultUsers))->download('Users.xlsx');
    }

    public function getFullOrder()
    {
        return '';
    }

    public function thisDayOrder(Request $request)
    {
        $result = [
            'orderAmount' => 0,
            'count' => 0,
            'status' => [
                0 => 0,
                1 => 0,
                2 => 0
            ],
            'orderStatus' =>[]
        ];
        $date = Carbon::now()->startOfDay()->timestamp;

        $orders = OrderItems::where('m_status', 5)->where('m_date', '>=', $date)->get();
        if($orders == null || count($orders) == 0 ){
            return response()->json($result);
        }

        foreach ($orders as $key => $value) {
            $result['orderAmount'] += $value['order_amount'];
            $result['status'][$value['order_status']]++;
            $inOrders = $value['orders'];
            if(!is_array($value['orders']))
                $inOrders = json_decode($value['orders'], true);
            foreach($inOrders as $key => $value){
                $result['count'] += $value['count'];
            }
        }
        return response()->json($result);
    }

    public function thisMonthOrder(Request $request)
    {
        $result = [
            'orderAmount' => 0,
            'count' => 0,
            'status' => [
                0 => 0,
                1 => 0,
                2 => 0
            ],
            'orderStatus' =>[]
        ];
        $date = Carbon::now()->startOfMonth()->timestamp;

        $orders = OrderItems::where('m_status', 5)->where('m_date', '>=', $date)->get();
        if(count($orders) == 0){
            return response()->json($result);
        }

        foreach ($orders as $key => $value) {
            $result['orderAmount'] += $value['order_amount'];
            $result['status'][$value['order_status']]++;
            $inOrders = $value['orders'];
            if(!is_array($value['orders']))
                $inOrders = json_decode($value['orders'], true);
            foreach($inOrders as $key => $value){
                $result['count'] += $value['count'];
            }
        }
        return response()->json($result);
    }

    public function thisDayPayment()
    {
        $result = [
            'kapidaNakit' => 0,
            'kapidaKartla' => 0,
            'krediKarti' => 0
        ];
        $date = Carbon::now()->startOfDay()->timestamp;

        $orders = OrderItems::where('m_status', 5)->where('m_date', '>=', $date)->get();
        if(count($orders) == 0){
            return response()->json($result);
        }

        foreach ($orders as $key => $value) {
            //0 = kapida odeme
            //1= kartla kapida odeme
            //2 = kredi karti ile odeme
            if ($value['order_status'] == 0) {
                $result['kapidaNakit']++;
            } else if ($value['order_status'] == 1) {
                $result['kapidaKartla']++;
            } else if ($value['order_status'] == 2) {
                $result['krediKarti']++;
            }
        }
        return response()->json($result);
    }

    public function thisMonthPayment()
    {
        $result = [
            'kapidaNakit' => 0,
            'kapidaKartla' => 0,
            'krediKarti' => 0
        ];
        $date = Carbon::now()->startOfMonth()->timestamp;

        $orders = OrderItems::where('m_status', 5)->where('m_date', '>=', $date)->get();
        if(count($orders) == 0){
            return response()->json($result);
        }

        foreach ($orders as $key => $value) {
            //0 = kapida odeme
            //1= kartla kapida odeme
            //2 = kredi karti ile odeme
            if ($value['order_status'] == 0) {
                $result['kapidaNakit']++;
            } else if ($value['order_status'] == 1) {
                $result['kapidaKartla']++;
            } else if ($value['order_status'] == 2) {
                $result['krediKarti']++;
            }
        }
        return response()->json($result);
    }

    public function iptalOrder()
    {
        $date = Carbon::now()->startOfDay()->timestamp;
        $orders = OrderItems::where('m_status', 2)->where('m_date', '>=', $date)->count();

        return response()->json(['iptalCount' => $orders]);
    }

    public function iptalOrderMonth()
    {
        $date = Carbon::now()->startOfMonth()->timestamp;
        $orders = OrderItems::where('m_status', 2)->where('m_date', '>=', $date)->count();

        return response()->json(['iptalCount' => $orders]);
    }

    public function thisDayMany()
    {
        $date = Carbon::now()->startOfDay()->timestamp;
        $orders = OrderItems::where('m_status', 5)->where('m_date', '>=',  $date)->sum('order_amount');

        return response()->json(['toplam' => round($orders, 2)]);
    }

    public function thisMonthMany()
    {
        $date = Carbon::now()->startOfMonth()->timestamp;
        $orders = OrderItems::where('m_status', 5)->where('m_date', '>=',  $date)->sum('order_amount');

        return response()->json(['toplam' => round($orders, 2)]);
    }

    public function allCategory()
    {
        $category = Category::all();
        return response()->json($category);
    }

    public function allKurye()
    {
        $kurye = Kurye::where('active', 1)->get();
        foreach ($kurye as $key => $value){
            $kurye[$key]['siparis'] = $value->orderCount();
        }

        return response()->json($kurye);
    }

    public function userCount()
    {
        $userCount = Users::all()->count();
        return response()->json(['count' => $userCount]);
    }

    public function userThisMonth()
    {
        $date = Carbon::now()->startOfMonth()->timestamp;
        $userCount = Users::where('registration_date', '>=', $date)->count();
        return response()->json(['count' => $userCount]);
    }

    public function userThisYear()
    {
        $date = Carbon::now()->startOfYear()->timestamp;
        $userCount = Users::where('registration_date', '>=', $date)->count();
        return response()->json(['count' => $userCount]);
    }

    public function allRezervasyonCount()
    {
        $rezervasyonCount = Rezervasyon::where('m_status', 1)->count();
        return response()->json(['count' => $rezervasyonCount]);
    }

    public function allRezervasyonDayCount()
    {
        $date = Carbon::now()->startOfDay()->timestamp;
        $rezervasyon = Rezervasyon::where('time', '>=', $date)->get();
        $result = array('toplam' => $rezervasyon->count(), 'wait' => 0, 'ok' => 0, 'red' => 0, 'usercount' => 0);

        if(count($rezervasyon) == 0){
            return response()->json($result);
        }

        foreach ($rezervasyon as $key => $value) {
            if ($value['m_status'] == '0') {
                $result['wait'] = $result['wait'] + 1;
            } else if ($value['m_status'] == '1') {
                $result['ok'] = $result['ok'] + 1;
            } else if ($value['m_status'] == '2') {
                $result['red'] = $result['red'] + 1;
            }

            if (isset($value['kisi_sayisi'])) {
                $result['usercount'] += (int) $value['kisi_sayisi'];
            }
        }
        return response()->json($result);
    }

    public function allRezervasyonMonthCount()
    {
        $date = Carbon::now()->startOfMonth()->timestamp;
        $rezervasyon = Rezervasyon::where('time', '>=', $date)->get();
        $result = array('toplam' => $rezervasyon->count(), 'wait' => 0, 'ok' => 0, 'red' => 0, 'usercount' => 0);

        if(count($rezervasyon) == 0){
            return response()->json($result);
        }

        foreach ($rezervasyon as $key => $value) {
            if ($value['m_status'] == '0') {
                $result['wait'] = $result['wait'] + 1;
            } else if ($value['m_status'] == '1') {
                $result['ok'] = $result['ok'] + 1;
            } else if ($value['m_status'] == '2') {
                $result['red'] = $result['red'] + 1;
            }

            if (isset($value['kisi_sayisi'])) {
                $result['usercount'] += (int) $value['kisi_sayisi'];
            }
        }
        return response()->json($result);
    }

    public function allRezervasyonYearCount()
    {
        $date = Carbon::now()->startOfYear()->timestamp;
        $rezervasyon = Rezervasyon::where('time', '>=', $date)->get();
        $result = array('toplam' => $rezervasyon->count(), 'wait' => 0, 'ok' => 0, 'red' => 0, 'usercount' => 0);

        if(count($rezervasyon) == 0){
            return response()->json($result);
        }

        foreach ($rezervasyon as $key => $value) {
            if ($value['m_status'] == '0') {
                $result['wait'] = $result['wait'] + 1;
            } else if ($value['m_status'] == '1') {
                $result['ok'] = $result['ok'] + 1;
            } else if ($value['m_status'] == '2') {
                $result['red'] = $result['red'] + 1;
            }

            if (isset($value['kisi_sayisi'])) {
                $result['usercount'] += (int) $value['kisi_sayisi'];
            }
        }
        return response()->json($result);
    }

    public function siteUpdate(SiteUpdateRequest $request)
    {
        if(isset($request['online']))
            $site = Site::where('id', 1)->update(['site_online'=> $request['online']]);

        if($request['cupon'])
            $site = Cupon::where('id', 1)->update(['cart_cupon'=>$request['cupon']]);

        return response()->json(['status' => true]);
    }

    public function siteData()
    {
        $site =  Site::where('id', 1)->first();
        return response()->json([
            'site_name' => $site->site_name,
            'site_description' => $site->site_description,
            'site_create_date' => $site->site_create_date,
            'site_url' => $site->site_url,
            'site_online' => (int)$site->site_online,
            'site_lisans' => $site->site_lisans
        ]);
    }

}
