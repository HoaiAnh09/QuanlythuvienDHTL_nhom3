<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BookRequestSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('book_requests')->insert([
                'title' => $faker->sentence(3), // Tiêu đề sách giả lập
                'author' => $faker->name(), // Tác giả giả lập
                'category' => $faker->word(), // Thể loại sách
                'quantity' => $faker->numberBetween(1, 20), // Số lượng
                'user_id' => $faker->numberBetween(1, 5), // Giả định có 5 user
                'status' => $faker->randomElement(['pending', 'approved', 'rejected']), // Trạng thái ngẫu nhiên
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
