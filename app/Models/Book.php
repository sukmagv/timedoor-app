<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function author(): BelongsTo 
    { 
        return $this->belongsTo(Author::class);
    }

    public function category(): BelongsTo 
    { 
        return $this->belongsTo(Category::class); 
    }

    public function ratings(): HasMany 
    { 
        return $this->hasMany(Rating::class); 
    }
}
