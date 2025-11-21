<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Kalau nama tabel 'categories', ini sebenarnya bisa dihapus
    protected $table = 'categories';

    // Field yang boleh diisi mass-assignment
    protected $fillable = [
        'name',
        'description',
    ];

    // Relasi: 1 kategori punya banyak buku
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
