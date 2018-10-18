@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <a class="btn btn-default" href="/home">du dupa Panel Urzytkownika</a>
            <a class="btn btn-default" href="{{route('upload',$oferta)}}"> Galeria</a>
            <div class="panel panel-default">
                <div class="panel-heading">Galeria</div>
                   <div class="panel-body">
                       <form action="/drobzone" class="dropzone" id="mydropzone">
                           <input type="hidden" name="_token" value="{{csrf_token()}}">
                       </form>
                       {{csrf_token()}}
                    </div>
            </div>
        </div>
    </div>
</div>

<script>
  $("#mydropzone").dropzone({ url: "event-image", addRemoveLinks : true, maxFilesize: 3, sending: function(file, xhr, formData) { // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example. formData.append("_token", $('[name=_token').val()); // Laravel expect the token post value to be named _token by default } });    
    </script>
<p>{{}}</p>
@endsection

