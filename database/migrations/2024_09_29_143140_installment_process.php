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
        // Create installment_process table
        Schema::create('installment_process', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable(); // Make customer_id nullable
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customer_info')
                  ->onDelete('set null'); // Use set null on delete to avoid orphan records
            $table->string('payment_method', 15)->nullable();
            $table->decimal('amount', 10, 2)->nullable(); 
            $table->date('date')->nullable();
            $table->string('status', 15)->nullable();
            $table->string('violation', 255)->nullable();
            $table->string('comment', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installment_process');
    }
};
