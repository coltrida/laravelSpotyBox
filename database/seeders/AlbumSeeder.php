<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Album::insert([
            [
                'name' => 'Primo Album',
                'artist_id' => 1
            ],
            [
                'name' => 'Secondo Album',
                'artist_id' => 1
            ],
            [
                'name' => 'Terzo Album',
                'artist_id' => 1
            ],
            [
                'name' => 'Alba Chiara',
                'artist_id' => 1
            ]
        ]);
    }
}
