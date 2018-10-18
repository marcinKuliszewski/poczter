@extends('layouts.app')

@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')

    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <h4 class="page-title">{{Auth::user()->name}}</h4>
           
        </div>
        <div class="col-md-offset-1 col-md-10">
            
            <div class="jumbotron how-to-create" >
            <div class="panel-group">   
                {{$file}}
              <embed src="{{$file}}" width="500" height="375" type='application/pdf'>
            </div>
            </div>
            
        </div>
    </div>

   

@stop



