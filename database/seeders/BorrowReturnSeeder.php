<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BorrowReturn;
use App\Models\User;
use App\Models\Book;
use Faker\Factory as Faker;

class BorrowReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all();
        $books = Book::all();

        foreach ($users as $user) {
            $borrowedBooks = $books->random(rand(1, 5));

            foreach ($borrowedBooks as $book) {
                $borrowDate = $faker->dateTimeBetween('-2 months', 'now');
                $returnDate = rand(0, 1) ? $faker->dateTimeBetween($borrowDate, 'now') : null;
                $status = $returnDate ? 'returned' : 'borrowed';

                BorrowReturn::create([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                    'borrow_date' => $borrowDate,
                    'return_date' => $returnDate,
                    'status' => $status,
                ]);
            }
        }
    }
}
