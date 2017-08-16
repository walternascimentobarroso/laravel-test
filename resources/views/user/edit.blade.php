@extends('base')

@section('title', 'Cadastro de Usuario')

@section('container')
          <form action="/user/{{ $user['id'] }}" method="post">
            
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $user['id'] }}">
            <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Nome</label>
                <div class="col-10">
                    <input class="form-control" type="text" placeholder="Seu Nome" name="nome" value="{{ $user['name'] }}">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="example-email-input" class="col-2 col-form-label">Email</label>
                <div class="col-10">
                    <input class="form-control" type="email" placeholder="seu-email@example.com" name="email"  value="{{ $user['email'] }}">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="example-password-input" class="col-2 col-form-label">Senha</label>
                <div class="col-10">
                    <input class="form-control" type="password" placeholder="algumasenha" name="senha">
                </div>
            </div>
           <button type="submit" class="btn btn-primary btn-lg">Salvar</button>
            <button type="button" class="btn btn-secondary btn-lg">Cancelar</button>
          </form>
@endsection
