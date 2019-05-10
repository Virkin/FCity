<?php

namespace App\Http\Controllers;

use App\Ride;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);   
    }

    public function graph()
    {

        $user = Auth::user();
        
        $userRide = DB::select("SELECT id, start_reservation from ride where user_id=$user->id");

        if (Input::get('ride') !== null)
        {
            $ride_id = Input::get('ride');
            $measure_name = Input::get('chartType');

            if($measure_name == "puiss")
            {
                $req = "SELECT avg(d1.value*d2.value) as value, d1.added_on
                            FROM (SELECT value, added_on, ride_id FROM data as d  WHERE d.measure_id=2 and d.ride_id=$ride_id) as d1
                            JOIN (SELECT value, added_on FROM data as d WHERE d.measure_id=3  and d.ride_id=$ride_id) as d2 ON d2.added_on=d1.added_on
                            GROUP BY d1.added_on";
            }
            else
            {
                $req = "SELECT value, added_on from data as d join ride as r on d.ride_id=r.id where r.id=$ride_id and d.measure_id=1";
            }
        }
        else
        {
            $req = "SELECT value, added_on from data as d join ride as r on d.ride_id=r.id where now() between r.start_reservation and r.end_reservation and d.measure_id=1";
        }

        $speedValues = DB::select($req);

        $value = array();
        $xLabel = array();
        
        $i = 1;

        $step = 10;

        foreach($speedValues as $speedValue)
        {
            if($i < $step)
            {
                if($i == $step/2)
                {
                    $date = $speedValue->added_on;
                }

                if(isset($avg))
                {
                    $avg = ($avg+$speedValue->value)/2;
                }
                else
                {
                    $avg = $speedValue->value;
                }

                $i++;
            }
            else
            {
                array_push($xLabel, $date);
                array_push($value, $avg);
                $i=1;
            }
        }

        $speedChart = app()->chartjs
            ->name('speedChart')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($xLabel)
            ->datasets([
                [
                    "label" => "Speed",
                    "lineTension" => 0,
                    #"pointRadius" => 0, 
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $value,
                ],
            ])
            ->options([]);

        $speedChart->optionsRaw("{
            scales: {
                xAxes: [{
                    type: 'time',
                    time: {
                        unit: 'hour',
                        stepSize: 0.25,
                        displayFormats: {
                            'hour': 'HH:mm',
                        }
                    }
                }]
            },
            animation: {
                duration: 0
            }
        }");

        if (Input::get('ride') !== null)
        {
            return view('graph', compact('speedChart','userRide','ride_id', 'measure_name'));
        }
        else
        {
            return view('graph', compact('speedChart','userRide'));
        }
    }

    /*public function ride($user_id)
    {
        $columns = ['id', 'name', 'model', 'brand', 'start_reservation', 'end_reservation'];
        $ride = DB::select('SELECT r.id, u.name, v.model, v.brand, r.start_reservation, r.end_reservation FROM ride AS r JOIN users AS u ON u.id = r.user_id JOIN vehicle AS v ON v.id = r.vehicle_id WHERE u.id = ? AND r.end_reservation > NOW()', [$user_id]);
        return view('reservation', compact('ride', 'columns'));
    }*/

}
