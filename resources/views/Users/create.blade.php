@extends('layouts')
@section('title')
    Add New User
@endsection
@section('content')


    <div class="container  p-4">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="card border-left-primary text-dark  font-weight-bold ">
                <div class="   card-header">
                    <h3 class="text-dark font-weight-bold ">Add New User</h3>
                </div>

                <div class="row p-3 ">
                    <div class="col-6 text-dark">


                        <div class="form-group ">
                            <label class="form-label"> Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">

                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">

                            <label class="form-label">Choose Permision</label>


                            <select class="form-control" name="isAdmin" id="">
                                <option>Choose Permision</option>
                                <option value="admin">admin</option>
                                <option value="staff">staff</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
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
