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
        
        $speedValues = DB::select("SELECT value, added_on from data as d join ride as r on d.ride_id=r.id 
        where NOW() BETWEEN r.start_reservation and r.end_reservation    and d.measure_id=1");

        $value = array();
        $xLabel = array();
        $i = 0;

        foreach($speedValues as $speedValue)
        {
            array_push($xLabel,$speedValue->added_on);
            array_push($value, $speedValue->value);
            $i++;
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
                    //"pointRadius" => 0, 
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

        $voltageValues = DB::select("SELECT value from data as d join ride as r on d.ride_id=r.id 
        where NOW() BETWEEN r.start_reservation and r.end_reservation and d.measure_id=2");

        $value = array();
        $xLabel = array();
        $i = 0;

        foreach($voltageValues as $voltageValue)
        {
            array_push($xLabel,$i);
            array_push($value, $voltageValue->value);
            $i++;
        }

        $voltageChart = app()->chartjs
            ->name('voltageChart')
            ->type('line')
            ->size(['width' => 200, 'height' => 200])
            ->labels($xLabel)
            ->datasets([
                [
                    "label" => "Voltage",
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

        $voltageChart->optionsRaw("{
            scales: {
                xAxes: [{
                    gridLines : {
                        display : false
                    }, 
                    ticks: {
                        display:false
                    } 
                }]
            },
            animation: {
                duration: 0
            }
        }");

    	return view('graph', compact('speedChart','voltageChart','ip'));
    }

    /*public function ride($user_id)
    {
        $columns = ['id', 'name', 'model', 'brand', 'start_reservation', 'end_reservation'];
        $ride = DB::select('SELECT r.id, u.name, v.model, v.brand, r.start_reservation, r.end_reservation FROM ride AS r JOIN users AS u ON u.id = r.user_id JOIN vehicle AS v ON v.id = r.vehicle_id WHERE u.id = ? AND r.end_reservation > NOW()', [$user_id]);
        return view('reservation', compact('ride', 'columns'));
    }*/

}
