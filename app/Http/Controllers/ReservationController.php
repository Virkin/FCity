<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Ride;
use DB;
use Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get current user
        $user = Auth::user();

        $columns = ['id', 'nickname', 'model', 'brand', 'start_reservation', 'end_reservation'];

        // Select all ride of all users
        $ride = DB::select("SELECT r.id, u.nickname, v.model, v.brand, r.start_reservation, r.end_reservation, r.start_date, r.end_date, r.user_id
                            FROM ride AS r
                            JOIN users AS u ON u.id = r.user_id
                            JOIN vehicle AS v ON v.id = r.vehicle_id
                            ORDER BY r.id");

        return view('reservation.index', compact('ride', 'columns', 'user'));
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
        $previous = url()->previous();
        $previous_url = explode('/', $previous);
        $previous_route = end($previous_url);
        $start_reservation = request('start_reservation_date') . ' ' . request('start_reservation_time');
        $end_reservation = request('end_reservation_date') . ' ' . request('end_reservation_time');

        if ($end_reservation < $start_reservation)
        {
            if ($previous_route == "create")
            {
                return view('reservation.create', compact('datetime'));
            }
            elseif ($previous_route == "edit")
            {
                return view('reservation.edit', compact('datetime'));
            }
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

            $vehicle = DB::select("SELECT v.id, v.brand, v.model, v.type
                                FROM vehicle AS v
                                LEFT JOIN ride AS r ON r.vehicle_id = v.id
                                WHERE v.id NOT IN
                                (SELECT r.vehicle_id
                                FROM ride AS r
                                WHERE r.start_reservation BETWEEN '$start_reservation' AND '$end_reservation' 
                                OR '$start_reservation' BETWEEN r.start_reservation AND r.end_reservation)
                                GROUP BY v.id");
            if ($vehicle == [])
            {
                if ($previous_route == "create")
                {
                    return view('reservation.create', compact('datetime'));
                }
                elseif ($previous_route == "edit")
                {
                    return view('reservation.edit', compact('datetime'));
                }
            }
            else
            {
                if ($previous_route == "create")
                {
                    return view('reservation.create', compact('vehicle', 'datetime'));
                }
                elseif ($previous_route == "edit")
                {
                    return view('reservation.edit', compact('vehicle', 'datetime'));
                }
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
        $columns = ['id', 'nickname', 'model', 'brand', 'type', 'numberPlate', 'start_reservation', 'end_reservation', 'start_date', 'end_date'];

        $ride = DB::select("SELECT r.id, u.nickname, v.model, v.brand, v.type, v.numberPlate, r.start_reservation, r.end_reservation, r.start_date, r.end_date
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
        // Get current user
        $user = Auth::user();

        $ride = Ride::find($id);

        if ($user->id == $ride->user_id AND $ride->start_date == null AND $ride->end_date == null)
        {
            if (Input::get("start_reservation_date") !== null)
            {

                $start_reservation = Input::get("start_reservation_date").' '.Input::get("start_reservation_time");
                $end_reservation = Input::get("end_reservation_date").' '.Input::get("end_reservation_time");
                $start_reservation_date = Input::get("start_reservation_date");
                $start_reservation_time = Input::get("start_reservation_time");
                $end_reservation_date = Input::get("end_reservation_date");
                $end_reservation_time = Input::get("end_reservation_time");

                $datetime = [
                    'start_reservation' => $start_reservation,
                    'end_reservation' => $end_reservation,
                    'start_reservation_date' => $start_reservation_date,
                    'start_reservation_time' => $start_reservation_time,
                    'end_reservation_date' => $end_reservation_date,
                    'end_reservation_time' => $end_reservation_time
                ];

                $user_id = $ride["user_id"];

                $vehicle = DB::select("SELECT v.id, v.brand, v.model, v.type
                                FROM vehicle AS v
                                LEFT JOIN ride AS r ON r.vehicle_id = v.id
                                WHERE v.id NOT IN
                                (SELECT r.vehicle_id
                                FROM ride AS r
                                WHERE (r.start_reservation BETWEEN '$start_reservation' AND '$end_reservation' 
                                OR '$start_reservation' BETWEEN r.start_reservation AND r.end_reservation)
                                AND r.user_id != '$user_id')
                                GROUP BY v.id");

                if ($vehicle == [])
                {
                    return view('reservation.edit', compact('datetime', 'ride'));
                }
                else
                {
                    return view('reservation.edit', compact('vehicle', 'datetime', 'ride'));
                }
            }
            else
            {
                $start_reservation = $ride["start_reservation"];
                $end_reservation = $ride["end_reservation"];

                list($start_reservation_date, $start_reservation_time) = explode(' ', $start_reservation);
                list($end_reservation_date, $end_reservation_time) = explode(' ', $end_reservation);

                $datetime = [
                    'start_reservation' => $start_reservation,
                    'end_reservation' => $end_reservation,
                    'start_reservation_date' => $start_reservation_date,
                    'start_reservation_time' => $start_reservation_time,
                    'end_reservation_date' => $end_reservation_date,
                    'end_reservation_time' => $end_reservation_time
                ];

                return view('reservation.edit', compact('vehicle', 'datetime', 'ride'));
            }
        }
        else
        {
            return redirect('/reservation');
        }
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
        $ride = Ride::find($id);
        $ride->update($request->all());
        $ride->user_id = $request->get('user_id');
        $ride->vehicle_id = $request->get('vehicle_id');
        $ride->start_reservation = $request->get('start_reservation');
        $ride->end_reservation = $request->get('end_reservation');
        $ride->start_date = $request->get('start_date');
        $ride->end_date = $request->get('end_date');
        $ride->save();

        return redirect('/reservation')->with('success', 'Votre trajet à été  mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get current user
        $user = Auth::user();

        $ride = Ride::find($id);

        if ($user->id == $ride->user_id AND $ride->start_date == null AND $ride->end_date == null)
        {
            $ride->delete();
            return redirect()->route('reservation.index')->with('success','Trajet supprimé correctement');
        }
        else
        {
            return redirect('/reservation');
        }
    }
}
