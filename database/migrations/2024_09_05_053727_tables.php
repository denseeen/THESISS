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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable(); // Adding avatar field
            $table->unsignedTinyInteger('user_roles'); // Adding user_roles field
            $table->rememberToken();
            $table->timestamps();
        });

         // Create password_reset_tokens table
         Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Create sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Create customer_info table
        Schema::create('customer_info', function (Blueprint $table) {
            $table->id(); // Primary key added
            $table->string('name', 244);
            $table->string('email', 255);
            $table->string('streetaddress', 255);
            $table->string('phone_number'); // Changed to string
            $table->date('date_of_birth');
            $table->unsignedTinyInteger('age'); // Changed to unsignedTinyInteger
            $table->string('facebook')->nullable();
            $table->string('gender');
            $table->string('telephone_number'); // Changed to string
            $table->unsignedBigInteger('user_id')->nullable()->before('name');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        // Create admin_info table
        Schema::create('admin_info', function (Blueprint $table) {
            $table->id();
            $table->string('name', 244)->nullable(false);
            $table->string('email', 255)->nullable(false);
            $table->string('streetaddress', 255)->nullable();
            $table->string('phone_number')->nullable(); // Changed to string
            $table->date('date_of_birth')->nullable();
            $table->unsignedTinyInteger('age')->nullable(); // Changed to unsignedTinyInteger
            $table->string('facebook')->nullable();
            $table->string('gender', 15)->nullable();
            $table->string('telephone_number')->nullable(); // Changed to string
            $table->unsignedBigInteger('user_id')->nullable()->before('name');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->timestamps(); // Adds created_at and updated_at columns
        });

        // Create orders table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable(); // Make customer_id nullable
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customer_info')
                  ->onDelete('set null'); // Use set null on delete to avoid orphan records
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
