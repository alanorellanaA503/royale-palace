<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('platos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sede_id')->constrained('sedes')->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->string('nombre');
            $table->text('descripcion');
            $table->decimal('precio', 8, 2);
            $table->string('imagen')->nullable();
            $table->boolean('disponible')->default(true);
            $table->boolean('es_temporada')->default(false);  // indicador de temporada
            $table->boolean('es_insignia')->default(false);   // Royal Cuscatlán
            $table->integer('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('platos');
    }
};