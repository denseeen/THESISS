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
        'name', 
        'email', 
        'streetaddress', 
        'phone_number', 
        'date_of_birth',
        'age',
        'facebook',
        'gender',
        'telephone_number'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
