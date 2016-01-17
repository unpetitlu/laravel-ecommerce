<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Services\Twitter;

class AdminController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth.admin');
        $this->middleware('auth.admin', ['except' => [
          'login',
        ]]);
    }
    
    public function dashboard()
    {
      $twitter = new Twitter();

      $tweets = $twitter->getTweets();

      return view('dashboard', compact('tweets'));
    }

    public function login()
    {
      return view('auth.login-admin');
    }
}
