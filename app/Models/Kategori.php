<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;
    //Burdaki kodda ingilizce olarak sonuna -s takısı getirmemesi için bu kodu yazıyoruz!!!
    protected $table="kategori";
    //Burdaki kodda oluşturacagımız kolonların create komutunu izin vermesi için yazıyoruz!!
    //protected $fillable=["kategori_adi","slug"];
    //Burdaki kodda veritabanına ulaşılmasını istemedigimiz dosyaların listesini tutabiliriz!!
    protected $guarded=[];
    //Tablonun içinde Türkçeleştirdigimiz kolonları Laravelin de anlaması için aşagıdaki kodları yazıyoruz !!
    public const CREATED_AT = "olusturulma_tarihi";
    public const UPDATED_AT = "guncelleme_tarihi";
    public const DELETED_AT= "silinme_tarihi";

    public function urunler()
    {
        return $this->belongsToMany("App\Models\Urun","kategori_urun");
    }
}
