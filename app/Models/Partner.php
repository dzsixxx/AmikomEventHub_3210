<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    // Mengizinkan pengisian data massal untuk kolom name dan logo_url
    protected $fillable = ['name', 'logo_url'];
}