@extends('layouts.app')

@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')
<div class="container szary">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <h4 class="page-title">{{session('klient_name')}}</h4> 
        </div>
        <div class="col-md-offset-1 col-md-10">
            
           
                    @if(!empty($poczta))
                    <table class="table table-striped table-bordered">
                        <thead>
                           <tr>
                            <th scope="col">PLIK</th>
                            <th scope="col">NADAWCA</th>
                            <th scope="col">USUŃ</th>
                            <th scope="col">POBIERZ</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($poczta as $list)
                        <tr>
                            @if($list['docum_stan']=='dodany')
                            <td>{{ $list['filename']}}
                                <td>{{ $list['nadawca']}}
                            <td class="text-center"><a  class="btn btn-warning text-center" href="{{ route('usunlist',['list'=>$list['id']]) }}">USUŃ</a></td>
                            <td class="text-center"><a  class="btn @if($list['docum_stan']=='pobrany') btn-default @else btn-danger @endif " href="{{ route('podglad_list',['list'=>$list['id']]) }}">POBIERZ</a></td>
                     
                                
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                
                @if(!empty($komunikat))
                {{$komunikat}}<br><br>
                @endif
                @if(empty($list))
                Brak wiadomości do wysłania! <br><br>
                @else
                <b>UWAGA ! Po zatwierdzeniu dokumenty zostaną przesłąne dla odbiorcy !!!</b><br><br>
                <a  class="btn btn-default btn-danger" href="{{ route('wyslij_nowapoczta',['klient_id'=>session('klient_id')]) }}">ZATWIERDŹ</a>
                @endif
       
            
        </div>
    </div>
</div>
   

@stop

