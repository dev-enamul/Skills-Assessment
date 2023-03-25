 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
     <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
     <title>Login | Retinasoft</title>
 </head>

 <body>
     <main class="main">
         <div class="container">
            <img class="img-responsive" style="max-width: 400px" src="{{asset('images/logo/logo.png')}}" alt="">
             <section class="wrapper">
                 <div class="heading">
                     <h1 class="text text-large">Login</h1>
                     <p class="text text-normal">Login for attendance tracking efficiency. 
                     </p>
                 </div>
                 @if($errors->any())
                 <p class="text-danger p-0">{{$errors->first()}}</p>
               @endif
                

                 <form name="signin" class="form" method="POST" action="{{ url('login') }}">
                  @csrf
                     <div class="input-control">
                         <label for="email" class="input-label" hidden>Email Address</label>
                         <input type="email" name="email" id="email" class="form-control"
                             placeholder="Email Address">
                     </div>
                     <div class="input-control">
                         <label for="password" class="input-label" hidden>Password</label>
                         <input id="password-field" type="password" class="form-control" name="password"
                             placeholder="Password"> 
                         <span toggle="#password-field" class="material-symbols-outlined  field-icon toggle-password"> visibility_off </span>

                     </div>
                     <div class="input-control">
                         <a href="{{route('password.request')}}" class="text text-links">Forgot Password</a>
                         <input type="submit" name="submit" class="btn btn-success" value="Login">
                     </div>
                 </form>
                 <div class="striped">
                     <span class="striped-line"></span>
                     <span class="striped-text">Or</span>
                     <span class="striped-line"></span>
                 </div>
                 <div class="method">

                     <div class="method-control">
                         <a href="#" class="method-action">
                             <i class="ion ion-logo-google"></i>
                             <span>Sign in with Google</span>
                         </a>
                     </div>

                     {{-- <div class="method-control">
                        <a href="#" class="method-action">
                            <i class="ion ion-logo-facebook"></i>
                            <span>Sign in with Facebook</span>
                        </a>
                    </div>
                    <div class="method-control">
                        <a href="#" class="method-action">
                            <i class="ion ion-logo-apple"></i>
                            <span>Sign in with Apple</span>
                        </a>
                    </div> --}}

                 </div>
             </section>
         </div>
     </main>
 </body>
 <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
 <script src="{{asset('assets/js/jquery.min.js')}}"></script>
 <script src="{{asset('assets/js/master.js')}}"></script>

 
 </html>
