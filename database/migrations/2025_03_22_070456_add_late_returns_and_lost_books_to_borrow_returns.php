<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('borrow_returns', function (Blueprint $table) {
        $table->boolean('late_returns')->default(false); // Mặc định không trễ hạn
        $table->integer('lost_books')->default(0); // Mặc định không có sách bị mất
    });
}


    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('borrow_returns', function (Blueprint $table) {
        $table->dropColumn(['late_returns', 'lost_books']);
    });
}

};
