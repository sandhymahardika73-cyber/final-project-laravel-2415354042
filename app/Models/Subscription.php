<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    // Kolom sesuai dengan rancangan tabel subscriptions modul halaman 3 [cite: 70]
    protected $fillable = ['customer_id', 'service_id', 'start_date', 'end_date', 'status'];

    // Setiap data langganan merujuk balik ke satu data Customer [cite: 80]
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // Setiap data langganan merujuk balik ke satu data Service [cite: 80]
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}