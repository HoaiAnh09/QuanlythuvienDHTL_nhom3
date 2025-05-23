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
        Schema::table('borrow_returns', function (Blueprint $table) {
            $table->decimal('fine', 10, 2)->nullable()->after('returned_at'); // Thêm cột fine
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrow_returns', function (Blueprint $table) {
            $table->dropColumn('fine'); // Xóa cột nếu rollback
        });
    }
};
