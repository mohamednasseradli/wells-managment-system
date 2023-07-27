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
        Schema::create('well_switch', function ( Blueprint $table) {

            $table->id();
            $table->string('sender');
            $table->string('remarks', 1000)->nullable();
            $table->integer('badge');
            $table->date('date');
            $table->integer('trunk_id');
            $table->integer('vehicle')->nullable();
            $table->boolean('seen')->default(false);
            $table->foreignId('well_id')
                    ->constrained('wells')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            
                    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
