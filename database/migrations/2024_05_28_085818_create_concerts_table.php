<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('concerts', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('city_id');
            $table->integer('singer_id');
            $table->date('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concerts');
    }
};
