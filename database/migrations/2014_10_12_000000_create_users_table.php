<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role')->default('user');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')
              ->references('id')->on('cities')->onDelete('restrict');
            $table->rememberToken();
            $table->timestamps();
        });
        
        DB::table('users')->insert(
            array(
                'name' => 'Victor Hernando Gualdron Ruiz',
                'email' => 'victor.gualdron.r@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('13171638'),
                'address' => 'carrera 5 # 3n-02, barrio santander',
                'phone' => '3043427319',
                'user_id' => '1',
                'city_id' => '1'
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
