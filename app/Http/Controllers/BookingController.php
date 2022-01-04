<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Rooms;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings=Booking::with('Customer','Room')->get();
        // dd($bookings);
        return view('Bookings.index',compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $customers=Customers::get();
        return view('Bookings.create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            Booking::create($request->all());
            return redirect('/bookedrooms');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking=Booking::findOrFail($id);

          $customers=Customers::get();
        return view('Bookings.edit',compact('booking','customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $booking=Booking::findOrFail($id);
         $booking->update($request->all());
        return redirect('/bookedrooms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }

     function available_rooms(Request $request,$checkin_date){
        $arooms=DB::SELECT("SELECT * FROM rooms WHERE id NOT IN
        (SELECT room_id FROM bookings WHERE '$checkin_date' BETWEEN checkin_date AND checkout_date)");

        // $data[]=$arooms;
        // foreach($arooms as $room){
        //     $roomTypes=Rooms::find($room->id);
        //     $data[]=['room'=>$room,];
        // }

        return response()->json(['data'=>$arooms]);
    }
}
