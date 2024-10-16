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
        Schema::create('filter_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('less_height');
            $table->integer('high_height');
            $table->enum('marital_status',['married','single','divorced','widower']);
            $table->boolean('have_kids')->default(0);
            $table->integer('less_age');
            $table->integer('high_age');
            $table->integer('city_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filter_users');
    }
};
