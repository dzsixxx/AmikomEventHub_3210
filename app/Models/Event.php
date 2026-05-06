<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Menggunakan PHP 8 Attribute seperti di model User Anda
#[Fillable(['category_id', 'title', 'description', 'date', 'location', 'price', 'stock', 'poster_path'])]
class Event extends Model
{
    use HasFactory;

    /**
     * Relasi ke model Category (Satu event memiliki satu kategori)
     * Ini dibutuhkan karena di controller ada pemanggilan: with('category')
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}