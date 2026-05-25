<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    // Sesuai dengan kolom di Analisa Database Modul halaman 2 [cite: 46]
    protected $fillable = ['customer_id', 'name', 'email', 'phone', 'address', 'status'];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    // Satu Customer dapat memiliki banyak Subscription [cite: 83]
    public function subscriptions(): HasMany
    {
       // Menggunakan string nama model lengkap agar Intelephense tidak bingung mencari file class-nya
         return $this->hasMany('App\Models\Subscription');
    }
}