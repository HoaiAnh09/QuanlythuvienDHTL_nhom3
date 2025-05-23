<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\BorrowReturn;
use Faker\Factory as Faker;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
           
        
        $this->call(BookSeeder::class);
        $this->call(BorrowReturnSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BookRequestSeeder::class);


    }
}
