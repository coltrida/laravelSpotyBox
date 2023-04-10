<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
     //   $this->call(AlbumsalesSeeder::class);
     //   $this->call(SongsalesSeeder::class);
        $this->call(ArtistsalesSeeder::class);

        Storage::disk('public')->deleteDirectory('covers/');
        Storage::disk('public')->deleteDirectory('songs/');

        Storage::disk('public')->makeDirectory('covers/');
        Storage::disk('public')->makeDirectory('songs/');

        Storage::copy('1.mp3', 'public/songs/1.mp3');
        Storage::copy('2.mp3', 'public/songs/2.mp3');
        Storage::copy('3.mp3', 'public/songs/3.mp3');
        Storage::copy('4.mp3', 'public/songs/4.mp3');
        Storage::copy('5.mp3', 'public/songs/5.mp3');
        Storage::copy('6.mp3', 'public/songs/6.mp3');
        Storage::copy('7.mp3', 'public/songs/7.mp3');
        Storage::copy('8.mp3', 'public/songs/8.mp3');
        Storage::copy('9.mp3', 'public/songs/9.mp3');

        Storage::copy('1.jpg', 'public/covers/1.jpg');
        Storage::copy('2.jpg', 'public/covers/2.jpg');
        Storage::copy('3.jpg', 'public/covers/3.jpg');
        Storage::copy('4.jpg', 'public/covers/4.jpg');
        Storage::copy('5.jpg', 'public/covers/5.jpg');
    }
}
