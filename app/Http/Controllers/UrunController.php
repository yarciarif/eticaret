<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Urun;

class UrunController extends Controller
{
    public function index($slug_urunadi)
    {
        $urun=Urun::whereSlug($slug_urunadi)->firstorfail();
//DISTINCT fonksiyonu ise bir kategoriye birden fazla ürün eklersek tek bir kategori adı görülmesini sağlıyor !
        $kategoriler=$urun->kategoriler()->distinct()->get();
    	return view("urun",compact("urun","kategoriler"));
    }

    public function ara()
//Bu fonksiyonun amacı ise bi filtreleme yaparak site içindeki ürünleri arama yapmak
//aranan değişkenine request istegi ile inputtaki aranan ürününe atıyoruz ve eşit olup olmadıgını kontrol ediyoruz!!
    {
    //bu alanlar dısındaki ürünleri almak için yazılan kod EXCEPT   request()->except("aa","bb","cc"); ONLY sadece onları istersek
        $aranan=request()->input("aranan");
        $urunler=Urun::where("urun_adi","like","%$aranan%")
            ->orwhere("aciklama","like","%$aranan%")
            ->paginate(2);
//Burda arama yaptıgımız kutucukta aranan kelimenin yerinde kalması için kullanıyoruz !! REQUEST()->FLASH()
        request()->flash();
        return view("arama",compact("urunler"));
    }
}
