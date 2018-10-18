@extends('layouts.klient_lay')

@section('head')
  
@stop

@section('footer')
  <script>
    $(document).ready(function(){
        $('.kod').addClass('active-link');
    });
    </script>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12" style="padding-right:0;">

            <h3 class="page-title">KOD ODBIORU KORESPONDENCJI</h3>

        </div>
        <div class="col-md-offset-1 col-md-10">
            
            <div class="" >
                  
                <p style="margin-bottom: 50px;margin-top:50px; padding:10px;background-color: #ff0; border:1px solid #999;">
                    Wygeneruj kod odbioru listów/przesyłek z siedziby biura.
                     <a class="btn btn-danger" href="{{ route('kod_odbioru',['klient'=>Auth::user()->id]) }}">KOD ODBIORU</a>
                </p>
                 <p class="samouczek">
                    <h4>POMOC</h4><br>
                    @if(!empty(Session::get('kod_odbioru'))) {{ Session::get('kod_odbioru')}} @endif
                </p>

            </div>
            
        </div>
    </div>

   

@stop

