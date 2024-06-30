<?php

namespace App\Http\Controllers\landingViewController;

use App\Http\Controllers\Controller;
use App\Models\LandingModel\Orders;
use App\Models\LandingModel\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Mpdf\Mpdf;
class OrderController extends Controller
{
    //

    public function orderConfirmation(Request $request) {
        $order_id = $request->query('order_id');
        $order = Orders::findOrFail($order_id);

        $products = DB::table('Products')
            ->join('order_items', 'Products.ProductID', '=', 'order_items.product_id')
            ->where('order_items.order_id', $order_id)
            ->select('Products.*', 'order_items.quantity', 'order_items.price as pivot_price')
            ->get();

        return view('landing_view.pages.confirmation_page', compact('order', 'products'));

    }

    public function downloadInvoice($order_id) {
        // Fetch the order details using the order ID
        $order = Orders::where('orderid', $order_id)->firstOrFail();

        // Fetch the products associated with the order using Eloquent's query builder
        $products = DB::table('Products')
            ->join('order_items', 'Products.SKU', '=', 'order_items.product_id')
            ->where('order_items.order_id', $order->orderid)
            ->select('Products.Name', 'Products.Description', 'Products.picture', 'order_items.quantity', 'order_items.price as pivot_price')
            ->get();

        // Define the PDF view
        $view = view('landing_view.pages.invoice', compact('order', 'products'))->render();

        // Define the custom font path
        $fontDirs = [
            __DIR__ . '/fonts',
            public_path('fonts')
        ];

        // Define the custom font data
        $fontData = [
            'nikosh' => [
                'R' => 'Nikosh.ttf',
                'useOTL' => 0xFF,
                'useKashida' => 75,
            ]
        ];

        // Create an instance of mPDF with the custom font configuration
        $mpdf = new Mpdf([
            'fontDir' => array_merge($fontDirs, [public_path('fonts/Nikosh')]),
            'fontdata' => array_merge((new \Mpdf\Config\FontVariables())->getDefaults()['fontdata'], $fontData),
            'default_font' => 'nikosh',
        ]);

        // Write the view's content to the PDF
        $mpdf->WriteHTML($view);

        // Output the PDF as a download
        return $mpdf->Output('invoice_' . $order_id . '.pdf', 'D');
    }

    public function placeOrder(Request $request)
    {
//        dd($request->all());
        // Validate the request data
        $validatedData = $request->validate([
            'receiver_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'district' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'cart_items' => 'required|array',
            'cart_items.*.id' => 'required',
            'cart_items.*.price' => 'required|numeric',
            'cart_items.*.quantity' => 'required|',
        ]);

        // Calculate total price
        $totalPrice = 0;
        foreach ($validatedData['cart_items'] as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Create the order
        $order = new Orders();
        $UUID=date('YmdHis') . '-' . Str::random(5);
        $order->orderid = $UUID;
        $order->receiver_name = $validatedData['receiver_name'];
        $order->phone_number = $validatedData['phone_number'];
        $order->address = $validatedData['address'];
        $order->district = $validatedData['district'];
        $order->city = $validatedData['city'];
        $order->total_price = $totalPrice;
        $order->save();

        // Create order items
        foreach ($validatedData['cart_items'] as $item) {
            $orderItem = new OrderItems();
            $orderItem->order_id = $UUID;
            $orderItem->product_id = $item['id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->total_price = $item['price'] * $item['quantity'];
            $orderItem->save();
        }

        // Return response with order ID
        return response()->json(['order_id' => $order->id]);
    }

}
