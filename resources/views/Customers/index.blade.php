@extends('layouts')
@section('title')
    All Customers Info
@endsection

@section('css')
    <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')

    {{-- End- AddCustomerModal --}}
    <div class="container-fluid">
        <h4 class="successmessage"></h4>
        <div class="">
            <a href="{{ route('customers.create') }}" type="button" class="btn btn-primary ">
                Add New Customer
            </a>

            <div class="card shadow mt-4">
                <div class="card-header py-3">
                    <h2 class="m-0 font-weight-bold f text-dark">All Customers List</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  text-center font-weight-bold" id="dataTable">
                            <thead class="">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">
                                        <h5>Customer Name </h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Email</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Country</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Phone</h5>
                                    </th>
                                    <th scope="col">
                                        <h5>Created Date</h5>
                                    </th>
                                    <th scope="col" class="not-export">
                                        <h5>Actions</h5>
                                    </th>


                                </tr>
                            </thead>
                            <tfoot class="">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col" class="not-export">Actions</th>


                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td>
                                        <td> {{ $customer->customerName ?? ' ' }}</td>

                                        <td>{{ $customer->email ?? ' ' }} </td>
                                        <td>{{ $customer->city ?? ' ' }} </td>
                                        <td>{{ $customer->phone ?? ' ' }} </td>
                                        <td>
                                            {{ $customer->created_at ?? '  2025' }}
                                            {{-- {{ \Carbon\Carbon::createFromTimestamp(strtotime($customer->created_at))->format('d-m-Y') ?? '2025 ' }} --}}
                                        </td>
                                        <td class="text-center">

                                            <a href="{{ route('customers.edit', $customer->id) }}"
                                                class="btn btn-circle btn-success"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('customer.delete', $customer->id) }}}" type="button"
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
    </div>
@endsection

@section('script')
    {{-- <script>
        $(document).ready(function() {

            fetchAllCustomers();
            // fetching all customer inside table using ajax +jquery code
            function fetchAllCustomers() {
                $.ajax({
                    type: "GET",
                    url: "/allcustomers",

                    dataType: "json",
                    success: function(response) {

                        $('tbody').html(' ');
                        $.each(response.customers, function(key, customer_value) {
                            $('tbody').append(
                                '<tr>\
                                                                                                                                                        <td>' +
                                customer_value
                                .id +
                                '</td>\
                                                                                                                                                        <td>' +
                                customer_value
                                .customerName +
                                '</td>\
                                                                                                                                                        <td>' +
                                customer_value
                                .email +
                                '</td>\
                                                                                                                                                        <td>' +
                                customer_value
                                .phone +
                                '</td>\
                                                                                                                                                        <td>' +
                                customer_value
                                .city +
                                '</td>\
                                                                                                                                                        <td><button type="button" value="' +
                                customer_value
                                .id +
                                '" class="btn btn-info editbtn btn-sm">Edit</button><button type="button" value="' +
                                customer_value.id +
                                '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                                                                                                                                                        </tr>'
                            );
                        });
                    }
                });
            }


            // add customer using ajax + jquery code
            $('.add_customer').click(function(e) {
                e.preventDefault();
                var data = {
                    'customerName': $('.customerName').val(),
                    'email': $('.email').val(),
                    'phone': $('.phone').val(),
                    'city': $('.city').val(),

                }
                // csrfToken
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/customers",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {
                            $('.customerErrors').html(' ');
                            $('.customerErrors').addClass('alert alert-danger text-white');
                            $.each(response.errors, function(key, error_value) {
                                $('.customerErrors').append('<li>' + error_value +
                                    '</li>');
                            });
                        } else {
                            $('.customerErrors').html(' ');
                            $('.successmessage').addClass('alert alert-success text-white');
                            $('.successmessage').text(response.message);
                            $('#AddCustomerModal').modal('hide');
                            $('#AddCustomerModal').find('input').val(' ');
                            fetchAllCustomers();

                        }
                    }
                });

            });
        });
    </script> --}}
    <!-- DataTable -->
    {{-- <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" type="text/javascript"></script> --}}

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
    <script>
        jQuery(document).ready(function($) {
            $('#dataTable').DataTable({
                // dom: 'Bfrtip',
                dom: "Blfrtip",

                buttons: [{
                        extend: 'pdfHtml5',
                        text: '<button  class="btn  btn-primary w-100 px-3 "><i class="fa fa-file-pdf mr-1 "></i> PDF</button>',

                        title: 'All Customers List',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }

                    },
                    {
                        text: '<button  class="btn  btn-primary w-100 px-3 "><i class="fa fa-file-csv mr-1"></i> CSV</button>',
                        extend: 'csvHtml5',
                        title: 'All Customers List',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }
                    },
                    {
                        text: '<button  class="btn  btn-primary w-100 px-3 "><i class="fa fa-file-excel mr-1"></i> Excel</button>',
                        extend: 'excelHtml5',
                        title: 'All Customers List',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<button  class="btn  btn-primary w-100 px-3 "><i class="fa fa-print mr-1"></i> Print</button>',

                        pageSize: 'A4',
                        title: 'All Customers List',
                        exportOptions: {
                            columns: ':visible:not(.not-export)'
                        }

                    },
                ]
            });

        });
    </script>
@endsection
