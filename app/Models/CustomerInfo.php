<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    use HasFactory;

    protected $table = 'customer_info'; // default table name

    public $timestamps = false;

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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
