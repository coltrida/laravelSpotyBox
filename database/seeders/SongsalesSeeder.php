<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SongsalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(2);
        $user->songsales()->attach([1,2,3,4,5]);

        $user = User::find(3);
        $user->songsales()->attach([6,7]);

        $user = User::find(4);
        $user->songsales()->attach([8,9]);
    }
}
