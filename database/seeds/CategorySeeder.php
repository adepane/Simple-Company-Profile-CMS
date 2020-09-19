<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert([
            'name' => 'Tidak Berkategori',
            'slug' => 'tidak-berkategori',
        ]);
    }
}
