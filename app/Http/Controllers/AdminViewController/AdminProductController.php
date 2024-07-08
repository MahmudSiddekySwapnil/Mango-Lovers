<?php

namespace App\Http\Controllers\AdminViewController;

use App\Http\Controllers\Controller;
use App\Models\LandingModel\Categories;
use App\Models\LandingModel\Products;
use App\Models\LandingModel\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Services\ImageDeleteService;
use App\Services\ImageUploadService;
use App\Traits\MangoLoversTrait;
class AdminProductController extends Controller
{
    protected $imageDeleteService;
    protected $imageUploadService;

    public function __construct(ImageDeleteService $imageDeleteService, ImageUploadService $imageUploadService)
    {
        $this->imageDeleteService = $imageDeleteService;
        $this->imageUploadService = $imageUploadService;

    }

    public function index()
    {
        return view('admin_view.pages.Product');
    }

    public function productManage()
    {
        $categories = Categories::all();
        return view('admin_view.pages.ProductManage',compact('categories'));

    }


    public function productProcessor(Request $request)
    {
        // Validate the request
        $request->validate([
            'productName' => 'required|string|max:255',
            'productPrice' => 'required|numeric',
            'productDescription' => 'nullable|string',
            'productStock' => 'required|integer',
            'productCategory' => 'required|integer',
            'productStatus' => 'required|integer',
            'main_picture' => 'required|string',
            'pictures.*' => 'string',
        ]);

        // Create the product
        $product = new Products();
        $product->Name = $request->productName;
        $product->Price = $request->productPrice;
        $product->Description = $request->productDescription;
        $product->Stock = $request->productStock;
        $product->CategoryID = $request->productCategory;
        $product->status = $request->productStatus;
        $product->SKU = MangoLoversTrait::generateShortUUID('TR');

        // Save the main image
        $mainImage = $this->saveBase64Image($request->main_picture);
        $product->picture = $mainImage;
        $product->save();

        // Save the additional images
        if ($request->has('pictures')) {
            foreach ($request->pictures as $picture) {
                $imagePath = $this->saveBase64Image($picture);
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image_link = $imagePath;
                $productImage->status = 1;
                $productImage->save();
            }
        }

        return response()->json(['message' => 'successful', 'url' => route('product_details')]);
    }

    private function saveBase64Image($base64Image)
    {
        $imageData = explode(';base64,', $base64Image);
        $imageType = explode('image/', $imageData[0])[1];
        $imageBase64 = base64_decode($imageData[1]);
        $imageName = uniqid() . '.' . $imageType;
        $directory = 'product_images/';

        // Create directory if it does not exist
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory, 0775, true); // Recursive create with permissions
        }

        // Save the image
        Storage::disk('public')->put($directory . $imageName, $imageBase64);

        // Set permissions explicitly (optional)
        // Storage::disk('public')->setVisibility($directory . $imageName, 'public');

        return $directory . $imageName;
    }

    public function showProductList(Request $request)
    {

        $columns = ['ProductID', 'CategoryID', 'Name', 'Description', 'Price', 'Stock', 'Status', 'SKU','Created_at'];

        $query = Products::query();

        // Apply search filter
        if ($request->has('search') && $request->input('search.value') != '') {
            $search = $request->input('search.value');
            $query->where(function($q) use ($search) {
                $q->where('ProductID', 'like', "%{$search}%")
                    ->orWhere('CategoryID', 'like', "%{$search}%")
                    ->orWhere('Name', 'like', "%{$search}%")
                    ->orWhere('Description', 'like', "%{$search}%")
                    ->orWhere('Price', 'like', "%{$search}%")
                    ->orWhere('Stock', 'like', "%{$search}%")
                    ->orWhere('Status', 'like', "%{$search}%")
                    ->orWhere('SKU', 'like', "%{$search}%")
                    ->orWhere('Created_at', 'like', "%{$search}%");
            });
        }

        $totalData = $query->count();
        $totalFiltered = $totalData;

        // Apply ordering
        if ($request->has('order')) {
            $orderColumn = $columns[$request->input('order.0.column')];
            $orderDir = $request->input('order.0.dir');
            $query->orderBy($orderColumn, $orderDir);
        }

        // Apply pagination
        if ($request->has('start') && $request->has('length')) {
            $start = $request->input('start');
            $length = $request->input('length');
            $query->offset($start)->limit($length);
        }

        $orders = $query->get();

        $json_data = [
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $orders
        ];

        return response()->json($json_data);

    }

    public function mangeProductStatus(Request $request)
    {

        $model = Products::where('ProductID',$request->id)->first();
        $model->status = $request->status;
        $model->save();
        return response()->json(['message' => 'successful', 'url' => '/product_list', 'status' => $request->status]);

    }


    public function deleteProduct($id)
    {
        $url = '/product_details';
        $path = '/storage/';
        return $this->imageDeleteService->deleteImage(Products::class, $id, $path, $url);

    }




}
