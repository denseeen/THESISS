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
        //
        Schema::table('payment_service', function (Blueprint $table) {
            $table->unsignedTinyInteger('customer_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_service', function (Blueprint $table) {
            $table->dropColumn('customer_id');  // Drops 'dark_mode' column when rolling back
        });
    }
};
