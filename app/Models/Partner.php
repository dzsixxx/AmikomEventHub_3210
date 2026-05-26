<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    // Mengizinkan kolom name dan logo_url untuk diisi (Mass Assignment)
    protected $guarded = []; 
}