@extends('layouts.klient_lay')

@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')

 
         <div class="col-md-12" style="padding-right:0;">

            <h3 class="page-title">KOD ODBIORU KORESPONDENCJI</h3>

        </div>
        <div class="col-md-offset-1 col-md-10">
            
            <div class="" >
                  
                <p style="margin-bottom: 50px;margin-top:50px; padding:10px;background-color: #ff0;border:1px solid #555;border:1px solid #999;">
                    <b>Sprawdź skrzynkę email. Kod odbioru został wysłany. Sprawdź również folder spam.</b>
       
                </p>
                <p class="samouczek">
                    <h4>POMOC</h4><br>
                    @if(!empty(Session::get('kod_odbioru'))) {{ Session::get('kod_odbioru')}} @endif
                </p>

            </div>
            
        </div>


 @stop
  