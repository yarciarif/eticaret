<?php

namespace App\Http\Controllers;

use App\Models\Sepet;
use App\Models\SepetUrun;
use App\Models\Urun;
use function Faker\Provider\pt_BR\check_digit;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SepetController extends Controller
{
    public function __construct()
    {
//Middleware kullanımının Controllerdaki gösterimi
// Yani Kullanıcı giriş yapmadan sepet sayfasına erişemezzz !
//        $this->middleware("auth");
    }
    public function index()
    {
    	return view("sepet");
    }
    public function ekle()
//Formdan gelen veriyi Almak için request parametreesini kullanıyoruz !!
    {
        $urun=Urun::find(request("id"));
//Sepete ürün eklemek için tek satırda Cart fonksiyonuna 4 tane parametre ekleyerek tamamlamış oluyoruz !!
//İlk parametresi ID si, İkincisi:Adı, Üçüncüsü:adedi, Dördüncüsü:Fiyati
//ÜRÜNÜN ÖZELLİKLERİNİ EKLEMEK İSTİYOSAN PARAMETRE OLARAK EKLEYEBİLİRİZ==RENK, BOYUTU GİBİ DEĞERLER OLABİLİR
        $cartItem=Cart::add($urun->slug,$urun->urun_adi,1,$urun->fiyati,["slug"=>$urun->slug]);
//Veri tabanında bir sepet oluşturmaaa!!
//SADECE KULLANICI GİRİŞİ YAPANLAR İÇİN GEÇCERLİ OLUCAK !!!!!
        if (auth()->check())
        {
            $aktif_sepet_id=session("aktif_sepet_id");
                if (!isset($aktif_sepet_id))
                {
                    $aktif_sepet=Sepet::create([
                        'kullanici_id'=>auth()->id()
                    ]);
                    $aktif_sepet_id=$aktif_sepet->id;
                    session()->put('aktif_sepet_id',$aktif_sepet_id);
                }
                SepetUrun::updateorcreate(
                    ['sepet_id'=>$aktif_sepet_id, 'urun_id'=>$urun->id],
                    ['adet'=>$cartItem->qty, 'fiyat'=>$urun->fiyati, 'durum'=>'Beklemede']
                );
        }

        return redirect()->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ürün Sepete Eklendi.');
    }
    public function kaldir($rowid)
    {
        if (auth()->check())
        {
            $aktif_sepet_id=session("aktif_sepet_id");
            $cartItem=Cart::get($rowid);
            SepetUrun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)->delete();
        }
        Cart::remove($rowid);
         return redirect()
             ->route('sepet')
//Sepetten Ürün Kaldırıldıgında Bir Mesajın Yayınlanmasıı
             ->with('mesaj_tur','success')
             ->with('mesaj','Ürün Sepetten Kaldırıldı.');
    }
    public function bosalt()
    {
        if (auth()->check())
        {
            $aktif_sepet_id=session("aktif_sepet_id");
            SepetUrun::where('sepet_id',$aktif_sepet_id)->delete();
        }

        Cart::destroy();

        return redirect()
        ->route('sepet')
        ->with('mesaj_tur','success')
        ->with('mesaj','Sepetiniz Boşaltıldı.');
    }
    public function guncelle($rowid)
    {
        $validator=Validator::make(request()->all(),
            ['adet'=>'required|numeric|between:0,5']);

        if ($validator->fails())
        {
            session()->flash('mesaj_tur','danger');
            session()->flash('mesaj','Adet değeri en az 1 en fazla 5 olmalıdır.');
            return response()->json(['success'=>false]);
        }
        if (auth()->check())
        {
            $aktif_sepet_id=session("aktif_sepet_id");
            $cartItem=Cart::get($rowid);

            if (request('adet')== 0)
                SepetUrun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)->delete();
            else
                SepetUrun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)
                ->update(['adet'=>request('adet')]);
        }

        Cart::update($rowid,request('adet'));

            session()->flash('mesaj_tur','success');
            session()->flash('mesaj','Adet Bilgisi Güncellendi');

        return response()->json(['success'=>true]);
    }
}
