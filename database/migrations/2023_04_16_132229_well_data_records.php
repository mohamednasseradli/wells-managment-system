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
        Schema::create('well_data_records', function ( Blueprint $table) {

            $table->id();
            $table->string('sender');
            $table->integer('well');
            $table->integer('suc_prss');
            $table->integer('temp');
            $table->integer('dis_prss');
            $table->integer('choke_set');
            $table->integer('vehicle')->nullable();
            $table->integer('badge');
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
