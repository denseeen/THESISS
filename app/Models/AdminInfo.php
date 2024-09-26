<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminInfo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'admin_info'; // default table name
    
    protected $fillable = [
        'id',
        'name', 
        'email', 
        'streetaddress', 
        'phone_number', 
        'date_of_birth',
        'age',
        'facebook',
        'gender',
        'telephone_number',
        'user_id' // foreign, this stablish a relationship between customer_info and users
    ];


    public function user()
    {
        return $this->belongsTo(User::class); // Define the relationship with User
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'recipient_id'); // Assuming recipient_id is the foreign key in the messages table
    }
}
