<?php

namespace App\Http\Controllers\AdminViewController;

use App\Http\Controllers\Controller;
use App\Models\LandingModel\Categories;
use App\Models\LandingModel\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ImageDeleteService;
use App\Services\ImageUploadService;
class CategoryController extends Controller
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
        return view('admin_view.pages.Category');

    }

    public function categoryListShow()
    {
        $categories = Categories::all();
        return view('admin_view.product.create', compact('categories'));
    }

    public function mangeCategory(Request $request)
    {
        $validationRules = [
            'picture' => 'required',
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ];
        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            // Validation failed, including the 'picture' not being uploaded.
            return response()->json(['message' => 'please check your file extension support only (jpeg,jpg,png)']);
        } else {
            // Validation passed, and 'picture' is uploaded.
            $model = new Categories();
            $path = "media/Category";
            $result = $this->imageUploadService->imageUploadService($request, 'Categories', $path);

            if ($result['message'] == "exists") {
                return response()->json(['message' => 'Image already exists']);
            } else {
                $model->image_url = $result['image_url'];
                $model->picture = $result['picture'];
                $model->image_hash = $result['image_hash']; // Store the image hash in the database.
                $model->Name = $request->categoryName;
                $model->Description = $request->categoryDescription;
                $model->status = 1;
                $model->save();
                return response()->json(['message' => 'successful', 'url' => 'category']);
            }


        }

    }

    public function showCategoryList(Request $request)
    {
        $columns = ['CategoryID', 'Name', 'Description', 'picture', 'status'];

        $query = Categories::query();

        // Apply search filter
        if ($request->has('search') && $request->input('search.value') != '') {
            $search = $request->input('search.value');
            $query->where(function($q) use ($search) {
                $q->where('CategoryID', 'like', "%{$search}%")
                    ->orWhere('Name', 'like', "%{$search}%")
                    ->orWhere('Description', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('created_at', 'like', "%{$search}%");
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

        $categories = $query->get();

        $json_data = [
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $categories
        ];

        return response()->json($json_data);
    }


    public function mangeCategoryStatus(Request $request)
    {

        $model = Categories::where('CategoryID',$request->id)->first();
        $model->status = $request->status;
        $model->save();
        return response()->json(['message' => 'successful', 'url' => '/category', 'status' => $request->status]);

    }


    public function deleteCategory($id)
    {
        $url = '/category';
        $path = '/storage/media/Category';

        // Fetch the category
        $category = Categories::find($id);

        if ($category) {
            // Delete products associated with the category
            Products::where('CategoryID', $id)->delete();

            // Now delete the category
            $category->delete();

            // Call the image deletion service
            $this->imageDeleteService->deleteImage(Categories::class, $id, $path, $url);

            return response()->json(['message' => 'successful', 'url' => '/category']);

        }

        return response()->json(['error' => 'Category not found.'], 404);
    }



}
