@extends('base')

@section('title', 'Usuarios')

@section('container')
            <div class="row">
                <div class="col">
                    <a class="btn btn-secondary" href="/user/create">
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
                                <th>Email</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <button class="btn btn-secondary">
                                        <i class="fa fa-pencil fa-lg text-warning" aria-hidden="true"></i>
                                    </button>
                                    |
                                    <a class="btn btn-secondary" href="/user/{{ $user->id }}">
                                        <i class="fa fa-trash-o fa-lg text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
