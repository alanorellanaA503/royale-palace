<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sedes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');                     // Santa Ana, San Salvador, San Miguel
            $table->string('zona');                       // Occidente, Centro, Oriente
            $table->string('direccion');
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('imagen')->nullable();         // foto de la sede
            $table->string('slug')->unique();             // santa-ana, san-salvador, san-miguel
            $table->boolean('activa')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('sedes');
    }
};