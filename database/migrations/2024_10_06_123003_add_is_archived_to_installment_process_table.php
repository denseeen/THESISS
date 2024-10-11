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
            $table->boolean('is_archived')->default(false); // Add default false to indicate non-archived        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('installment_process', function (Blueprint $table) {
            $table->dropColumn('is_archived');
        });
    }
};
