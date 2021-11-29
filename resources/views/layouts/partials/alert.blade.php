<!--Burda controllerdan anasayfaya yönlendirdiğimiz mesaj değerini anasayfada görüntülemek için if bloğunun içinde HTML kodlarıyla bütünleştiriyoruz !!-->
@if(session()->has("mesaj"))
    <div class="container">
        <div class="alert alert-{{session('mesaj_tur')}}">{{session("mesaj")}}</div>
    </div>
@endif