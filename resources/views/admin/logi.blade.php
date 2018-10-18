 @extends(Auth::user()->admin!='klient' ? 'layouts.app' : 'layouts.klient_lay'); 


@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')


<!--  OSTATNIE LOGOWANIA     -->

<div class="container szary">
   <div class="row">
        <div class="col-md-offset-1 col-md-10">
            
           <h4 class="page-title">Ostatnie Logowania</h4>
        </div>
        <div class="col-md-offset-1 col-md-10">
             <table class="table table-bordered table-striped table-hover">
                          <thead class="thead-dark">
                                <tr>
                                  <th scope="col">DATA</th>
                                  <th scope="col">URZYTKOWNIK</th>
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
                   @else
                   <h4>BRAK WIADOMOŚCI</h4>
                  @endif
                
                  <div class='pagi-bar'>
                  {{ $logi->links() }}
                  </div>

            
        </div>
    </div>
</div>

@stop

