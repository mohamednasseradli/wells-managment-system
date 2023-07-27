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
        Schema::create('under_testing', function (Blueprint $table) {

            $table->id();
            $table->date('date');
            $table->time('time');
            $table->integer('oil_rate')->nullable();
            $table->integer('water_rate')->nullable();
            $table->integer('water_cut')->nullable();
            $table->string('testing_status')->nullable();
            $table->string('remarks', 500)->nullable();
            $table->integer('badge')->nullable();
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
