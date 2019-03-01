<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function ranking()
    {
        $ranking = DB::select(" 
            SELECT u.name as name, round(avg(dataAvg.avgRide),2) as score
            FROM
            (
                SELECT d.ride_id as ride_id, avg((d1.startValue-d1.endValue)/d2.avgSpeed*TIMESTAMPDIFF(HOUR, r.start_date, r.end_date)) as avgRide
                FROM data as d
                JOIN
                (
                    SELECT d.ride_id as id, max(d.value) as startValue, min(d.value) as endValue 
                    FROM data as d
                    JOIN measure as m on m.id=d.measure_id
                    WHERE m.name='voltage'
                    GROUP BY d.ride_id
                ) as d1 on d.ride_id=d1.id
                JOIN
                (
                    SELECT d.ride_id as id, avg(d.value) as avgSpeed 
                    FROM data as d 
                    JOIN measure as m ON d.measure_id=m.id
                    WHERE m.name='speed'
                    GROUP BY d.ride_id
                ) as d2 on d.ride_id=d2.id
                JOIN ride as r on d.ride_id=r.id
                GROUP BY d.ride_id
            ) as dataAvg
            JOIN ride as r on dataAvg.ride_id=r.id
            JOIN users as u on r.user_id=u.id 
            GROUP BY r.user_id
            ORDER BY score");
        
        return view('ranking',compact('ranking'));
    }
}
