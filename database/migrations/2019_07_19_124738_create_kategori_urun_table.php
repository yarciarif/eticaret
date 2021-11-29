<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriUrunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_urun', function (Blueprint $table) {
            $table->bigIncrements('id');
            //negatif sayıların kullanılmaması için UNSIGNED
            $table->unsignedBigInteger("kategori_id");
            $table->unsignedBigInteger("urun_id");
//Burdaki yaptıgımız işlem bir ürüne veya kategoriye id atayarak ikisini birbiriyle ilişkilendirip bir ürünü veya bir kategoriyi sildigimzde o id ye ait olan tüm ürünlerin silinmesini sağlıyo !!
            $table->foreign("kategori_id")->references("id")->on("kategori")->onDelete("cascade");
            $table->foreign("urun_id")->references("id")->on("urun")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_urun');
    }
}
