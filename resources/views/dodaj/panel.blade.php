@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
             <h2>Dodaj</h2>
             <form method="post" action="{{route('dodaj.zapisz')}}">
                 <input type="hidden" name="_token" value="{{csrf_token()}}">
                 <input type="hidden" name="inde" value="4">
                  <input type="hidden" name="user_id" value="64">
                <div class="form-group">
                 <input class="form-control" placeholder="Nazwa" type="text" name="nazwa" value="{{old('nazwa')}}">
                </div>
                 <div class="form-group">
                 <select class="form-control" placeholder="Rodzaj" type="text" name="typ">
                     @if(old('typ')!='')
                        <option value="{{old('typ')}}">{{old('typ')}}</option>
                      @else 
                         <option value="">Rodzaj</option>
                      @endif
                        <option value="gospodarstwo agroturystyczne">agroturystyka</option>
                        <option value="domek letniskowy">domek letniskowy</option>
                        <option value="dom wczasowy">dom wczasowy</option>
                        <option value="hotel">hotel</option>
                        <option value="ośrodek wypoczynkowy">ośrodek wypoczynkowy</option>
                        <option value="pensjonat">pensjonat</option>
                        <option value="pokoje gościnne">pokoje gościnne</option>
                        <option value="pole namiotowe">pole namiotowe/canping</option>
                        <option value="zajazd">zajazd</option>
                        <option value="leśniczówka">leśniczówka</option>
                        <option value="stadnina konna">stadnina konna</option>
                        <option value="pole namiotowe">pole namiotowe</option>
                        <option value="łowisko rybne">łowisko rybne</option>
                        <option value="domek">domek</option>
                 </select>
                 </div>
                 <div class="form-group">
                <input class="form-control" placeholder="Miejscowość " type="text" name="adres" value="{{old('adres')}}">
                 </div>
                <div class="form-group">
                <select class="form-control" placeholder="Województwo" type="text" name="wojew">
                     @if(old('wojew')!='')
                        <option value="{{old('wojew')}}">{{old('wojew')}}</option>
                      @else 
                         <option value="">Województwo</option>
                       @endif
                    	<option value="dolnośląskie">dolnośląskie</option>
                        <option value="kujawsko-pomorskie">kujawsko-pomorskie</option>
                        <option value="łódzkie">łódzkie</option>
                        <option value="lubelskie">lubelskie</option>
                        <option value="lubuskie">lubuskie</option>
                        <option value="mazowieckie">mazowieckie</option>
                        <option value="małopolskie">małopolskie</option>
                        <option value="opolskie">opolskie</option>
                        <option value="podkarpackie">podkarpackie</option>
                        <option value="podlaskie">podlaskie</option>
                        <option value="pomorskie">pomorskie</option>
                        <option value="śląskie">śląskie</option>
                        <option value="świętokrzyskie">świętokrzyskie</option>
                        <option value="warmińsko-mazurskie">warmińsko-mazurskie</option>
                        <option value="wielkopolskie">wielkopolskie</option>
                        <option value="zachodniopomorskie">zachodniopomorskie</option>
                </select>
                </div>
                <div class="form-group">
                <select class="form-control" placeholder="Region" type="text" name="region">
                     @if(old('region')!='')
                        <option value="{{old('region')}}">{{old('region')}}</option>
                      @else
                    <option value="">Region</option>
                    @endif
                    <option value="wybrzeże bałtyckie">wybrzeże bałtyckie</option>
                    <option value="mazury">mazury</option>
                    <option value="tatry">tatry</option>
                    <option value="bieszczady">bieszczady</option>
                    <option value="pomorze">pomorze</option>
                    <option value="kaszuby">kaszuby</option>
                    <option value="lubelszczyzna">lubelszczyzna</option>
                    <option value="lubuski" >lubuski</option>
                    <option value="mazowsze">mazowsze</option>
                    <option value="śląsk">śląsk</option>
                    <option value="podkarpacie">podkarpacie</option>
                    <option value="podlasie">podlasie</option>
                    <option value="śląsko-krakowski">śląsko-krakowski</option>
                    <option value="sudety">sudety</option>
                    <option value="beskidy">beskidy</option>
                    <option value="suwalszczyzna">suwalszczyzna</option>
                    <option value="świetokrzyski">świetokrzyski</option>
                    <option value="wielkopolski">wielkopolski</option>
                    <option value="pojezierze">pojezierze</option>
                    <option value="kurpie">kurpie</option>
                    <option value="piękna Polska">piękna Polska</option>
                </select>
                 </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Telefon kontaktowy" type="text" name="telefon" value="{{old('telefon')}}">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Telefon kontaktowy 2" type="text" name="telefon2" value="{{old('telefon2')}}">
                </div>
                <div class="form-group">
                <input class="form-control" placeholder="Email" type="text" name="email" value="{{old('email')}}">
                 </div>
                <div class="form-group">
                    <label class="control-label">Wyżywienie na miejscu</label>
                    <div class="radio-wrap">
                        <input  class="radio-inline"  type="radio" name="jadlonamiejscu" value="tak"  @if(old('jadlonamiejscu')=="tak") checked @endif >
                        <span class="">tak</span>
                        <input  class="radio-inline"  type="radio" name="jadlonamiejscu" value="nie"  @if(old('jadlonamiejscu')=="nie") checked @endif >
                        <span class="">nie</span> 
                    </div>
                </div>
               <div class="form-group">
                   <label class="control-label">Wyżywienie w cenie</label>
                    <div class="radio-wrap">
                            <input  class="radio-inline"  type="radio" name="obowiazkowejadlo" value="tak" @if(old('obowiazkowejadlo')=="tak") checked @endif >
                            <span class="">tak</span>
                            <input  class="radio-inline"  type="radio" name="obowiazkowejadlo" value="nie" @if(old('obowiazkowejadlo')=="nie") checked @endif >
                            <span class="">nie</span>
                    </div> 
                   </div>
                <div class="form-group">
                <input class="form-control" placeholder="Cena śniadania" type="text" name="sniadanie" value="{{old('sniadanie')}}">
                 </div>
                <div class="form-group">
                <input class="form-control" placeholder="Cena Obiadu" type="text" name="obiad" value="{{old('obiad')}}">
                 </div>
                <div class="form-group">
                <input class="form-control" placeholder="Cena kolacji" type="text" name="kolacja" value="{{old('kolacja')}}">
                 </div>
                 <div class="form-group">
                <input class="form-control" placeholder="Cena obiadokolacji" type="text" name="obiadokolacja" value="{{old('obiadokolacja')}}">
                 </div>
                <div class="form-group">
                <input class="form-control" placeholder="Ilość Miejsc" type="text" name="iloscmiejsc" value="{{old('iloscmiejsc')}}">
                 </div>
                <div class="form-group">
                <input class="form-control" placeholder="Ilość pokoii" type="text" name="iloscpokoi" value="{{old('iloscpokoi')}}">
                 </div>
                <div class="form-group">
                <input class="form-control" placeholder="Ilość łazienek" type="text" name="ilosclazienek" value="{{old('ilosclazienek')}}">
                 </div>
                <div class="form-group">
                <input class="form-control" placeholder="W okolicy" type="text" name="okolica" value="{{old('okolica')}}">
                 </div>
                 
                
                 <div class="form-group">
                <input class="form-control" placeholder="Cena minimalna osoba/doba" type="text" name="cenamin" value="{{old('cenamin')}}">
                 </div>
                <div class="form-group">
                <input class="form-control" placeholder="Cena maksymalna osoba/doba" type="text" name="cenamax" value="{{old('cenamax')}}">
                 </div>
                <div class="form-group"><label class="control-label">dostępne od </label>
                    <select   class="form-control"  name="dostod" >
                          @if(old('dostod')!='')
                        <option value="{{old('dostod')}}">{{old('dostod')}}</option>
                      @else
                       <option value="całoroczny">całoroczny</option>
                        @endif
                        <option value="styczeń">styczeń</option><option value="luty">luty</option><option value="mrzec">marzec</option>
                        <option value="kwiecień">kwiecień</option><option value="maj">maj</option><option value="czerwiec">czerwiec</option>
                        <option value="lipiec">lipiec</option><option value="sierpień">sierpień</option><option value="wrzesień">wrzesień</option><option value="październik">październik</option><option value="listopad">listopad</option><option value="grudzień">grudzień</option>
                    </select>
                </div>

                <div class="form-group"><label class="control-label">do </label>
                    <select   class="form-control"  name="dostdo">
                      @if(old('dostdo')!='')
                        <option value="{{old('dostdo')}}">{{old('dostdo')}}</option>
                      @else
                       <option value="całoroczny">całoroczny</option>
                        @endif
                        <option value="styczen">styczeń</option><option value="luty">luty</option><option value="marzec">marzec</option>
                        <option value="kwiecień">kwiecień</option><option value="maj">maj</option><option value="czerwiec">czerwiec</option><option value="lipiec">lipiec</option>
                        <option value="sierpień">sierpień</option><option value="wrzesień">wrzesień</option><option value="październik">październik</option><option value="listopad">listopad</option><option value="grudzień">grudzień</option>
                    </select>
                </div>
                 
                <div class="form-group">
                    <label class="control-label">Atrakcje </label>
                     <input name = "piktogram[]" type = "checkbox" value = "1" {{ (is_array(old('piktogram')) && in_array(1, old('piktogram'))) ? ' checked' : '' }}>
                      <input name = "piktogram[]" type = "checkbox" value = "2" {{ (is_array(old('piktogram')) && in_array(2, old('piktogram'))) ? ' checked' : '' }}>
                       <input name = "piktogram[]" type = "checkbox" value = "3" {{ (is_array(old('piktogram')) && in_array(3, old('piktogram'))) ? ' checked' : '' }}>
                </div>
                 
                <div class="form-group">
                    <label class="control-label">Dodatkowe</label>
                     <input name = "dodatkowe[]" type = "checkbox" value = "1" {{ (is_array(old('dodatkowe')) && in_array(1, old('dodatkowe'))) ? ' checked' : '' }}>
                     <input name = "dodatkowe[]" type = "checkbox" value = "2"{{ (is_array(old('dodatkowe')) && in_array(2, old('dodatkowe'))) ? ' checked' : '' }}>
                     <input name = "dodatkowe[]" type = "checkbox" value = "3"{{ (is_array(old('dodatkowe')) && in_array(3, old('dodatkowe'))) ? ' checked' : '' }}>
                </div>
                 
                 
                 
                 
                 <div class="form-group">
                <input class="form-control" placeholder="Współrzędne - szerokość" type="text" name="poz_x" value="{{old('poz_x')}}">
                 </div>
                <div class="form-group">
                <input class="form-control" placeholder="Współrzędne - długość" type="text" name="poz_y" value="{{old('poz_y')}}">
                 </div>
                 <div class="form-group">
                <input class="form-control" placeholder="Strona www" type="text" name="link" value="{{old('link')}}">
                 </div>
                <div class="form-group">
                    <textarea class="form-control" name="opis" placeholder="Opis">{{old('opis')}}</textarea>
                 </div>
                <div class="form-group">
                    <textarea class="form-control" name="wiecej" placeholder="Wiecej informacj">{{old('wiecej')}}</textarea>
                 </div>
                 <div class="form-group">
                <button class="btn btn-default">DODAJ</button>
                 </div>
            </form>
        </div>
    </div>
</div>
@endsection