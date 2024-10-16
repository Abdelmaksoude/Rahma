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
        Schema::create('profile_header_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_header_id')->references('id')->on('profile_headers')->onDelete('cascade');
            $table->string('value_name');
            $table->string('value_name_ar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_header_values');
    }
};
