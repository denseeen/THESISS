<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityQuestion extends Model
{
    use HasFactory; // Ensure this trait is included

    // Define the table associated with the model
    protected $table = 'security_questions';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'user_id',
        'predefined_question_id',
        'answer',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the PredefinedSecurityQuestion model
    public function predefinedQuestion()
    {
        return $this->belongsTo(PredefinedSecurityQuestion::class, 'predefined_question_id');
    }
}

