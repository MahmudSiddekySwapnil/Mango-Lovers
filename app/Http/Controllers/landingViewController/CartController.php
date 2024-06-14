<?php

namespace App\Http\Controllers\landingViewController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('id');
        $productName = $request->input('name');
        $productPrice = $request->input('price');

        // Perform validation or any other necessary checks

        // Add to session/cart
        $cart = session()->get('cart', []);
        if (!isset($cart[$productId])) {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $productName,
                'price' => $productPrice,
                'quantity' => 1
            ];
        } else {
            $cart[$productId]['quantity']++;
        }
        session()->put('cart', $cart);

        return response()->json(['message' => 'Product added to cart']);
    }

    public function updateCart(Request $request)
    {
        $productId = $request->input('id');
        $quantity = $request->input('quantity');

        // Perform validation or any other necessary checks

        // Update session/cart
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return response()->json(['message' => 'Cart updated']);
        }
        return response()->json(['message' => 'Product not found in cart'], 404);
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('id');

        // Perform validation or any other necessary checks

        // Remove from session/cart
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return response()->json(['message' => 'Product removed from cart']);
        }
        return response()->json(['message' => 'Product not found in cart'], 404);
    }
}
