<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    // Menggunakan protected $fillable standar Laravel agar 100% aman tersimpan
    protected $fillable = [
        'category_id', 
        'title', 
        'description', 
        'date', 
        'location', 
        'price', 
        'stock', 
        'poster_path' // <-- Ini yang mengizinkan link gambar masuk ke tabel
    ];

    /**
     * Relasi ke model Category (Satu event memiliki satu kategori)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}