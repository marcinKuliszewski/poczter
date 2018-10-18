 @extends(Auth::user()->admin!='klient' ? 'layouts.app' : 'layouts.klient_lay')


@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')

        <div class="col-md-12">

          <h3 class="page-title">Nieprzeczytana Korespondencja</h3>
            

        </div>
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-hover">
                 <thead class="thead-dark">
                    <tr>
                       <th scope="col">DATA</th>
                        <th scope="col">NADAWCA</th>
                        <th scope="col">SKAN</th>
                         <th scope="col">NAZWA</th>
                     </tr>
                </thead>
            <tbody>
              
                   
                 @if(!empty($nowa_poczta))
                                    @foreach($nowa_poczta as $list)
                                        @if($list['docum_stan']=='wyslany')
                                          @php
                                            $dat_arr=explode(' ',$list['data']);
                                            $dat=explode('-',$dat_arr[0]);
                                            $date=$dat[2].'-'.$dat[1].'-'.$dat[0];
                                           @endphp
                                   
                                   <tr>
                                          <td>{{ $date}}</td>
                                          <td>{{ $list['nadawca']}}</td>
                                          <td>
                                             {{ $list['filename']}}
                                             @if($list['docum_stan']=='wyslany')   
                                                  <span class="badge badge-secondary" title="Nowe wiadomości">!</span>
                                             @endif
                                          </td>
                                          <td>  <a class="zapisz btn @if($list['docum_stan']=='pobrany') btn-default @else btn-danger @endif btn-sm" href="{{ route('podglad_list',['list'=>$list['id']]) }}">POBIERZ</a></td>
                                     </tr>   
                                   
                                        @endif
                                    @endforeach
                           
                    </tbody>
                    </table> 
                  @endif
                
   
              

            </div>
            
       
    </div>

   

@stop

