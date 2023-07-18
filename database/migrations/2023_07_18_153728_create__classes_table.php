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
    { //dokonczyc wpisywanie migracji a potem artisan migrate
        Schema::create('Classes', function (Blueprint $table) {
            $table->id();
            $table->string('nazwa');
            $table->string('rok_szkolny');
            $table->string('profil');
            $table->string('wychowawca');
            $table->Integer('liczba_uczniow');
            $table->String('godziny_lekcyjne');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
