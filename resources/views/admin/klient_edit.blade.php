@extends('layouts.app')

@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')
<div class="container szary">
    <div class="row">
        <div class="col-md-offset-1 col-md-10"> 
              <h4 class="page-title">EDYCJA - {{$data['name']}}</h4>
        </div>
        <div class="log-panel"> 
          
        
            <form action="{{ route('klient_save') }}" method="post">
                <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                    <input type="hidden" name="user_id" value="{{ $data['user_id'] }}">
                    <div class="form-group">
                    <label>Login</label>
                    <input type="taxt" name="name" class="form-control" value="{{$data['name']}}" placeholder="Login">
                    </div>
                    <div class="form-group">
                    <label>Email</label>
                    <input type="taxt" name="email" class="form-control" value="{{$data['email']}}" placeholder="Email" style="color:#f33;">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                    <input type="taxt" name="status" class="form-control" value="{{$data['status']}}" placeholder="Status">
                    </div>
                    <div class="form-group">
                        <label>Typ</label>
                    <input type="taxt" name="typ" class="form-control" value="{{$data['typ']}}" placeholder="Typ">
                    </div>
                    
                    <div class="form-group">
                        <label>Telefon</label>
                    <input type="taxt" name="tel" class="form-control" value="{{$data['tel']}}" placeholder="Telefon">
                    </div>
                    <div class="form-group">
                        <label>Adres</label>
                    <input type="taxt" name="adres" class="form-control" value="{{$data['adres']}}" placeholder="Adres">
                    </div>
                    <div class="form-group">
                        <label>Email kontaktowy</label>
                    <input type="taxt" name="poczta_info" class="form-control" value="{{$data['poczta_info']}}" placeholder="Email kontaktowy">
                    </div>
                    <div class="form-group">
                        <label>Opis</label>
                    <textarea  name="description" class="form-control" >{{$data['description']}}</textarea>
                    </div>
                    <button class="btn btn-danger">ZAPISZ</button>
               </div>  
            </form>
           
            
        </div>
    </div>
</div>
   

@stop
