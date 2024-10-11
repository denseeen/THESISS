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
        'user_id', // foreign, this stablish a relationship between customer_info and users
        'is_archived', // Newly added column for archiving
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Define the relationship with User
    }

    public function paymentService()
    {
        return $this->hasOne(PaymentService::class, 'customer_id');
    }

    public function orders() {
        return $this->hasMany(Order::class, 'customer_id'); // Adjust to your actual foreign key
    }

    public function installmentProcess()
    {
        return $this->hasMany(InstallmentProcess::class, 'customer_id', 'id'); // Adjust foreign key as necessary
    }
}
