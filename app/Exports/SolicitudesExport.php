<?php

namespace App\Exports;

use App\Models\Solicitud;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class SolicitudesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    public function collection(): \Illuminate\Support\Collection
    {
        return Solicitud::with('atendidoPor')->oldest()->get();
    }

    public function title(): string
    {
        return 'Solicitudes Bienestar';
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Apellido',
            'Documento',
            'Ficha',
            'Programa',
            'Edad',
            'Fecha',
            'Categoría',
            'Nota del Caso',
            'Recomendación IA',
            'Prioridad',
            'Estado',
            'Seguimiento',
            'Atendido por',
            'Fecha Registro',
        ];
    }

    public function map($solicitud): array
    {
        return [
            $solicitud->id,
            $solicitud->nombre,
            $solicitud->apellido,
            $solicitud->documento ?? 'N/A',
            $solicitud->ficha_programa,
            $solicitud->nombre_programa ?? 'N/A',
            $solicitud->edad,
            $solicitud->fecha->format('d/m/Y'),
            $solicitud->label_categoria,
            $solicitud->nota,
            $solicitud->recomendacion_ia ?? '',
            ucfirst($solicitud->prioridad),
            $solicitud->label_estado,
            $solicitud->seguimiento ?? '',
            $solicitud->atendidoPor?->name ?? 'N/A',
            $solicitud->created_at->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF39A900'],
                ],
            ],
        ];
    }
}
