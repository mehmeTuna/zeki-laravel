<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\ImgResize\ResizeImage;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return response()->json(['status' => true]);
    }

    public function update(ProductUpdateRequest $request)
    {
        $updateData = [];
        $features = [];
        $featureId=  rand(10, 100000);
        if(isset($request['product']['live'])){
            $updateData['live'] = $request['product']['live'];
        }
        if(false &&(is_array($request['product']['options']['content']) && count($request['product']['options']['content']) > 0)){
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
        $products = Products::where('live', 1)->with(['category', 'option'])->get();
        $result = [];

        foreach ($products as $data){
            $product = [];
            $product['id'] = $data['id'];
            $product['name'] = $data['name'];
            $product['price'] = $data['price'];
            $product['numberOfProduct'] = $data['numberOfProduct'];
            $product['categoryName'] = isset($data['category']['name']) ? $data['category']['name'] : 'Kategori Silindi';
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
