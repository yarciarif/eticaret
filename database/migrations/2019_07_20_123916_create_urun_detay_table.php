<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUrunDetayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urun_detay', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("urun_id");
            $table->boolean("goster_slider")->default(0);
            $table->boolean("goster_gunun_firsati")->default(0);
            $table->boolean("goster_one_cikan")->default(0);
            $table->boolean("goster_cok_satan")->default(0);
            $table->boolean("goster_indirimli")->default(0);

            $table->unique("urun_id");

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
        Schema::dropIfExists('urun_detay');
    }
}
