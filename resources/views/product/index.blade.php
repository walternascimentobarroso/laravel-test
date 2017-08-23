@extends('base')

@section('title', 'Produtos')

@section('container')
<h1 class="display-2">Produtos</h1>
            <div class="row">
                <div class="col">
                    <a class="btn btn-secondary" href="/product/create">
                        <i class="fa fa-plus fa-lg text-primary" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @include('table.table')
                </div>
            </div>
@endsection
