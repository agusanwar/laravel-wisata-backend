<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // call seeder
        $this->call([
            UserSeeder::class,
            // CategorySeeder::class,
            // ProductSeeder::class,
        ]);
    }
}