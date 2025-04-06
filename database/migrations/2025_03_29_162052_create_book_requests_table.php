<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('book_requests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('category');
            $table->integer('quantity')->default(1);
            $table->foreignId(column: 'user_id')->constrained()->constrained('users')-> onDelete('cascade'); // Người gửi đề xuất
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Trạng thái đề xuất
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_requests');
    }
};
