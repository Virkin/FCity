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
        $columns = ['id', 'name', 'model', 'brand', 'start_reservation', 'end_reservation'];
        $ride = DB::select('SELECT r.id, u.name, v.model, v.brand, r.start_reservation, r.end_reservation FROM ride AS r JOIN users AS u ON u.id = r.user_id JOIN vehicle AS v ON v.id = r.vehicle_id WHERE u.id = ? AND r.end_reservation > NOW()', [$user_id]);
        return view('reservation', compact('ride', 'columns'));
    }
}
