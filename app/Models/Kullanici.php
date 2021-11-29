<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Kullanici extends Authenticatable
{
    use softDeletes;
    protected $table="kullanici";

    protected $fillable = ['adsoyad', 'email', 'sifre',"aktivasyon_anahtari","aktif_mi"];
    protected $hidden = ['sifre', 'aktivasyon_anahtari',];

    const CREATED_AT = "olusturma_tarihi";
    const UPDATED_AT =  "guncelleme_tarihi";
    const DELETED_AT = "silinme_tarihi";
    
//Veritabanındaki şifre alanına uydurmak için PASSWORD olan değişkeni burda sifre olarak eziyoruz!
    public function getAuthPassword()
    {
        return $this->sifre;
    }

    public function detay()
    {
        return $this->hasOne('App\Models\KullaniciDetay');
    }
}
