<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentPlan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'installment_plan'; // default table name
    
    protected $fillable = [
        'customer_id',
        'sixmonths', 
        'twelvemonths', 
        'eighteenmonths'
        
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
