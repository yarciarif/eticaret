<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siparis extends Model
{
    use SoftDeletes;

    protected $table='siparis';

    protected $fillable=
        ['sepet_id','siparis_tutari','durum',
        'adsoyad','adres','telefon','ceptelefonu',
        'banka','taksit_sayisi'];


    public const CREATED_AT = "olusturma_tarihi";
    public const UPDATED_AT = "guncelleme_tarihi";
    public const DELETED_AT= "silinme_tarihi";

    public function sepet()
    {
        return $this->belongsTo('App\Model\Sepet');
    }
}
