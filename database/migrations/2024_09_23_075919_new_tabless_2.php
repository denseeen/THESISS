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
         // Create users table
         Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable(); // Adding avatar field
            $table->unsignedTinyInteger('user_roles'); // Adding user_roles field
            $table->rememberToken();
            $table->boolean('dark_mode')->default(false); // Adding dark_mode field
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
            $table->id(); // Primary key
            $table->string('name', 244);
            $table->string('email', 255);
            $table->string('streetaddress', 255);
            $table->unsignedBigInteger('phone_number'); // Changed to BigInt
            $table->date('date_of_birth');
            $table->unsignedTinyInteger('age'); // Changed to unsignedTinyInteger
            $table->string('facebook')->nullable();
            $table->string('gender');
            $table->unsignedBigInteger('telephone_number'); // Changed to BigInt
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        // Create admin_info table
        Schema::create('admin_info', function (Blueprint $table) {
            $table->id();
            $table->string('name', 244);
            $table->string('email', 255);
            $table->string('streetaddress', 255);
            $table->unsignedBigInteger('phone_number'); // Changed to BigInt
            $table->date('date_of_birth');
            $table->unsignedTinyInteger('age'); // Changed to unsignedTinyInteger
            $table->string('facebook')->nullable();
            $table->string('gender');
            $table->unsignedBigInteger('telephone_number'); // Changed to BigInt
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        // Create orders table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable(); // Add the column, initially nullable
            $table->foreign('customer_id')->references('id')->on('customer_info')->onDelete('cascade'); // Add foreign key constraint
            $table->unsignedBigInteger('orderNumber')->nullable(false); // Changed to BigInt
            $table->date('dateOrder')->nullable();
            $table->string('unitName', 255)->nullable();
            $table->decimal('unitprice', 10, 2)->nullable();
            $table->text('unitDescription')->nullable();
        });

        // Create payment_service table
        Schema::create('payment_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable(); // Add the column, initially nullable
            $table->foreign('customer_id')->references('id')->on('customer_info')->onDelete('cascade'); // Add foreign key constraint
            $table->boolean('installment')->nullable();
            $table->boolean('fullypaid')->nullable();
        });

        // Create installment_plan table
        Schema::create('installment_plan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customer_info')->onDelete('cascade');
            $table->boolean('sixmonths')->nullable();
            $table->boolean('twelvemonths')->nullable();
            $table->boolean('eighteenmonths')->nullable();

      
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        }); 


        // Create predefined_security_questions table
        Schema::create('predefined_security_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question'); // The security question
            $table->timestamps(); // Timestamps for created_at and updated_at
        });

        // Insert predefined questions
        DB::table('predefined_security_questions')->insert([
            ['question' => "What is your mother's maiden name?"],
            ['question' => "What was the name of your first pet?"],
            ['question' => "What is the name of the street you grew up on?"],
            ['question' => "What is your favorite food?"],
        ]);

        // Create security_questions table
        Schema::create('security_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users table
            $table->foreignId('predefined_question_id')->constrained('predefined_security_questions')->onDelete('cascade'); // Foreign key to predefined questions
            $table->string('answer'); // The answer to the security question
            $table->timestamps(); // Timestamps for created_at and updated_at
        });

    

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('admin_info')->onDelete('cascade'); // Reference to admin_info
            $table->foreignId('recipient_id')->constrained('customer_info')->onDelete('cascade'); // Reference to customer_info
            $table->text('content');
            $table->boolean('is_read')->default(false); // Add the is_read column
            $table->timestamps();
        });

        // Create installment_process table
        Schema::create('installment_process', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable(); // Make customer_id nullable
            $table->foreign('customer_id')
                ->references('id')
                ->on('customer_info')
                ->onDelete('set null'); // Use set null on delete to avoid orphan records
            $table->unsignedBigInteger('account_number'); // Added BigInt account_number
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
        Schema::dropIfExists('messages');
        Schema::dropIfExists('security_questions');
        Schema::dropIfExists('predefined_security_questions');
        Schema::dropIfExists('installment_plan');
        Schema::dropIfExists('payment_service');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('admin_info');
        Schema::dropIfExists('customer_info');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
