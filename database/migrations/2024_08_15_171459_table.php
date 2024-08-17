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
        // Create Customer_info table
        Schema::create('customer_info', function (Blueprint $table) {
            $table->id();
            $table->string('name', 244);
            $table->string('email', 255);
            $table->string('streetaddress', 255)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->date('date_of_birth')->nullable();
        });

        // Create admin_info table
        Schema::create('admin_info', function (Blueprint $table) {
            $table->id();
            $table->string('name', 244)->nullable(false);
            $table->string('email', 255)->nullable(false);
            $table->string('streetaddress', 255)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->date('date_of_birth')->nullable();
        });

        // Create orders table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('orderNumber', 255)->nullable(false);
            $table->date('dateOrder')->nullable();
            $table->string('unitName', 255)->nullable();
            $table->decimal('unitprice', 10, 2)->nullable();
            $table->text('unitDescription')->nullable();
        });

        // Create payment_service table
        Schema::create('payment_service', function (Blueprint $table) {
            $table->id();
            $table->boolean('installment')->nullable();
            $table->boolean('fullypaid')->nullable();
        });

        // Create installment_plan table
        Schema::create('installment_plan', function (Blueprint $table) {
            $table->id();
            $table->boolean('sixmonths')->nullable();
            $table->boolean('twelvemonths')->nullable();
            $table->boolean('eighteenmonths')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_info');
        Schema::dropIfExists('admin_info');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('payment_service');
        Schema::dropIfExists('installment_plan');
    }
};
