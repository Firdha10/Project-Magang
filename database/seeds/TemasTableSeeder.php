<?php

use Illuminate\Database\Seeder;

class TemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('temas')->insert([
            [
                'tema' => 'Pendidikan'
            ],
            [
                'tema' => 'Olahraga'
            ],
            [
                'tema' => 'Berita'
            ]
        ]);
    }
}
