<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoom;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotel_id = 0;
        $rooms = Room::get();
        return view('rooms.index')
            ->with('rooms',$rooms)
            ->with('hotel_id',$hotel_id);
    }
    public function roomsFromHotel($hotel_id)
    {
        $rooms = Room::where('hotel_id',$hotel_id)->get();
        $hotel = Hotel::find($hotel_id);
        return view('rooms.index')
            ->with('rooms',$rooms)
            ->with('hotel_id',$hotel_id)
            ->with('hotel',$hotel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotels = Hotel::orderBy('name','asc')
            ->pluck('name','id');
        $hotel_id = 0;

        return view('rooms.create')
            ->with('hotels',$hotels)
            ->with('hotel_id',$hotel_id);
    }
    public function createFromHotel($hotel_id)
    {
        $hotels = Hotel::orderBy('name','asc')
            ->pluck('name','id');

        return view('rooms.create')
            ->with('hotels',$hotels)
            ->with('hotel_id',$hotel_id);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoom $request)
    {
        $room = Room::create($request->all());

        if($request->current_hotel > 0){

            return redirect()->route('hotels.rooms',[$request->current_hotel])
                ->with('success', trans("web.created_ok"));
        }
        return redirect()->route('rooms.index')
            ->with('success', trans("web.created_ok"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $hotels = Hotel::orderBy('name','asc')
            ->pluck('name','id');
        $hotel_id = 0;

        $room = Room::find($id);
        return view('rooms.edit')
            ->with('hotels',$hotels)
            ->with('room',$room)
            ->with('hotel_id',$hotel_id);
    }

    public function editFromHotel($id,$hotel_id)
    {

        $hotels = Hotel::orderBy('name','asc')
            ->pluck('name','id');

        $room = Room::find($id);
        return view('rooms.edit')
            ->with('hotels',$hotels)
            ->with('room',$room)
            ->with('hotel_id',$hotel_id);
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

        $room  = Room::find($id);
        $room->update($request->all());

        if($request->current_hotel > 0) {
            return redirect()->route('hotels.rooms', [$request->current_hotel])
                ->with('success', trans("web.updated_ok"));
        }
        return redirect()->route('rooms.index')
            ->with('success', trans("web.updated_ok"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $room = Room::find($id);

        $room->delete();
        return redirect()->route('rooms.index')
            ->with('success', trans("web.deleted_ok"));
    }
    public function destroyFromHotel($id,$hotel_id)
    {

        $room = Room::find($id);

        $room->delete();
        return redirect()->route('hotels.rooms', [$hotel_id])
            ->with('success', trans("web.deleted_ok"));
    }
}
