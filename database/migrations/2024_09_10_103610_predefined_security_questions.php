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

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predefined_security_questions');

    }
};
