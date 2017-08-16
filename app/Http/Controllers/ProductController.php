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
}
