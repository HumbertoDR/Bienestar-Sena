<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = [
        'nombre',
        'apellido',
        'documento',
        'ficha_programa',
        'nombre_programa',
        'edad',
        'fecha',
        'nota',
        'categoria',
        'recomendacion_ia',
        'prioridad',
        'estado',
        'seguimiento',
        'atendido_por',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function atendidoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'atendido_por');
    }

    /**
     * Nombre completo del aprendiz.
     */
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombre} {$this->apellido}";
    }

    /**
     * Color de semáforo según prioridad.
     */
    public function getColorPrioridadAttribute(): string
    {
        return match ($this->prioridad) {
            'alta'  => 'red',
            'media' => 'orange',
            default => 'green',
        };
    }

    /**
     * Badge CSS según prioridad.
     */
    public function getBadgePrioridadAttribute(): string
    {
        return match ($this->prioridad) {
            'alta'  => 'badge-danger',
            'media' => 'badge-warning',
            default => 'badge-success',
        };
    }

    /**
     * Badge CSS según estado.
     */
    public function getBadgeEstadoAttribute(): string
    {
        return match ($this->estado) {
            'cerrado'        => 'badge-secondary',
            'en_seguimiento' => 'badge-info',
            default          => 'badge-warning',
        };
    }

    /**
     * Label legible de estado.
     */
    public function getLabelEstadoAttribute(): string
    {
        return match ($this->estado) {
            'en_seguimiento' => 'En seguimiento',
            'cerrado'        => 'Cerrado',
            default          => 'Pendiente',
        };
    }

    /**
     * Label legible de categoría.
     */
    public function getLabelCategoriaAttribute(): string
    {
        return match ($this->categoria) {
            'academico'    => 'Académico',
            'salud_mental' => 'Salud Mental',
            'economico'    => 'Económico',
            'personal'     => 'Personal',
            default        => 'Otro',
        };
    }

    /**
     * Palabras clave de alta prioridad.
     */
    public static function palabrasAlta(): array
    {
        return [
            'suicidio', 'suicidar', 'morir', 'matarse', 'violencia', 'abuso',
            'agresión', 'agresion', 'drogadicción', 'drogadiccion', 'crisis',
            'deserción', 'desercion', 'amenaza', 'depresión severa', 'automutilación',
        ];
    }

    /**
     * Palabras clave de media prioridad.
     */
    public static function palabrasMedia(): array
    {
        return [
            'ansiedad', 'depresión', 'depresion', 'estrés', 'estres',
            'bullying', 'acoso', 'conflicto', 'problema familiar',
            'dificultad económica', 'dificultad economica', 'bajo rendimiento',
            'falta de recursos', 'desempleo', 'deuda',
        ];
    }

    /**
     * Determinar prioridad automática basada en nota.
     */
    public static function calcularPrioridad(string $nota): string
    {
        $notaLower = mb_strtolower($nota);

        foreach (self::palabrasAlta() as $palabra) {
            if (str_contains($notaLower, $palabra)) {
                return 'alta';
            }
        }

        foreach (self::palabrasMedia() as $palabra) {
            if (str_contains($notaLower, $palabra)) {
                return 'media';
            }
        }

        return 'baja';
    }
}
