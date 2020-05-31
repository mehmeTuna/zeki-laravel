<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Http\Requests\ProductCreateRequest;
use App\ImgResize\ResizeImage;
use App\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(ProductCreateRequest $request)
    {
        $features = [];
        $img = '';
        $img_1 ='';
        $img_2 = '';
        $img_3 = '';
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

        if($request->hasFile('img')){
            $randname =  md5(time() . $_FILES['img']['name']) .".".pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
            $img = '/public/img/'.$randname;
            $image = new ResizeImage();
            $image->load($_FILES['img']['tmp_name']);
            $image->resize(320,300);
            $image->save($img);
        }

        if($request->hasFile('img_1')){
            $randname =  md5(time() . $_FILES['img_1']['name']) .".".pathinfo($_FILES['img_1']['name'], PATHINFO_EXTENSION);
            $img_1 = '/public/img/'.$randname;
            $image = new ResizeImage();
            $image->load($_FILES['img_1']['tmp_name']);
            $image->resize(320,300);
            $image->save($img_1);
        }

        if($request->hasFile('img_2')){
            $randname =  md5(time() . $_FILES['img_2']['name']) .".".pathinfo($_FILES['img_2']['name'], PATHINFO_EXTENSION);
            $img_2 = '/public/img/'.$randname;
            $image = new ResizeImage();
            $image->load($_FILES['img_2']['tmp_name']);
            $image->resize(320,300);
            $image->save($img_2);
        }

        if($request->hasFile('img_3')){
            $randname =  md5(time() . $_FILES['img_3']['name']) .".".pathinfo($_FILES['img_3']['name'], PATHINFO_EXTENSION);
            $img_3 = '/public/img/'.$randname;
            $image = new ResizeImage();
            $image->load($_FILES['img_3']['tmp_name']);
            $image->resize(320,300);
            $image->save($img_3);
        }

        $product = Products::create([

            'price' => $request['price'],
            'features' => $feature->id,
            'name' => $request['name'],
            'date' => time(),
            'categoeyId' => $request['categoryId'],
            'card_text' => isset($request['card_text']) ? $request['card_text'] : '',
            'img' => $img ,
            'other_img' => json_encode([
                1 => $img_1,
                2 => $img_2,
                3=> $img_3
            ]),
            'long_text' => isset($request['long_text']) ? $request['long_text'] : ''
        ]);
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
        $products = Products::where('live', 1)->with(['category', 'option'])->get();
        $result = [];

        foreach ($products as $data){
            $product = [];
            $product['id'] = $data['id'];
            $product['name'] = $data['name'];
            $product['price'] = $data['price'];
            $product['numberOfProduct'] = $data['numberOfProduct'];
            $product['categoryName'] = $data['category']['name'];
            $product['live'] = $data['live'];
            $product['cardText'] = $data['cardText'];
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
}
