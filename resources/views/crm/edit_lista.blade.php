 @extends(Auth::user()->admin!='klient' ? 'layouts.app' : 'layouts.klient_lay'); 


@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')


<div class="container szary">
   <div class="row">
        <div class="col-md-offset-1 col-md-10">
            
           <h4 style="" class="page-title">WPISY CMS</h4>
           <a style="" class="btn btn-danger" href="{{ route('add_post') }}"><i class="fa fa-pencil"></i> DODAJ</a><br><br>
        </div>
        <div class="col-md-offset-1 col-md-10">
             <table class="table table-bordered table-striped table-hover">
                          <thead class="thead-dark">
                                <tr>
                                  <th scope="col">ID</th>
                                  <th scope="col">NAZWA</th>
                                  <th scope="col">DATA</th>
                                  <th scope="col">KATEGORIA</th>
                                  <th scope="col">AUTOR</th>
                                  <th scope="col">USUŃ</th>
                                  <th scope="col">EDYCJA</th>
                                </tr>
                          </thead>
                        <tbody>
            
                 @if(!empty($wpisy))
                        @foreach($wpisy as $wpis)   
                                <tr>
                                    <td>{{ $wpis['id']}}</td>
                                     <td>{{ $wpis['nazwa']}}</td>
                                     <td>{{ $wpis['created_at']}}</td>
                                     <td>{{ $wpis['kategoria']}}</td>
                                     <td>{{ $wpis['autor']}}</td>
                                     <td><a class="btn btn-danger" href="{{ route('post_delete',['id'=>$wpis['id']]) }}">USUŃ</a></td>
                                     <td><a class="btn btn-default" href="{{ route('post_edit',['id'=>$wpis['id']]) }}">EDYCJA</a></td>
                                </tr>
                        @endforeach
                   
                    </tbody>
                    </table>
                   @else
                   <h4>BRAK WPISÓW</h4>
                  @endif
                
                  <div class='pagi-bar'>
                  {{ $wpisy->links() }}
                  </div>

            
        </div>
    </div>
</div>

@stop

