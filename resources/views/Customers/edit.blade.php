@extends('layouts')
@section('content')


    <div class="container  p-4">
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card border-left-primary text-dark  font-weight-bold ">
                <div class="   card-header">
                    <h3 class="text-dark font-weight-bold ">Add New Customer</h3>
                </div>

                <div class="row p-3 ">
                    <div class="col-6 text-dark">


                        <div class="form-group ">
                            <label class="form-label">Customer Name</label>
                            <input type="text" class="form-control" name="customerName"
                                value="{{ $customer->customerName }}">
                        </div>
                        <div class="   form-group">

                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}">
                        </div>
                    </div>

                    <div class="col-6">

                        <div class="form-group">

                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $customer->email }}">
                        </div>

                        <div class="form-group">

                            <label class="form-label">City</label>
                            <input type="text" class="form-control" name="city" value="{{ $customer->city }}">
                        </div>





                    </div>



                    <div class="form-group m-auto">

                        <button type="submit" class="btn btn-primary mt-4">Edit Customer info</button>
                        <a href="/customers" type="button" class="btn btn-danger mt-4">Go back To Customers</a>
                    </div>




                </div>
        </form>
    </div>
    </div>


@endsection
