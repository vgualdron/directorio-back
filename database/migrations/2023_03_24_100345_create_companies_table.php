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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('linkweb')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('schedule')->nullable();
            $table->string('payments')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('plan_date_initial')->nullable();
            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')
              ->references('id')->on('plans')->onDelete('restrict');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
              ->references('id')->on('categories')->onDelete('restrict');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')
              ->references('id')->on('cities')->onDelete('restrict');
            $table->timestamps();
        });
        
        DB::table('companies')->insert(
            array(
                'name' => 'Vgualdron company s.a.s',
                'description' => 'Empresa de desarrollo de software',
                'address' => 'Carrera 5 # 3n-02, barrio santander',
                'email' => 'victor.gualdron.r@gmail.com',
                'phone' => '3043427319',
                'whatsapp' => '3043427319',
                'facebook' => 'https://www.facebook.com/victor.gualdron.r',
                'instagram' => '@victor.gualdron.r',
                'latitude' => '7.839055',
                'longitude' => '-72.469049',
                'schedule' => 'de lunes a viernes de 8 am a 12 y de 2 pm a 6 pm.',
                'payments' => 'Efectivo y transferencia de cualquier banco',
                'status' => 'active',
                'plan_id' => '1',
                'user_id' => '1',
                'category_id' => '1',
                'city_id' => '1'
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
