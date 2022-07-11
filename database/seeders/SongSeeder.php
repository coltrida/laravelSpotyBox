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
                'album_id' => 1
            ],
            [
                'name' => 'Shape of You',
                'album_id' => 1
            ],
            [
                'name' => 'Lose Yourself',
                'album_id' => 2
            ],
            [
                'name' => 'On The Floor',
                'album_id' => 2
            ],
            [
                'name' => 'Beggin',
                'album_id' => 3
            ],
            [
                'name' => 'Siamo Solo Noi',
                'album_id' => 4
            ],
            [
                'name' => 'Bollicine',
                'album_id' => 4
            ],
            [
                'name' => 'Te felicito',
                'album_id' => 5
            ],
            [
                'name' => 'Dont You Worry',
                'album_id' => 5
            ],
        ]);
    }
}
