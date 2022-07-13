<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(ArtistSeeder::class);
        $this->call(AlbumSeeder::class);
        $this->call(SongSeeder::class);
     //   $this->call(PreferiteSeeder::class);
        $this->call(AlbumsalesSeeder::class);
     //   $this->call(SongsalesSeeder::class);
        $this->call(ArtistsalesSeeder::class);
    }
}
