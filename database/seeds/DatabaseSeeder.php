<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Burda oluşturgudumuz seeder dosyalarındaki verileri çekmek ve okutmak için aşagıdaki kodları yazıyoruz !!
        $this->call(KategoriTableSeeder::class);
        $this->call(UrunTableSeeder::class);
    }
}
