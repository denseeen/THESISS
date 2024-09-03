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
}
