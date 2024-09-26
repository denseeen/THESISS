<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'user_roles',
        'dark_mode',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // establishes a hasOne relationship with the CustomerInfo model
    public function customerInfo()
    {
        return $this->hasOne(CustomerInfo::class); // Define the relationship with CustomerInfo
    }

    public function adminInfo()
    {
        return $this->hasOne(AdminInfo::class); // Define the relationship with AdminInfo
    }

    public function messages()
{
    return $this->hasMany(Message::class, 'recipient_id'); // Assuming recipient_id is the foreign key in the messages table
}
   

}
