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
                'cost' => 120,
                'category' => 'Havy Metal'
            ],
            [
                'name' => 'Vasco Rossi',
                'cost' => 100,
                'category' => 'Pop'
            ],
            [
                'name' => 'Shakira',
                'cost' => 80,
                'category' => 'Pop'
            ]
        ]);
    }
}
