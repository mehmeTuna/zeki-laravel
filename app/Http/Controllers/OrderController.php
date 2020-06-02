<?php

namespace App\Http\Controllers;

use App\OrderItems;
use App\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF ;

class OrderController extends Controller
{
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

    public function orderFis()
    {
        $data = [
            'foo' => 'bar'
        ];
        $pdf = PDF::loadView('pdfTemplate.orderFis', $data,[], [
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
}
