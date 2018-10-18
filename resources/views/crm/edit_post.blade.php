@extends('layouts.app')

@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')
<div class="container szary">
     <div class="col-md-offset-1 col-md-10">
           <h4 style="" class="page-title">EDYCJA WPISU</h4>
     </div>
    <div class="row">
        <div class="log-panel"> 
            <form action="{{ route('post_save') }}" method="post">
                <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{$wpis['id']}}">
                    <div class="form-group">
                        <label>TYTUŁ</label>
                        <input type="taxt" name="nazwa" class="form-control" value="{{$wpis['nazwa']}}" placeholder="nazwa">
                    </div>
                    <div class="form-group">
                         <label>TREŚĆ</label>
                        <textarea  name="tresc" class="form-control" >{{$wpis['tresc']}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>KATEGORIA</label>
                        <input type="taxt" name="kategoria" class="form-control" value="{{$wpis['kategoria']}}" placeholder="kategoria">
                    </div>
                    <div class="form-group">
                        <label>AUTOR</label>
                        <input type="taxt" name="autor" class="form-control" value="{{$wpis['autor']}}" placeholder="autor">
                    </div>
                    <button class="btn btn-default">ZAPISZ</button>
               </div>  
            </form>
           
            
        </div>
    </div>
</div>
   

@stop
