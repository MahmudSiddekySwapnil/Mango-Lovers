<?php

namespace App\Http\Controllers\AdminViewController;

use App\Http\Controllers\Controller;
use App\Models\LandingModel\Orders;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
  public function index(){
      return view('admin_view.pages.OrderManage');
  }
    public function showOrderDetails(Request $request)
    {
        $query = Orders::all();

        return $returnedJson = array("data" => $query);
    }

}
