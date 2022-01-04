<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customers::orderByDesc("customerName")->get();
        return view('Customers.index',compact('customers'));
    }
    public function allCustomers()
    {
     $customers=Customers::orderByDesc("customerName")->get();

     return response()->json([
        'customers'=>$customers
     ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('Customers.create');
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
        //     'customerName'=>'required',
        //     'email'=>'required|email',
        //     'phone'=>'required',
        //     'city'=>'required',
        // ]);

        // if ($validate->fails()) {
        //     return response()->json([
        //         'status'=>400,
        //         'errors'=>$validate->messages()
        //     ]);
        // } else {
        //     Customers::create($request->all());
        //     return response()->json([
        //         'status'=>200,
        //         'message'=>'Customer Added Succesfully'
        //     ]);
        // }

         Customers::create($request->all());
         return redirect('/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function show(Customers $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customers,$id)
    {
        $customer=Customers::findOrFail($id);
        return view('Customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

         $customer=Customers::findOrFail($id);
         $customer->update($request->all());
        return redirect('/customers');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customers  $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           $customer=Customers::findOrFail($id);
           $customer->delete();
             return redirect('/customers');
    }
}
