@extends(Auth::user()->admin!='klient' ? 'layouts.app' : 'layouts.klient_lay')


@section('footer')
<script>
    $(document).ready(function(){
        $('.kor').addClass('active-link');
    });
    </script>
@stop

@section('content')
<div class="col-md-12" style="padding-right:0;">
            <div class="table-responsive">
             <table class="table table-bordered table-striped table-hover">
                          <thead class="thead-dark">
                                <tr>
                                  <th scope="col">DATA</th>
                                  <th scope="col">NADAWCA</th>
                                  <th scope="col">SKAN</th>
                                  <th scope="col">AKCJA</th>
                                </tr>
                          </thead>
                        <tbody>
            
                 @if(!empty($poczta))
                        @foreach($poczta as $list)   
       
                                   @if($list['docum_stan']!='dodany' && $list['docum_stan']!='delete')
                                     @php
                                        $dat_arr=explode(' ',$list['created_at']);

                                        $dat=explode('-',$dat_arr[0]);
                                        $date=$dat[2].'-'.$dat[1].'-'.$dat[0];
                                        
                                     @endphp
                                   
                                   
                                   <tr>
                                          <td>{{ $date}}</td>
                                          <td>{{ $list['nadawca']}}</td>
                                          <td>
                                             {{ $list['filename']}}
                                             @if($list['docum_stan']=='wyslany')   
                                                  <span class="badge badge-secondary" title="Nowa wiadomości">!</span>
                                             @else
                                                  <span class="badge badge-success" title="Pobrany"><i class="fa fa-download" aria-hidden="true"></i></span>
                                             @endif
                                          </td>
                                          <td>  <a class="zapisz btn @if($list['docum_stan']=='pobrany') btn-default @else btn-danger @endif btn-sm" href="{{ route('podglad_list',['list'=>$list['id']]) }}">POBIERZ</a></td>
                                      </tr>
                            @endif
                        @endforeach
                   
                    </tbody>
                    </table>
                    </div>
                   @else
                   <h4>BRAK WIADOMOŚCI</h4>
                  @endif
                
                  <div class='pagi-bar'>
                  {{ $poczta->links() }}
                  </div>
                  
         
                
                @if(!empty($komunikat))
                {{$komunikat}}
                @endif

         
            
        </div>
 

<!--  OSTATNIE LOGOWANIA     -->

        <div class="col-md-12"  style="padding-right:0;">
            
           <h3 class="page-title" style="margin-top:50px;border:1px solid #eee;">Ostatnie Logowania</h3>
        </div>
        <div class="col-md-12"  style="padding-right:0;">
            <div class="table-responsive">
             <table class="table table-bordered table-striped table-hover">
                          <thead class="thead-dark">
                                <tr>
                                  <th scope="col">DATA</th>
                                  <th scope="col">UŻYTKOWNIK</th>
                                  <th scope="col">STATUS</th>
                                </tr>
                          </thead>
                        <tbody>
            
                 @if(!empty($logi))
                        @foreach($logi as $log)   
                                <tr>
                                     <td>{{ $log['created_at']}}</td>
                                     <td>{{ $log['name']}}</td>
                                     <td>{{ $log['status']}}</td>
                                </tr>
                        @endforeach
                   
                    </tbody>
                    </table>
                    </div>
                   @else
                   <h4>BRAK WIADOMOŚCI</h4>
                  @endif
                
               

            
        </div>


@stop


