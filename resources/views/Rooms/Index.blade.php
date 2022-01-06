@extends('layouts')
@section('title')
    All Rooms Info
@endsection
@section('css')
    <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')



    <div class="container-fluid">
        <h4 class="allmessages"></h4>


        <div class="card shadow mt-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-10">
                        <h2 class=" font-weight-bold font-size-5 text-dark">Rooms List</h2>

                    </div>
                    <div class="col-2">
                        <a href="{{ route('rooms.create') }}" type="button" class="btn btn-lg btn-primary ">
                            Add New Room
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  text-center font-weight-bold" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">
                                    <h5>Room Name</h5>
                                </th>
                                <th scope="col">
                                    <h5>Floor</h5>
                                </th>
                                <th scope="col">
                                    <h5>Price</h5>
                                </th>
                                <th scope="col" class="text-center not-export">
                                    <h5>Actions</h5>
                                </th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Room Name</th>
                                <th scope="col">Floor</th>
                                <th scope="col">Price</th>
                                <th scope="col" class="text-center not-export">Actions</th>

                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($rooms as $room)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ $room->RoomName ?? ' ' }}</td>

                                    <td>{{ $room->Price ?? ' ' }} $ </td>
                                    <td>{{ $room->Floor ?? ' ' }} Floor </td>
                                    <td class="text-center">

                                        <a href="{{ route('rooms.edit', $room->id) }}" type="button"
                                            class="btn btn-circle btn-success"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('rooms.destroy', $room->id) }}" type="button"
                                            class="btn btn-circle btn-danger"><i class="fas fa-trash"></i></a>


                                    </td>


                                </tr>
                            @endforeach

                        </tbody>
                    </table>
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
                                                                                                                                                                                         <td>' +
                                item
                                .id +
                                '</td>\
                                                                                                                                                                                         <td>' +
                                item
                                .RoomName +
                                '</td>\
                                                                                                                                                                                          <td>' +
                                item
                                .Floor +
                                '</td>\
                                                                                                                                                                                          <td>' +
                                item
                                .Price +
                                " $" +
                                '</td>\
                                                                                                                                                                                          <td> <button   type="button" value="' +
                                item
                                .id +
                                '" class="btn btn-info  btn-sm editRoom">Edit</button><button type="button" value="' +
                                item.id +
                                '" class="btn btn-danger  btn-sm deleteRoom">Delete</button></td>\
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

                        title: 'All Rooms List',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }

                    },
                    {
                        text: '<button  class="btn  btn-primary w-100 px-3 "><i class="fa fa-copy mr-1"></i> Copy</button>',
                        extend: 'copyHtml5',
                        title: 'All Rooms List',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }
                    },
                    {
                        text: '<button  class="btn  btn-primary w-100 px-3 "><i class="fa fa-file-excel mr-1"></i> Excel</button>',
                        extend: 'excelHtml5',
                        title: 'All Rooms List',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<button  class="btn  btn-primary w-100 px-3 "><i class="fa fa-print mr-1"></i> Print</button>',

                        pageSize: 'A4',
                        title: 'All Rooms List',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }

                    },
                ]
            });

        });
    </script>
@endsection
