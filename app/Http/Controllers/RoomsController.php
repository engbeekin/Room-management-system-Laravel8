<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Validator;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $rooms=Rooms::get();
        return view('Rooms.Index',compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $validate=Validator::make($request->all(),[
        //      'RoomName'=>'required',
        //     'Floor'=>'required',
        //     'Price'=>'required',
        // ]);
        // if ($validate->fails()) {
        //     return response()->json([
        //         'status'=>400,
        //          'errors'=>$validate->messages(),

        //     ]);
        // }else {

        //        return response()->json([
        //         'status'=>200,

        //          'message'=>"Room Added SuccessFully"

        //     ]);
        // }
         Rooms::create($request->all());
         return redirect('/rooms');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
    public function show(Rooms $rooms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $room=Rooms::findOrFail($id);
        return view('Rooms.edit',compact('room'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

            $room=Rooms::findOrFail($id);
                $room->update($request->all());

                return redirect('/rooms');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $room=Rooms::findOrFail($id);
          $room->delete();
          return redirect('/rooms');
    }
}
