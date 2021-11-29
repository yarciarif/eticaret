@extends("layouts.master")

@section("content")
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('anasayfa')}}">Anasayfa</a></li>
            <li class="active">Arama Sonucu</li>
        </ol>
        <div class="products bg-content">
            <div class="row">
                @if(count($urunler)==0)
                    <div class="col-md-12 text-center">
                        Bir Ürün Bulunamadı !!
                    </div>
                @endif
                @foreach($urunler as $urun)
                    <div class="col-md-3 product">
                        <a href="{{route('urun',$urun->slug)}}">
                            <img src="http://via.placeholder.com/400x400?text=UrunResmi" alt="{{$urun->urun_adi}}">
                        </a>
                        <p>
                            <a href="{{route('urun',$urun->slug)}}">
                                {{$urun->urun_adi}}
                            </a>
                        </p>
                        <p class="price">{{$urun->fiyati}} ₺</p>
                    </div>
                @endforeach
            </div>
<!--Burda da aranan ürünlerin listelenmesi sırasında 2.sayfaya geçişte aranan kelimeyi bulmayıp ürünlerin tamamını listelendirmemesi için bu işlemi yapıyoruz!! -->
                {{$urunler->appends(["aranan"=>old("aranan")])->links()}}
        </div>
    </div>
@endsection