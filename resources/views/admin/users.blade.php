@extends('layouts.admin_layout')

@section('title', 'Users | Retinasoft')
@section('page_flow')
    <a href="">Users</a>
@endsection

@section('style')
    <link href="{{ asset('assets/css/dataTables.min.css') }}" rel="stylesheet">
    <style>
        .dataTables_length {
            display: none;
        }

        table td,
        th {
            background: var(--color-background) !important;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        table span {
            cursor: pointer;
        }

        label {
            display: none !important;
        }
        input, select{
            background: var(--color-background) !important;
        }
    </style>
@endsection

@section('content')
<h3 class="mt-4 mb-1 d-flex align-items-center"> <span class="material-symbols-outlined" title="Filter"> filter_list</span><span class="ml-1">Filter</span></h3>
    <div class="row  mb-4">
        <div class="col-md-3">
            <select name="" id="status" class="form-control">
                <option value="">All Status</option>
                <option value="1">Active</option>
                <option value="0">Deactive</option>
            </select>
        </div>
        <div class="col md-3">
            <input type="text"  id="name" class="form-control" placeholder="Name" autocomplete="false">
        </div>
        <div class="col md-3">
            <input type="text"  id="email" class="form-control" placeholder="Email" autocomplete="false">
        </div>
        <div class="col md-3">
            <input type="text" id="phone" class="form-control" placeholder="Phone" autocomplete="false">
        </div>
    </div>
    <table class="table table-responsive-md table-bordered mt-3 user_list" style="width: 100%">
        <thead>
            <tr>
                <th>Emp. ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>


            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

@endsection

@section('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/js/dataTables.min.js') }}"></script>
  
    <script type="text/javascript">
        $(function() {
            var table = $('.user_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('users') }}",
                    data: function(d) {
                        d.status = $('#status').val(),
                        d.name = $('#name').val()
                            d.search = $('input[type="search"]').val()
                            d.email = $('#email').val()
                            d.phone = $('#phone').val()
                    }
                },

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'sction'
                    },
                ]
            });

            $('#status').change(function() {
                table.draw();
            });

            $('#name').keypress(function() {
                table.draw();
            });


            $('#email').keypress(function() {
                table.draw();
            });

            $('#phone').keypress(function() {
                table.draw();
            });

        });



        function update_status(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('/users/status') }}/" + id,
                type: 'get',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status == "success") {
                        $.toastr.success(response.message);

                        refreshTable();
                    } else {
                        $.toastr.info(response.message);
                    }

                },
                error: function(response) {
                    $.toastr.error('Something Wrong');
                }
            });
        }


        function delete_data(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            });

            $('.swal-button--confirm').click(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ url('/delete/data') }}/" + id,
                    type: 'get',
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.status == "success") {
                            $.toastr.success(response.message);

                            refreshTable();
                        } else {
                            $.toastr.info(response.message);
                        }

                    },
                    error: function(response) {
                        $.toastr.error('Something Wrong');
                    }
                });
            });



        }

 

 
    </script>
@endsection
