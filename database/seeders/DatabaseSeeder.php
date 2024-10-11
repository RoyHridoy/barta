<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->hasPosts(rand(3, 20))->create();
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class
        ]);
    }
}
