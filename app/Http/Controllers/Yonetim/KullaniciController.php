<?php

namespace App\Http\Controllers\yonetim;

use Illuminate\Http\Request;
use App\Kullanici;
use App\Http\Controllers\Controller;
use Auth;

class KullaniciController extends Controller
{
    public function oturumac()
    {
    	if (Request()->isMethod("POST"))
    	{
    		$this->validate(Request(),[
    			"email"=>"required | email",
    			"sifre"=>"required"
    		]);
//Yönetici Giriş İşlemi İCin bu işlemleri Yapıyoruz 
//Bir DİZİ oluşuturup sonrasında bu diziye EMAİL ŞİFRE ve YÖNETCİ Mİ DOĞRULAMALARINI sağlayıp girişi tamamlıyoruz    		
    		$credentials=[
    		"email"=>Request()->get("email"),
    		"password"=>Request()->get("sifre"),
    		"yonetici_mi"=>1,
    		"aktif_mi"=>1
    		];	
//Burda GUARD ile müsteri ve YONETİCİ arasındaki ayrımı yapmış olacagız!!  		
    		if(auth::guard("yonetim")->attempt($credentials,Request()->has("benihatirla"))) 
    		{
    			return redirect()->route("yonetim.anasayfa");
    		}
    		else
    		{
    			return back()->withInput()->withErrors(["email"=>"Eposta Hatalı","sifre"=>"Şifre Hatalı"]);
    		}
    	}
    	return view ("Yonetim.oturumac");
    }
    public function oturumukapat()
    {
    	Auth::guard('yonetim')->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route("yonetim.oturumac");
    }

    public function index()
    {
    	$list=Kullanici::orderByDesc('olusturma_tarihi')->paginate(8);
    	return view('yonetim.Kullanici.index',compact('list'));
    }
}
