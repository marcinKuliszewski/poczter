<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="/img/wplogo-mini.png"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/packages/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('https://code.jquery.com/jquery-2.1.4.min.js') }}" rel="stylesheet">
    <link href="{{ asset('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
 
    <link href="/css/dropzone.css" type="text/css" rel="stylesheet" />


 
    @yield('head')
    
  
    <title>POCZTER</title>

    <!-- Styles -->
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="nav-kontener">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/dashboard') }}">
                         <img class="logo-mid" src="/img/wplogo-mini.png" alt="wirtualne biuro">
                        Wirtualne Biuro
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        
                        @if(!Auth::guest())
                        <li class="dropdown">
                                <a id="btn-admin" href="#" class="btn uwaga_jeden " data-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="fa fa-power-off"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}" 
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Wyloguj
                                        </a>
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                  
                                    </li>
                                </ul>
                            </li>   
                        @endif
                        
                        
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Logowanie</a></li>
                            @if(empty($sa))<li><a href="{{ route('register') }}">Rejestracja</a></li>@endif
                        @else
                          @if(empty($menu))
                            @if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
                                 <a class="btn btn-default" href="/poczta_wyslana">POCZTA</a>
                                 <a class="btn btn-default" href="/klienci">KLIENCI</a>
                            @endif
                            @if(Auth::user()->admin=='superadmin')
                                 <a class="btn btn-default" href="/admini">ADMINI</a>
                             @endif
                             @if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
                                 <a class="btn btn-default" href="/logi">LOGI</a>
                                  <a href="{{ route('kody_lista') }}" class="btn btn-default" >KODY</a>	
                             @endif
                             @if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
                                 <a class="btn btn-default" href="{{ route('crm_lista') }}">CMS</a>
                             @endif
                             @if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
                                <a href="{{ route('backup_file') }}" class="btn btn-default" >KOPIA ZAPASOWA</a>	
                             @endif
                         @endif
                         
                           
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="kontener">  
        @yield('content')
        </div>
       
        <div class="container admin-stopa">
            <div class="row">
                 <hr>
                 <span>&copy;  Agencja Innowacji</span>
                <hr>
            </div>
        </div>
    </div>
   
    <!-- OSTRZEŻENIE O KOPI ZAPASOWEJ PRZED WYLOGOWANIEM -->
     <div id="uwaga-jeden" class="uwaga_okno">
         <p>   <span>UWAGA !!! </span>
             WYKONAJ KOPIĘ ZAPASOWĄ
             </p>   
     </div>
    
   
    <!-- Scripts -->
           
    <script src="{{ asset('js/app.js') }}"></script>
    <script>  
         $('.uwaga_jeden').click(
              function()
                {
                  $('#uwaga-jeden').addClass('widoczny');
                });
        $('#uwaga-jeden').click(
              function()
                {
                  $('#uwaga-jeden').addClass('niewidoczny');
                });
    </script>
</body>
@yield('footer')
</html>
