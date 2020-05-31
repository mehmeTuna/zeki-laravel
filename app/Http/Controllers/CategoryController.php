<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\Request;
use App\ImgResize\ResizeImage;

class CategoryController extends Controller
{
    public function delete(Request $request)
    {
        $category = Category::where('id', $request['id'])->delete();
        return response()->json(['status' => 'ok']);
    }

    public function create(CategoryCreateRequest $request)
    {
        $name = json_decode($request['category']);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('img'), $imageName);

        $img = new ResizeImage();
        $img->load(public_path('img').'/'. $imageName);
        $img->resize(env('CATEGORY_IMG_WIDTH'), env('CATEGORY_IMG_HEIGHT'));
        $img->save(public_path('img'). '/'.$imageName);

        $category = Category::create([
            'name' => $name->name,
            'img' =>'img/'.$imageName
        ]);

        return response()->json(['status' => 'ok']);
    }

    public function update(CategoryUpdateRequest $request)
    {
        $updateData = [
            'name' => $request['name']
        ];

        if($request->hasFile('image')){
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('img'), $imageName);

            $img = new ResizeImage();
            $img->load(public_path('img').'/'. $imageName);
            $img->resize(env('CATEGORY_IMG_WIDTH'), env('CATEGORY_IMG_HEIGHT'));
            $img->save(public_path('img'). '/'.$imageName);

            $updateData['img'] = '/img/'.$imageName;
        }

        $category = Category::where('id', $request['id'])->update($updateData);

        return response()->json(['status' => 'ok']);
    }

    public function list(Request $request)
    {
        if(!isset($request['data']) || !is_array($request['data'])){
            return response()->json(['status' => 'hatali deger']);
        }
        foreach ($request['data'] as $key => $value ){
            $category = Category::where('id', $value)->update(['queue' => $key]);
        }

        return response()->json(['status' => 'ok']);
    }
}
