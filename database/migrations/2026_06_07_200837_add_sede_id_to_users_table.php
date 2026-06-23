<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('sede_id')->nullable()->constrained('sedes')->onDelete('set null');
            $table->string('telefono')->nullable();
            $table->string('avatar')->nullable();
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['sede_id']);
            $table->dropColumn(['sede_id', 'telefono', 'avatar']);
        });
    }
};