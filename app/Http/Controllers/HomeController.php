<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }


    public function index() {

        $user = auth()->user();

        return view('home',compact('user'));
    }
}
