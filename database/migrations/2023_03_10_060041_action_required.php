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
        Schema::create('action_required', function (Blueprint $table)
        {
            $table->id();
            $table->string('status');
            $table->string('remarks')->nullable();
            $table->date('date');
            $table->string('badge');
            $table->integer('new_well')->nullable();
            $table->string('new_well_remarks')->nullable();
            $table->string('data_sent')->default(false);
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
