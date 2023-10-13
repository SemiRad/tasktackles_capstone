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
        Schema::create('service', function (Blueprint $table) {
            $table->id();
            $table->string('service_list_name');
            $table->foreignId('user_id')->constrained('user');
            $table->decimal('price');
            $table->string('description');
            $table->string('gcashnum')->nullable(); //nullable
            $table->string('photo')->nullable(); //nullable
            $table->string('status');
            $table->string('category'); //added
            $table->timestamps();
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
