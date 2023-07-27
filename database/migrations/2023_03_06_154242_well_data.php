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
        Schema::create('well_data', function ( Blueprint $table) {

            $table->id();
            $table->string('sender_badge')->nullable();
            $table->string('receiver_badge')->nullable();
            $table->integer('temp')->nullable();
            $table->integer('choke_set')->nullable();
            $table->integer('suc_prss')->nullable();
            $table->integer('dis_prss')->nullable();
            $table->integer('oil_rate')->nullable();
            $table->integer('water_rate')->nullable();
            $table->integer('water_cut')->nullable();
            $table->integer('vehicle')->nullable();
            $table->date('switch_date')->nullable();
            $table->timestamp('undertesting_datetime')->nullable();
            $table->string('switch_remarks')->nullable();
            $table->string('undertesting_remarks')->nullable();
            $table->string('notifications_remarks')->nullable();
            $table->string('status')->default('off');
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
