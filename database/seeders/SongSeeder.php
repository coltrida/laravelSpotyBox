<?php

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Song::insert([
            [
                'name' => 'Monkey Dance',
                'cost' => 3,
                'album_id' => 1
            ],
            [
                'name' => 'Shape of You',
                'cost' => 2,
                'album_id' => 1
            ],
            [
                'name' => 'Lose Yourself',
                'cost' => 1,
                'album_id' => 2
            ],
            [
                'name' => 'On The Floor',
                'cost' => 3,
                'album_id' => 2
            ],
            [
                'name' => 'Beggin',
                'cost' => 3,
                'album_id' => 3
            ],
            [
                'name' => 'Siamo Solo Noi',
                'cost' => 2,
                'album_id' => 4
            ],
            [
                'name' => 'Bollicine',
                'cost' => 3,
                'album_id' => 4
            ],
            [
                'name' => 'Te felicito',
                'cost' => 3,
                'album_id' => 5
            ],
            [
                'name' => 'Dont You Worry',
                'cost' => 4,
                'album_id' => 5
            ],
        ]);
    }
}
