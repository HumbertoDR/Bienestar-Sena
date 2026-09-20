<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Acta de Atención #{{ $solicitud->id }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #333;
            padding: 20px 30px;
        }

        /* Header SENA */
        .header {
            display: flex;
            align-items: center;
            border-bottom: 3px solid #39A900;
            padding-bottom: 12px;
            margin-bottom: 15px;
        }
        .header-logo {
            width: 60px;
            height: 60px;
            background: #39A900;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 900;
            font-size: 13px;
            flex-shrink: 0;
            text-align: center;
            line-height: 60px;
        }
        .header-info { margin-left: 15px; }
        .header-info h1 {
            font-size: 14px;
            font-weight: 700;
            color: #39A900;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .header-info p {
            font-size: 10px;
            color: #666;
            margin-top: 2px;
        }
        .header-acta {
            margin-left: auto;
            text-align: right;
        }
        .header-acta h2 {
            font-size: 13px;
            font-weight: 700;
            color: #333;
            text-transform: uppercase;
        }
        .header-acta p { font-size: 10px; color: #666; margin-top: 2px; }

        /* Semáforo */
        .priority-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .priority-alta   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
        .priority-media  { background: #ffedd5; color: #9a3412; border: 1px solid #fdba74; }
        .priority-baja   { background: #dcfce7; color: #166534; border: 1px solid #86efac; }

        /* Secciones */
        .section {
            margin-bottom: 14px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            overflow: hidden;
        }
        .section-header {
            background: #f3f4f6;
            padding: 6px 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }
        .section-body { padding: 10px 12px; }

        /* Grid */
        .grid-2 { display: table; width: 100%; }
        .col { display: table-cell; vertical-align: top; width: 50%; padding-right: 10px; }
        .col:last-child { padding-right: 0; }
        .field { margin-bottom: 8px; }
        .field label {
            display: block;
            font-size: 9px;
            text-transform: uppercase;
            color: #6b7280;
            font-weight: 600;
            letter-spacing: 0.3px;
            margin-bottom: 2px;
        }
        .field p { font-size: 11px; color: #111827; }

        /* Nota y recomendación */
        .text-block {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            padding: 10px 12px;
            font-size: 11px;
            line-height: 1.6;
            color: #374151;
            white-space: pre-wrap;
        }
        .ia-block {
            background: #f5f3ff;
            border: 1px solid #ddd6fe;
            border-radius: 4px;
            padding: 10px 12px;
            font-size: 11px;
            line-height: 1.6;
            color: #374151;
            white-space: pre-wrap;
        }

        /* Estado */
        .estado-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 600;
        }
        .estado-pendiente    { background: #fef9c3; color: #713f12; }
        .estado-seguimiento  { background: #dbeafe; color: #1e40af; }
        .estado-cerrado      { background: #f3f4f6; color: #374151; }

        /* Firmas */
        .firmas {
            display: table;
            width: 100%;
            margin-top: 30px;
            border-top: 2px solid #39A900;
            padding-top: 20px;
        }
        .firma {
            display: table-cell;
            text-align: center;
            width: 50%;
            padding: 0 10px;
        }
        .firma-linea {
            border-top: 1px solid #374151;
            width: 70%;
            margin: 0 auto 5px;
        }
        .firma p { font-size: 10px; color: #374151; }
        .firma .cargo { font-size: 9px; color: #6b7280; }

        /* Footer */
        .footer {
            margin-top: 20px;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
            text-align: center;
            font-size: 9px;
            color: #9ca3af;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <div class="header-logo">SENA</div>
        <div class="header-info">
            <h1>Servicio Nacional de Aprendizaje</h1>
            <p>Área de Bienestar al Aprendiz</p>
            <p>Sistema de Gestión de Casos</p>
        </div>
        <div class="header-acta">
            <h2>Acta de Atención</h2>
            <p>N° {{ str_pad($solicitud->id, 6, '0', STR_PAD_LEFT) }}</p>
            <p>Fecha: {{ $solicitud->fecha->format('d/m/Y') }}</p>
        </div>
    </div>

    {{-- Datos del aprendiz --}}
    <div class="section">
        <div class="section-header">Datos del Aprendiz</div>
        <div class="section-body">
            <div class="grid-2">
                <div class="col">
                    <div class="field">
                        <label>Nombre Completo</label>
                        <p>{{ $solicitud->nombre_completo }}</p>
                    </div>
                    <div class="field">
                        <label>Número de Documento</label>
                        <p>{{ $solicitud->documento ?? 'No registrado' }}</p>
                    </div>
                    <div class="field">
                        <label>Edad</label>
                        <p>{{ $solicitud->edad }} años</p>
                    </div>
                </div>
                <div class="col">
                    <div class="field">
                        <label>Ficha de Programa</label>
                        <p>{{ $solicitud->ficha_programa }}</p>
                    </div>
                    <div class="field">
                        <label>Nombre del Programa</label>
                        <p>{{ $solicitud->nombre_programa ?? 'No especificado' }}</p>
                    </div>
                    <div class="field">
                        <label>Fecha de Atención</label>
                        <p>{{ $solicitud->fecha->format('d \d\e F \d\e Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Clasificación del caso --}}
    <div class="section">
        <div class="section-header">Clasificación del Caso</div>
        <div class="section-body">
            <div class="grid-2">
                <div class="col">
                    <div class="field">
                        <label>Categoría</label>
                        <p>{{ $solicitud->label_categoria }}</p>
                    </div>
                </div>
                <div class="col">
                    <div class="field">
                        <label>Prioridad (IA)</label>
                        <p>
                            <span class="priority-badge priority-{{ $solicitud->prioridad }}">
                                {{ ucfirst($solicitud->prioridad) }}
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label>Estado de Atención</label>
                        <p>
                            <span class="estado-badge estado-{{ str_replace('_','-', $solicitud->estado) }}">
                                {{ $solicitud->label_estado }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Nota descriptiva --}}
    <div class="section">
        <div class="section-header">Nota Descriptiva del Caso</div>
        <div class="section-body">
            <div class="text-block">{{ $solicitud->nota }}</div>
        </div>
    </div>

    {{-- Recomendación IA --}}
    @if($solicitud->recomendacion_ia)
    <div class="section">
        <div class="section-header">Recomendación — Análisis IA Bienestar</div>
        <div class="section-body">
            <div class="ia-block">{{ $solicitud->recomendacion_ia }}</div>
        </div>
    </div>
    @endif

    {{-- Seguimiento --}}
    @if($solicitud->seguimiento)
    <div class="section">
        <div class="section-header">Notas de Seguimiento</div>
        <div class="section-body">
            <div class="text-block">{{ $solicitud->seguimiento }}</div>
        </div>
    </div>
    @endif

    {{-- Atendido por --}}
    @if($solicitud->atendidoPor)
    <div class="section">
        <div class="section-header">Profesional que Atiende</div>
        <div class="section-body">
            <div class="field">
                <label>Nombre</label>
                <p>{{ $solicitud->atendidoPor->name }}</p>
            </div>
        </div>
    </div>
    @endif

    {{-- Firmas --}}
    <div class="firmas">
        <div class="firma">
            <div class="firma-linea"></div>
            <p>{{ $solicitud->atendidoPor?->name ?? '_______________________' }}</p>
            <p class="cargo">Profesional de Bienestar al Aprendiz</p>
        </div>
        <div class="firma">
            <div class="firma-linea"></div>
            <p>{{ $solicitud->nombre_completo }}</p>
            <p class="cargo">Aprendiz SENA — Ficha {{ $solicitud->ficha_programa }}</p>
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        Servicio Nacional de Aprendizaje (SENA) — Área de Bienestar al Aprendiz ·
        Documento generado el {{ now()->format('d/m/Y H:i') }} ·
        Acta N° {{ str_pad($solicitud->id, 6, '0', STR_PAD_LEFT) }}
    </div>

</body>
</html>
