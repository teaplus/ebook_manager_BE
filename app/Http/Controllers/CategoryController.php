<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{
    public function createCategory(Request $request){
        $user = $request->user();
        $category = new Category();

        // DB::table('categories')->insert([
        //     'name_category'=> $request->only('name_category'),
        //     'created_at' => getdate()->toString()
        // ]);
        // Kiểm tra xem người dùng đã xác thực chưa
        $category ->category_name=$request->input('category_name');
        $category->save();

        return $request;
    }

    public function listCategory(){

    }

}
