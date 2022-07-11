<?php

namespace Database\Seeders;

use App\Models\Album;
use Carbon\Carbon;
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
                'artist_id' => 1,
                'cost' => 10,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Secondo Album',
                'artist_id' => 1,
                'cost' => 14,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Terzo Album',
                'artist_id' => 1,
                'cost' => 11,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Alba Chiara',
                'artist_id' => 2,
                'cost' => 13,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Waka Waka',
                'artist_id' => 3,
                'cost' => 12,
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
