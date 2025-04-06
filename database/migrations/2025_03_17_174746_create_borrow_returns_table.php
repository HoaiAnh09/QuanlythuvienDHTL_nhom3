<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('borrow_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Người mượn
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade'); // Sách mượn
            $table->date('borrow_date');  // Ngày mượn
            $table->date('return_date')->nullable();  // Ngày trả (có thể null nếu chưa trả)
            $table->enum('status', ['borrowed', 'returned'])->default('borrowed');  // Trạng thái
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_returns');
    }
};