@extends('layouts.app')

@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')
<div class="container szary">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <h4 class="page-title">PANEL ADMINISTRATORÓW</h4>
            @if(Auth::user()->admin=='superadmin')

            <a class="btn btn-danger" href="/admin_create"><i class="fa fa-user-plus"></i> DODAJ</a><br><br>
             @endif
        </div>
        <div class="col-md-offset-1 col-md-10">
            <div class="row">
            
             
              @foreach($person as $klient)
              @if($klient['admin']=='admin')
              <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="dropdown rozwijane-podmenu"> 
                       <button type="button" class="btn  dropdown-toggle btn-lg @if($klient['status']=='aktywny') btn-primary  @else btn-dark @endif btn-klient" data-toggle="dropdown">
                        {{$klient['name']}}
                        </button>
                            <ul class="dropdown-menu ">
                               <a class="btn btn-danger" href="{{ route('admin_edit',$klient) }}">EDYCJA</a>
                                @if($klient['status']=='aktywny')
                               <a class="btn btn-danger" href="{{ route('supsend',$klient) }}">ZAWIEŚ</a>
                               @else
                                <a class="btn btn-danger" href="{{ route('up_supsend',$klient) }}">AKTYWUJ</a>
                               @endif
                               <a class="btn btn-warning" href="{{ route('delete',$klient) }}">USUŃ</a>
                           </ul>
                    </div> 
                </div>
              @endif
              @endforeach
           <div class="col-md-12">
              <hr><hr>
           </div>
            </div> 
        </div>
    </div>
</div>
   

@stop

