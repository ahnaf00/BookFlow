<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Landing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
        'status',
        'loaned_on',
        'due_date',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function user():BelongsTo
    {
        return $this->belongsTo(UserProfile::class);
    }

    public function book():BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
