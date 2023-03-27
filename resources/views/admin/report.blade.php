@extends('layouts.admin_layout')
@section('title','Report | Retinasoft')
@section('page_flow','Report')

@section('style')
    <link href="{{ asset('assets/css/dataTables.min.css') }}" rel="stylesheet">
    <style>
      

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
<div class="row">
    
    <div class="col-md-3">
        <select name="" class="form-control mt-3 mb-3" id="user">
            <option value="">Search user</option>
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-9"></div>
</div>
<table class="table table-bordered table-hover table-responsive-sm attendance_report">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">In Time</th>
        <th scope="col">Out Time</th> 
        <th scope="col">Worked</th> 
      </tr>
    </thead>
    <tbody>
     
    </tbody>
  </table>
@endsection

@section('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/js/dataTables.min.js') }}"></script>
 
<script>
      $(function() {
            var table = $('.attendance_report').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('attendance.report') }}",
                    data: function(d) {
                        d.status = $('#status').val()
                        d.user = $('#user').val()
                     
                    }
                },

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'in_time',
                        name: 'in_time'
                    },
                    {
                        data: 'out_time',
                        name: 'out_time'
                    } ,
                    {
                        data: 'worked',
                        name: 'worked'
                    } 
                ]
            });

            $('#user').change(function() {
                table.draw();
            });
 
        });
</script>
@endsection