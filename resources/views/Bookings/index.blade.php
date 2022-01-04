@extends('layouts')
@section('title')
    All Booked Rooms Info
@endsection
@section('css')
    <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Button trigger modal -->
    {{-- AddRoomModal --}}

    <div class="modal fade" id="AddRoomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Room</h5>
                    <button type="button" class="btn-btn-danger btn-close " data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="roomErrors ">

                    </ul>
                    <div class="form-group mb-3">
                        <label for="">Room Name</label>
                        <input type="text" class="form-control RoomName" name="RoomName">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Floor</label>
                        <input type="text" class="form-control Floor" name="Floor">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Price</label>
                        <input type="text" class="form-control Price" name="Price">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success add_room">Add Room </button>
                </div>
            </div>
        </div>
    </div>
    {{-- End- AddRoomModal --}}



    {{-- DeleteRoomModal --}}

    <div class="modal fade" id="deleteRoomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Room</h5>
                    <button type="button" class="btn-btn-danger btn-close " data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="editroomErrors ">

                    </ul>
                    <input type="" class="form-control" id="delete_room_id">


                    <h4>Are you Sure to Delete this Room</h4>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger delete_room_btn">Yes Sure </button>
                </div>
            </div>
        </div>
    </div>
    {{-- End- DeleteRoomModal --}}




    <div class="container-fluid">
        <h4 class="allmessages"></h4>
        <div class="align-right">
            <a href="{{ route('booking.create') }}" class="btn btn-primary">
                Book Room
            </a>
            <div class="card shadow mt-4 border-left-primary ">
                <div class="card-header py-3">
                    <h2 class="font-weight-bold text-dark text-uppercase ">Booking List</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="font-weight-bold text-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th class="" scope="col">Room Name</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Price</th>

                                    <th scope="col">Check In</th>
                                    <th scope="col">Check Out</th>
                                    <th scope="col">No Adults</th>
                                    <th scope="col">Total Staying Days</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col" class="not-export">Actions</th>

                                </tr>
                            </thead>
                            <tfoot class="font-weight-bold text-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th class="" scope="col">Room Name</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Price</th>

                                    <th scope="col">Check In</th>
                                    <th scope="col">Check Out</th>
                                    <th scope="col">No Adults</th>
                                    <th scope="col">Total Staying Days</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col" class="not-export">Actions</th>

                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr class="text-dark" style="font-weight: bold">
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ $booking->Room->RoomName ?? ' ' }}</td>
                                        <td> {{ $booking->Customer->customerName ?? ' ' }}</td>
                                        <td>{{ $booking->Room->Price ?? ' ' }} $ </td>

                                        <td> {{ \Carbon\Carbon::createFromTimestamp(strtotime($booking->checkin_date))->format('d-m-y') }}
                                        </td>
                                        <td> {{ \Carbon\Carbon::createFromTimestamp(strtotime($booking->checkout_date))->format('d-m-y') }}
                                        </td>
                                        <td class="text-center"> {{ $booking->total_adults }} Adults</td>
                                        <td class="text-center">
                                            {{-- {{ date_diff($booking->checkin_date, $booking->checkout_date) }} --}}

                                            {{ abs(\Carbon\Carbon::createFromTimestamp(strtotime($booking->checkin_date))->format('d') - \Carbon\Carbon::createFromTimestamp(strtotime($booking->checkout_date))->format('d')) }}
                                        </td>
                                        <td class="text-center">
                                            {{ abs($booking->Room->Price * (\Carbon\Carbon::createFromTimestamp(strtotime($booking->checkout_date))->format('d') - \Carbon\Carbon::createFromTimestamp(strtotime($booking->checkin_date))->format('d')) * $booking->total_adults) ?? '  ' }}
                                            $
                                        <td>
                                            <button type="button" class="btn btn-circle btn-success"><i
                                                    class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-circle btn-danger"><i
                                                    class="fas fa-trash"></i></button>

                                        </td>


                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    {{-- <script>
        $(document).ready(function() {
            fetchRooms();

            function fetchRooms() {
                $.ajax({
                    type: "GET",
                    url: "/fetchrooms",

                    dataType: "json",
                    success: function(response) {

                        $('tbody').html();
                        $.each(response.rooms, function(kay, item) {
                            $('tbody').append(
                                '<tr>\
                                                                                     <td>' + item.id + '</td>\
                                                                                     <td>' + item.RoomName + '</td>\
                                                                                      <td>' + item.Floor + '</td>\
                                                                                      <td>' + item.Price + " $" +
                                '</td>\
                                                                                      <td> <button   type="button" value="' +
                                item
                                .id +
                                '" class="btn btn-info  btn-sm editRoom">Edit</button><button type="button" value="' +
                                item.id + '" class="btn btn-danger  btn-sm deleteRoom">Delete</button></td>\
                                                                 < /tr > '
                            );
                        });

                    }
                });
            }
            // ADDing rooms to database using ajax code
            $(document).on('click', '.add_room', function(e) {
                e.preventDefault();
                var data = {
                    'RoomName': $('.RoomName').val(),
                    'Floor': $('.Floor').val(),
                    'Price': $('.Price').val(),

                }

                // csrfToken
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Add New Room ajax code
                $.ajax({
                    type: "POST",
                    url: "/rooms",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.status == 400) {
                            $('.roomErrors').html(' ');
                            $('.roomErrors').addClass("alert alert-danger text-white");
                            $.each(response.errors, function(key, err_value) {


                                $('.roomErrors').append('<li>' + err_value + '</li>');
                            });
                        } else {
                            $('.roomErrors').html(' ');
                            $('.allmessages').addClass('alert alert-success text-white');
                            $('.allmessages').text(response.message);
                            $('#AddRoomModal').modal('hide');
                            $('#AddRoomModal').find('input').val(' ');
                            fetchRooms();

                        }
                    }
                });
            });

            // Edit Room using ajax + jquery code

            $(document).on('click', '.editRoom', function(e) {
                e.preventDefault();
                var room_id = $(this).val();

                $('#editRoomModal').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/edit-room/" + room_id,
                    data: "data",
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 404) {

                            $('allmessages').html(' ');
                            $('allmessages').addClass('alert alter-danger');
                            $('allmessages').text(response.message);
                        } else {
                            $('.RoomName').val(response.room.RoomName);
                            $('.Floor').val(response.room.Floor);
                            $('.Price').val(response.room.Price);
                            $('#room_id').val(response.room.id);
                        }
                    }
                });
            });

            // Update Room code



            $(document).on('click', '.deleteRoom', function(e) {
                e.preventDefault();
                var room_id = $(this).val();

                $('#delete_room_id').val(room_id);

                $('#deleteRoomModal').modal('show');
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.delete_room_btn', function(e) {
                e.preventDefault();
                var room_id = $('#delete_room_id').val();

                $.ajax({
                    type: "DELETE",
                    url: "/deleteroom/" + room_id,
                    dataType: "json",

                    success: function(response) {
                        console.log(response);

                        $('.allmessages').addClass('alert alert-danger');
                        $('.allmessages').text(response.message);
                        $('#deleteRoomModal').modal('hide');
                        fetchRooms();

                    }
                });
            });
        });
    </script> --}}
    {{-- Datatable cdns --}}
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js">
    </script>

    {{-- datatable code --}}
    <script>
        jQuery(document).ready(function($) {
            $('#dataTable').DataTable({
                // dom: 'Bfrtip',
                dom: "Blfrtip",

                buttons: [{
                        extend: 'pdfHtml5',
                        text: '<button  class="btn  btn-primary w-100 px-3 "><i class="fa fa-file-pdf mr-1 "></i> PDF</button>',

                        title: 'All Booked Rooms Info',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }

                    },
                    {
                        text: '<button  class="btn  btn-primary w-100 px-3 "><i class="fa fa-copy mr-1"></i> Copy</button>',
                        extend: 'copyHtml5',
                        title: 'All Booked Rooms Info',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }
                    },
                    {
                        text: '<button  class="btn  btn-primary w-100 px-3 "><i class="fa fa-file-excel mr-1"></i> Excel</button>',
                        extend: 'excelHtml5',
                        title: 'All Booked Rooms Info',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<button  class="btn  btn-primary w-100 px-3 "><i class="fa fa-print mr-1"></i> Print</button>',

                        pageSize: 'A4',
                        title: 'All Booked Rooms Info',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }

                    },
                ]
            });

        });
    </script>
@endsection
