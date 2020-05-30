<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function delete(Request $request)
    {
        $category = Category::where('id', $request['id'])->delete();
    }
}
