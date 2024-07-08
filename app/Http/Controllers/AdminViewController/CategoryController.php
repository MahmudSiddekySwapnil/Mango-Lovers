<?php

namespace App\Http\Controllers\AdminViewController;

use App\Http\Controllers\Controller;
use App\Models\LandingModel\Categories;
class CategoryController extends Controller
{
    //


    public function categoryListShow()
    {
        $categories = Categories::all();
        return view('admin_view.product.create', compact('categories'));
    }
}
