<?php

namespace App\Http\Controllers;

use App\Exports\SolicitudesExport;
use App\Models\Solicitud;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class SolicitudController extends Controller
{
    public function index(Request $request): View
    {
        $query = Solicitud::with('atendidoPor')->latest();

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('documento', 'like', "%{$buscar}%")
                  ->orWhere('ficha_programa', 'like', "%{$buscar}%")
                  ->orWhere('nombre', 'like', "%{$buscar}%")
                  ->orWhere('apellido', 'like', "%{$buscar}%");
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('prioridad')) {
            $query->where('prioridad', $request->prioridad);
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        $solicitudes = $query->paginate(15)->withQueryString();

        return view('solicitudes.index', compact('solicitudes'));
    }

    public function create(): View
    {
        return view('solicitudes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nombre'         => ['required', 'string', 'max:100'],
            'apellido'       => ['required', 'string', 'max:100'],
            'documento'      => ['nullable', 'string', 'max:20'],
            'ficha_programa' => ['required', 'string', 'max:20'],
            'nombre_programa'=> ['nullable', 'string', 'max:150'],
            'edad'           => ['required', 'integer', 'min:14', 'max:100'],
            'fecha'          => ['required', 'date'],
            'nota'           => ['required', 'string', 'min:10'],
            'categoria'      => ['required', 'in:academico,salud_mental,economico,personal,otro'],
            'estado'         => ['required', 'in:pendiente,en_seguimiento,cerrado'],
            'recomendacion_ia' => ['nullable', 'string'],
            'prioridad_ia'   => ['nullable', 'in:alta,media,baja'],
        ], [
            'nombre.required'         => 'El nombre es obligatorio.',
            'apellido.required'       => 'El apellido es obligatorio.',
            'ficha_programa.required' => 'La ficha de programa es obligatoria.',
            'edad.required'           => 'La edad es obligatoria.',
            'edad.min'                => 'La edad mínima es 14 años.',
            'fecha.required'          => 'La fecha es obligatoria.',
            'nota.required'           => 'La nota descriptiva es obligatoria.',
            'nota.min'                => 'La nota debe tener al menos 10 caracteres.',
        ]);

        // Usar la prioridad detectada por la IA si está disponible, si no calcular localmente
        $validated['prioridad']    = $validated['prioridad_ia'] ?? Solicitud::calcularPrioridad($validated['nota']);
        $validated['atendido_por'] = Auth::id();
        unset($validated['prioridad_ia']);

        Solicitud::create($validated);

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitud registrada exitosamente.');
    }

    public function show(Solicitud $solicitud): View
    {
        return view('solicitudes.show', compact('solicitud'));
    }

    public function edit(Solicitud $solicitud): View
    {
        return view('solicitudes.edit', compact('solicitud'));
    }

    public function update(Request $request, Solicitud $solicitud): RedirectResponse
    {
        $validated = $request->validate([
            'nombre'         => ['required', 'string', 'max:100'],
            'apellido'       => ['required', 'string', 'max:100'],
            'documento'      => ['nullable', 'string', 'max:20'],
            'ficha_programa' => ['required', 'string', 'max:20'],
            'nombre_programa'=> ['nullable', 'string', 'max:150'],
            'edad'           => ['required', 'integer', 'min:14', 'max:100'],
            'fecha'          => ['required', 'date'],
            'nota'           => ['required', 'string', 'min:10'],
            'categoria'      => ['required', 'in:academico,salud_mental,economico,personal,otro'],
            'estado'         => ['required', 'in:pendiente,en_seguimiento,cerrado'],
            'seguimiento'    => ['nullable', 'string'],
            'recomendacion_ia' => ['nullable', 'string'],
            'prioridad_ia'   => ['nullable', 'in:alta,media,baja'],
        ]);

        $validated['prioridad'] = $validated['prioridad_ia'] ?? Solicitud::calcularPrioridad($validated['nota']);
        unset($validated['prioridad_ia']);

        $solicitud->update($validated);

        return redirect()->route('solicitudes.show', $solicitud)
            ->with('success', 'Solicitud actualizada correctamente.');
    }

    public function destroy(Solicitud $solicitud): RedirectResponse
    {
        $solicitud->delete();
        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitud eliminada.');
    }

    /**
     * Historial de un aprendiz por documento o ficha.
     */
    public function historial(Request $request): View
    {
        $solicitudes = collect();
        $buscar      = $request->buscar;

        if ($request->filled('buscar')) {
            $solicitudes = Solicitud::where('documento', $buscar)
                ->orWhere('ficha_programa', $buscar)
                ->latest()
                ->get();
        }

        return view('solicitudes.historial', compact('solicitudes', 'buscar'));
    }

    /**
     * Recomendar via IA (AJAX).
     */
    public function recomendar(Request $request): JsonResponse
    {
        $request->validate([
            'nota' => ['required', 'string', 'min:10'],
        ]);

        $nota    = $request->nota;
        $apiKey  = config('services.gemini.key');

        if (empty($apiKey)) {
            // Sin API Key: fallback local
            $prioridad     = Solicitud::calcularPrioridad($nota);
            $recomendacion = $this->recomendacionLocal($nota, $prioridad);
            return response()->json([
                'recomendacion' => $recomendacion,
                'prioridad'     => $prioridad,
                'color'         => $this->colorPrioridad($prioridad),
                'categoria'     => '',
            ]);
        }

        // Modelos a intentar en orden (fallback si el primero está saturado)
        $modeloPrincipal = str_replace('models/', '', config('services.gemini.model', 'gemini-3.6-flash'));
        $modelosFallback = array_values(array_unique(array_filter([
            $modeloPrincipal,
            'gemini-2.5-flash',
            'gemini-2.0-flash',
        ])));

        $prompt = <<<PROMPT
Eres un asistente experto en bienestar estudiantil del SENA Colombia. Analiza la nota del aprendiz y responde ÚNICAMENTE con un objeto JSON válido, sin texto adicional, sin bloques de código, sin explicaciones.

Clasifica la PRIORIDAD según estas reglas:
- "Alta / Crítica": autoagresión, suicidio, violencia, amenazas, acoso, crisis severa, ataques de pánico, sin alimentación/sueño varios días.
- "Media": deserción, problemas económicos, falta de vivienda, problemas familiares graves, estrés moderado, salud no crítica.
- "Baja": dificultades académicas normales, dudas del programa, deportes/cultura, bajo rendimiento.

Responde SOLO este JSON (máximo 80 palabras en recomendacion):
{"prioridad":"Alta / Crítica|Media|Baja","color":"Rojo|Naranja|Verde","categoria":"Salud Mental|Económico|Académico|Convivencia","recomendacion":"texto aquí"}

Nota del aprendiz: "{$nota}"
PROMPT;

        $ultimoError = null;

        foreach ($modelosFallback as $model) {
            try {
                $client = new \GuzzleHttp\Client(['timeout' => 30]);
                $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

                $response = $client->post($apiUrl, [
                    'headers' => ['Content-Type' => 'application/json'],
                    'json'    => [
                        'contents' => [
                            ['parts' => [['text' => $prompt]]]
                        ],
                        'generationConfig' => [
                            'temperature'     => 0.2,
                            'maxOutputTokens' => 1024,
                        ],
                    ],
                ]);

                $body    = json_decode($response->getBody()->getContents(), true);
                $content = $body['candidates'][0]['content']['parts'][0]['text'] ?? '';

                \Illuminate\Support\Facades\Log::info("Gemini [{$model}] raw response: " . substr($content, 0, 500));

                $ia = $this->extraerJson($content);

                if (empty($ia)) {
                    throw new \RuntimeException("No se encontró JSON válido en la respuesta. Respuesta: " . substr($content, 0, 200));
                }

                $prioridadTexto   = strtolower(trim($ia['prioridad'] ?? ''));
                $prioridadInterna = match(true) {
                    str_contains($prioridadTexto, 'alta') || str_contains($prioridadTexto, 'cr') => 'alta',
                    str_contains($prioridadTexto, 'media') => 'media',
                    default => 'baja',
                };

                return response()->json([
                    'recomendacion'   => $ia['recomendacion'] ?? '',
                    'prioridad'       => $prioridadInterna,
                    'prioridad_label' => $ia['prioridad'] ?? ucfirst($prioridadInterna),
                    'color'           => $ia['color'] ?? $this->colorPrioridad($prioridadInterna),
                    'categoria'       => $ia['categoria'] ?? '',
                    'modelo_usado'    => $model,
                ]);

            } catch (\GuzzleHttp\Exception\ServerException $e) {
                // 503 / 5xx: el modelo está saturado — intentar con el siguiente
                $statusCode  = $e->getResponse()?->getStatusCode();
                $ultimoError = $e;
                \Illuminate\Support\Facades\Log::warning("Gemini [{$model}] error {$statusCode}, intentando siguiente modelo...");
                continue;

            } catch (\Throwable $e) {
                // Cualquier otro error: no tiene sentido reintentar con otro modelo
                $ultimoError = $e;
                \Illuminate\Support\Facades\Log::error("Gemini [{$model}] error inesperado: " . $e->getMessage());
                break;
            }
        }

        // Todos los modelos fallaron — usar análisis local
        $prioridad     = Solicitud::calcularPrioridad($nota);
        $recomendacion = $this->recomendacionLocal($nota, $prioridad);

        \Illuminate\Support\Facades\Log::error('IA fallback local activado. Último error: ' . ($ultimoError?->getMessage() ?? 'desconocido'));

        return response()->json([
            'recomendacion' => $recomendacion,
            'prioridad'     => $prioridad,
            'color'         => $this->colorPrioridad($prioridad),
            'categoria'     => '',
            'error'         => 'El servicio de IA está temporalmente saturado. Se usó análisis local automático.',
        ]);
    }

    /**
     * Extrae el primer objeto JSON válido de un texto libre.
     * Maneja respuestas con bloques ```json```, texto antes/después, etc.
     */
    private function extraerJson(string $texto): ?array
    {
        // 1. Intentar parsear directo (caso ideal)
        $data = json_decode(trim($texto), true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
            return $data;
        }

        // 2. Extraer bloque ```json ... ``` o ``` ... ```
        if (preg_match('/```(?:json)?\s*(\{.*?\})\s*```/si', $texto, $m)) {
            $data = json_decode(trim($m[1]), true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                return $data;
            }
        }

        // 3. Buscar el primer { ... } balanceado en el texto
        $inicio = strpos($texto, '{');
        if ($inicio === false) return null;

        $nivel  = 0;
        $fin    = null;
        $len    = strlen($texto);

        for ($i = $inicio; $i < $len; $i++) {
            if ($texto[$i] === '{') $nivel++;
            if ($texto[$i] === '}') {
                $nivel--;
                if ($nivel === 0) { $fin = $i; break; }
            }
        }

        if ($fin !== null) {
            $jsonStr = substr($texto, $inicio, $fin - $inicio + 1);
            $data    = json_decode($jsonStr, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                return $data;
            }
        }

        return null;
    }

    /**
     * Color legible según prioridad interna.
     */
    private function colorPrioridad(string $prioridad): string
    {
        return match($prioridad) {
            'alta'  => 'Rojo',
            'media' => 'Naranja',
            default => 'Verde',
        };
    }

    /**
     * Recomendación local basada en palabras clave (fallback sin API).
     */
    private function recomendacionLocal(string $nota, string $prioridad): string
    {
        $nota = mb_strtolower($nota);

        if ($prioridad === 'alta') {
            return 'ATENCIÓN URGENTE: Se detectan indicadores de alto riesgo. Se recomienda activar el protocolo de atención en crisis del SENA de forma inmediata. Contactar al equipo de psicología, notificar al coordinador académico y, de ser necesario, activar la red de emergencias (Línea 106 de salud mental). No dejar al aprendiz solo hasta garantizar su seguridad.';
        }

        if ($prioridad === 'media') {
            return 'Se recomienda agendar una cita con el psicólogo del área de Bienestar en los próximos 2 días hábiles. Realizar seguimiento semanal al aprendiz, informar al instructor de ficha y evaluar posibles apoyos socioeconómicos disponibles en el SENA (subsidios, transporte, alimentación). Mantener comunicación con familia si aplica.';
        }

        return 'Se sugiere brindar orientación y acompañamiento preventivo al aprendiz. Programar una sesión de seguimiento en las próximas 2 semanas. Informar al aprendiz sobre los servicios de bienestar disponibles (deporte, cultura, emprendimiento) y motivar su participación activa en el proceso formativo.';
    }

    /**
     * Exportar a Excel.
     */
    public function exportarExcel(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new SolicitudesExport, 'solicitudes_bienestar_' . now()->format('Y-m-d') . '.xlsx');
    }

    /**
     * Generar PDF (Acta de Atención).
     */
    public function exportarPdf(Solicitud $solicitud): \Illuminate\Http\Response
    {
        $pdf = Pdf::loadView('solicitudes.pdf', compact('solicitud'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("acta_atencion_{$solicitud->id}_{$solicitud->documento}.pdf");
    }
}
