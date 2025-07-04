<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'isadmin'=>1
        ]);
        User::factory()->create([
            'name' => 'User User',
            'email' => 'user@example.com',
            'isadmin' => 0
        ]);
        User::factory()->create([
            'name' => 'Kim Nathan',
            'email' => 'kim@example.com',
            'isadmin' => 0
        ]);
        // Category::factory(5)->create();
        // Post::factory(10)->create();
        // Event::factory(5)->create();
    }
}
