<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artist::insert([
            [
                'name' => 'Tommaso Vitali',
                'user_id' => 6,
                'cost' => 120,
                'category' => 'Havy Metal'
            ],
            [
                'name' => 'Vasco Rossi',
                'user_id' => 5,
                'cost' => 100,
                'category' => 'Pop'
            ],
            [
                'name' => 'Shakira',
                'user_id' => 7,
                'cost' => 80,
                'category' => 'Pop'
            ]
        ]);
    }
}
