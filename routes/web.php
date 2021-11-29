<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(["prefix"=>"yonetim","namespace"=>"Yonetim"],function()
{
 Route::redirect("/","/yonetim/oturumac");
 Route::match(["get","post"],"/oturumac","KullaniciController@oturumac")->name("yonetim.oturumac");
 Route::get("/oturumukapat","KullaniciController@oturumukapat")->name("yonetim.oturumukapat");
 
    Route::group(["middleware"=>"yonetim"],function (){
        Route::get("/anasayfa","AnasayfaController@index")->name("yonetim.anasayfa");

Route::group(['prefix'=>'kullanici'],function()
{
    Route::match(['get','post'],'/','KullaniciController@index')->name('yonetim.kullanici');
    Route::get('/yeni','KullaniciController@form')->name('yonetim.kullanici.yeni');
    Route::get('/duzenle/{id}','KullaniciController@form')->name('yonetim.kullanici.duzenle');
    Route::POST('/kaydet/{id?}','KullaniciController@kaydet')->name('yonetim.kullanici.kaydet');
    Route::get('/sil/{id}','KullaniciController@sil')->name('yonetim.kullanici.sil');
        });
    });
});


Route::get('/', "AnasayfaController@index")->name("anasayfa");
//API örneği
Route::get("/kullaniciapi/{id}","ApiController@index");
Route::get("/urunapi/{id}","ApiController@urunBul");

/*
//Fonksiyon kullanımı metinsel değer girdi
Route::get("/merhaba",function(){
	return "Merhaba";
});
//Array olarak metinsel girdi
Route::get("/api/v1/merhaba",function(){
	return ["mesaj"=>"Merhaba"];
});
//Parametre kullanarak route gönderimi 
Route::get("/urun/{urunadi}/{id?}",function($urunadi,$id=0){
	return "Ürün Adı:$id $urunadi";
})->name("urun_detay");
//		ve İSİMLENDİRME
Route::get("/kampanya",function(){
	return redirect()->route("urun_detay",["isim"=>"Elma","id"=>"5"]);
});
*/
    Route::get("/kategori/{slug_kategoriadi}","KategoriController@index")->name("kategori");

    Route::get("/urun/{slug_urunadi}","UrunController@index")->name("urun");
    Route::post("/ara","UrunController@ara")->name("urun_ara");
//Burda POST tan sonra 2.kez ara kontrollerini yapmamızın nedeni sayfalandırma için ürünleri sayfalandırsın diye yani!!
    Route::get("/ara","UrunController@ara")->name("urun_ara");


    Route::Group(["prefix"=>"sepet"],function (){
        Route::get("/","SepetController@index")->name("sepet");//->middleware("auth");
        Route::POST("/ekle","SepetController@ekle")->name("sepet.ekle");
        Route::DELETE("/kaldir/{rowId}","SepetController@kaldir")->name("sepet.kaldir");
        Route::DELETE("/bosalt","SepetController@bosalt")->name("sepet.bosalt");
        Route::patch("/guncelle/{rowid}","SepetController@guncelle")->name("sepet.guncelle");
});


    Route::get("/odeme","OdemeController@index")->name("odeme");
    Route::post("/odeme","OdemeController@odemeyap")->name("odemeyap");

//Middleware kullanarak kullanıcı giriş yapmadan görmesini istemediğimiz sayfaları oluşturuyoruz !!
    Route::group(["middleware"=>"auth"],function (){
        Route::get("/siparisler","SiparisController@ind ex")->name("siparisler");
        Route::get("/siparisler/{id}","SiparisController@detay")->name("siparis");
    });

//Route değerlerini Prefix ile gruplayarak öndeki kullanıcı ön ekini tekrar terkrar yazmaktan kurtulduk
    Route::group(["prefix"=>"kullanici"], function(){
	Route::get("/oturumac","KullaniciController@giris_form")->name("kullanici.oturumac");
	Route::POST("/oturumac","KullaniciController@giris")->name("kullanici.oturumac");
	Route::get("/kaydol","KullaniciController@kaydol_form")->name("kullanici.kaydol");
	Route::POST("/kaydol","KullaniciController@kaydol");
	Route::get("/aktiflestir{anahtar}","KullaniciController@aktiflestir")->name("aktiflestir");
	Route::POST("/oturumukapat","KullaniciController@oturumukapat")->name("kullanici.oturumukapat");

    });


	Route::get("/test/mail",function (){
//Burda karşılaştıgım bir sorun ise App klasörü altındaki modelsi görmeyip direk Kullanici diye tanımlamak oldu !!
	    $kullanici=\App\Kullanici :: find(1);
	    return new \App\Mail\KullaniciKayitMail($kullanici);
    });

