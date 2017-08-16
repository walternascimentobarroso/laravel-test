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
        var_dump($request->all());
        return 'TRUE';
    }
}
