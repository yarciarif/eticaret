<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKullaniciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kullanici', function (Blueprint $table) {
            $table->bigIncrements('id')->index()->nullable();
            $table->string( "adsoyad",50);
            $table->string( "email",150)->unique();
            $table->string("sifre",60);
            $table->string("aktivasyon_anahtari",60)->nullable();
            $table->boolean("aktif_mi")->default(0);
            $table->boolean("yonetici_mi")->default(0);
//Burda Oturum Ac sayfasında Beni Hatırla butonunu kolon haline getirebilmek için RememberToken kolonu oluşturuyoruz !
            $table->rememberToken();

            $table->timestamp("olusturma_tarihi")->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->timestamp("guncelleme_tarihi")->default(DB::raw("CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP"));
            $table->timestamp("silinme_tarihi")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kullanici');
    }
}
 