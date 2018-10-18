@extends('layouts.app')

@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')

    <div class="row">
        <div class="col-md-offset-1 col-md-10"> 
              <h4 class="page-title">DODAJ NOWEGO ADMINISTRATORA</h4>
        </div>
       <div class="log-panel"> 
       
            <form action="{{ route('admin_add') }}" method="post">
                <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="taxt" placeholder="Login" class="form-control" name="name" class="form-control" value="{{ old('name') }}">
                    <input type="taxt" placeholder="Email" class="form-control" name="email" class="form-control" value="{{ old('email') }}">
                    
                    <button class="btn btn-danger">ZAPISZ</button>
               </div>  
            </form>
       </div>

    </div>

@stop



