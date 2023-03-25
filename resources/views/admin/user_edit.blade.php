@extends('layouts.admin_layout')
@section('title', $user->name . ' |Retinasoft');
@section('style')
    <style>
        main{
            margin-top: 0px !important;
        }
        .top{
            margin-top: 0px !important;
        }
    </style>
@endsection
@section('page_flow','Profile')

@section('content')
    <form action="{{ route('user.update') }}" method="post" id="update_user_form" enctype="multipart/form-data">
        @csrf
        <div class="row mb-4">
            <div class="col-md-1">
            </div>
            <input type="hidden" name="id" value="{{$user->id}}">
            <div class="col-md-3"> 
                @if (isset($user->details) && $user->details->photo != null)
      
                    <img src="{{ asset('images/profile/' . $user->details->photo) }}" class="img-responsiv mb-2"
                        alt="Profile Photo" id="output">
                @else
                    <img src="{{ asset('images/profile/blank.jpg') }}" class="img-responsiv mb-2" alt="Profile Photo"
                        id="output">
                @endif

                <div class="form-group">
                    <label for="">Profile Photo</label>
                    <input type="file" name="photo" id="" class="form-control"
                        onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                </div>
            </div>

            <div class="col-md-7">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" value="{{old('name', @$user->name)}}" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" value="{{old('email', @$user->email)}}" placeholder="Enter Email">
                </div>

                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{old('phone', @$user->phone)}}" placeholder="Enter Phone">
                </div>

                <div class="form-group">
                    <label for="">Status</label>
                    <input type="text" class="form-control" name="phone"
                        value="{{ Auth::user()->status == 1 ? 'Active' : 'Deactive' }}">
                </div>

                <div class="form-group">
                    <label for="">Date of Birth</label>
                    <input type="date" class="form-control" name="dob" value="{{old('dob', @$user->details->dob)}}">
                </div>


                <div class="form-group">
                    <label for="">IP address</label>
                    <input type="text" class="form-control" name="ip_address" value="{{old('ip_address', @$user->details->ip_address)}}" placeholder="192.168.92.5">
                </div>


                <div class="form-group">
                    <label for="">Address</label>
                    <textarea name="address" id="" cols="30"  class="form-control" rows="3">{{old('address', @$user->details->address)}}</textarea>
                </div>

                <hr>
                <h6>Emergency Contact</h6>

                <div class="form-group">
                    <label for=""> Name</label>
                    <input type="text" class="form-control" name="contact_name" value="{{old('contact_name', @$user->contact->contact_name)}}"
                        placeholder="Enter Emergency Contact Name">
                </div>

                <div class="form-group">
                    <label for=""> Email</label>
                    <input type="text" class="form-control" name="contact_email" value="{{old('contact_email', @$user->contact->contact_email)}}"
                        placeholder="Enter Emergency Contact Email">
                </div>

                <div class="form-group">
                    <label for=""> Phone</label>
                    <input type="text" class="form-control" name="contact_phone" placeholder="Enter Emergency Contact Phone" value="{{old('contact_phone', @$user->contact->contact_phone)}}">
                </div>

                <button class="btn btn-dark">Update Profile</button>
            </div>
 
            <div class="col-md-1 ">

            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };



   $('#update_user_form').submit(function(evt){
    evt.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: "{{route('user.update')}}",
        type: "POST",
        data:formData,
            cache:false,
            contentType: false,
            processData: false,
        dataType:'json',
        success: function(data){
            if(data.status=='success'){
                $.toastr.success(data.message);
                refreshTable();
                $('#userCreateModal').modal('hide');
            }
            if(data.status=='fail'){
                $.toastr.error(data.message);
            }
        },
        error: function(msg){ 
            $.toastr.error("User Creatre Fail"); 
        }           
    });

 })

    </script>
@endsection
