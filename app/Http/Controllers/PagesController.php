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

    /*public function ride($user_id)
    {
        $columns = ['id', 'name', 'model', 'brand', 'start_reservation', 'end_reservation'];
        $ride = DB::select('SELECT r.id, u.name, v.model, v.brand, r.start_reservation, r.end_reservation FROM ride AS r JOIN users AS u ON u.id = r.user_id JOIN vehicle AS v ON v.id = r.vehicle_id WHERE u.id = ? AND r.end_reservation > NOW()', [$user_id]);
        return view('reservation', compact('ride', 'columns'));
    }*/

    public function ranking()
    {
        $ranking = DB::select(" SELECT u.name as name, avg(d.value) as value FROM data as d 
                                    JOIN ride as r ON d.ride_id=r.id 
                                    JOIN measure as m ON d.measure_id=m.id
                                    JOIN users as u ON r.user_id=u.id 
                                WHERE m.name='speed'
                                GROUP BY r.user_id");
        return view('ranking',compact('ranking'));
    }
}
