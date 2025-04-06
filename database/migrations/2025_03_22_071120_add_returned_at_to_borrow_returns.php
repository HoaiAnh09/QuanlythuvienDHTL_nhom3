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
            $table->dateTime('returned_at')->nullable()->after('return_date'); // Ngày trả thực tế (có thể null nếu chưa trả)
        });
    }

    public function down()
    {
        Schema::table('borrow_returns', function (Blueprint $table) {
            $table->dropColumn('returned_at');
        });
    }

};
