<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('documento')->nullable();
            $table->string('ficha_programa');
            $table->string('nombre_programa')->nullable();
            $table->unsignedTinyInteger('edad');
            $table->date('fecha');
            $table->text('nota');

            // Categoría del caso
            $table->enum('categoria', ['academico', 'salud_mental', 'economico', 'personal', 'otro'])
                  ->default('otro');

            // IA
            $table->text('recomendacion_ia')->nullable();
            $table->enum('prioridad', ['baja', 'media', 'alta'])->default('baja');

            // Gestión
            $table->enum('estado', ['pendiente', 'en_seguimiento', 'cerrado'])->default('pendiente');
            $table->text('seguimiento')->nullable();

            $table->foreignId('atendido_por')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
