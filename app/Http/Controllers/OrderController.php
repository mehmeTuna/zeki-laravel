<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Kurye;
use App\KuryeTakip;
use App\OrderItems;
use App\Products;
use App\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF ;

class OrderController extends Controller
{
    public function update(Request $request)
    {
        $orderStatus = ['iptal', 'onay'];
        $updateData = [];
        if(!isset($request['id'])){
            return response()->json(['status' => false, 'text' => 'Gecerli id giriniz']);
        }

        if(isset($request['status']) && in_array($request['status'], $orderStatus)){
            switch ($request['status']){
                case 'iptal':
                    $updateData['m_status'] = OrderItems::CANCEL;
                    $order = OrderItems::where('order_id', $request['id'])->update($updateData);
                    return response()->json(['status' => true]);
                    break;
                case 'onay':
                    $updateData['m_status'] = OrderItems::KURYEVERILDI;
                    $kurye = Kurye::where('id', $request['kuryeId'])->first();
                
                    if($kurye == null){
                        return response()->json(['status' => false, 'text' => 'Gecerli kurye id si giriniz']);
                    }
            
                    $order = OrderItems::where('order_id', $request['id'])->update($updateData);
                    if ($order){
                        KuryeTakip::create([
                            'order_id' => $request['id'],
                            'kurye_id' => $kurye->id,
                            'start_date' => time()
                        ]);
                    }
                    break;
            }
           
        }

        return response()->json(['status' => true, 'text' => 'ok']);
    }

    public function thisYear()
    {
        $resultData = [];
        $date = Carbon::now()->startOfYear()->timestamp;
        $orders = OrderItems::where('m_status', 5)->where('m_date', '>=', $date)->get();
        foreach ($orders as $key => $value) {
            foreach ($value["orders"] as $value) {
                //satılan urunlerın kacar adet satıldıgı hesaplanacak
                if (isset($resultData[$value["id"]])) {
                    $resultData[$value["id"]] = $resultData[$value["id"]] + $value["count"];
                } else {
                    $resultData[$value["id"]] = $value["count"];
                }
            }
        }
        $response = [];
        foreach ($resultData as $key => $val) {
            $product = Products::where('id', $key)->select('name')->first();
            $response[] = [
                'name' => $product != null ? $product->name : '',
                "count" => $val,
                "id" => $key
            ];
        }
        return response()->json($response);
    }

    public function thisMonth()
    {
        $resultData = [];
        $date = Carbon::now()->startOfMonth()->timestamp;
        $orders = OrderItems::where('m_status', 5)->where('m_date', '>=', $date)->get();
        foreach ($orders as $key => $value) {
            foreach ($value["orders"] as $value) {
                //satılan urunlerın kacar adet satıldıgı hesaplanacak
                if (isset($resultData[$value["id"]])) {
                    $resultData[$value["id"]] = $resultData[$value["id"]] + $value["count"];
                } else {
                    $resultData[$value["id"]] = $value["count"];
                }
            }
        }
        $response = [];
        foreach ($resultData as $key => $val) {
            $product = Products::where('id', $key)->select('name')->first();
            $response[] = [
                'name' => $product != null ? $product->name : '',
                "count" => $val,
                "id" => $key
            ];
        }
        return response()->json($response);
    }

    public function thisWeek()
    {
        $resultData = [];
        $date = Carbon::now()->startOfWeek()->timestamp;
        $orders = OrderItems::where('m_status', 5)->where('m_date', '>=', $date)->get();
        foreach ($orders as $key => $value) {
            foreach ($value["orders"] as $value) {
                //satılan urunlerın kacar adet satıldıgı hesaplanacak
                if (isset($resultData[$value["id"]])) {
                    $resultData[$value["id"]] = $resultData[$value["id"]] + $value["count"];
                } else {
                    $resultData[$value["id"]] = $value["count"];
                }
            }
        }
        $response = [];
        foreach ($resultData as $key => $val) {
            $product = Products::where('id', $key)->select('name')->first();
            $response[] = [
                'name' => $product != null ? $product->name : '',
                "count" => $val,
                "id" => $key
            ];
        }
        return response()->json($response);
    }

    public function thisDay()
    {
        $resultData = [];
        $date = Carbon::now()->startOfDay()->timestamp;
        $orders = OrderItems::where('m_status', 5)->where('m_date', '>=', $date)->get();
        foreach ($orders as $key => $value) {
            foreach ($value["orders"] as $value) {
                //satılan urunlerın kacar adet satıldıgı hesaplanacak
                if (isset($resultData[$value["id"]])) {
                    $resultData[$value["id"]] = $resultData[$value["id"]] + $value["count"];
                } else {
                    $resultData[$value["id"]] = $value["count"];
                }
            }
        }
        $response = [];
        foreach ($resultData as $key => $val) {
            $product = Products::where('id', $key)->select('name')->first();
            $response[] = [
                'name' => $product != null ? $product->name : '',
                "count" => $val,
                "id" => $key
            ];
        }
        return response()->json($response);
    }

    public function orderFis(Request $request)
    {
        if(!isset($request->id)){
            return response()->json(['status' => false, 'text'=> 'Id required']);
        }

        $order = OrderItems::where('order_id', $request->id)->with(['kurye', 'user', 'address'])->first();
        if($order == null){
            return response()->json(['status' => false, 'text' => 'Id required']);
        }

        if(!is_array($order['orders'])){
            $order['orders'] = json_decode($order['orders'], true);
        }

        switch ($order['order_status']){
            case 0:
                $order['order_status'] = 'Kapıda Nakit Ödeme';
                break;
            case 1:
                $order['order_status'] = 'Kart İle Kapıda Ödeme';
                break;
            case 2:
                $order['order_status'] = 'Kredi Kartı İle Ödeme';
                break;
        }

        $pdf = PDF::loadView('pdfTemplate.orderFis', $order,[], [
            'mode' => 'utf-8',
            'format' => [1200, 75],
            "default_font_size"=>10,
            "margin_top"=>1,
            "margin_left"=>1,
            "margin_right"=>4,
            "margin_bottom"=>3,
            'orientation' => 'L'
        ]);
        return $pdf->stream('Fis.pdf');
    }

    public function getOrder()
    {
        $oneDayBeforeTime = time() - 24 * 60 * 60 ;
        DB::connection()->enableQueryLog();
        $worker = Worker::where('id', session('workerId'))->with(['store.locations'])->first();
        $addressIdList = [];
        foreach ($worker->store->locations as $key => $value){
            $addressIdList[] = $value['address_id'];
        }
        $orders = OrderItems::where('m_date', '>=', $oneDayBeforeTime)
            ->with(['kurye', 'user', 'address'])
            ->whereIn('adress', $addressIdList)
            ->whereIn('m_status', [0, 1, 2, 3, 4, 5])
            ->orderBy('m_date', 'DESC')
            ->get();
        $queries = \DB::getQueryLog();
       // return dd($queries);
        $data = [
            'wait' => 0,
            'success' => 0,
            'cancel' => 0,
            'kurye' => 0,
            'waitList' => [],
            'successList' => [],
            'cancelList' => [],
            'kuryeList' => []
        ];
        if ($orders == null){
            return response()->json($data);
        }

        foreach ($orders as $key => $order){

            if(!is_array($order['orders'])){
                $order['orders'] = json_decode($order['orders'], true);
           }

            switch ($order['order_status']){
                case 0:
                    $order['order_status'] = 'Kart İle Kapıda Ödeme';
                    break;
                case 1:
                    $order['order_status'] = 'Kapıda Nakit Ödeme';
                    break;
                case 2:
                    $order['order_status'] = 'Kredi Kartı İle Ödeme';
                    break;
            }

            $order['m_date'] = date('H:i', $order['m_date']);
            switch ($order->m_status){
                case OrderItems::WAITING ;
                $data['wait']++;
                $data['waitList'][] = $order;
                break;
                case OrderItems::SUCCESS ;
                $data['success']++ ;
                $data['successList'][] = $order;
                break;
                case OrderItems::CANCEL ;
                $data['cancel']++;
                $data['cancelList'][] = $order;
                break;
                case OrderItems::KURYEVERILDI ;
                $data['kurye']++;
                $data['kuryeList'][] = $order;
                break;
            }
        }

        return response()->json([
            'status' => true,
            'data' =>$data
        ]);
    }
}
