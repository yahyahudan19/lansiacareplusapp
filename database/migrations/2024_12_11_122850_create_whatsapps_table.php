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
        Schema::create('whatsapps', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nomor_whatsapp'); 
            $table->string('api_key'); 
            $table->string('endpoint'); 
            $table->string('keterangan'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp');
    }
};
