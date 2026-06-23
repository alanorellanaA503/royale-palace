<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('plato_id')->constrained('platos')->onDelete('cascade');
            $table->unique(['user_id', 'plato_id']);     // un favorito por plato por usuario
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('favoritos');
    }
};