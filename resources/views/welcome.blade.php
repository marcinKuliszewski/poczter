<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="/img/wplogo-mini.png"/>
        <title>{{ config('app.name', 'POCZTER') }}</title>
        
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('/packages/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('https://code.jquery.com/jquery-2.1.4.min.js') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <style>
           
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
          

            <div class="container" style="height:100vh;">
               <video muted=true autoplay="autoplay" loop="loop" poster="" style="background-color: #fff;">
                 <source src="/img/start.webm" type="video/webm" />
                 <source src="/img/start.mp4" type="video/mp4" />
               </video>
                
                
                
                <div class="card log-panel">
                <div class="card-header">
                <img class="logo-mid" src="/img/wplogo-mini.png" alt="wirtualne biuro">
                    <h4>WIRTUALNE BIURO</h4>
                    <h5>Zapraszamy</h5></div>
                @auth
                 <a id="btn-panel" class="btn btn-danger btn-lg"  href="{{ url('/login') }}">PANEL KLIENTA</a>
                   
                  @else
                  <form method="POST" action="{{ route('login') }}" aria-label="{{ __('LOGOWANIE') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label text-md-right"></label>

                                <div class="col-md-8">
                                    <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-2 col-form-label text-md-right"></label>

                                <div class="col-md-8">
                                    <input id="password" placeholder="Hasło" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <label for="password" class="col-md-2 col-form-label text-md-right"></label>
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Zaloguj się 
                                    </button> 
                                </div>
                            </div>
                    </form>
                  
                   @endauth
                </div>
            
            
            </div> 
            

            
        </div>
        
        
        
        
        
  
        
    </body>
</html>
