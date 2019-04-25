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

    public function ranking(Request $request)
    {
        if(isset($request->rankType))
        {
            $type = $request->rankType;

            if($type == "user")
            {
                $ranking = array();
                $users = DB::select("SELECT id,nickname FROM users"); 
                
                foreach ($users as $user) 
                {
                    $ranking[$user->nickname] = 0; 

                    $rides = DB::select("SELECT r.id FROM ride as r join data as d on d.ride_id=r.id WHERE r.user_id='$user->id' GROUP BY r.id");

                    $i = 0;

                    foreach($rides as $ride)
                    {
                        
                        $powerGlobal = DB::select("
                            SELECT EXP(SUM(LN(value))) as value, d.added_on as date 
                            FROM data as d 
                            JOIN measure as m ON m.id=d.measure_id 
                            WHERE ( m.name='Voltage' or m.name='Intensity' ) and d.ride_id='$ride->id' 
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

                        $ranking[$user->nickname] += $averagePower;

                        $i++;
                    }

                    $ranking[$user->nickname] = $ranking[$user->nickname]/$i;
                }

                asort($ranking);

                return view('ranking',compact('ranking'));
            }

            else if($type =="ride")
            {
                $ranking = array();
                
                $rides = DB::select("SELECT r.id as id, u.nickname as nickname FROM ride as r join data as d on d.ride_id=r.id join users as u on u.id=r.user_id group by r.id");

                $i=0;

                foreach($rides as $ride)
                {
                    $powerGlobal = DB::select("
                        SELECT EXP(SUM(LN(value))) as value, d.added_on as date 
                        FROM data as d 
                        JOIN measure as m ON m.id=d.measure_id 
                        WHERE ( m.name='Voltage' or m.name='Intensity' ) and d.ride_id='$ride->id' 
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

                    $ranking[$i] = array("nickname"=>$ride->nickname, "score"=>$averagePower);

                    $i++;
                }
                
                $n = count($ranking);
                
                while($n > 1)
                {
                    $newn = 0;
                    
                    for($i=1; $i<=$n-1; $i++)
                    {
                        if($ranking[$i-1]["score"] > $ranking[$i]["score"])
                        {
                            $temp = $ranking[$i-1];
                            $ranking[$i-1] = $ranking[$i];
                            $ranking[$i] = $temp;
                            $newn=$i;
                        }
                    }
        
                    $n = $newn;
                }

                return view('ranking',compact('ranking'));
            }
        }

        else
        {
            return view('ranking');
        }

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