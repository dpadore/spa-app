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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('specialist_id')->nullable();
            $table->date('reservation_date');
            $table->time('reservation_time');
            $table->enum('status', [
                'active',   
                'completed',  
                'cancelled'   
            ])->default('active');
            $table->timestamps();
            
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('service_id')->references('service_id')->on('services')->onDelete('cascade');    
            $table->foreign('specialist_id')->references('specialist_id')->on('specialists')->onDelete('set null');
                  
            $table->index('reservation_date');
            $table->index('status');
            $table->index(['reservation_date', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
