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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('price');
            $table->integer('priority');
            $table->unsignedBigInteger('categorie_id');
            $table->timestamps();
            $table->foreign('categorie_id')
              ->references('id')->on('products')->onDelete('restrict');
        });
        
        DB::table('products')->insert(
            array(
                'name' => 'Producto de prueba',
                'description' => 'Solo pertenecer a la app',
                'price' => 10000,
                'priority' => 0,
                'categorie_id' => 1,
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
