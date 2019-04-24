<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use DB;
use DateTime;

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
        $ranking = array();
        $users = DB::select("SELECT id,name FROM users"); 
        
        foreach ($users as $user) 
        {
            $rides = DB::select("SELECT r.id FROM ride as r join data as d on d.ride_id=r.id WHERE r.user_id='$user->id' GROUP BY r.id");

            foreach($rides as $ride)
            {
                $powerGlobal = DB::select("
                    SELECT EXP(SUM(LN(value))) as value, d.added_on as date 
                    FROM data as d 
                    JOIN measure as m ON m.id=d.measure_id 
                    WHERE ( m.name='voltage' or m.name='intensity' ) and d.ride_id='$ride->id' 
                    GROUP BY d.added_on 
                    ORDER BY d.added_on ASC ");

                $power = $powerGlobal[0]->value;
                $date = new DateTime($powerGlobal[0]->date);

                $energyPulse = 0;

                foreach($powerGlobal as $powerPulse)
                {
                    $nextDate = new DateTime($powerPulse->date);

                    $step = ($nextDate->diff($date)->s)/3600;

                    $energyPulse += (($powerPulse->value + $power)*($step))/2;

                    $power = $powerPulse->value;
                    
                    $date = $nextDate;            
                }

                $firstDate = new DateTime($powerGlobal[0]->date);

                $totalTime = ($date->diff($firstDate)->s)/3600;

                $averagePower = $energyPulse/$totalTime;

                $ranking[$user->name] = $averagePower;
            }
        }

        return view('ranking',compact('ranking'));
    }

    public function old_ranking()
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
