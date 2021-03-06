<?php

use Illuminate\Database\Seeder;
use App\Models\Urun;
use App\Models\UrunDetay;
class UrunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
        //FAKER kütüphanesi rastgele verileri tablolara ekleme işlemi yapıyoruz !!
    {
        //Urun::truncate();

        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        for ($i=0;$i<30;$i++)
        {
            $urun_adi=$faker->sentence(2);

            $urun=Urun::create([
                "urun_adi"=>$urun_adi,
                "slug"=>str_slug($urun_adi),
                "aciklama"=>$faker->paragraph(20),
                "fiyati"=>$faker->randomFloat(2,1,20)
            ]);
        //Değişken atayarak olusturdugumuz ürünlere ait detayları da detay değişkenine atamış oluyoruz!!
            $detay=$urun->detay()->create([
                "goster_slider"=>rand(0,1),
                "goster_gunun_firsati"=>rand(0,1),
                "goster_one_cikan"=>rand(0,1),
                "goster_cok_satan"=>rand(0,1),
                "goster_indirimli"=>rand(0,1)
            ]);
        }
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
    }
}
