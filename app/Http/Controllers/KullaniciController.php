<?php
namespace App\Http\Controllers;

use App\Mail\KullaniciKayitMail;
use App\Models\KullaniciDetay;
use App\Models\Sepet;
use App\Models\SepetUrun;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Kullanici;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class KullaniciController extends Controller
{
    public function __construct()
    {
//Burda Guest metdou ile kullanıcı giriş yaptıktan sonra tekrardan giriş yapmasını,kaydolmasını,ya da aktifleştirmesini önlemek için GUEST fonksiyonunu kullanıyoruzz !
//Except ile de hangisinin dahil olmasını istemediğimizi belirtiyoruz !!
        $this->middleware("guest")->except("oturumukapat");
    }

    public function giris_form()
    {
    	return view("kullanici.oturumac");
    }

    public function giris()
    {
        $this->validate(request(),[
            "email"=>"required | email",
            "sifre"=>"required"
        ]);
        $credentials=[
            "email"=>request("email"),
            "password"=>request("sifre"),
            "aktif_mi"=>1,
            
        ];
        if (auth()->attempt($credentials,request()->has("benihatirla"))){
            request()->session()->regenerate();

             $aktif_sepet_id=Sepet::firstorCreate(["kullanici_id"=>auth()->id()])->id;
             session()->put("aktif_sepet_id",$aktif_sepet_id);

             if (Cart::count()>0)
             {
                 foreach (Cart:: content() as $cartItem)
                 {
                    SepetUrun::updateorcreate
                    (
                        ['sepet_id'=>$aktif_sepet_id,'urun_id'=>$cartItem->id],
                        ['adet'=>$cartItem->qty,'fiyat'=>$cartItem->price,'durum'=>'Beklemede']
                    );
                 }
             }

             Cart::destroy();
             $sepetUrunler=SepetUrun::where('sepet_id',$aktif_sepet_id)->get();

             foreach ($sepetUrunler as $sepetUrun)
             {
                 Cart::add($sepetUrun->urun->id,$sepetUrun->urun->urun_adi,$sepetUrun->adet,$sepetUrun->fiyat,['slug'=>$sepetUrun->urun->slug]);
             }
//Kullanıcı girişi yap ılmadan sitenin içindeki sayfalardan birine erişmeyi önlemek için ve giriş yaptıktan sonra da o sayfaya yönlendirmek için kullanıyoruz!!
            return redirect()->intended("/");
        }
        else
        {
            $errors=["email"=>"Hatalı Giriş"];
            return back()->withErrors($errors);
        }
    }

    public function kaydol_form()
    {
    	return view("kullanici.kaydol");
    }

    public function kaydol()
    {
        $this->validate(request(),[
            "adsoyad"=> "required | min:5 | max:60",
            "email" => "required | email | unique:kullanici",
            "sifre"=>"required | confirmed | min:5 | max:15 "
        ]);
//Şifreleri databasede dogrudan saklanmıyor HASH leyerek saklıyoruz kendi degerini degil HASH lenmiş halini saklıyoruz !!
        $kullanici = Kullanici::create([
            "adsoyad"=>request("adsoyad"),
            "email"=>request("email"),
            "sifre"=>Hash::make(request("sifre")),
            "aktivasyon_anahtari"=>str::random(60),
            "aktif_mi"=>0
        ]);

        $kullanici->detay()->save(new KullaniciDetay());
//Mail gönderim işlemiii
       // Mail::to(request("email"))->send(new KullaniciKayitMail($kullanici));
//Kullanıcının girebilmesi için AUTH fonksiyonu eşliginde Kullanıcıyla bi giriş yapıyoruz
        auth()->login($kullanici);

        return redirect()->route("anasayfa");
    }

    public function aktiflestir($anahtar)
    {
        $kullanici = Kullanici::where("aktivasyon_anahtari",$anahtar)->first();

        if(!is_null($kullanici))
        {
            $kullanici->aktivasyon_anahtari = null;
            $kullanici->aktif_mi=1;
            $kullanici->save();
            return redirect()->to("/")
                ->with("mesaj","Kullanıcı kaydınız aktifleştirildi.")
                ->with("mesaj_tur","success");
        }
        else
        {
            return redirect()->to("/")
                ->with("mesaj","Kullanıcı kaydınız bulunamadı.")
                ->with("mesaj_tur","warning");
        }
    }

    public function oturumukapat()
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route("anasayfa");
    }
}
