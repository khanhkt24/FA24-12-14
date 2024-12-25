<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        $this->call([
            ProductSeeder::class,
            TagSeeder::class,
            CategorySeeder::class,
            
=======
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
            ProductSeeder::class,
>>>>>>> 4625ecb367a26edb2375fcd522d2fba9dfe89fa3
        ]);
    }
}
