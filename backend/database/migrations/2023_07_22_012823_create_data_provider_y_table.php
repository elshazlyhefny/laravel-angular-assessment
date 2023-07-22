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
        Schema::create('data_provider_y', function (Blueprint $table) {
            $table->integer('balance');
            $table->string('currency');
            $table->string('email');
            $table->integer('status');
            $table->date('created_at');
            $table->string('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_provider_y');
    }
};
