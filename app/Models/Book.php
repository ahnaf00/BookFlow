<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title','author','publisher','description','image','quantity','category_id','subcategory_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory():BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }
}
