<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages'; // default table name

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'content',
        'is_read',
    ];

      // BelongsTo relationship with User
      public function user()
      {
          return $this->belongsTo(User::class, 'user_id', 'id');
      }

      public function sender()
        {
            return $this->belongsTo(User::class, 'sender_id'); // Adjust according to your schema
        }

        public function adminInfo()
        {
            return $this->hasOne(AdminInfo::class); // Define the relationship with AdminInfo
        }

        public function recipient()
        {
            return $this->belongsTo(User::class, 'recipient_id'); // Link the recipient
        }
}
