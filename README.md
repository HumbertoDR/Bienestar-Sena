# 🎓 Sistema de Bienestar al Aprendiz — SENA

Sistema web desarrollado con **Laravel 13** para la gestión de solicitudes de atención a aprendices del SENA. Permite registrar, hacer seguimiento y exportar casos de bienestar, con un módulo de **inteligencia artificial** que analiza automáticamente la nota del caso y sugiere prioridad y recomendaciones de atención.

---

## 📋 Tabla de Contenidos

- [Características](#características)
- [Stack Tecnológico](#stack-tecnológico)
- [Requisitos](#requisitos)
- [Instalación Local](#instalación-local)
- [Instalación con Docker](#instalación-con-docker)
- [Configuración de Variables de Entorno](#configuración-de-variables-de-entorno)
- [Base de Datos](#base-de-datos)
- [Credenciales de Acceso](#credenciales-de-acceso)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Rutas de la Aplicación](#rutas-de-la-aplicación)
- [Módulo de Inteligencia Artificial](#módulo-de-inteligencia-artificial)
- [Exportaciones](#exportaciones)
- [Comandos Útiles](#comandos-útiles)

---

## ✨ Características

- **Autenticación segura** con sesión y opción "recuérdame".
- **Dashboard con KPIs** y gráficas: total de solicitudes, estados, prioridades, categorías, solicitudes por semana y programas con más casos.
- **CRUD completo** de solicitudes de atención a aprendices.
- **Filtros avanzados** por nombre, documento, ficha de programa, estado, prioridad y categoría.
- **Historial por aprendiz** consultable por documento o número de ficha.
- **Análisis automático de prioridad** mediante palabras clave (alta / media / baja) sin necesidad de API externa.
- **Integración con Google Gemini AI** para recomendaciones personalizadas en tiempo real (AJAX). Si la API no está configurada, el sistema usa análisis local como respaldo.
- **Exportación a Excel** de todas las solicitudes con fecha en el nombre del archivo.
- **Generación de PDF** (Acta de Atención) por solicitud individual.
- **Semáforo de prioridad** visual (rojo / naranja / verde) en listados y detalle.
- Diseño responsivo con **Tailwind CSS v4**.

---

## 🛠️ Stack Tecnológico

| Capa | Tecnología |
|---|---|
| Backend | PHP 8.3 + Laravel 13 |
| Base de datos | SQLite (local) / MySQL 8 (Docker/producción) |
| Frontend | Blade + Tailwind CSS v4 |
| Bundler | Vite 8 |
| IA | Google Gemini API (con fallback local) |
| Exportación Excel | Maatwebsite/Excel 4 |
| Generación PDF | barryvdh/laravel-dompdf 3 |
| Contenedores | Docker + Docker Compose |
| Administración DB | phpMyAdmin (Docker) |

---

## 📦 Requisitos

### Sin Docker
- PHP **8.3** o superior con extensiones: `pdo`, `pdo_sqlite`, `mbstring`, `xml`, `zip`, `gd`
- Composer **2.x**
- Node.js **18+** y npm

### Con Docker
- Docker Desktop (o Docker Engine + Docker Compose V2)

---

## 🚀 Instalación Local

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/bienestar-sena.git
cd bienestar-sena
```

### 2. Instalación automática (recomendada)

El proyecto incluye un script `setup` en Composer que hace todo en un solo paso:

```bash
composer run setup
```

Esto ejecuta en orden:
1. `composer install` — instala dependencias PHP
2. Copia `.env.example` a `.env` si no existe
3. `php artisan key:generate` — genera la clave de la aplicación
4. `php artisan migrate --force` — crea las tablas en la base de datos
5. `npm install` — instala dependencias de Node.js
6. `npm run build` — compila los assets con Vite

### 3. Instalación manual (paso a paso)

```bash
# Dependencias PHP
composer install

# Copiar entorno
cp .env.example .env

# Generar clave
php artisan key:generate

# Crear la base de datos SQLite
touch database/database.sqlite

# Ejecutar migraciones y seeder
php artisan migrate --seed

# Dependencias Node.js
npm install

# Compilar assets
npm run build
```

### 4. Levantar el servidor

```bash
php artisan serve
```

La aplicación estará disponible en: **http://localhost:8000**

---

## 🐳 Instalación con Docker

El `docker-compose.yml` levanta tres servicios: la aplicación Laravel, MySQL 8 y phpMyAdmin.

### 1. Configurar el entorno para Docker

Edita el archivo `.env` y ajusta los valores de la base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=bienestar_sena
DB_USERNAME=sail
DB_PASSWORD=secret
```

### 2. Construir y levantar los contenedores

```bash
docker compose up -d --build
```

### 3. Ejecutar migraciones y seeder dentro del contenedor

```bash
docker compose exec app php artisan migrate --seed
```

### Servicios disponibles

| Servicio | URL |
|---|---|
| Aplicación Laravel | http://localhost:8000 |
| phpMyAdmin | http://localhost:8080 |
| MySQL | localhost:3306 |

---

## ⚙️ Configuración de Variables de Entorno

Las variables más importantes del archivo `.env`:

```env
# Nombre de la aplicación
APP_NAME="Bienestar SENA"
APP_ENV=local
APP_KEY=              # Se genera con php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de datos (SQLite por defecto en local)
DB_CONNECTION=sqlite
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=bienestar_sena
# DB_USERNAME=root
# DB_PASSWORD=

# Google Gemini AI (opcional — si se omite, el sistema usa análisis local)
GEMINI_API_KEY=
GEMINI_MODEL=gemini-1.5-flash
```

> **Nota:** Si no configuras `GEMINI_API_KEY`, la funcionalidad de IA seguirá funcionando con el motor de análisis local basado en palabras clave.

---

## 🗄️ Base de Datos

### Tablas principales

#### `users`
| Columna | Tipo | Descripción |
|---|---|---|
| id | bigint | Clave primaria |
| name | string | Nombre del funcionario de bienestar |
| email | string | Correo (único) |
| password | string | Contraseña cifrada |

#### `solicitudes`
| Columna | Tipo | Descripción |
|---|---|---|
| id | bigint | Clave primaria |
| nombre | string | Nombre del aprendiz |
| apellido | string | Apellido del aprendiz |
| documento | string | Número de documento (opcional) |
| ficha_programa | string | Número de ficha del programa |
| nombre_programa | string | Nombre del programa (opcional) |
| edad | tinyint | Edad del aprendiz (14–100) |
| fecha | date | Fecha de atención |
| nota | text | Descripción detallada del caso |
| categoria | enum | `academico`, `salud_mental`, `economico`, `personal`, `otro` |
| recomendacion_ia | text | Recomendación generada por la IA |
| prioridad | enum | `baja`, `media`, `alta` |
| estado | enum | `pendiente`, `en_seguimiento`, `cerrado` |
| seguimiento | text | Notas de seguimiento posteriores |
| atendido_por | FK → users | Funcionario que registró la solicitud |
| created_at / updated_at | timestamp | Fechas automáticas |

### Ejecutar migraciones

```bash
php artisan migrate
```

### Poblar con datos iniciales (seeder)

```bash
php artisan db:seed
```

El seeder crea el usuario administrador por defecto (ver sección de credenciales).

---

## 🔑 Credenciales de Acceso

El seeder crea automáticamente un usuario de prueba:

| Campo | Valor |
|---|---|
| Correo | `bienestar@sena.edu.co` |
| Contraseña | `Bienestar2024*` |

> ⚠️ Cambia la contraseña inmediatamente en un entorno de producción.

---

## 📁 Estructura del Proyecto

```
bienestar-sena/
├── app/
│   ├── Exports/
│   │   └── SolicitudesExport.php      # Lógica de exportación a Excel
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   └── LoginController.php   # Login / logout
│   │   │   ├── DashboardController.php   # KPIs y estadísticas
│   │   │   └── SolicitudController.php   # CRUD, historial, IA, PDF, Excel
│   │   └── Middleware/
│   │       └── NoCacheMiddleware.php      # Evita cacheo en páginas protegidas
│   ├── Models/
│   │   ├── Solicitud.php              # Modelo principal con lógica de prioridad
│   │   └── User.php                   # Modelo de usuario / funcionario
│   └── Providers/
│       └── AppServiceProvider.php
├── database/
│   ├── migrations/                    # Esquemas de base de datos
│   └── seeders/
│       └── DatabaseSeeder.php         # Usuario administrador por defecto
├── resources/
│   ├── css/app.css                    # Estilos con Tailwind CSS
│   ├── js/app.js                      # JavaScript principal
│   └── views/
│       ├── auth/login.blade.php       # Pantalla de inicio de sesión
│       ├── dashboard.blade.php        # Panel de control con gráficas
│       ├── layouts/app.blade.php      # Layout base de la aplicación
│       └── solicitudes/
│           ├── index.blade.php        # Listado con filtros y paginación
│           ├── create.blade.php       # Formulario de nueva solicitud (con IA)
│           ├── edit.blade.php         # Formulario de edición
│           ├── show.blade.php         # Detalle de una solicitud
│           ├── historial.blade.php    # Historial por aprendiz
│           └── pdf.blade.php          # Plantilla del Acta de Atención
├── routes/web.php                     # Definición de todas las rutas
├── docker-compose.yml                 # Servicios Docker (app, MySQL, phpMyAdmin)
├── Dockerfile                         # Imagen base de la aplicación
└── .env.example                       # Plantilla de configuración
```

---

## 🗺️ Rutas de la Aplicación

| Método | URL | Descripción | Acceso |
|---|---|---|---|
| GET | `/` | Redirige al login o dashboard | Público |
| GET | `/login` | Formulario de inicio de sesión | Invitados |
| POST | `/login` | Procesar autenticación | Invitados |
| POST | `/logout` | Cerrar sesión | Autenticado |
| GET | `/dashboard` | Panel con KPIs y gráficas | Autenticado |
| GET | `/solicitudes` | Listado con filtros y paginación | Autenticado |
| GET | `/solicitudes/create` | Formulario de nueva solicitud | Autenticado |
| POST | `/solicitudes` | Guardar nueva solicitud | Autenticado |
| GET | `/solicitudes/{id}` | Ver detalle de una solicitud | Autenticado |
| GET | `/solicitudes/{id}/edit` | Formulario de edición | Autenticado |
| PUT/PATCH | `/solicitudes/{id}` | Actualizar solicitud | Autenticado |
| DELETE | `/solicitudes/{id}` | Eliminar solicitud | Autenticado |
| GET | `/historial` | Historial de atención por aprendiz | Autenticado |
| GET | `/exportar/excel` | Descargar Excel con todas las solicitudes | Autenticado |
| GET | `/solicitudes/{id}/pdf` | Descargar Acta de Atención en PDF | Autenticado |
| POST | `/ia/recomendar` | Obtener análisis de IA vía AJAX | Autenticado |

---

## 🤖 Módulo de Inteligencia Artificial

El sistema incluye un asistente de IA que analiza la nota de cada caso y devuelve:

- **Prioridad sugerida:** Alta / Media / Baja
- **Categoría del caso:** Salud Mental, Económico, Académico, Convivencia
- **Recomendación de acción** personalizada para el equipo de bienestar

### Flujo de funcionamiento

```
Asesor escribe la nota del caso
        ↓
Clic en "Analizar con IA"
        ↓
Solicitud AJAX a POST /ia/recomendar
        ↓
¿Está configurada GEMINI_API_KEY?
   ├── SÍ → Consulta a Google Gemini API
   └── NO → Análisis local por palabras clave
        ↓
Respuesta JSON con prioridad + recomendación
        ↓
Se pre-rellena el formulario automáticamente
```

### Clasificación local por palabras clave

Cuando no hay API configurada, el sistema determina la prioridad así:

**Alta (riesgo crítico):** suicidio, violencia, abuso, crisis, automutilación, deserción, amenaza, depresión severa, drogadicción...

**Media:** ansiedad, depresión, estrés, bullying, acoso, conflicto, dificultad económica, bajo rendimiento...

**Baja:** todo lo que no coincide con los patrones anteriores.

### Configurar Google Gemini

1. Obtén una API Key gratuita en [Google AI Studio](https://aistudio.google.com/app/apikey)
2. Agrégala al `.env`:

```env
GEMINI_API_KEY=tu_api_key_aqui
GEMINI_MODEL=gemini-1.5-flash
```

3. Agrega la clave al archivo `config/services.php`:

```php
'gemini' => [
    'key'   => env('GEMINI_API_KEY'),
    'model' => env('GEMINI_MODEL', 'gemini-1.5-flash'),
],
```

---

## 📊 Exportaciones

### Excel
Descarga un archivo `.xlsx` con todas las solicitudes registradas. El nombre incluye la fecha de generación: `solicitudes_bienestar_YYYY-MM-DD.xlsx`.

```
GET /exportar/excel
```

### PDF — Acta de Atención
Genera un documento PDF individual por solicitud con todos los datos del caso, listo para imprimir o archivar.

```
GET /solicitudes/{id}/pdf
→ acta_atencion_{id}_{documento}.pdf
```

---

## 🧰 Comandos Útiles

```bash
# Levantar servidor de desarrollo
php artisan serve

# Compilar assets (producción)
npm run build

# Compilar assets con hot reload (desarrollo)
npm run dev

# Ejecutar migraciones
php artisan migrate

# Ejecutar migraciones + seeder
php artisan migrate --seed

# Revertir todas las migraciones y volver a crearlas
php artisan migrate:fresh --seed

# Limpiar caché de configuración
php artisan config:clear

# Limpiar caché de vistas
php artisan view:clear

# Ver todas las rutas registradas
php artisan route:list

# Abrir consola interactiva de Laravel
php artisan tinker

# Con Docker: ejecutar comandos dentro del contenedor
docker compose exec app php artisan migrate --seed
docker compose exec app php artisan tinker
```

---

## 📄 Licencia

Este proyecto está licenciado bajo la [Licencia MIT](https://opensource.org/licenses/MIT).

---

> Desarrollado para el área de **Bienestar al Aprendiz** del SENA Colombia.
