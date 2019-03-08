<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ride;
use DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['id', 'name', 'model', 'brand', 'type', 'start_reservation', 'end_reservation'];

        $ride = DB::select("SELECT r.id, u.name, v.model, v.brand, v.type, r.start_reservation, r.end_reservation
                            FROM ride AS r
                            JOIN users AS u ON u.id = r.user_id
                            JOIN vehicle AS v ON v.id = r.vehicle_id
                            ORDER BY r.id");

        return view('reservation.index', compact('ride', 'columns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservation.create');
    }

    public function date(Request $request)
    {
        $start_reservation = request('start_reservation_date') . ' ' . request('start_reservation_time');
        $end_reservation = request('end_reservation_date') . ' ' . request('end_reservation_time');

        if ($end_reservation < $start_reservation)
        {
            return view('reservation.create', compact('datetime'));
        }
        else
        {
            $datetime = [
                'start_reservation' => $start_reservation,
                'end_reservation' => $end_reservation,
                'start_reservation_date' => request('start_reservation_date'),
                'start_reservation_time' => request('start_reservation_time'),
                'end_reservation_date' => request('end_reservation_date'),
                'end_reservation_time' => request('end_reservation_time')
            ];

            $ride = DB::select("SELECT v.id, v.brand, v.model, v.type
                                FROM vehicle AS v
                                LEFT JOIN ride AS r ON r.vehicle_id = v.id
                                WHERE v.id NOT IN
                                (SELECT r.vehicle_id
                                FROM ride AS r
                                WHERE r.start_reservation BETWEEN '$start_reservation' AND '$end_reservation' 
                                OR '$start_reservation' BETWEEN r.start_reservation AND r.end_reservation)
                                GROUP BY v.id");
            if ($ride == [])
            {
                return view('reservation.create', compact('datetime'));
            }
            else
            {
                return view('reservation.create', compact('ride', 'datetime'));
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Ride::create([
            'user_id' => request('user_id'),
            'vehicle_id' => request('vehicle_id'),
            'start_reservation' => request('start_reservation'),
            'end_reservation' => request('end_reservation'),
            'start_date' => request('start_date'),
            'end_date' => request('end_date')
        ]);

        return redirect('/reservation');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ride $reservation)
    {
        $columns = ['id', 'name', 'model', 'brand', 'type', 'start_reservation', 'end_reservation', 'start_date', 'end_date'];

        $ride = DB::select("SELECT r.id, u.name, v.model, v.brand, v.type, r.start_reservation, r.end_reservation, r.start_date, r.end_date
                            FROM ride AS r
                            JOIN users AS u ON u.id = r.user_id
                            JOIN vehicle AS v ON v.id = r.vehicle_id
                            WHERE r.id = '$reservation->id'");

        return view('reservation.show', compact('ride', 'columns'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}