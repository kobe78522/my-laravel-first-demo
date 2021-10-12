<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function index(Request $req)
    {
        $cartItems = $this->getCartItems();
        //print_r($cartItems);
        // $cart = json_encode($cart);
        // Cookie::queue('cart', $cart);

        return view('cart.index', [
            "cartItems" => $cartItems
        ]);
    }

    public function updateCookie(Request $req)
    {
        $cart = $this->getCartFromCookie();
        foreach ($cart as $productId => $currentQty) {
            $key = "product_" . $productId;
            if ($req->has($key)) {
                //$cart[id] => 數量
                $cart[$productId] = $req->input($key);
            }
        }
        $cart = json_encode($cart, true);
        //Cookie::queue('cart', $cart);
        Cookie::queue('cart', $cart, 60 * 24 * 7, null, null, false, false);
        return redirect()->route('cart.index');
    }

    private function getCartFromCookie()
    {
        $cart = Cookie::get('cart');
        if (!is_null($cart)) {
            $cart = json_decode($cart, true);
        } else {
            $cart = [];
        }
        return $cart;
        //return (!is_null($cart)) ? json_decode($cart, true) : [];
    }

    private function getCartItems()
    {
        //[id => quantity]
        $cart = $this->getCartFromCookie();

        //[id]
        $productIds = array_keys($cart);

        //[
        // [ productInfo => value , quantity => value ]
        // ]
        $cartItems = array_map(function ($productId) use ($cart) {
            $qty = $cart[$productId];
            $product = $this->getProductInfo($productId);
            if ($product) {
                return [
                    "productInfo" => $product,
                    "quantity" => $qty,
                ];
            } else {
                return null;
            }
        }, $productIds);

        return $cartItems;
    }

    private function getProductInfo($id)
    {
        $products = $this->getProducts();
        foreach ($products as $product) {
            if ($product["id"] == $id) {
                return $product;
            }
        }
        return null;
    }

    private function getProducts()
    {
        return [
            [
                "id" => 1,
                "name" => "Apple",
                "price" => 34,
                "imageUrl" => asset('images/apple01.jpg')
            ],
            [
                "id" => 2,
                "name" => "Orange",
                "price" => 25,
                "imageUrl" => asset('images/orange01.jpg')
            ]
        ];
    }
}
