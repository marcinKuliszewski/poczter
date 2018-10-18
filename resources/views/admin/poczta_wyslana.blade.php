 @extends(Auth::user()->admin!='klient' ? 'layouts.app' : 'layouts.klient_lay'); 


@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')
<div class="container szary">
    <div class="row">
      
        <div class="col-md-offset-1 col-md-10">
            
           <h4 class="page-title">Korespondencja wysłana {{$od}} - {{$do}}</h4>
        </div>
          <div class="col-md-offset-1 col-md-10 data-szuk">
            <form action="{{ route('poczta_wyslana') }}" method="get">
               OD <input type="date" name="dzien_od" value='{{ old("dzien_od") }}'> 
               DO <input type="date" name="dzien_do" value='{{ old("dzien_do") }}'>
                <button class="btn btn-danger">SZUKAJ</button>    
            </form>
        </div>
        <div class="col-md-offset-1 col-md-10">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover">
                          <thead class="thead-dark">
                                <tr>
                                  <th scope="col">DATA</th>
                                  <th scope="col">NAZWA</th>
                                  <th scope="col">NADAWCA</th>
                                  <th scope="col">SKAN</th>
                                  <th scope="col">OPERATOR</th>
                                  <th scope="col">AKCJA</th>
                                  <th scope="col">Nr.tel</th>
                                </tr>
                          </thead>
                            <tbody>
            
                 @if(!empty($poczta))
                        @foreach($poczta as $list)   
                            @if($list['list']['docum_stan']!='delete')
                                     @php
                                       $dat_arr=explode(' ',$list['list']['created_at']);
                                       $dat=explode('-',$dat_arr[0]);
                                       $date=$dat[2].'-'.$dat[1].'-'.$dat[0];
                                     @endphp
                                   
                     
                                       <tr>
                                          <td>{{$date}}</td>
                                          <td><b>{{ $list['user']['name']}}</b></td>
                                          <td>{{ $list['list']['nadawca']}}</td>
                                          <td>
                                              {{ $list['list']['filename']}}
                                                 @if($list['list']['docum_stan']=='wyslany')   
                                                      <span class="badge badge-secondary" title="Nowa wiadomości">!</span>
                                                 @else
                                                      <span class="badge badge-success" title="Pobrany"><i class="fa fa-download" aria-hidden="true"></i></span>
                                                 @endif
                                          </td>
                                           <td>{{ $list['list']['operator']}}</td>
                                          <td><a class="btn @if($list['list']['docum_stan']=='pobrany') btn-default @else btn-danger @endif btn-sm" href="{{ route('podglad_list',['list'=>$list['list']['id']]) }}">POBIERZ</a></td>
                                         <td>{{ $list['user']['tel']}}</td>
                                       </tr>
                             
                            @endif
                        @endforeach
                    @else
                       <h4>BRAK WIADOMOŚCI</h4>
                  @endif
                        </tbody>
                       </table>
                    </div>
                   
                @if(!empty($komunikat))
                {{$komunikat}}
                @endif
                 

        </div>
    </div>
</div>

@stop



