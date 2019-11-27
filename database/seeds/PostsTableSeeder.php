<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 0; $i < 10; $i++){
            DB::table('posts')->insert([
                'judul' => $faker->title,
                'isi' => $faker->text,
                'foto' => $faker->title,
                'tema_id' => 1
            ]);
        }

    }
}
