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
        Schema::table('installment_process', function (Blueprint $table) {
            $table->decimal('penalty', 8, 2)->default(0); // Penalty column with default value of 0
            $table->decimal('rebate', 8, 2)->default(0);  // Rebate column with default value of 0
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('installment_process', function (Blueprint $table) {
            $table->dropColumn(['penalty', 'rebate']);
        });
    }
};
