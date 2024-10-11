<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentProcess extends Model
{
    use HasFactory;

    protected $table = 'installment_process'; // default table name

    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'customer_id', // foreign, this stablish a relationship between installment_process and customer_info
        'account_number',
        'payment_method', 
        'amount', 
        'date', 
        'status', 
        'violation',
        'comment',
        'is_archived', // Newly added column for archiving
    ];


    // Define a relationship with the CustomerInfo
    public function customerInfo()
    {
        return $this->hasOne(CustomerInfo::class, 'id', 'id');  // Assuming the 'id' matches
    }

    public function customer() {
        return $this->belongsTo(CustomerInfo::class, 'customer_id');
    }
}
