<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');//kind of protection.if you are not logged in,no method of this class is accessible.Otherwise you will be redirected to the login page
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::find(Auth::id());
        $todos=$user->todos()->latest()->get();
        return view('home')->with('todos',$todos); //the 'todos' will be the variable name in our home.blade.php
    }
}
