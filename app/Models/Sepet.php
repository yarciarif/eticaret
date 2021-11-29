<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sepet extends Model
{
    use SoftDeletes;

    protected $table="sepet";
    protected $guarded=[];


    public const CREATED_AT = 'olusturma_tarihi';
    public const UPDATED_AT = 'guncelleme_tarihi';
    public const DELETED_AT= 'silinme_tarihi';

    public function siparis()
    {
//Sepet sayfası ile arasındaki ilişkiyi tanımlamak için hasOne metodunu kullanıyoruz !!
        return $this->hasOne('App\Models\Sepet');
    }
}
