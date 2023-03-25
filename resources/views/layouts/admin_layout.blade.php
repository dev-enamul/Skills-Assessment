<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" /> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> 

    <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dashboard/style.css')}}">

    <style>
        .modal-content{
            background: var(--color-white);
        }
    </style>
    <title>@yield('title') </title>

    @yield('style')
    
</head>
<body>
    <div class="content">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="{{asset('images/logo/logo.png')}}" alt="" style="width:100%">
                  
                </div> 
                <div class="close" id="close-btn">
                    <span class="material-symbols-outlined"> close </span>
                </div>
            </div>

            <div class="sidebar">
                
                <a  href="{{route('users')}}" class="{{Route::current()->getName() == 'users' || Route::current()->getName() == 'edit.user' ||Route::current()->getName() == 'user.view' ?'active':''}}">
                    <span class="material-symbols-outlined"> person_outline </span>
                    <h3>User</h3>
                </a>

                {{-- <a href="#">
                    <span class="material-symbols-outlined"> receipt </span>
                    <h3>Designation</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined"> insights </span>
                    <h3>Holiday</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-outlined"> mail_outline </span>
                    <h3>Leave</h3>
                    <span class="message-count">10</span>
                </a> --}}
                <a href="{{route('attendance.report')}}">
                    <span class="material-symbols-outlined"> mail_outline </span>
                    <h3>Report</h3> 
                </a>

                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    <span class="material-symbols-outlined"> logout </span>
                    <h3>Logout</h3>
                </a>
  
            </div>
        </aside>
        <!-- -----------------END OF ASIDE----------------------->
        <main>
            <div class="d-flex justify-content-between">
                <div class="h5"> @yield('page_flow')  
                </div>
                <div class="right">
                    <div class="top">
                        <a type="button" class="d-flex" data-toggle="modal" data-target="#userCreateModal" data-whatever="@mdo">
                            <span class="material-symbols-outlined">
                                person_add
                            </span>User</a>

                        <button id="menu-btn">
                            <span class="material-symbols-outlined"> menu </span>
                        </button>
                        <div class="theme-toggler">
                            <span class="material-symbols-outlined active"> light_mode </span>
                            <span class="material-symbols-outlined dark_btn"> dark_mode </span>
                        </div>
                        <div class="profile">
                            <div class="info">
                                <p>Hey, <b>{{Auth::user()->name}}</b></p> <small>Admin</small>
                            </div>
                            <img src="{{asset('images/profile/blank.jpg')}}" alt="">
                        </div>
                    </div>
         
                </div>
            </div>
            
             
            @yield('content')

        </main>  
    </div>
 

    {{-- user create modal --}}
    <div class="modal fade" id="userCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Create New User</h5> 
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="post" id="create_user_form">
                @csrf
                <div class="modal-body"> 
                    <div class="input-control"> 
                      <input type="text" class="form-control" id="name" name="name" placeholder="User Name" autocomplete="false" required>
                    </div>
                    <div class="input-control">
                        <input type="email" class="form-control" id="email" name="email" placeholder="User Email" autocomplete="off" required>
                    </div>
    
                    <div class="input-control">
                        <label for="password" class="input-label" hidden>Password</label>
                        <input id="pwd" type="password" class="form-control" name="password"
                            placeholder="Password" autocomplete="false" required>
                        <span toggle="#password" class="material-symbols-outlined  field-icon toggle-password">
                            visibility </span>
    
                        <div id="pwd_strength_wrap">
                            <div id="passwordDescription">Password not entered</div>
                            <div id="passwordStrength" class="strength0"></div>
                            <div id="pswd_info">
                                <strong>Strong Password Tips:</strong>
                                <ul>
                                    <li class="invalid" id="length">At least 6 characters</li>
                                    <li class="invalid" id="pnum">At least one number</li>
                                    <li class="invalid" id="capital">At least one lowercase &amp; one uppercase letter
                                    </li>
                                    <li class="invalid" id="spchar">At least one special character</li>
                                </ul>
                            </div><!-- END pswd_info -->
                        </div><!-- END pwd_strength_wrap --> 
                    </div>
    
                    <div class="input-control">
                        <label for="password_confirmation" class="form-control" hidden>Confirm Password</label>
                        <input id="password_confirmation" type="password" class="form-control"
                            name="password_confirmation" placeholder="Confirm Password" required>
                            <span toggle="#password" class="material-symbols-outlined  field-icon toggle-password">
                                visibility </span>
    
                    </div>
    
                    <div class="input-control">
                        <input type="text" class="form-control" id="ip_address" name="ip_address" placeholder="192.168.10.10">
                    </div>
              
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="submit_button">Create</button>
                </div>
            </form>
            
          </div>
        </div>
      </div> 
</body> 
 
<script src="{{asset('assets/js/jquery.min.js')}}"></script> 
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script> 
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/master.js')}}"></script>
<script src="{{asset('assets/dashboard/index.js')}}"></script> 
<script>
 

 $('#create_user_form').submit(function(evt){
    evt.preventDefault();
    console.log();

    $.ajax({
        url: "{{url('user/create')}}",
        type: "POST",
        data:  $(this).serialize(),
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

 function refreshTable() {
            $(".user_list").DataTable().ajax.reload();
        }

</script>
@yield('script') 
 
</html>