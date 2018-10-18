@extends('layouts.app')

@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')
<div class="container szary">
    <div class="row">
         <div class="col-md-offset-1 col-md-10"> 
           <h4 style="" class="page-title">NOWY WPIS</h4>
        </div>
        <div class="log-panel"> 
        
            <form action="{{ route('post_save') }}" method="post">
                <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                        <input type="taxt" name="nazwa" class="form-control" value="" placeholder="nazwa">
                    </div>
                    <div class="form-group">
                        <textarea  name="tresc" class="form-control" placeholder="Treść"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="taxt" name="kategoria" class="form-control" value="" placeholder="kategoria">
                    </div>
                    <div class="form-group">
                        <input type="taxt" name="autor" class="form-control" value="" placeholder="autor">
                    </div>
                   
                    <button class="btn btn-default">ZAPISZ</button>
               </div>  
            </form>
           
            
        </div>
    </div>
</div>
@stop
