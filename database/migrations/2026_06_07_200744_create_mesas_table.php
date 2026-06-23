<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sede_id')->constrained('sedes')->onDelete('cascade');
            $table->string('numero');                     // M-01, M-02...
            $table->integer('capacidad');                 // 2, 4, 6, 8 personas
            $table->enum('ubicacion', ['interior', 'exterior', 'terraza', 'privada'])->default('interior');
            $table->boolean('activa')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('mesas');
    }
};