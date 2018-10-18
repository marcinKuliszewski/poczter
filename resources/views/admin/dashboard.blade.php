@extends('layouts.app')

@section('head')
  
@stop

@section('footer')
  
@stop

@section('content')

    <div class="row dashboard-panel">
        <div class="col-md-offset-1 col-md-10">
            <h4 class="page-title">PANEL ADMINISTRACYJNY</h4>
            
        </div>
        <div class="col-md-offset-1 col-md-10">
            <div class="row">
                   @if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
                    <div class="col-md-4 col-sm-6">
                             <a class="" href="/klienci"><i class="fa fa-users"></i> KLIENCI</a>
                    </div>
                     <div class="col-md-4 col-sm-6">
                         <a class="" href="/poczta_wyslana"><i class="fa fa-envelope"></i> POCZTA</a>
                    </div>
                    
                        @endif
                        @if(Auth::user()->admin=='superadmin')
                         <div class="col-md-4 col-sm-6">
                             <a class="" href="/admini"><i class="fa fa-user"></i>ADMINI</a>
                         </div>
                         @endif
                         @if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
                          <div class="col-md-4 col-sm-6">
                             <a class="" href="/logi"><i class="fa fa-book"></i> LOGI</a>
                          </div>
                          <div class="col-md-4 col-sm-6">
                              <a href="{{ route('kody_lista') }}" class="" ><i class="fa fa-folder-open"></i> KODY</a>
                          </div>
                              
                         @endif
                         @if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
                          <div class="col-md-4 col-sm-6">
                             <a class="" href="{{ route('cms_lista') }}"><i class="fa fa-pencil-square-o"></i> CMS </a>
                          </div>
                         @endif
                         @if(Auth::user()->admin=='superadmin' || Auth::user()->admin=='admin')
                          <div class="col-md-4 col-sm-6">
                            <a href="{{ route('backup_file') }}" class="" ><i class="fa fa-cloud-download"></i> KOPIA ZAPASOWA</a>
                          </div>
                         @endif
     
            
            </div> 
        </div>
        
        
    </div>

   

@stop

