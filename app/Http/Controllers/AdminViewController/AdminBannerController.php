<?php

namespace App\Http\Controllers\AdminViewController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\ImageDeleteService;
use App\Services\ImageUploadService;
use App\Models\AdminModel\Banners;
class AdminBannerController extends Controller
{
    protected $imageDeleteService;
    protected $imageUploadService;

    public function __construct(ImageDeleteService $imageDeleteService, ImageUploadService $imageUploadService)
    {
        $this->imageDeleteService = $imageDeleteService;
        $this->imageUploadService = $imageUploadService;

    }
    public function index(){
       return view('admin_view.pages.Banner');
    }

    public function mangeBanner(Request $request)
    {
        $validationRules = [
            'picture' => 'required|image|mimes:jpeg,jpg,png|max:10240',
            'bannerName' => 'required',
            'bannerDescription' => 'required',
        ];
        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            // Validation failed, including the 'picture' not being uploaded.
            return response()->json(['message' => 'please check your file extension support only (jpeg,jpg,png)']);
        } else {
            // Validation passed, and 'picture' is uploaded.
            $model = new Banners();
            $path = "media/Banner";
            $result = $this->imageUploadService->imageUploadService($request, 'Banners', $path);

            if ($result['message'] == "exists") {
                return response()->json(['message' => 'Image already exists']);
            } else {
                $model->image_url = $result['image_url'];
                $model->picture = $result['picture'];
                $model->image_hash = $result['image_hash']; // Store the image hash in the database.
                $model->Name = $request->bannerName;
                $model->Description = $request->bannerDescription;
                $model->status = 1;
                $model->save();
                return response()->json(['message' => 'successful', 'url' => 'banner']);
            }


        }

    }

    public function showBannerList(Request $request)
    {
        $columns = ['BannerID', 'Name', 'Description', 'picture', 'status'];

        $query = Banners::query();

        // Apply search filter
        if ($request->has('search') && $request->input('search.value') != '') {
            $search = $request->input('search.value');
            $query->where(function($q) use ($search) {
                $q->where('BannerID', 'like', "%{$search}%")
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


    public function mangeBannerStatus(Request $request)
    {

        $model = Banners::where('BannerID',$request->id)->first();
        $model->status = $request->status;
        $model->save();
        return response()->json(['message' => 'successful', 'url' => '/banner', 'status' => $request->status]);

    }


    public function deleteBanner($id)
    {
        $url = '/banner';
        $path = '/storage/media/Banner';
        // Fetch the category
        $Banners = Banners::find($id);
        if ($Banners) {
            // Now delete the category
            $Banners->delete();
            // Call the image deletion service
            $this->imageDeleteService->deleteImage(Banners::class, $id, $path, $url);
            return response()->json(['message' => 'successful', 'url' => '/banner']);
        }
        return response()->json(['error' => 'Category not found.'], 404);
    }
}
