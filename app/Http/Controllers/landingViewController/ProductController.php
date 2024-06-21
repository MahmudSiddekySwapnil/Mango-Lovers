<?php

namespace App\Http\Controllers\landingViewController;

use App\Http\Controllers\Controller;
use App\Models\LandingModel\ProductImage;
use App\Models\LandingModel\Products;

class ProductController extends Controller
{
    public function index(){
         $result['productsImage'] = ProductImage::where('status', 1)->get();
        return view('landing_view.pages.home',$result);
    }

    public function show($id)
    {
        $product = Products::where('ProductID', $id)
            ->where('status', 1)
            ->first();
        if ($product) {
            $images=[];
            if ($product->picture) {
                array_unshift($images, $product->picture); // Add the main image to the beginning of the array
            }

            // Prepare the response data
            $data = [
                'name' => $product->Name,
                'sku' => $product->SKU ?? 'N/A',
                'original_price' => $product->OriginalPrice ?? 155,
                'price' => $product->Price,
                'description' => $product->Description,
                'images' => $images,
            ];

            return response()->json($data);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }


}






//
//public function show($id)
//{
//    $result['products_list'] =  Products::where('ProductID', $id)
//        ->where('status', 1)
//        ->first();
//    $result['products_list_image'] =  ProductImage::where('product_id', $id)
//        ->where('status', 1)
//        ->get();
//
////         dd($result['products_list']->Name );
//    if ($result) {
//        $data = [
//            'name' => $result['products_list']->Name,
////                'link' => route('products.show', $product->id),
//            'sku' => "nan",
////                'brand' => $product->brand->name,
////                'brand_link' => route('brands.show', $product->brand->id),
//            'original_price' => 500,
//            'price' =>$result['products_list']->Price,
//            'description' => $result['products_list']->Description,
////              'images' => $product->images->pluck('url'),
////                'rating' => $product->rating,
////                'reviews_count' => $product->reviews_count,
////                'tags' => $product->tags->pluck('name'),
//        ];
//        return response()->json($data);
//    } else {
//        return response()->json(['error' => 'Product not found'], 404);
//    }
//}
