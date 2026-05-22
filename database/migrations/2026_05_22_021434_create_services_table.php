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
    Schema::create('services', function (Blueprint $table) {
        $table->id(); // [cite: 338]
        $table->string('name'); // [cite: 339]
        $table->unsignedInteger('price'); // [cite: 340]
        $table->text('description')->nullable(); // [cite: 341]
        $table->boolean('status')->default(true); // [cite: 342]
        $table->timestamps(); // [cite: 343]
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
