@extends('base')

@section('title', 'Produtos')

@section('container')
            <div class="row">
                <div class="col">
                    <a class="btn btn-secondary" href="/product/create">
                        <i class="fa fa-plus fa-lg text-primary" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>Preço</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <button class="btn btn-secondary">
                                        <i class="fa fa-pencil fa-lg text-warning" aria-hidden="true"></i>
                                    </button>
                                    |
                                    <button class="btn btn-secondary">
                                        <i class="fa fa-trash-o fa-lg text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
