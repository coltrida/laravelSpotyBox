<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreferiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*PreferitesUser::insert([
            [
                'song_id' => 1,
                'user_id' => 2
            ],
            [
                'song_id' => 3,
                'user_id' => 2
            ],
        ]);*/

        $user = User::find(2);
        $user->preferites()->attach([1,3]);

        $user = User::find(3);
        $user->preferites()->attach(6);
    }
}
