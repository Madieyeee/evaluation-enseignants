<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')->constrained()->onDelete('cascade');
            $table->foreignId('critere_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('note'); // Note sur 5
            $table->text('commentaire')->nullable();
            $table->timestamps();
            
            $table->unique(['evaluation_id', 'critere_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
