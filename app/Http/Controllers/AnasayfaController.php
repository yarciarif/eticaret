<?php
//Controller Yapısı
namespace App\Http\Controllers;

use App\Models\UrunDetay;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Urun;

class AnasayfaController extends Controller
{
	    public function index()
    {
//Filtreleme işlemi yapmak için whereRaw kontrolu ile id si olmayan yani ana kategorileri listelemek ve anasayfada görüntülemek için bu kodu yazıyoruz !!
        $kategoriler=Kategori::whereRaw("ust_id is null")->take(8)->get();
//Burdaki sliderdaki gib yapmamızın nedeni ise eklenen bi ürünün guncelleme tarihine göre o sıraya girip listelenmesi !!
        $urunler_slider=Urun::select("urun.*")
            ->join("urun_detay","urun_detay.urun_id","urun_id")
            ->where("urun_detay.goster_slider",1)
            ->orderby("guncelleme_tarihi","desc")
            ->take(4)->get();

        $urun_gunun_firsati=Urun::select("urun.*")
            ->join("urun_detay","urun_detay.urun_id","urun_id")
            ->where("urun_detay.goster_gunun_firsati",1)
            ->orderby("guncelleme_tarihi","desc")
            ->first();

        $urunler_one_cikan=Urun::select("urun.*")
            ->join("urun_detay","urun_detay.urun_id","urun_id")
            ->where("urun_detay.goster_one_cikan",1)
            ->orderby("guncelleme_tarihi","desc")
            ->take(4)->get();



        $urunler_cok_satan=Urun::select("urun.*")
            ->join("urun_detay","urun_detay.urun_id","urun_id")
            ->where("urun_detay.goster_cok_satan",1)
            ->orderby("guncelleme_tarihi","desc")
            ->take(4)->get();


        $urunler_indirimli=Urun::select("urun.*")
            ->join("urun_detay","urun_detay.urun_id","urun_id")
            ->where("urun_detay.goster_indirimli",1)
            ->orderby("guncelleme_tarihi","desc")
            ->take(4)->get();



        return view("anasayfa",compact("kategoriler","urunler_slider","urun_gunun_firsati","urunler_one_cikan","urunler_cok_satan","urunler_indirimli"));

    }
}
