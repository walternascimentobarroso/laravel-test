<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel as Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('product.index',['products' => $products]);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        var_dump($request->all());
        return 'TRUE';
    }
}
