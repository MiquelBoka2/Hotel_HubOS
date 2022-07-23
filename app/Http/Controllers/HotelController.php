<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHotel;
use App\Http\Requests\UpdateHotel;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Session;
use Yajra\DataTables\DataTables;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::get();
        return view('hotels.index')
            ->with('hotels',$hotels);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateHotel  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateHotel $request)
    {
        $hotel = Hotel::create($request->all());
        Session::flash('flash','Message info');

        return redirect()->route('hotels.index')
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
        $hotel = Hotel::find($id);
        return view('hotels.edit')
            ->with('hotel',$hotel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHotel  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHotel $request, $id)
    {

        $hotel  = Hotel::find($id);
        $hotel->update($request->all());
        return redirect()->route('hotels.index')
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

        $hotel = Hotel::find($id);

        $hotel->delete();
        return redirect()->route('hotels.index')
            ->with('success', trans("web.deleted_ok"));
    }
}
