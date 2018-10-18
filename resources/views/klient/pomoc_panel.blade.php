 @extends(Auth::user()->admin!='klient' ? 'layouts.app' : 'layouts.klient_lay') 


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

          <h3 class="page-title">KONTAKT</h3>
            

        </div>
        <div class="col-md-offset-1 col-md-10">
            <div class="kontakt-tel">
                <div class="tel-rama">
                    <i class="glyphicon glyphicon-earphone" style="background-color: #fff;"></i>
                    <a href="tel:797678702">797-678-702</a>
                </div>
            </div>
            
            <div class="log-panel"> 
                <h4>Masz pytania? Napisz.</h4>
                <form action="{{ route('kontakt_klient') }}" method="post">
                    <div class="form-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <input type="text" name="temat" class="form-control" placeholder="Temat" value="{{ old('temat') }}"><br>
                        <textarea name="tresc" class="form-control" style="height:180px;" placeholder="Wiadomość">{{ old('tresc') }}</textarea>
                        <br>
                        <button class="btn btn-default">WYŚLIJ</button>
                   </div>  
                </form>
           
            
        </div>
            
        </div>
 

   

@stop

