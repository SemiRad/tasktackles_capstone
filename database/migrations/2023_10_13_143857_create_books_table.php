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
        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('Service');
            $table->foreignId('user_id_customer')->constrained('user');
            $table->foreignId('user_id_provider')->constrained('user');
            $table->date('date');
            $table->string('time');
            $table->string('location');
            $table->string('status');
            $table->string('payment_type');
            $table->integer('refno')->nullable(); //nullable
            $table->string('payment_status');
            $table->boolean('isRated')->default(0);
            $table->boolean('isffbyCust')->default(0);
            $table->boolean('isffbyProv')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }

    
};
