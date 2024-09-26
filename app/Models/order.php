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

    public function customer() {
        return $this->belongsTo(CustomerInfo::class, 'customer_id');
    }
}
