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
        return redirect()->route('product.index')->with('message', 'Produto salvo com sucesso!');
    }

    public function show(Request $request, $id)
    {
        Product::where('id', $id)->delete();
        return redirect()->route('product.index')->with('message', 'Produto' + $id + 'excluido com sucesso!');
    }

    public function destroy(Request $request)
    {
        var_dump($request->all());
        return 'TRUE';
    }
}
