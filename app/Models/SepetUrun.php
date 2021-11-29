<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SepetUrun extends Model
{
    use SoftDeletes;

    protected $table="sepet_urun";
    protected $guarded=[];


    public const CREATED_AT = "olusturma_tarihi";
    public const UPDATED_AT = "guncelleme_tarihi";
    public const DELETED_AT= "silinme_tarihi";

    public function urun()
    {
        return $this->belongsTo('App\Models\Urun');
    }
}
