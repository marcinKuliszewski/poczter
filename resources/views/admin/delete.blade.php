@extends('layouts.app')

@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')
<div class="container szary">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <h4  class="page-title"> USUŃ URZYTKOWNIKA  </h4>
        </div>
        <div class="col-md-offset-1 col-md-10">
         
            <div class="log-panel"> 
                   <h5>POTWIERDŹ DANE</h5>
            <form action="{{ route('delete_user') }}" method="post">
                <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    <input type="taxt" name="email" class="form-control"  placeholder="email" value="{{ old('email') }}">
                    
                    <button class="btn btn-danger">ZAPISZ</button>
               </div>  
            </form>
            </div>
           
            
        </div>
    </div>
</div>
@stop

