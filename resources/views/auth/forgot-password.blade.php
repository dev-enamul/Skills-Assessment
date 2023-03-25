
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
     <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <title>Forgot password | Retinasoft</title>
  
</head>

<body>
    <main class="main">
        <div class="container">
           <img class="img-responsive" style="max-width: 400px" src="{{asset('images/logo/logo.png')}}" alt="">
            <section class="wrapper">
                <div class="heading"> 
                    <h3>Forgot your password?</h3>
                    <p class="text text-normal"> No problem! Enter the email address associated with your account below. We will send you a link to reset your password.
                    </p>
                </div>
                @if($errors->any())
                <p class="text-danger p-0">{{$errors->first()}}</p>
              @endif

              @if (\Session::has('status'))
                <div class="alert alert-success">
                    {!! \Session::get('status') !!}
                </div>
            @endif
                
                <form name="signin" class="form"  method="POST" action="{{ route('password.email') }}">
                 @csrf
                    <div class="input-control">
                        <label for="email" class="input-label" hidden>Email Address</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Email Address">
                    </div>
                   
                    <div class="input-control"> 
                        <input type="submit" name="submit" class="btn btn-success" value="Submit">
                    </div>
                </form> 
            </section>
        </div>
    </main>
</body>
 

</html>

