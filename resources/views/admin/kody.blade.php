@extends('layouts.app') 


@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')
<div class="container szary">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <h4 class="page-title">Kody odbioru korespondencji - <smal> {{$nazwa}}</smal></h4>
        </div>
        <div class="col-md-offset-1 col-md-10">
             <table class="table table-bordered table-striped table-hover">
                          <thead class="thead-dark">
                                <tr>
                                  <th scope="col">WYSTAWIONY</th>
                                  <th scope="col">KOD</th>
                                  <th scope="col">STATUS</th>
                                  <th scope="col">WYDANY</th>
                                  <th scope="col">WYDAJĄCY</th>
                                  <th scope="col">AKCJA</th>
                                </tr>
                          </thead>
                        <tbody>
                            @foreach($paka as $wiersz)
                            <tr>
                                <td>{{$wiersz['created_at']}}</td>
                                <td>{{$wiersz['kod']}}</td>
                                <td>{{$wiersz['status']}}</td>
                                <td>{{$wiersz['data_odbioru']}}</td>
                                <td>{{$wiersz['name']}}</td>
                                <td>
                                  <a class="btn btn-default @if($wiersz['status']=='odebrane') disabled @endif" href="{{ route('potwierdzenie_odbior',['id'=>$wiersz['id'],'klient_id'=>$wiersz['user_id']]) }}">POTWIERDŹ</a>
                                </td>
                            </tr>
                            @endforeach
                   
                    </tbody>
                    </table>
                 
                
                <div class='pagi-bar'>
                  {{ $paka->links() }}
                </div>
            
                @if(!empty($komunikat))
                {{$komunikat}}
                @endif 
        </div>
    </div>
</div>
   

@stop

