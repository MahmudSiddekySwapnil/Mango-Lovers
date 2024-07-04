<?php

namespace App\Http\Controllers\AdminViewController;

use App\Http\Controllers\Controller;
use App\Models\LandingModel\Orders;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
  public function index(){
      return view('admin_view.pages.NewOrder');
  }
    public function showOrderDetails(Request $request)
    {
        $columns = ['orderid', 'receiver_name', 'phone_number', 'address', 'district', 'city', 'total_price', 'created_at'];

        $query = Orders::query();

        // Apply search filter
        if ($request->has('search') && $request->input('search.value') != '') {
            $search = $request->input('search.value');
            $query->where(function($q) use ($search) {
                $q->where('orderid', 'like', "%{$search}%")
                    ->orWhere('receiver_name', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('district', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('total_price', 'like', "%{$search}%")
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

        $orders = $query->get();

        $json_data = [
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $orders
        ];

        return response()->json($json_data);
    }



}
