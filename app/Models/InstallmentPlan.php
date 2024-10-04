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
        'sixmonths', 
        'twelvemonths', 
        'eighteenmonths'
    ];


    public function customer() {
        return $this->belongsTo(CustomerInfo::class, 'customer_id');
    }
}
