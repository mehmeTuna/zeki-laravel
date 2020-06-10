<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\ImgResize\ResizeImage;
use App\OrderItems;
use App\Products;

use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use Rap2hpoutre\FastExcel\FastExcel;

class ProductController extends Controller
{
    public function create(ProductCreateRequest $request)
    {
        $createData = [];

        if(false && (is_array($request['features']) && count($request['features']) > 0)){
            $features = [];
            foreach ($request['features'] as $value ){
                $features[] = [
                    'id' => rand(0, 1000),
                    'content' => $value
                ];
            }

            $feature = Feature::create([
                'id' => rand(10, 100000),
                'content' => $features
            ]);
            $createData['features'] = $feature->id;
        }

        if($request->hasFile('image')){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('img'), $imageName);

            $img = new ResizeImage();
            $img->load(public_path('img').'/'. $imageName);
            $img->resize(env('PRODUCT_IMG_WIDTH'), env('PRODUCT_IMG_HEIGHT'));
            $img->save(public_path('img'). '/'.$imageName);

            $createData['img'] = '/img/'.$imageName;
        }

        if($request->hasFile('img_1')){
            $imageName = time().'.'.request()->image_1->getClientOriginalExtension();
            request()->image_1->move(public_path('img'), $imageName);

            $img = new ResizeImage();
            $img->load(public_path('img').'/'. $imageName);
            $img->resize(env('PRODUCT_IMG_WIDTH'), env('PRODUCT_IMG_HEIGHT'));
            $img->save(public_path('img'). '/'.$imageName);

            $createData['other_img'][] = '/img/'.$imageName;
        }

        if($request->hasFile('img_2')){
            $imageName = time().'.'.request()->image_2->getClientOriginalExtension();
            request()->image_2->move(public_path('img'), $imageName);

            $img = new ResizeImage();
            $img->load(public_path('img').'/'. $imageName);
            $img->resize(env('PRODUCT_IMG_WIDTH'), env('PRODUCT_IMG_HEIGHT'));
            $img->save(public_path('img'). '/'.$imageName);

            $createData['other_img'][] = '/img/'.$imageName;
        }

        if($request->hasFile('img_3')){
            $imageName = time().'.'.request()->image_3->getClientOriginalExtension();
            request()->image_3->move(public_path('img'), $imageName);

            $img = new ResizeImage();
            $img->load(public_path('img').'/'. $imageName);
            $img->resize(env('PRODUCT_IMG_WIDTH'), env('PRODUCT_IMG_HEIGHT'));
            $img->save(public_path('img'). '/'.$imageName);

            $createData['other_img'][] = '/img/'.$imageName;
        }

        $request['product'] = json_decode($request['product'], true);
        $createData['price'] = $request['product']['price'];
        $createData['name'] = $request['product']['name'];
        $createData['date'] = time();
        $createData['categoryId'] = $request['product']['categoryId'];
        $createData['card_text'] = isset($request['product']['card_text']) ? $request['product']['card_text'] : '';
        $createData['long_text'] = isset($request['product']['long_text']) ? $request['product']['long_text'] : '';

        $product = Products::create($createData);
    }

    public function update(ProductUpdateRequest $request)
    {
        $updateData = [];
        $features = [];
        $featureId=  rand(10, 100000);
        if(isset($request['product']['live'])){
            $updateData['live'] = $request['product']['live'];
        }
        if(is_array($request['product']['options']['content']) && count($request['product']['options']['content']) > 0){
            foreach ($request['product']['options']['content'] as $value ){
                $features[] = [
                    'id' => rand(0, 1000),
                    'content' => $value['content']
                ];
            }

         /*
          *    $feature = Feature::create([
                'id' => $featureId,
                'content' => $features
            ]);
          */
         //   $updateData['features'] = $featureId;
        }

        if($request->hasFile('img')){
            $imageName = time().'.'.request()->img->getClientOriginalExtension();
            request()->img->move(public_path('img'), $imageName);

            $img = new ResizeImage();
            $img->load(public_path('img').'/'. $imageName);
            $img->resize(env('PRODUCT_IMG_WIDTH'), env('PRODUCT_IMG_HEIGHT'));
            $img->save(public_path('img'). '/'.$imageName);

            $updateData['img'] = '/img/'.$imageName;
        }

        if($request->hasFile('img_1')){
            $imageName = time().'.'.request()->image_1->getClientOriginalExtension();
            request()->image_1->move(public_path('img'), $imageName);

            $img = new ResizeImage();
            $img->load(public_path('img').'/'. $imageName);
            $img->resize(env('PRODUCT_IMG_WIDTH'), env('PRODUCT_IMG_HEIGHT'));
            $img->save(public_path('img'). '/'.$imageName);

            $updateData['other_img'][] = '/img/'.$imageName;
        }

        if($request->hasFile('img_2')){
            $imageName = time().'.'.request()->image_2->getClientOriginalExtension();
            request()->image_2->move(public_path('img'), $imageName);

            $img = new ResizeImage();
            $img->load(public_path('img').'/'. $imageName);
            $img->resize(env('PRODUCT_IMG_WIDTH'), env('PRODUCT_IMG_HEIGHT'));
            $img->save(public_path('img'). '/'.$imageName);

            $updateData['other_img'][] = '/img/'.$imageName;
        }

        if($request->hasFile('img_3')){
            $imageName = time().'.'.request()->image_3->getClientOriginalExtension();
            request()->image_3->move(public_path('img'), $imageName);

            $img = new ResizeImage();
            $img->load(public_path('img').'/'. $imageName);
            $img->resize(env('PRODUCT_IMG_WIDTH'), env('PRODUCT_IMG_HEIGHT'));
            $img->save(public_path('img'). '/'.$imageName);

            $updateData['other_img'][] = '/img/'.$imageName;
        }

       if(isset($request['product']['price']) && (int)$request['product']['price'] > 0){
           $updateData['price'] = $request['product']['price'];
       }

        if(isset($request['product']['name'])){
            $updateData['name'] = $request['product']['name'];
        }

        if(isset($request['product']['categoryId'])){
            $updateData['categoryId'] = $request['product']['categoryId'];
        }
        if(isset($request['product']['cardText'])){
            $updateData['card_text'] = $request['product']['cardText'];
        }
        if(isset($request['product']['long_text'])){
            $updateData['long_text'] = $request['product']['long_text'];
        }

        $updateData['date'] = time();
        $product = Products::where('id', $request['id'])->update($updateData);

        return response()->json(['status' => 'ok']);
    }

    public function delete(Request $request)
    {
        $product = Products::where('id', $request['id'])->first();
        $features = Feature::where('id', $product->features)->delete();
        $product->delete();
        return response()->json(['status' => 'ok']);
    }

    public function allProduct()
    {
        $products = Products::with(['category', 'option'])->get();
        $result = [];

        foreach ($products as $data){
            $product = [];
            $product['id'] = $data['id'];
            $product['name'] = $data['name'];
            $product['price'] = $data['price'];
            $product['numberOfProduct'] = $data['numberOfProduct'];
            $product['categoryName'] = isset($data['category']['name']) ? $data['category']['name'] : 'Kategori Silindi';
            $product['live'] = $data['live'];
            $product['cardText'] = $data['card_text'];
            $product['stores'] = $data['stores'];
            $product['options'] = json_decode($data['option']);
            $product['img'] = $data['img'];
            $result[] = $product;
        }
        return response()->json($result);
    }

    public function list(Request $request)
    {
        if(!isset($request['data']) || !is_array($request['data'])){
            return response()->json(['status' => 'hatali veri']);
        }

        foreach ($request['data'] as $key => $value){
            $product = Products::where('id', $value)->update(['queue' => $key]);
        }

        return response()->json(['status' => 'ok']);
    }

    public function pdfList()
    {
        $dateDay = Carbon::now()->startOfDay()->timestamp;
        $dateWeek = Carbon::now()->startOfWeek()->timestamp;
        $dateMonth = Carbon::now()->startOfMonth()->timestamp;
        $dateYear = Carbon::now()->startOfYear()->timestamp;
        $allOrders = [];
        $orders = OrderItems::where('m_status', 5)->where('m_date', '>=', $dateYear)->get();

        foreach ($orders as $key => $value){
            if(!is_array($value['orders']))
                $value['orders'] = json_decode($value['orders'], true);
            foreach ($value['orders'] as $itemQueue => $item){
                $haveOrder = false ;
                foreach ($allOrders as $orderId => $orderItem){
                    if($orderItem['id'] == $item['id']){
                        $haveOrder = true;
                        if($value['m_date'] > $dateDay){
                            $allOrders[$orderId]['day'] += $item['count'];
                        }
                        if($value['m_date'] > $dateWeek){
                            $allOrders[$orderId]['week'] += $item['count'];
                        }
                        if($value['m_date'] > $dateMonth){
                            $allOrders[$orderId]['month'] += $item['count'];
                        }
                        if($value['m_date'] > $dateYear){
                            $allOrders[$orderId]['year'] += $item['count'];
                        }
                    }
                }
                if(!$haveOrder){
                    if($value['m_date'] > $dateDay){
                        $allOrders[] = [
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'day' => $item['count'],
                            'week' => 0,
                            'month' => 0,
                            'year' => 0
                        ];
                    }
                    if($value['m_date'] > $dateWeek){
                        $allOrders[] = [
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'day' => 0,
                            'week' =>  $item['count'],
                            'month' => 0,
                            'year' => 0
                        ];
                    }
                    if($value['m_date'] > $dateMonth){
                        $allOrders[] = [
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'day' => 0,
                            'week' => 0,
                            'month' =>  $item['count'],
                            'year' => 0
                        ];
                    }
                    if($value['m_date'] > $dateYear){
                        $allOrders[] = [
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'day' =>0,
                            'week' => 0,
                            'month' => 0,
                            'year' =>  $item['count']
                        ];
                    }
                }
            }
        }

        $pdf = PDF::loadView('pdfTemplate.productList', ['order' => $allOrders],[], [
            'mode' => 'utf-8',
            "default_font_size"=>10,
        ]);
        return $pdf->stream('kuryeList.pdf');
    }

    public function excelList()
    {
        $dateDay = Carbon::now()->startOfDay()->timestamp;
        $dateWeek = Carbon::now()->startOfWeek()->timestamp;
        $dateMonth = Carbon::now()->startOfMonth()->timestamp;
        $dateYear = Carbon::now()->startOfYear()->timestamp;
        $allOrders = [];
        $orders = OrderItems::where('m_status', 5)->where('m_date', '>=', $dateYear)->get();

        foreach ($orders as $key => $value){
            if(!is_array($value['orders']))
                $value['orders'] = json_decode($value['orders'], true);
            foreach ($value['orders'] as $itemQueue => $item){
                $haveOrder = false ;
                foreach ($allOrders as $orderId => $orderItem){
                    if($orderItem['id'] == $item['id']){
                        $haveOrder = true;
                        if($value['m_date'] > $dateDay){
                            $allOrders[$orderId]['day'] += $item['count'];
                        }
                        if($value['m_date'] > $dateWeek){
                            $allOrders[$orderId]['week'] += $item['count'];
                        }
                        if($value['m_date'] > $dateMonth){
                            $allOrders[$orderId]['month'] += $item['count'];
                        }
                        if($value['m_date'] > $dateYear){
                            $allOrders[$orderId]['year'] += $item['count'];
                        }
                    }
                }
                if(!$haveOrder){
                    if($value['m_date'] > $dateDay){
                        $allOrders[] = [
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'day' => $item['count'],
                            'week' => 0,
                            'month' => 0,
                            'year' => 0
                        ];
                    }
                    if($value['m_date'] > $dateWeek){
                        $allOrders[] = [
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'day' => 0,
                            'week' =>  $item['count'],
                            'month' => 0,
                            'year' => 0
                        ];
                    }
                    if($value['m_date'] > $dateMonth){
                        $allOrders[] = [
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'day' => 0,
                            'week' => 0,
                            'month' =>  $item['count'],
                            'year' => 0
                        ];
                    }
                    if($value['m_date'] > $dateYear){
                        $allOrders[] = [
                            'id' => $item['id'],
                            'name' => $item['name'],
                            'day' =>0,
                            'week' => 0,
                            'month' => 0,
                            'year' =>  $item['count']
                        ];
                    }
                }
            }
        }

        return (new FastExcel($allOrders))->download('Siparisler.xlsx');
    }
}
