<?php

use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//cmd de php artisan db:seed sorgusuyla çalıştırıp migrate ederek database e kayıt işlemini gerçekleştirmiş oluyoruz !!

//truncate fonksiyonu ile tabloyu silmeyip içindeki verileri komple silmeye yarıyo !!
        //DB::table("kategori")->truncate();
        $id=DB::table("kategori")->insertGetId(["kategori_adi"=>"Elektronik","slug"=>"Elektronik"]);
        DB::table("kategori")->insert(["kategori_adi"=>"Bilgisayar","slug"=>"bilgisayar","ust_id"=>"$id"]);
        DB::table("kategori")->insert(["kategori_adi"=>"Kulaklık","slug"=>"kulaklık","ust_id"=>"$id"]);
        DB::table("kategori")->insert(["kategori_adi"=>"Telefon","slug"=>"telefon","ust_id"=>"$id"]);
        DB::table("kategori")->insert(["kategori_adi"=>"TV ve Ses Sistemleri","slug"=>"tv ve ses sistemleri","ust_id"=>"$id"]);


        $id=DB::table("kategori")->insertGetId(["kategori_adi"=>"Kitap","slug"=>"Kitap"]);
        DB::table("kategori")->insert(["kategori_adi"=>"Edebiyat","slug"=>"edebiyat","ust_id"=>"$id"]);
        DB::table("kategori")->insert(["kategori_adi"=>"Çocuk","slug"=>"çocuk","ust_id"=>"$id"]);
        DB::table("kategori")->insert(["kategori_adi"=>"Bilişim","slug"=>"bilişim","ust_id"=>"$id"]);
        DB::table("kategori")->insert(["kategori_adi"=>"Sınavlara Hazırlık","slug"=>"sınavlara hazırlık","ust_id"=>"$id"]);


        DB::table("kategori")->insert(["kategori_adi"=>"Dergi","slug"=>"Dergi"]);
        DB::table("kategori")->insert(["kategori_adi"=>"Mobilya","slug"=>"Mobilya"]);
        DB::table("kategori")->insert(["kategori_adi"=>"Dekorasyon","slug"=>"Dekorasyon"]);
        DB::table("kategori")->insert(["kategori_adi"=>"Kozmetik","slug"=>"Kozmetik"]);
        DB::table("kategori")->insert(["kategori_adi"=>"Kişisel Bakım","slug"=>"Kişisel Bakım"]);
        DB::table("kategori")->insert(["kategori_adi"=>"Giyim ve Moda","slug"=>"Giyim ve Moda"]);
        DB::table("kategori")->insert(["kategori_adi"=>"Anne ve Çocuk","slug"=>"Anne ve Çocuk"]);
    }
}
