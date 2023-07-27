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
        Schema::create('well_switch_records', function ( Blueprint $table) {

            $table->id();
            $table->string('sender');
            $table->string('remarks', 1000)->nullable();
            $table->integer('badge');
            $table->integer('vehicle')->nullable();
            $table->integer('well');
            $table->timestamp('date')->useCurrent();

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
