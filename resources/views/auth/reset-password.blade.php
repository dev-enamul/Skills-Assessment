 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <title>Reset Password | Retinasoft</title>
 

</head>

<body>
    <main class="main">
        <div class="container">
            <img class="img-responsive" style="max-width: 400px" src="{{ asset('images/logo/logo.png') }}"
                alt="">
            <section class="wrapper">
                <div class="heading">
                    <h1 class="text text-large">Change Password</h1>
                   
                </div>
                @if ($errors->any())
                    <p class="text-danger p-0">{{ $errors->first() }}</p>
                @endif


                <form name="signin" class="form" method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="input-control">
                        <label for="email" class="input-label" hidden>Email Address</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email', $request->email) }}" placeholder="Email Address">
                    </div>
                    <div class="input-control">
                        <label for="password" class="input-label" hidden>Password</label>
                        <input id="pwd" type="password" class="form-control" name="password"
                            placeholder="Password">
                        <span toggle="#password-field" class="material-symbols-outlined  field-icon toggle-password">
                            visibility_off </span>

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
                        <input id="password_confirmation-field" type="password" class="form-control"
                            name="password_confirmation" placeholder="password_confirmation">
                        <span toggle="#password_confirmation-field"
                            class="material-symbols-outlined  field-icon toggle-password_confirmation"> visibility_off
                        </span>

                    </div>

                    <div class="input-control">
                        <input type="submit" id="submit_button" name="submit" class="btn btn-success"
                            value="Reset Password" disabled>
                    </div>
                </form>

            </section>
        </div>
    </main>
</body>

<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/master.js')}}"></script>
</html>
