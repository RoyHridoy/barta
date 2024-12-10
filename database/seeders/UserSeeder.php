<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstName' => 'Jhon',
            'lastName' => 'Doe',
            'username' => 'jhondoe',
            'email' => 'jhon@doe.com',
            'password' => static::$password ??= Hash::make('password'),
            'bio' => 'Keep Coding',
            'email_verified_at' => now(),
        ]);
        User::factory(15)->create();
    }
}
