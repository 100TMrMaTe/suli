<?php

namespace Database\Seeders;

use App\Models\admin;
use App\Models\games;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::forceCreate([
            'username' => 'player1',
            'password' => bcrypt('helloworld1'),
        ]);

        User::forceCreate([
            'username' => 'player2',
            'password' => bcrypt('helloworld2'),
        ]);

        $dev1 = User::forceCreate([
            'username' => 'dev1',
            'password' => bcrypt('hellobyte1'),
        ]);

        $dev2 = User::forceCreate([
            'username' => 'dev2',
            'password' => bcrypt('hellobyte2'),
        ]);

        games::forceCreate([
            'title' => 'demo game 1',
            'slug' => 'demo-game-1',
            'description' => 'This demo game is game 1',
            'author_id' => $dev1->id,
        ]);

        games::forceCreate([
            'title' => 'demo game 2',
            'slug' => 'demo-game-2',
            'description' => 'This demo game is game 2',
            'author_id' => $dev2->id,
        ]);

        admin::forceCreate([
            'username' => 'admin1',
            'password' => bcrypt('hellouniverse1'),
        ]);
    }
}
