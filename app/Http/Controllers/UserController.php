<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
   public function index()
    {
        $users = User::get();
        return view('user.index',['users' => $users]);
    }

    public function create()
    {
        return view('user.create');
    }
    
    public function store(Request $request)
    {
        return redirect()->route('user.index')->with('message', 'Usuario salvo com sucesso!');
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
