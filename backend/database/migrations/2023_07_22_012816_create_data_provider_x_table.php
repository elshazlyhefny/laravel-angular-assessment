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
        Schema::create('data_provider_x', function (Blueprint $table) {
            $table->integer('parentAmount');
            $table->string('Currency');
            $table->string('parentEmail');
            $table->integer('statusCode');
            $table->date('registerationDate');
            $table->string('parentIdentification');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_provider_x');
    }
};
