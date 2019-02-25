<?php

namespace App\Http\Controllers;

use App\Ride;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use DB;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function graph()
    {
    
    	if(isset($_SERVER['SERVER_ADDR']))
    	{
    		$ip = $_SERVER['SERVER_ADDR'];
    	}
    	else
    	{
    		$ip = "127.0.0.1";
    	}
    	

    	return view('graph', compact('ip'));
    }

    public function ride($user_id)
    {
        $columns = DB::getSchemaBuilder()->getColumnListing('ride');
        $ride = Ride::where('user_id', $user_id)->get();
        return view('reservation', compact('ride', 'columns'));
    }
}
