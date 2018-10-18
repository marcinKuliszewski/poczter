@extends('layouts.app')

@section('top-reklama')
    <marquee scrollamount="2" truespeeed="truespeeed" scrolldelay="1">
           @if(!empty(Session::get('top-reklama'))) {{ Session::get('top-reklama')}} @endif 
    </marquee>
@stop




