@extends('layouts.app')

@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')
<div class="container szary">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <h4 class="page-title">EDYCJA - {{$klient['name']}}</h4> 
        </div>
        <div class="log-panel"> 
            <form action="{{ route('save_firme_edit') }}" method="post">
                <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="hidden" name="id" value="{{$klient['id']}}">
                    <input type="hidden" name="user_id" value="{{$klient['user_id']}}">
                    <div class="form-group">
                        <label>NAZWA</label>
                    <input type="taxt" name="name" class="form-control" value="{{$klient['name']}}" placeholder="NAZWA">
                    </div>
                    <div class="form-group">
                        <label>EMAIL</label>
                    <input type="taxt" name="email" class="form-control" value="{{$klient['email']}}" placeholder="NAZWA">
                    </div>
                    <button class="btn btn-danger">ZAPISZ</button>
               </div>  
            </form>
           
            
        </div>
    </div>
</div>
   

@stop
