<?php

namespace App\Http\Controllers\landingViewController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
//    public function addToCart(Request $request)
//    {
//        $productId = $request->input('id');
//        $productName = $request->input('name');
//        $productPrice = $request->input('price');
//
//        // Perform validation or any other necessary checks
//
//        // Add to session/cart
//        $cart = session()->get('cart', []);
//        if (!isset($cart[$productId])) {
//            $cart[$productId] = [
//                'id' => $productId,
//                'name' => $productName,
//                'price' => $productPrice,
//                'quantity' => 1
//            ];
//        } else {
//            $cart[$productId]['quantity']++;
//        }
//        session()->put('cart', $cart);
//
//        return response()->json(['message' => 'Product added to cart']);
//    }
//
//    public function updateCart(Request $request)
//    {
//        $productId = $request->input('id');
//        $quantity = $request->input('quantity');
//
//        // Perform validation or any other necessary checks
//
//        // Update session/cart
//        $cart = session()->get('cart', []);
//        if (isset($cart[$productId])) {
//            $cart[$productId]['quantity'] = $quantity;
//            session()->put('cart', $cart);
//            return response()->json(['message' => 'Cart updated']);
//        }
//        return response()->json(['message' => 'Product not found in cart'], 404);
//    }
//
//    public function removeFromCart(Request $request)
//    {
//        $productId = $request->input('id');
//
//        // Perform validation or any other necessary checks
//
//        // Remove from session/cart
//        $cart = session()->get('cart', []);
//        if (isset($cart[$productId])) {
//            unset($cart[$productId]);
//            session()->put('cart', $cart);
//            return response()->json(['message' => 'Product removed from cart']);
//        }
//        return response()->json(['message' => 'Product not found in cart'], 404);
//    }

//    public function updateCart(Request $request)
//    {
//        $products = $request->input('products');
//        // Store the products in the session or database
//        Session::put('cart', $products);
//
//        return response()->json(['message' => 'Cart updated successfully']);
//    }
//
//    public function getCart()
//    {
//        // Retrieve the products from the session or database
//        $products = Session::get('cart', []);
//
//        return response()->json(['products' => $products]);
//    }

    public function addToCart(Request $request)
    {
        $sessionId = $request->session()->getId();
        $userId = Auth::id(); // Get the logged-in user ID, if available
        $product = $request->only(['sku', 'quantity', 'price', 'totalPrice']);

        // Determine whether to use the session ID or user ID
        $identifier = $userId ? $userId : $sessionId;
        $identifierColumn = $userId ? 'user_id' : 'session_id';

        // Check if the product is already in the cart
        $existingProduct = DB::table('Carts')
            ->where($identifierColumn, $identifier)
            ->where('sku', $product['sku'])
            ->first();

        if ($existingProduct) {
            // Update the existing product quantity and total price
            DB::table('Carts')
                ->where('id', $existingProduct->id)
                ->update([
                    'quantity' => $existingProduct->quantity + $product['quantity'],
                    'total_price' => ($existingProduct->quantity + $product['quantity']) * $product['price'],
                    'updated_at' => now(),
                ]);
        } else {
            // Insert a new product
            $userId = Session::get('userid');
            DB::table('Carts')->insert([
                $identifierColumn => $identifier,
                'sku' => $product['sku'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'total_price' => $product['totalPrice'],
                'Userid' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json([
            'message' => 'Product added to cart',
            'product' => $product,
        ], 200);
    }




    public function updateCart(Request $request)
    {

        $sessionId = $request->session()->getId();
        $product = $request->only(['sku', 'quantity', 'price', 'totalPrice']);

        // Check if the product is already in the cart
        $existingProduct = DB::table('Carts')
            ->where('session_id', $sessionId)
            ->where('sku', $product['sku'])
            ->first();

        if ($existingProduct) {
            if ($product['quantity'] <= 0) {
                // Remove the product from the cart if quantity is 0 or less
                DB::table('Carts')->where('id', $existingProduct->id)->delete();
            } else {
                // Update the existing product quantity and total price
                DB::table('Carts')
                    ->where('id', $existingProduct->id)
                    ->update([
                        'quantity' => $product['quantity'],
                        'total_price' => $product['totalPrice'],
                    ]);
            }
        }

        return response()->json([
            'message' => 'Product quantity updated in cart',
            'product' => $product,
        ], 200);
    }

    public function clearCart(Request $request)
    {
        $sessionId = $request->session()->getId();

        // Remove all products from the cart for the current session
        DB::table('Carts')->where('session_id', $sessionId)->delete();

        return response()->json([
            'message' => 'Cart cleared'
        ], 200);
    }

    public function removeFromCart(Request $request)
    {

        $sessionId = $request->session()->getId();
        $sku = $request->input('sku');

        // Remove the specific product from the cart
        DB::table('Carts')
            ->where('session_id', $sessionId)
            ->where('sku', $sku)
            ->delete();

        return response()->json([
            'message' => 'Product removed from cart'
        ], 200);
    }


    public function fetchCart(Request $request)
    {
        $sessionId = $request->session()->getId(); // Get session ID

        $cartItems = DB::table('Carts')
            ->leftJoin('Products', 'Carts.sku', '=', 'Products.sku')
            ->where('Carts.session_id', $sessionId)
            ->select('Carts.*', 'Products.*') // Select columns you need from both tables
            ->get();

        return response()->json($cartItems);
    }

//    public function updateFinalCart(Request $request)
//    {
//        $cartItem = DB::table('Carts')->where('user_id', Auth::id())->where('id', $request->id)->first();
//        if ($cartItem) {
//            $cartItem->quantity = $request->quantity;
//            $cartItem->save();
//        }
//
//        return response()->json($cartItem);
//    }
}
