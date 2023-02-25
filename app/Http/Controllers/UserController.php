<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('user.lista-user');
    }

    public function editUser()
    {
        return view('user.novo-user');
    }
}
