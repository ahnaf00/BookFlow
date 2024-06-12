<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'user_id',
        'phone',
        'address'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
