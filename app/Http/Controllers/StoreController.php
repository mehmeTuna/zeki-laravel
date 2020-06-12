<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreateRequest;
use App\Http\Requests\StoreUpdateRequest;
use App\OrderItems;
use App\StoreAddress;
use Carbon\Carbon;
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
        $store = Store::where('id', $request['id'])->update(['active' => 0]);
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
            if(isset($request['address'][0])){
                foreach ($request['address'][0] as $key => $value){
                    $address = StoreAddress::create([
                        'store_id' => $store->id,
                        'address_id' => $value
                    ]);
                }
            }
            if(isset($request['address'][1])){
                foreach ($request['address'][1] as $key => $value){
                    $address = StoreAddress::where('id', $value)->update(['active' => 0]);
                }
            }
        }

        $store->save();

        return response()->json(['status' => true]);
    }

    public function getStoreData(Request $request)
    {
        if(!isset($request['store'])){
            return response()->json([
                'status' => false,
                'text' => 'store required'
            ]);
        }
        $yearTimestamp = Carbon::now()->startOfYear()->timestamp;
        $monthTimestamp = Carbon::now()->startOfMonth()->timestamp;
        $weekTimestamp = Carbon::now()->startOfWeek()->timestamp;
        $dayTimestamp = Carbon::now()->startOfDay()->timestamp ;

        $store = Store::where('id', $request['store'])->with('locations')->first();
        if($store == null){
            return response()->json([
                'status' => false,
                'text' => 'store required'
            ]);
        }

        $result = [
            'store' => [
                'id' => $store->id,
                'name' => $store->name
            ],
            'year' => [
                'totalOrderCount' => 0,
                'kuryeSuccess' => 0,
                'cancel' => 0,
                'totalPrice' => 0,
                'product' => []
            ],
            'month' => [
                'totalOrderCount' => 0,
                'kuryeSuccess' => 0,
                'cancel' => 0,
                'totalPrice' => 0,
                'product' => []
            ],
            'week' => [
                'totalOrderCount' => 0,
                'kuryeSuccess' => 0,
                'cancel' => 0,
                'totalPrice' => 0,
                'product' => []
            ],
            'day' => [
                'totalOrderCount' => 0,
                'kuryeSuccess' => 0,
                'cancel' => 0,
                'totalPrice' => 0,
                'product' => []
            ],
        ];

        $addressIdList = [];
        foreach ($store->locations as $key => $value){
            $addressIdList[] = $value['address_id'];
        }

        $orders = OrderItems::where('m_date', '>=', $yearTimestamp)
            ->whereIn('address_id', $addressIdList)
            ->whereIn('m_status', [0, 1, 2, 3, 4, 5])
            ->get();

        foreach ($orders as $key => $order){
            $orderItem = $order->orders;
            if (!is_array($order->orders)){
                $orderItem= json_decode($order->orders, true);
            }
            if($order->m_date >= $yearTimestamp){
                if($order->m_status == 5){
                    $result['year']['totalOrderCount']++;
                    $result['year']['totalPrice']+= $order->order_amount;
                    $result['year']['kuryeSuccess']++;
                    foreach ($orderItem as $key => $item){
                        $itemControl = true ;
                        foreach ($result['year']['product'] as $resultKey => $resultData){
                            if($resultData['id'] == $item['id']){
                                $itemControl = false ;
                                $result['year']['product'][$resultKey]['count']++;
                                $result['year']['product'][$resultKey]['totalPrice'] += $item['price'];
                                $result['year']['product'][$resultKey]['totalPrice'] = round($result['year']['product'][$resultKey]['totalPrice'], 2);
                            }
                        }
                        if($itemControl){
                            $data = [
                                'id' => $item['id'],
                                'name' => $item['name'],
                                'count' => $item['count'],
                                'totalPrice' => $item['price']
                            ];
                            $result['year']['product'][] = $data;
                        }
                    }
                }else if($order->m_status == 2){
                    $result['year']['cancel']++;
                }
            }
            if($order->m_date >= $monthTimestamp){
                if($order->m_status == 5){
                    $result['month']['totalOrderCount']++;
                    $result['month']['totalPrice']+= $order->order_amount;
                    $result['month']['kuryeSuccess']++;
                    foreach ($orderItem as $key => $item){
                        $itemControl = true ;
                        foreach ($result['month']['product'] as $resultKey => $resultData){
                            if($resultData['id'] == $item['id']){
                                $itemControl = false ;
                                $result['month']['product'][$resultKey]['count']++;
                                $result['month']['product'][$resultKey]['totalPrice'] += $item['price'];
                                $result['month']['product'][$resultKey]['totalPrice'] = round($result['month']['product'][$resultKey]['totalPrice'], 2);
                            }
                        }
                        if($itemControl){
                            $data = [
                                'id' => $item['id'],
                                'name' => $item['name'],
                                'count' => $item['count'],
                                'totalPrice' => $item['price']
                            ];
                            $result['month']['product'][] = $data;
                        }
                    }
                }else if($order->m_status == 2){
                    $result['month']['cancel']++;
                }
            }
            if($order->m_date >= $weekTimestamp){
                if($order->m_status == 5){
                    $result['week']['totalOrderCount']++;
                    $result['week']['totalPrice']+= $order->order_amount;
                    $result['week']['kuryeSuccess']++;
                    foreach ($orderItem as $key => $item){
                        $itemControl = true ;
                        foreach ($result['week']['product'] as $resultKey => $resultData){
                            if($resultData['id'] == $item['id']){
                                $itemControl = false ;
                                $result['week']['product'][$resultKey]['count']++;
                                $result['week']['product'][$resultKey]['totalPrice'] += $item['price'];
                                $result['week']['product'][$resultKey]['totalPrice'] = round($result['week']['product'][$resultKey]['totalPrice'], 2);
                            }
                        }
                        if($itemControl){
                            $data = [
                                'id' => $item['id'],
                                'name' => $item['name'],
                                'count' => $item['count'],
                                'totalPrice' => $item['price']
                            ];
                            $result['week']['product'][] = $data;
                        }
                    }
                }else if($order->m_status == 2){
                    $result['week']['cancel']++;
                }
            }
            if($order->m_date >= $dayTimestamp){
                if($order->m_status == 5){
                    $result['day']['totalOrderCount']++;
                    $result['day']['totalPrice']+= $order->order_amount;
                    $result['day']['kuryeSuccess']++;
                    foreach ($orderItem as $key => $item){
                        $itemControl = true ;
                        foreach ($result['day']['product'] as $resultKey => $resultData){
                            if($resultData['id'] == $item['id']){
                                $itemControl = false ;
                                $result['day']['product'][$resultKey]['count']++;
                                $result['day']['product'][$resultKey]['totalPrice'] += $item['price'];
                                $result['day']['product'][$resultKey]['totalPrice'] = round($result['day']['product'][$resultKey]['totalPrice'], 2);
                            }
                        }
                        if($itemControl){
                            $data = [
                                'id' => $item['id'],
                                'name' => $item['name'],
                                'count' => $item['count'],
                                'totalPrice' => $item['price']
                            ];
                            $result['day']['product'][] = $data;
                        }
                    }
                }else if($order->m_status == 2){
                    $result['day']['cancel']++;
                }
            }
        }

        $result['year']['totalPrice'] = round($result['year']['totalPrice'], 2);
        $result['month']['totalPrice'] = round($result['month']['totalPrice'], 2);
        $result['week']['totalPrice'] = round($result['week']['totalPrice'], 2);
        $result['day']['totalPrice'] = round($result['day']['totalPrice'], 2);

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }
}
