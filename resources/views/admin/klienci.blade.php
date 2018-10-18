@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop

@section('footer')
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    
    
    var availableTags;
      $(document).ready(function(){
        $.ajax({url: "/szukaj_klienta", success: function(result){
        availableTags=result.lista;
        $( "#tags" ).autocomplete({
           source: availableTags
         });
    }});

    $("#szukaj").click(function(){

             var nazwa=$('#tags').val();
            $.ajax({url: "/szukaj_nazwa/"+nazwa, 
                type: "get",
                data:{},
                dataType:'json',
                success: function(result){
             $('.klient-box').not('#' + result.user_id).css('display','none');
              $('#' + result.user_id).css('display','block');
                   
      
                 }});
            });


    });
    
  

</script>
@stop

@section('content')
<div class="container szary">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <h4 class="page-title">LISTA KLIENTÓW</h4>
            @if(Auth::user()->admin=='superadmin')
             <a class="btn btn-danger" href="/klient_create" title="Dodaj nowego klienta"><i class="fa fa-user-plus"></i> DODAJ</a>
            @endif
             <div class="ui-widget">
                   <input id="tags" type="text" name="szukany">
                   <button id="szukaj" class="btn btn-default btn-sm btn-szkaj" style="font-size:13px;"><i class="fa fa-search"></i></button>
             </div>
            
           
        </div>
        <div class="col-md-offset-1 col-md-10">
            <div class="row">
                  
              @foreach($person as $klient)
              @if($klient['admin']=='klient' && $klient['status']!='usuniety')

                 <div id="{{$klient['id']}}" class="klient-box col-md-3 col-sm-6 col-xs-12">
                    <div class="dropdown rozwijane-podmenu"> 
                       <button type="button" class="btn dropdown-toggle btn-lg @if($klient['status']=='aktywny') btn-primary @else btn-warning @endif btn-klient" data-toggle="dropdown">
                        {{$klient['name']}}
                        </button>
                        <ul class="dropdown-menu">
                            <a class="btn btn-info" href="{{ route('add_poczta_widok',['klient'=>$klient['id']]) }}">DODAJ POCZTĘ</a>

                            <a class="btn btn-info" href="{{ route('klient_poczta',['klient'=>$klient['id'],'nr_strony'=>0]) }}">ZOBACZ POCZTĘ</a>
                            <a class="btn btn-info" href="{{ route('klient_odbior',$klient) }}">ODBIÓR</a>
                            <a class="btn btn-danger" href="{{ route('klient_edit',$klient) }}">EDYCJA</a>
                            @if($klient['status']=='aktywny')
                                <a class="btn btn-danger" href="{{ route('supsend',$klient) }}">ZAWIEŚ</a>
                            @else
                                 <a class="btn btn-danger" href="{{ route('up_supsend',$klient) }}">AKTYWUJ</a>
                            @endif
                            @if(Auth::user()->admin=='superadmin')
                                <a class="btn btn-danger" href="{{ route('dodaj_firme',$klient) }}">DODAJ FIRMĘ</a>
                                <a class="btn btn-warning" href="{{ route('nowe_haslo',$klient) }}">NOWE HASŁO</a>
                                <a class="btn btn-warning" href="{{ route('delete',$klient) }}">USUŃ</a>
                            @endif
                        </ul>
                    </div> 
                </div> 
                  
              @endif
              @endforeach
            
            </div> 
        </div>
        
        
        <div class="col-md-offset-1 col-md-10">
            <div class="row">
                <div class="col-md-12">
                    <hr><hr>
                    <h4 class="page-title">FIRMY POWIĄZANE<h4>
                </div>  
              @foreach($firmy as $klient)
              @if($klient['status']!='usuniety')

                 <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="dropdown rozwijane-podmenu"> 
                       <button type="button" class="btn dropdown-toggle btn-lg @if($klient['status']=='aktywny') btn-primary @else btn-warning @endif btn-klient" data-toggle="dropdown">
                        {{$klient['name']}}
                        </button>
                        <ul class="dropdown-menu">
                            <a class="btn btn-info" href="{{ route('add_poczta_widok',['klient'=>$klient['user_id']])}}">DODAJ POCZTĘ</a>
                            <a class="btn btn-info" href="{{ route('klient_poczta',['klient'=>$klient['user_id'],'nr_strony'=>0]) }}">ZOBACZ POCZTĘ</a>
                            <a class="btn btn-danger" href="{{ route('edit_firme',$klient['id']) }}">EDYCJA</a>
                            @if($klient['status']=='aktywny')
                                <a class="btn btn-danger" href="{{ route('zawies_firme',$klient['id']) }}">ZAWIEŚ</a>
                            @else
                                 <a class="btn btn-danger" href="{{ route('aktywuj_firme',$klient['id']) }}">AKTYWUJ</a>
                            @endif
                            @if(Auth::user()->admin=='superadmin')
                                <a class="btn btn-warning" href="{{ route('usun_firme',$klient['id']) }}">USUŃ</a>
                            @endif
                        </ul>
                    </div> 
                </div> 
                  
              @endif
              @endforeach
            </div> 
        </div>
    </div>
</div>
   

@stop

