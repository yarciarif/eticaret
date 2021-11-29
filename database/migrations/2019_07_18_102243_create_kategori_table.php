<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("kategori_adi",30);
            $table->string("slug",40)->nullable();
            $table->integer("ust_id")->nullable();
            //Burda kolonların ismini değiştirmek istedigimizde alttaki gibi bir kod kullanıyoruz !!
            $table->timestamp("olusturma_tarihi")->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->timestamp("guncelleme_tarihi")->default(DB::raw("CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP"));
            //$table->softDeletes();
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
        Schema::dropIfExists('kategori');
    }
}
