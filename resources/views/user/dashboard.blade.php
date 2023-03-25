@extends('layouts.user_layout')
@section('title', 'Dashboard | Retinasoft')
@section('content')
    <style>
        .push_attent {
            margin: 0;
            display: grid;
            place-items: center;
            margin-bottom: 50px;
            margin-top: 50px;
        }

        .push_attent a {
            font: 700 30px consolas;
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            padding: 20px 60px;
            position: relative;
            overflow: hidden;
            border-radius: 5px;
            transition: 0.2s;
            transform: scale(2);
            width: 200px;
            height: 67px;
        }

        .push_attent a span {
            position: absolute;
            z-index: 0;
            color: #fff;
            font-size: 12px;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
        }

        .push_attent a .liquid {
            position: absolute;
            top: -60px;
            left: 0;
            width: 100%;
            height: 200px;
            background: #7293ff;
            box-shadow: inset 0 0 50px rgba(0, 0, 0, 0.7);
            z-index: -1;
            transition: 2s;
        }

        .push_attent a .liquid::after,
        .push_attent a .liquid::before {
            position: absolute;
            content: "";
            width: 200%;
            height: 200%;
            top: 0;
            left: 0;
            transform: translate(-25%, -75%);
        }

        .push_attent a .liquid::after {
            border-radius: 45%;
            background: rgba(20, 20, 20, 1);
            box-shadow: 0 0 10px 5px #7293ff, inset 0 0 5px #7293ff;
            animation: animate 5s linear infinite;
            opacity: 0.8;
        }

        .push_attent a .liquid::before {
            border-radius: 40%;
            box-shadow: 0 0 10px rgba(26, 26, 26, 0.5), inset 0 0 5px rgba(26, 26, 26, 0.5);
            background: rgba(26, 26, 26, 0.5);

            animation: animate 7s linear infinite;
        }

        @keyframes animate {
            0% {
                transform: translate(-25%, -75%) rotate(0);
            }

            100% {
                transform: translate(-25%, -75%) rotate(360deg);
            }
        }

        .push_attent a:active .liquid {
            top: -120px;
        }

        .push_attent a:active {
            box-shadow: 0 0 5px #7293ff, inset 0 0 5px #7293ff;
            transition-delay: 0.2s;
        }
    </style>
    <div class="push_attent">
        <a>
            
            @if(isset($attendance_status->leave_time) && $attendance_status->leave_time==null) 
                <span>Punch Out</span>
            @else 
                <span>Punch In</span>
            @endif
            
            <div class="liquid"></div>
        </a>
    </div>

    {{-- <div class="insights">

        <div class="salse">
            <span class="material-symbols-outlined">monitoring </span>
            <div class="middle">
                <div class="left">
                    <h3>&da</h3>
                    <h1>$4540</h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx="38" cy="38" r="36"></circle>
                    </svg>
                    <div class="number">
                        <p>81%</p>
                    </div>
                </div>
            </div>
            <small class="text-muted">Last 24 Hours</small>
        </div>

        <div class="salse">
            <span class="material-symbols-outlined">monitoring </span>
            <div class="middle">
                <div class="left">
                    <h3>Total Sales</h3>
                    <h1>$4540</h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx="38" cy="38" r="36"></circle>
                    </svg>
                    <div class="number">
                        <p>81%</p>
                    </div>
                </div>
            </div>
            <small class="text-muted">Last 24 Hours</small>
        </div>

        <div class="salse">
            <span class="material-symbols-outlined">monitoring </span>
            <div class="middle">
                <div class="left">
                    <h3>Total Sales</h3>
                    <h1>$4540</h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx="38" cy="38" r="36"></circle>
                    </svg>
                    <div class="number">
                        <p>81%</p>
                    </div>
                </div>
            </div>
            <small class="text-muted">Last 24 Hours</small>
        </div>
    </div> --}}
@endsection

@section('script')
    <script>
        $(window).mousedown(function(e) {
            clearTimeout(this.downTimer);
            this.downTimer = setTimeout(function() {
                punch_in();
            }, 1500);
        }).mouseup(function(e) {
            clearTimeout(this.downTimer);
        });


        function punch_in(){
            $.ajax({
                url: "{{ url('/punch/in') }}",
                type: 'get',
                dataType: 'JSON',
                success: function(response) {
                    if (response.status == "success") {
                        $.toastr.success(response.message);
                         
                        $('.push_attent span').text(response.text)
                    } else {
                        $.toastr.info(response.message);
                    }

                },
                error: function(response) {
                    $.toastr.error('Something Wrong');
                }
            });
        }
    </script>
@endsection
