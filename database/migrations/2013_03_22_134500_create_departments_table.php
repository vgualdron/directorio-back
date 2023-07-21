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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')
              ->references('id')->on('countries')->onDelete('restrict');
            $table->timestamps();
        });
        
        DB::table('departments')->insert(
            array(
                'name' => 'Norte de Santander',
                'label' => 'N. de Santander',
                'country_id' => 1
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
