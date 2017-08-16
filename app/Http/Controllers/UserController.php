<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
   public function index()
    {
        $users = User::get();
        return view('user.index',['users' => $users]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->get();
        return view('user.edit',['user' => $user[0]]);
    }
    
    public function store(Request $request)
    {
        User::insert([
            'name' => $request->nome,
            'email' => $request->email,
            'password' => bcrypt($request->senha)
        ]);
        return redirect()->route('user.index')->with('message', 'Usuario salvo com sucesso!');
    }

    public function update(Request $request, $id)
    {
         $r = User::where('id', $id)
            ->update([
            'name' => $request->nome,
            'email' => $request->email,
            'password' => bcrypt($request->senha)
        ]);
        return redirect()->route('user.index')->with('message', 'Usuario editado com sucesso!');
    }

    public function show(Request $request, $id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('user.index')->with('message', 'Usuario' + $id + 'excluido com sucesso!');
    }

    public function destroy(Request $request)
    {
        var_dump($request->all());
        return 'TRUE';
    }
}
