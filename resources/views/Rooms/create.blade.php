@extends('layouts')
@section('title')
    Add New Room
@endsection
@section('content')


    <div class="container  p-4">
        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf
            <div class="card border-left-primary text-dark  font-weight-bold ">
                <div class="   card-header">
                    <h3 class="text-dark font-weight-bold ">Add New Room</h3>
                </div>

                <div class="row p-3 ">
                    <div class="col-6 text-dark">


                        <div class="form-group ">
                            <label class="form-label">Room Name</label>
                            <input type="text" class="form-control" name="RoomName">
                        </div>
                        <div class="form-group">

                            <label class="form-label">Floor</label>
                            <input type="text" class="form-control" name="Floor">
                        </div>
                    </div>

                    <div class="col-6">

                        <div class="form-group">

                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" name="Price">
                        </div>







                    </div>



                    <div class="form-group m-auto">

                        <button type="submit" class="btn btn-primary mt-4">Add New Customer</button>
                        <a href="/rooms" type="button" class="btn btn-danger mt-4">Go back To Customers</a>
                    </div>




                </div>
        </form>
    </div>
    </div>


@endsection
