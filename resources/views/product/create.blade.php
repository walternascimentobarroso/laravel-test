@extends('base')

@section('title', 'Cadastro de Produto')

@section('container')
           <form action="/product" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group row">
                <label class="col-2 col-form-label">Nome</label>
                <div class="col-10">
                    <input class="form-control" type="text" placeholder="Seu Nome" name="nome">
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-2 col-form-label">Descrição</label>
                <div class="col-10">
                    <input class="form-control" type="text" placeholder="descrição" name="descricao">
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-2 col-form-label">Quantidade</label>
                <div class="col-10">
                    <input class="form-control" type="number" placeholder="quantidade" name="quantidade">
                </div>
            </div>

             <div class="form-group row">
                <label class="col-2 col-form-label">Preço</label>
                <div class="col-10">
                    <input class="form-control" type="number" placeholder="preço" name="preco">
                </div>
            </div>
           <button type="submit" class="btn btn-primary btn-lg">Salvar</button>
            <button type="button" class="btn btn-secondary btn-lg">Cancelar</button>
          </form>
@endsection
