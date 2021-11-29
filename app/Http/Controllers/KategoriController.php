<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index($slug_kategoriadi)
    {
        //istedigimiz view tanımı gelmeyecekse eğer bu şekilde ya istedigimizi getir ya da hata mesajı döndür şeklinde bir fonksiyon kullanıyoruz !!
        $kategori=Kategori::where("slug",$slug_kategoriadi)->firstorfail();
        $alt_kategoriler = Kategori::where("ust_id","$kategori->id")->get();

        $order=request('order');
        if ($order=='coksatanlar')
        {
            $urunler = $kategori->urunler()
                ->distinct()
                ->join("urun_detay","urun_detay.urun_id","urun.id")
                ->orderby("urun_detay.goster_cok_satan","desc")
                ->paginate(2);
        }
        else if($order=="yeni")
        {
            $urunler=$kategori->urunler()
                ->distinct()
                ->orderbydesc("guncelleme_tarihi")
                ->paginate(2);
        }
        else
        {
            $urunler = $kategori->urunler()
                ->distinct()
                ->paginate(2);
        }
    	return view("kategori",compact("kategori","alt_kategoriler","urunler"));
    }
}
