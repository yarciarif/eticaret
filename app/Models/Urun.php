<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Urun extends Model
{
    use SoftDeletes;


    protected $table="urun";

    protected $guarded=[];


    public const CREATED_AT = "olusturma_tarihi";
    public const UPDATED_AT = "guncelleme_tarihi";
    public const DELETED_AT= "silinme_tarihi";

    public function kategoriler()
    {
        //Çoka Çok bir ilişki için bu fonksiyonu kullanıyoruz !!
        return $this->belongsToMany("App\Models\Kategori","kategori_urun");
    }

    public function detay()
    {
        return $this->hasOne("App\Models\UrunDetay");
    }
}
