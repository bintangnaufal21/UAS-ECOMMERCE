<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Kalau nama tabel 'books', ini bisa dihapus juga
    protected $table = 'books';

    protected $fillable = [
        'title',
        'image',
        'description',
        'price',
        'stock',
        'category_id',
        'is_bestseller',
        'bestseller_order',
    ];

    // Casting harga ke decimal 2 angka di belakang koma
    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Relasi: 1 buku milik 1 kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
