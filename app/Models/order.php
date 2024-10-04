<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'orders'; // Default table name
    
    protected $fillable = [
        'orderNumber', 
        'dateOrder', 
        'unitName', 
        'unitprice', 
        'unitDescription'
    ];

     // Define a relationship with the installment plan
     public function installmentPlan()
     {
         return $this->hasOne(InstallmentPlan::class, 'id', 'id');  // Assuming the 'id' matches
     }

     // Define a relationship with the CustomerInfo
     public function customerInfo()
     {
         return $this->hasOne(CustomerInfo::class, 'id', 'id');  // Assuming the 'id' matches
     }

     public function Paymentservice()
     {
         return $this->hasOne(PaymentService::class, 'id', 'id');  // Assuming the 'id' matches
     }

    public function customer() {
        return $this->belongsTo(CustomerInfo::class, 'customer_id');
    }

}
