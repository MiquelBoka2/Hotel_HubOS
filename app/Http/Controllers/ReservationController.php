<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservation;
use App\Http\Requests\UpdateReservation;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    function index($room_id){

        $room = Room::find($room_id);
        $reservations = $room->reservations;

        return view('reservations.index')
            ->with('room',$room)
            ->with('reservations',$reservations);
    }

    function create($room_id){

        $room = Room::find($room_id);
        return view('reservations.create')
            ->with('room',$room);
    }

    public function store(CreateReservation $request)
    {
        $reservation = Reservation::create($request->all());


        return redirect()->route('reservations.index',[$request->room_id])
                ->with('success', trans("web.created_ok"));
    }
    public function edit($id)
    {
        $reservation = Reservation::find($id);
        $room = Room::find($reservation->id);
        return view('reservations.edit')
            ->with('reservation',$reservation)
            ->with('room',$room);
    }
    public function update(UpdateReservation $request, $id)
    {
        $reservation  = Reservation::find($id);
        $reservation->update($request->all());

        return redirect()->route('reservations.index',[$request->room_id])
                ->with('success', trans("web.updated_ok"));
    }
    public function destroy($id)
    {

        $reservation = Reservation::find($id);
        $room_id = $reservation->room_id;
        $reservation->delete();
        return redirect()->route('reservations.index',[$room_id])
            ->with('success', trans("web.deleted_ok"));
    }
    public function checkin($id){
        $reservation = Reservation::find($id);
        $reservation->status = 1;
        $reservation->save();
        return response()->json([
            'status' => "Ok"
        ]);
    }
    public function checkout($id){
        $reservation = Reservation::find($id);
        $reservation->status = 2;
        $reservation->checkout= date("Y-m-d");
        $reservation->save();
        return response()->json([
            'status' => "Ok",
            'reservation' => $reservation
        ]);
    }
}
