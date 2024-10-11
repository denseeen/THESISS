<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentService extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'payment_service'; // default table name
    
    protected $fillable = [
        'customer_id',
        'installment', 
        'fullypaid'
        
    ];


    // Define a relationship with the CustomerInfo
    public function customerInfo()
    {
        return $this->hasOne(CustomerInfo::class, 'id', 'id');  // Assuming the 'id' matches
    }

    public function customer()
    {
        return $this->belongsTo(CustomerInfo::class, 'customer_id');
    }
}
