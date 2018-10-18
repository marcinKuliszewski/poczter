 @extends(Auth::user()->admin!='klient' ? 'layouts.app' : 'layouts.klient_lay'); 


@section('head')
  
@stop

@section('footer')
  <script>
    $(document).ready(function(){
        $('.kon').addClass('active-link');
    });
    </script>
@stop

@section('content')

    
        <div class="col-md-12" style="padding-right:0;">

          <h3 class="page-title">Kontakt</h3>
            

        </div>
        <div class="col-md-offset-1 col-md-10">
            
            <div class="log-panel"> 
                <h4>Wiadomość została wysłana.</h4>
            
           
            
        </div>
            
        </div>
  

   

@stop

