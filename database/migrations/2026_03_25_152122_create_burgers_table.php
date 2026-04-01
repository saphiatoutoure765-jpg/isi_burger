<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('burgers', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->double('prix');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('archive')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('burgers');
    }
};
