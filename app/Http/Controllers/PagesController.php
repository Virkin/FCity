<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
    	return view('welcome');
    }

    public function graph()
    {
    	return view('graph');
    }
}
