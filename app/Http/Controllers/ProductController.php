<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function show(Request $req)
    {
        $id = $req->input('id');

        $product = [
            [
                "imageUrl" => asset('images/apple01.jpg')
            ],
            [
                "imageUrl" => asset('images/orange01.jpg')
            ]
        ];

        $product = $product[$id];

        return view('product.show', [
            "product" => $product
        ]);
    }
}
