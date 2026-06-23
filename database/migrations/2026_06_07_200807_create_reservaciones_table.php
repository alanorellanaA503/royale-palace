<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('sede_id')->constrained('sedes')->onDelete('cascade');
            $table->foreignId('mesa_id')->constrained('mesas')->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora');
            $table->integer('num_personas');
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada', 'completada'])->default('pendiente');
            $table->text('notas')->nullable();            // peticiones especiales del cliente
            $table->string('codigo')->unique();           // TRP-2026-00001
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('reservaciones');
    }
};