<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumsalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(2);
        $user->albumsales()->attach([1,2,3]);

        $user = User::find(3);
        $user->albumsales()->attach([2,4]);

        $user = User::find(4);
        $user->albumsales()->attach([2,4]);
    }
}
