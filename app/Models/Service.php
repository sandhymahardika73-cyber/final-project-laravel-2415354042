<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    // Mengizinkan pengisian data secara massal [cite: 205]
    protected $fillable = ['name', 'price', 'description', 'status'];

    // Menentukan konversi tipe data otomatis [cite: 206]
    protected function casts(): array
    {
        return [
            'status' => 'boolean', // [cite: 208]
            'price' => 'integer',  // [cite: 209]
        ];
    }

    // Relasi ke model Subscription (Satu Service digunakan banyak Subscription) [cite: 212]
   // public function subscriptions(): HasMany
   // {
   //     return $this->hasMany(Subscription::class); // [cite: 213]
   // }
}