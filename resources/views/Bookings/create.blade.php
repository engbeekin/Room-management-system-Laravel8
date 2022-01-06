@extends('layouts')
@section('content')




    <div class="container">
        <form action="{{ route('booking.store') }}" method="POST">
            @csrf
            <div class="card border-left-primary text-dark  font-weight-bold ">
                <div class="   card-header">
                    <h3 class="text-dark font-weight-bold ">Book A Room abdikani sugule</h3>
                </div>

                <div class="row p-3 ">
                    <div class="col-6 text-dark"">
                                                                                                            <div>
                                                                                                                <label for="
                        check in" class="form-label text-dark"">Choose Customer Name</label>
                                                                                                        <select class="






                                   form-control " name="customer_id">
                        <option>Choos Customer</option>
                        @foreach ($customers as $customer)

                            <option value="{{ $customer->id }}">{{ $customer->customerName }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="">
                        <label for="check in" class="form-label my-3">Check out</label>
                        <input type="date" class="form-control" name="checkout_date">
                    </div>
                    {{-- <div>
                        <label for="check in" class="form-label my-3">Total Staying Days</label>
                        <input type="number" class="form-control  " name="staying_days">
                    </div> --}}

                </div>

                <div class="col-6">


                    <div>
                        <label for="check in" class="form-label">Check in</label>
                        <input type="date" class="form-control checkin-date" name="checkin_date">
                    </div>
                    <div class="">
                        <label for="total_adults" class="form-label my-3">Availabe Rooms</label>
                        <select class="form-control room-list" name="room_id">
                            <option selected>Availabe Rooms</option>
                        </select>
                    </div>


                    <div>
                        <label for="check in" class="form-label my-3">Total Persons</label>
                        <input type="number" class="form-control " name="total_adults">
                    </div>



                    <button type="submit" class="btn btn-primary mt-3 ">Book Rooms</button>
                </div>







            </div>
        </form>
    </div>
    </div>


@endsection





@section('script')


    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>



    <script type="text/javascript">
        $(document).ready(function() {

            $(".checkin-date").on('blur', function() {

                var _checkindate = $(this).val();
                console.log(_checkindate);
                // Ajax
                $.ajax({
                    url: "{{ url('booking') }}/available-rooms/" + _checkindate,
                    dataType: 'json',

                    // beforeSend: function() {
                    //     $(".room-list").append('<option>--- Loading ---</option>');
                    // },
                    success: function(res) {

                        console.log(res);
                        // var _html = '';
                        $.each(res.data, function(key, value) {


                            $(".room-list").append(
                                '<option value = ' + value.id + ' >' + "Room No-" +
                                value
                                .RoomName + '</option>'
                            );
                        });




                    }
                    // }
                });
            });
        });
    </script>
@endsection
