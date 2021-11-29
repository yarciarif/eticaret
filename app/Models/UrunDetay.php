<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrunDetay extends Model
{

    public $timestamps=false;
        protected $table="urun_detay";
//Eğer created at ve updated at kolonlarını kullanmıcaksak TIMESTAMP fonksiyonunu false olarak eşitliyoruz !!


        public function urun()
    {
        return $this->belongsTo("App\Models\Urun");
    }
}
