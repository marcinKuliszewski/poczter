<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="/img/wplogo-mini.png"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Wirtualne Biuro</title>

    <!-- Styles -->
    
</head>
<body>
             


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
                   

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        
                        @if(!Auth::guest())
                        <li class="dropdown">
                                <a id="btn-admin" href="#" class="btn btn-default " data-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="fa fa-power-off"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a class="btn default" href="{{ route('logout') }}"
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
                        @if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
                             <a class="btn btn-default" href="/klienci">KLIENCI</a>
                        @endif
                        @if(Auth::user()->admin=='superadmin')
                             <a class="btn btn-default" href="/admini">ADMINI</a>
                         @endif
                           
                        @endif
                    </ul>
                </div> 
          
            </div>
             
        </nav>

        <div class="kontener">
             <marquee scrollamount="2" truespeeed="truespeeed" scrolldelay="1">
                    @if(!empty(Session::get('top_reklama'))) {{ Session::get('top_reklama')}} @endif 
           </marquee>
            <div class="lewa-col">
                <div class="menu-lewe">
                @if(Auth::user()->admin=='klient')
                                
                             <a class="btn btn-default kor" href="{{ route('klient_poczta',['klient'=>Auth::user()->id,'nr_strony'=>'0']) }}"><i class="glyphicon glyphicon-envelope"></i>

 KORESPONDENCJA</a>
                               <a class="btn btn-default kod" href="{{ route('kod_odbioru',['klient'=>Auth::user()->id]) }}"><i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i> ODBIÓR POCZTY</a>
                               <a class="btn btn-default kon" href="{{ route('kontakt_panel',['klient'=>Auth::user()->id]) }}"><i class="glyphicon glyphicon-phone" aria-hidden="true"></i> KONTAKT</a>
                           @endif<div style="clear:both;"></div>
                           <hr>
         <!-- SLIDER -->        
                 
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                              <!-- Indicators -->
                             

                              <!-- Wrapper for slides -->
                              <div class="carousel-inner">
                                <div class="item active">
                                   <a href="https://agencjainnowacji.pl/fanpage/">
                                        <img src="/img/11.jpg" alt="funpage" style="width:100%;">
                                    </a>
                                </div>

                                <div class="item">
                                     <a href="https://agencjainnowacji.pl/strony-www/">
                                        <img src="/img/22.jpg" alt="strony internetowe" style="width:100%;">
                                     </a>
                                </div>

                                <div class="item">
                                     <a href="https://agencjainnowacji.pl/konkursy/">
                                        <img src="/img/33.jpg" alt="dotacje unijne" style="width:100%;">
                                     </a>
                                </div>
                              </div>

                              
                            </div>
         <hr>
            <!-- END SLIDER -->
            
            
            <div class="kontakt-box">
                <h4>KONTAKT</h4>
                <span><i class="glyphicon glyphicon-earphone"></i>+48 797-678-702</span>
                <span><i class="glyphicon glyphicon-envelope"></i>biuro@agencjainnowacji.com.pl</span>
                <span><i class="glyphicon glyphicon-map-marker"></i>Agencja Innowacji<br> sp. z o.o.<br>
                    ul. Towarowa 20B<br>
10-417 Olsztyn</span><br>
            </div>
            
            
            
             </div> 
        </div>
         
        <div class="prawa-col">
            <div class="content-panel">
                @yield('content')
            </div>
      <div style="clear:both;"></div>
      </div>
        </div>
    <div class="stopa-wrap">

            <div class=" stopka">
                <div class="">
                    &copy <a href="https://agencjainnowacji.pl/">AGENCJA INNOWACJI</a>
                </div>
            </div>
    
    </div>
    <!-- Scripts -->

     <script>
    $(document).ready(function(){
      $('.zapisz').click(
              function()
                {
                  $(this).removeClass('btn-danger');
                  $(this).addClass('btn-default');
                    $(this).addClass('disabled');
                    

              });
               });
    </script>
        
    <script src="{{ asset('js/app.js') }}"></script>
    
<div id="punkt" style="position:fixed;bottom:1px;background-color:red;z-index:1111;width:0;height:0;"></div>   
</body>
@yield('footer')
</html>

