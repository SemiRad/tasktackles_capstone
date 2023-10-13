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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email_address');
            $table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->date('birthday');
            $table->string('gender');
            $table->string('contact');
            $table->string('address');
            $table->string('city'); //added
            $table->string('profile_picture')->nullable();
            $table->string('service_name')->nullable();
            $table->string('usertype');
            $table->string('account_status');
            $table->boolean('isValid')->default(0); //added
            $table->string('id_img');//added
            $table->timestamps();});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
