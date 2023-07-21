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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')
              ->references('id')->on('departments')->onDelete('restrict');
            $table->timestamps();
        });
        
        DB::table('cities')->insert(
            array(
                'name' => 'Villa del Rosario',
                'label' => 'V. del Rosario',
                'department_id' => 1
            )
        );
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
