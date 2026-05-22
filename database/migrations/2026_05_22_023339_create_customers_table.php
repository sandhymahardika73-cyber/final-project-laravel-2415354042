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
    Schema::create('customers', function (Blueprint $table) {
        $table->id(); // id integer [primary key]
        $table->string('customer_id')->unique(); // customer_id varchar [unique, not null]
        $table->string('name'); // name varchar [not null]
        $table->string('email')->unique()->nullable(); // email varchar [unique]
        $table->string('phone')->nullable(); // phone varchar
        $table->text('address')->nullable(); // address text
        $table->boolean('status')->default(true); // status boolean [not null, default: true]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
