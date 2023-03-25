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
        input, select,textarea{
            background: var(--color-white) !important;
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
                <a href="{{route('dashboard')}}" class="{{Route::current()->getName() == 'dashboard'?'active':''}}">
                    <span class="material-symbols-outlined"> grid_view </span>
                    <h3>Dashboard</h3>
                </a>

                <a  href="{{route('profile')}}" class="{{Route::current()->getName() == 'profile'?'active':''}}">
                    <span class="material-symbols-outlined"> person_outline </span>
                    <h3>Profile</h3>
                </a>
 
                <a href="{{route('user.report')}}" class="{{Route::current()->getName() == 'user.report'?'active':''}}">
                    <span class="material-symbols-outlined">
                        lab_profile
                        </span>
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
                      

                        <button id="menu-btn">
                            <span class="material-symbols-outlined"> menu </span>
                        </button>
                        <div class="theme-toggler">
                            <span class="material-symbols-outlined active"> light_mode </span>
                            <span class="material-symbols-outlined dark_btn"> dark_mode </span>
                        </div>
                        <a href="{{route('profile')}}">
                            <div class="profile">
                                <div class="info">
                                    <p>Hey, <b>{{Auth::user()->name}}</b></p> <small>User</small>
                                </div>
    
                                @if (isset(Auth::user()->details->photo) && Auth::user()->details->photo != null) 
                                     <img src="{{ asset('images/profile/' . Auth::user()->details->photo) }}" alt="Profile Photo">
                                    @else
                                       <img src="{{ asset('images/profile/blank.jpg') }}" alt="Profile Photo">
                                    @endif
    
                               
                            </div>
                        </a>
                       
                    </div>
         
                </div>
            </div> 
            @yield('content') 
        </main>  
    </div> 
</body> 
 
<script src="{{asset('assets/js/jquery.min.js')}}"></script> 
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script> 
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/master.js')}}"></script>
<script src="{{asset('assets/dashboard/index.js')}}"></script> 
<script src="{{asset('assets/js/sweetalert.min.js')}}"></script>
 
@yield('script') 
 
</html>