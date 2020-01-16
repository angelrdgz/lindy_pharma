<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;

use App\User;
use App\UserRole;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users'=>$users]);
    }

    public function create()
    {
        $roles = UserRole::all();
        return view('users.create', ['roles'=>$roles]);
    }

    public function store(Request $request)
    {
       $user = new User;
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = Hash::make($request->password);
       $user->role_id = $request->role;
       $user->save();

       return redirect('usuarios')->with('success', 'Usuario guardado correctamente');
    }
}
