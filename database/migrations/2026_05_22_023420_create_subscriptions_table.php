<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('subscriptions', function (Blueprint $table) {
        $table->id(); // id integer [primary key]
        
        // Relasi ke tabel customers (customer_id)
        $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
        
        // Relasi ke tabel services (service_id)
        $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
        
        $table->date('start_date')->nullable(); // start_date date
        $table->date('end_date')->nullable(); // end_date date
        $table->string('status'); // status varchar (active, inactive, trial, isolir, dismantle)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
