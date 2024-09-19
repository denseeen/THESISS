<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredefinedSecurityQuestion extends Model
{
   use HasFactory; // Make sure to include the HasFactory trait

   // Define the table associated with the model
   protected $table = 'predefined_security_questions';

   // Specify which attributes are mass assignable
   protected $fillable = [
       'question',
   ];

   // Define the relationship with the SecurityQuestion model
   public function securityQuestions()
   {
       return $this->hasMany(SecurityQuestion::class, 'predefined_question_id');
   }
}
