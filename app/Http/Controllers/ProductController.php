<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel as Product;
use App\Table\Table;

class ProductController extends Controller
{
    public function __construct(Table $table)
    {
        $this->table = $table;
        $this->middleware('auth');
    }

    public function index()
    {
        dd($this->table->model(Product::class)->search()->rows());
        $products = Product::get();
        return view('product.index', ['products' => $products]);
    }

    public function create()
    {
        return view('product.create');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->get();
        return view('product.edit', ['product' => $product[0]]);
    }

    public function store(Request $request)
    {
        Product::insert([
            'name' => $request->nome,
            'description' => $request->descricao,
            'quantity' => $request->quantidade,
            'price' => $request->preco
        ]);
        return redirect()->route('product.index')->with('message', 'Produto salvo com sucesso!');
    }

    public function update(Request $request, $id)
    {
         Product::where('id', $id)
            ->update([
            'name' => $request->nome,
            'description' => $request->descricao,
            'quantity' => $request->quantidade,
            'price' => $request->price
            ]);
        return redirect()->route('product.index')->with('message', 'Usuario editado com sucesso!');
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
