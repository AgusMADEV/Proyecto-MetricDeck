# Reporte de proyecto

## Estructura del proyecto

```
C:\xampp\htdocs\GitHub\Proyecto-MetricDeck
├── .env.example
├── .gitignore
├── MEJORAS.md
├── README.md
├── api.php
├── auth_config.php
├── grafica3.php
├── index.php
├── monitor_data
│   ├── apache_request_rate.csv
│   ├── bandwidth_Conexión de red Bluetooth.csv
│   ├── bandwidth_Conexión de área local_ 10.csv
│   ├── bandwidth_Conexión de área local_ 9.csv
│   ├── bandwidth_Ethernet 2.csv
│   ├── bandwidth_Ethernet.csv
│   ├── bandwidth_Loopback Pseudo-Interface 1.csv
│   ├── bandwidth_Wi-Fi.csv
│   ├── cpu_usage.csv
│   ├── disk_io_PhysicalDrive0.csv
│   ├── disk_usage.csv
│   └── ram_usage.csv
├── requirements.txt
└── server_monitor.py
```

## Código (intercalado)

# Proyecto-MetricDeck
**MEJORAS.md**
```markdown
# MetricDeck - Propuestas de Mejoras
*Versión 0.3 - Producción*

---

## 📊 Mejoras de Funcionalidad

### 1. **Sistema de Autenticación Mejorado**
- [ ] Implementar autenticación JWT para la API
- [ ] Agregar sistema de roles (Admin, Viewer, Editor)
- [ ] Mover credenciales hardcoded a variables de entorno (.env)
- [ ] Implementar sesiones PHP para evitar autenticación en cada request
- [ ] Sistema de logout explícito
- [ ] Logs de intentos de acceso fallidos

**Prioridad:** Alta 🔴  
**Complejidad:** Media

---

### 2. **Gestión de Datos y Almacenamiento**
- [ ] Implementar base de datos (MySQL/PostgreSQL) en lugar de CSV
  - Mejor rendimiento con grandes volúmenes de datos
  - Consultas más eficientes con índices
  - Integridad referencial
- [ ] Sistema de rotación de logs automático (eliminar datos antiguos)
- [ ] Configuración de retención de datos (7 días, 30 días, 90 días)
- [ ] Agregación de datos históricos (promedios por hora/día)
- [ ] Sistema de backup automático de datos
- [ ] Compresión de datos antiguos

**Prioridad:** Alta 🔴  
**Complejidad:** Alta

---

### 3. **Sistema de Alertas y Notificaciones**
- [ ] Alertas configurables por métrica (CPU > 90%, RAM > 85%, etc.)
- [ ] Notificaciones por email
- [ ] Notificaciones push (PWA)
- [ ] Integración con Slack/Discord/Telegram
- [ ] Webhooks personalizables
- [ ] Historial de alertas disparadas
- [ ] Silenciar alertas temporalmente
- [ ] Alertas predictivas basadas en tendencias

**Prioridad:** Alta 🔴  
**Complejidad:** Media

---

### 4. **Monitoreo Avanzado**
- [ ] Monitoreo de procesos individuales (top processes por CPU/RAM)
- [ ] Temperatura de CPU y GPU
- [ ] Estado de servicios (Apache, MySQL, PHP-FPM)
- [ ] Monitoreo de puertos abiertos
- [ ] Logs de errores de aplicaciones
- [ ] Métricas de PHP (memory_limit, execution_time)
- [ ] Monitoreo de certificados SSL (fecha de expiración)
- [ ] Análisis de logs de Apache (errores 404, 500, etc.)
- [ ] Uptime del servidor
- [ ] Latencia de red (ping a servidores externos)

**Prioridad:** Media 🟡  
**Complejidad:** Media-Alta

---

### 5. **Configuración Dinámica**
- [ ] Panel de configuración en la UI
- [ ] Seleccionar qué métricas mostrar/ocultar
- [ ] Configurar intervalo de actualización por métrica
- [ ] Cambiar orden de las tarjetas (drag & drop)
- [ ] Guardar layouts personalizados por usuario
- [ ] Exportar/Importar configuraciones
- [ ] Modo oscuro/claro seleccionable

**Prioridad:** Media 🟡  
**Complejidad:** Media

---

### 6. **Análisis y Reportes**
- [ ] Generación de reportes PDF/Excel
- [ ] Comparación de periodos (hoy vs ayer, semana actual vs anterior)
- [ ] Identificación de picos y anomalías
- [ ] Predicción de tendencias (ML básico)
- [ ] Métricas calculadas (promedio, máximo, mínimo del periodo)
- [ ] Dashboard de resumen semanal/mensual
- [ ] Exportar datos en formato JSON/CSV

**Prioridad:** Baja 🟢  
**Complejidad:** Alta

---

### 7. **Multi-servidor**
- [ ] Monitorear múltiples servidores desde un dashboard central
- [ ] Comparación lado a lado de servidores
- [ ] Vista de mapa/topología de infraestructura
- [ ] Grupos de servidores (producción, desarrollo, testing)
- [ ] Agregación de métricas multi-servidor

**Prioridad:** Baja 🟢  
**Complejidad:** Alta

---

### 8. **API Mejorada**
- [ ] Versionado de API (v1, v2)
- [ ] Documentación OpenAPI/Swagger
- [ ] Rate limiting
- [ ] Filtros de fecha en endpoints (desde/hasta)
- [ ] Paginación de resultados
- [ ] WebSocket para datos en tiempo real
- [ ] CORS configurables
- [ ] Compresión de respuestas (gzip)

**Prioridad:** Media 🟡  
**Complejidad:** Media

---

### 9. **Optimización de Rendimiento**
- [ ] Caché de datos en Redis/Memcached
- [ ] Lazy loading de gráficos
- [ ] Virtualización de datos (solo cargar datos visibles)
- [ ] Service Worker para offline-first
- [ ] Minificación de JS/CSS
- [ ] CDN para assets estáticos
- [ ] Optimización de consultas CSV (usar SplFileObject)

**Prioridad:** Media 🟡  
**Complejidad:** Media

---

## 🎨 Mejoras Estéticas y UX

### 10. **Interfaz de Usuario**
- [ ] **Dashboard personalizable:**
  - Widgets redimensionables
  - Drag & drop para reorganizar tarjetas
  - Layouts guardados (Grid, Lista, Compacto)
  
- [ ] **Mejoras visuales:**
  - Animaciones sutiles en gráficos
  - Transiciones suaves entre estados
  - Loading skeletons en lugar de spinners
  - Micro-interacciones (hover effects mejorados)
  - Partículas o efectos de fondo animados

- [ ] **Temas personalizables:**
  - Editor de colores en tiempo real
  - Temas predefinidos (Dark, Light, High Contrast, Cyberpunk, Minimal)
  - Modo automático según hora del día

- [ ] **Responsive mejorado:**
  - Optimización para tablets
  - Menú hamburguesa en móvil
  - Gráficos adaptables a pantalla vertical

**Prioridad:** Media 🟡  
**Complejidad:** Media

---

### 11. **Gráficos y Visualizaciones**
- [ ] Librería de gráficos más potente (Chart.js, D3.js, ApexCharts)
- [ ] Más tipos de gráficos:
  - Área apilada
  - Gauge/medidor circular
  - Heatmap
  - Sparklines
  - Gráficos de dispersión
  
- [ ] Interactividad mejorada:
  - Zoom y pan en gráficos
  - Exportar gráfico como imagen
  - Selección de rango temporal con slider
  - Comparación de múltiples métricas en un gráfico
  - Anotaciones en gráficos (eventos importantes)

- [ ] Tooltips más informativos:
  - Estadísticas en tiempo real
  - Comparación con periodo anterior
  - Tendencia (↑↓)

**Prioridad:** Alta 🔴  
**Complejidad:** Media

---

### 12. **Navegación y Usabilidad**
- [ ] Menú lateral/superior con navegación clara
- [ ] Breadcrumbs para navegación
- [ ] Búsqueda de métricas
- [ ] Favoritos/métricas destacadas
- [ ] Historial de navegación
- [ ] Atajos de teclado
- [ ] Tour guiado para nuevos usuarios
- [ ] Página de ayuda/documentación integrada

**Prioridad:** Media 🟡  
**Complejidad:** Baja-Media

---

### 13. **Indicadores Visuales Mejorados**
- [ ] Badges de estado con colores (verde/amarillo/rojo)
- [ ] Porcentajes grandes y legibles en las tarjetas
- [ ] Iconos representativos para cada métrica
- [ ] Barra de progreso circular en tarjetas
- [ ] Indicadores de tendencia (flecha arriba/abajo con %)
- [ ] Comparación visual con periodo anterior
- [ ] Alertas visuales llamativas (pulsado, color de fondo)

**Prioridad:** Media 🟡  
**Complejidad:** Baja

---

### 14. **Detalles de Diseño**
- [ ] Glassmorphism en topbar y tarjetas
- [ ] Sombras y depth más marcado
- [ ] Tipografía mejorada (variable fonts)
- [ ] Consistencia en espaciados (design tokens)
- [ ] Modo de pantalla completa
- [ ] Print-friendly styles
- [ ] Animación de carga inicial atractiva
- [ ] Página 404 personalizada
- [ ] Error states diseñados

**Prioridad:** Baja 🟢  
**Complejidad:** Baja

---

### 15. **Accesibilidad**
- [ ] ARIA labels completos
- [ ] Navegación por teclado
- [ ] Contraste de colores WCAG AA/AAA
- [ ] Textos alternativos para gráficos
- [ ] Modo de alto contraste
- [ ] Tamaños de fuente ajustables
- [ ] Screen reader friendly

**Prioridad:** Media 🟡  
**Complejidad:** Media

---

## 🔧 Mejoras Técnicas

### 16. **Arquitectura y Código**
- [ ] Separar frontend y backend (SPA con React/Vue/Svelte)
- [ ] API RESTful completa
- [ ] Frontend con TypeScript
- [ ] State management (Redux, Vuex, Pinia)
- [ ] Testing automatizado (PHPUnit, Jest, Cypress)
- [ ] CI/CD pipeline
- [ ] Containerización (Docker)
- [ ] Documentación del código
- [ ] Code linting y formatting (PSR-12 para PHP, ESLint para JS)

**Prioridad:** Media 🟡  
**Complejidad:** Alta

---

### 17. **Seguridad**
- [ ] HTTPS obligatorio
- [ ] Protección CSRF
- [ ] Sanitización de inputs
- [ ] Prevención de SQL injection (aunque ahora es CSV)
- [ ] Headers de seguridad (CSP, X-Frame-Options, etc.)
- [ ] Auditoría de seguridad regular
- [ ] Actualización automática de dependencias vulnerables
- [ ] 2FA (Two-Factor Authentication)
- [ ] IP whitelisting

**Prioridad:** Alta 🔴  
**Complejidad:** Media

---

### 18. **DevOps y Deployment**
- [ ] Script de instalación automatizada
- [ ] Variables de entorno para configuración
- [ ] Logging centralizado
- [ ] Monitoreo de errores (Sentry)
- [ ] Health check endpoint
- [ ] Graceful shutdown
- [ ] Hot-reload en desarrollo
- [ ] Staging environment

**Prioridad:** Media 🟡  
**Complejidad:** Media

---

## 🚀 Roadmap Sugerido

### Fase 1 (Corto Plazo - 1-2 meses)
1. Mover credenciales a .env
2. Implementar sistema de alertas básico
3. Mejorar gráficos con librería profesional
4. Modo oscuro/claro
5. Indicadores visuales mejorados

### Fase 2 (Medio Plazo - 3-6 meses)
1. Migrar de CSV a base de datos
2. Dashboard personalizable (drag & drop)
3. Sistema de notificaciones completo
4. API mejorada con documentación
5. Monitoreo de servicios adicionales

### Fase 3 (Largo Plazo - 6-12 meses)
1. Multi-servidor
2. Sistema de reportes avanzado
3. Separación frontend/backend (SPA)
4. Predicción de tendencias
5. Aplicación móvil nativa

---

## 📝 Notas Finales

### Quick Wins (Implementación rápida, alto impacto)
- ✅ Variables de entorno para credenciales
- ✅ Modo oscuro
- ✅ Indicadores de tendencia en tarjetas
- ✅ Tooltips mejorados
- ✅ Iconos para cada métrica
- ✅ Sistema de alertas básico (email)

### Consideraciones de Costos
- **Gratis:** Mejoras de UI/UX, optimización de código
- **Bajo costo:** Base de datos MySQL, Redis
- **Medio costo:** Servicios de notificación (SendGrid), Hosting mejorado
- **Alto costo:** ML/AI para predicciones, infraestructura multi-servidor

### Tecnologías Recomendadas
- **Frontend:** React + TypeScript + Tailwind CSS
- **Backend:** PHP 8.2+ o Node.js + Express
- **Base de datos:** PostgreSQL + TimescaleDB (optimizado para series temporales)
- **Caché:** Redis
- **Gráficos:** ApexCharts o Chart.js
- **Real-time:** Socket.io o Pusher
- **Testing:** PHPUnit, Jest, Cypress
- **DevOps:** Docker, GitHub Actions

---

**Fecha de creación:** Febrero 2026  
**Versión del documento:** 1.0  
**Mantenido por:** Equipo MetricDeck

```
**README.md**
```markdown
# MetricDeck

Dashboard web para monitoreo de servidor con frontend en PHP/JS, API en PHP y recolector de métricas en Python (persistidas en CSV).

---

## Objetivo del proyecto

MetricDeck permite visualizar métricas operativas del servidor de forma simple y rápida, sin depender de una base de datos ni de infraestructura compleja.

Actualmente está pensado para:
- monitoreo local o en entorno de laboratorio/desarrollo,
- validación visual de métricas con datos reales o simulados,
- base inicial para evolucionar hacia una solución más robusta.

Métricas incluidas:
- CPU
- RAM
- uso de disco
- I/O de disco
- ancho de banda por interfaz
- tasa de requests de Apache

---

## Cómo funciona (arquitectura)

El flujo general es:

1. `server_monitor.py` recopila métricas del sistema con `psutil` y escribe archivos CSV en `monitor_data/`.
2. `api.php` expone esos CSV como JSON por endpoint, con autenticación HTTP Basic.
3. `index.php` renderiza el dashboard y carga múltiples tarjetas de gráfico.
4. `grafica3.php` consume la API, dibuja SVG (línea/barra/pie), refresca cada 10s y calcula delta vs periodo anterior.

No usa base de datos por ahora: los CSV son la fuente de verdad.

---

## Árbol del proyecto

```text
Proyecto-MetricDeck/
├─ index.php                 # Dashboard principal
├─ api.php                   # API JSON (lee CSV + Basic Auth)
├─ grafica3.php              # Componente de gráficos SVG + auto refresh
├─ auth_config.php           # Credenciales activas para API
├─ auth_config-example.php   # Plantilla de credenciales
├─ server_monitor.py         # Recolección real de métricas del host
├─ random_monitor.py         # Generación de datos simulados para pruebas
├─ requirements.txt          # Dependencias Python
├─ .env                      # Variables preparadas (actualmente no conectadas en PHP)
├─ monitor_data/             # CSV de métricas
│  ├─ cpu_usage.csv
│  ├─ ram_usage.csv
│  ├─ disk_usage.csv
│  ├─ disk_io_*.csv
│  ├─ bandwidth_*.csv
│  └─ apache_request_rate.csv
└─ MEJORAS.md                # Backlog / roadmap técnico y UX
```

---

## Requisitos

### Backend web
- PHP 7.4+ (recomendado 8.x)
- Apache (XAMPP funciona perfecto)

### Recolector Python
- Python 3.9+
- Dependencias:
	- `psutil`
	- `pytz`

---

## Instalación (Windows + XAMPP)

### 1) Clonar/copiar el proyecto

Coloca el proyecto en:

```text
D:\xampp\htdocs\Proyecto-MetricDeck
```

### 2) Crear entorno virtual e instalar dependencias

Desde PowerShell en la raíz del proyecto:

```powershell
python -m venv .venv
.\.venv\Scripts\Activate.ps1
pip install -r requirements.txt
```

### 3) Configurar credenciales de API

Edita `auth_config.php` (o copia desde `auth_config-example.php`) y define usuario/clave:

```php
<?php
return [
		'username' => 'tu_usuario',
		'password' => 'tu_password',
];
```

### 4) Asegurar permisos de escritura en `monitor_data/`

El usuario que ejecuta Python debe poder crear/escribir CSV dentro de esa carpeta.

### 5) Levantar Apache y abrir el dashboard

URL típica:

```text
http://localhost/Proyecto-MetricDeck/
```

---

## Uso rápido

### Opción A: generar datos simulados (ideal para demos)

```powershell
.\.venv\Scripts\python.exe .\random_monitor.py --range 1d --step-seconds 60 --mode overwrite
```

Modo continuo (agrega puntos periódicamente):

```powershell
.\.venv\Scripts\python.exe .\random_monitor.py --points 60 --step-seconds 60 --mode overwrite --live --interval-seconds 10
```

Parámetros útiles de `random_monitor.py`:
- `--points`: cantidad de puntos
- `--step-seconds`: separación temporal entre filas
- `--range`: `1h | 1d | 1w | 1m` (calcula puntos automáticamente)
- `--mode`: `overwrite | append`
- `--seed`: resultados reproducibles
- `--live`: generación continua
- `--interval-seconds`: intervalo en vivo

### Opción B: recolectar métricas reales

```powershell
.\.venv\Scripts\python.exe .\server_monitor.py
```

Este script ejecuta una captura por corrida. Para captura periódica, prográmalo con Task Scheduler (Windows) o cron (Linux).

---

## API disponible

Base:

```text
GET /Proyecto-MetricDeck/api.php?endpoint=...
```

Requiere autenticación Basic usando las credenciales de `auth_config.php`.

Endpoints:
- `cpu`
- `ram`
- `disk_usage`
- `disk_io` (admite `&disk=sda` o `PhysicalDrive0`, etc.)
- `bandwidth` (admite `&iface=eth0`, `Ethernet`, etc.)
- `apache_request_rate`

Query params comunes:
- `range`: `1h | 1d | 1w | 1m`
- `period`: `current | previous`

Ejemplos:

```text
api.php?endpoint=cpu&range=1d&period=current
api.php?endpoint=disk_io&disk=sda&range=1h
api.php?endpoint=bandwidth&iface=Ethernet&range=1w
```

---

## Dashboard y visualización

- Layout en grid con tarjetas de tamaño variable.
- Selector de rango temporal (`1h`, `1d`, `1w`, `1m`) persistido en `localStorage`.
- Refresco automático cada 10 segundos.
- Tipos de gráfico soportados: `line`, `bar`, `pie`.
- Badge `Δ` por tarjeta comparando último valor del periodo actual vs anterior.

---

## Notas de compatibilidad (importante)

- En Linux suelen aparecer discos/interfaz como `sda`, `eth0`.
- En Windows suelen aparecer como `PhysicalDrive0`, `Ethernet`, `Loopback Pseudo-Interface 1`.

Si un gráfico sale sin datos, ajusta el parámetro del endpoint (`disk` o `iface`) al nombre real generado en `monitor_data/`.

---

## Solución de problemas

### 1) `401 Unauthorized` en la API
- Verifica usuario/clave en `auth_config.php`.
- Confirma que el navegador/cliente envía encabezado `Authorization: Basic ...`.

### 2) “No data available”
- Ejecuta `random_monitor.py` o `server_monitor.py` para poblar CSV.
- Confirma que existen archivos en `monitor_data/`.

### 3) `random_monitor.py` falla con código 1
- Revisa que los parámetros sean válidos (`--points > 0`, `--step-seconds > 0`, `--interval-seconds > 0`).
- Asegura que el entorno virtual tenga dependencias instaladas.

### 4) Apache request rate vacío en Windows
- `server_monitor.py` busca `/var/log/apache2/access.log` (ruta Linux).
- En Windows/XAMPP debes adaptar esa ruta si quieres recolectar requests reales.

---

## Seguridad actual

Estado actual:
- autenticación HTTP Basic simple,
- credenciales en archivo PHP local,
- sin JWT/sesiones/roles.

Para producción se recomienda mínimo:
- usar HTTPS,
- mover secretos a variables de entorno seguras,
- rotar credenciales,
- restringir acceso por red/IP.

---

## Roadmap

El backlog está en `MEJORAS.md`, incluyendo:
- mejoras de autenticación y seguridad,
- migración de CSV a base de datos,
- alertas/notificaciones,
- arquitectura frontend/backend más escalable,
- optimizaciones UX y performance.

---

## Comandos útiles

```powershell
# Activar venv
.\.venv\Scripts\Activate.ps1

# Instalar dependencias
pip install -r requirements.txt

# Generar dataset de 1 día para pruebas
.\.venv\Scripts\python.exe .\random_monitor.py --range 1d --mode overwrite

# Simulación en vivo cada 2 segundos
.\.venv\Scripts\python.exe .\random_monitor.py --points 5 --step-seconds 60 --mode overwrite --live --interval-seconds 2

# Captura real única del host
.\.venv\Scripts\python.exe .\server_monitor.py
```

---

## Licencia

No se definió licencia explícita en el repositorio.
```
**api.php**
```php
<?php
// api.php
$authConfig = require __DIR__ . '/auth_config.php';
$username = (string)($authConfig['username'] ?? '');
$password = (string)($authConfig['password'] ?? '');

function getBasicAuthCredentials() {
    if (isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
        return [$_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']];
    }

    $header = '';
    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $header = (string)$_SERVER['HTTP_AUTHORIZATION'];
    } elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
        $header = (string)$_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
    }

    if (stripos($header, 'Basic ') === 0) {
        $decoded = base64_decode(substr($header, 6), true);
        if ($decoded !== false) {
            $parts = explode(':', $decoded, 2);
            if (count($parts) === 2) {
                return [$parts[0], $parts[1]];
            }
        }
    }

    return [null, null];
}

[$providedUser, $providedPassword] = getBasicAuthCredentials();

// Check for valid credentials
if ($providedUser !== $username ||
    $providedPassword !== $password) {
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    die('Authentication required.');
}

// Get the endpoint from the query string
$endpoint = isset($_GET['endpoint']) ? $_GET['endpoint'] : '';
$range = isset($_GET['range']) ? strtolower((string)$_GET['range']) : '';
$period = isset($_GET['period']) ? strtolower((string)$_GET['period']) : 'current';

// Base directory for CSV files
$csvDir = 'monitor_data';

function resolveRangeInSeconds($range) {
    switch ($range) {
        case '1h':
            return 3600;
        case '1d':
            return 86400;
        case '1w':
            return 7 * 86400;
        case '1m':
            return 30 * 86400;
        default:
            return null;
    }
}

// Function to read CSV and return as JSON
function readCsvAsJson($csvFile, $range = null, $period = 'current') {
    if (!file_exists($csvFile)) {
        return ['error' => 'No data available.'];
    }

    $data = [];
    $rangeSeconds = resolveRangeInSeconds($range);
    $rows = [];
    $maxTimestamp = null;

    $file = fopen($csvFile, 'r');
    $header = fgetcsv($file);

    while ($row = fgetcsv($file)) {
        $entry = array_combine($header, $row);
        $entryTimestamp = null;
        if (isset($entry['date'])) {
            $entryTimestamp = strtotime((string)$entry['date']);
            if ($entryTimestamp !== false) {
                if ($maxTimestamp === null || $entryTimestamp > $maxTimestamp) {
                    $maxTimestamp = $entryTimestamp;
                }
            } else {
                $entryTimestamp = null;
            }
        }
        $rows[] = ['entry' => $entry, 'timestamp' => $entryTimestamp];
    }

    fclose($file);

    if ($rangeSeconds === null) {
        foreach ($rows as $rowData) {
            $data[] = $rowData['entry'];
        }
        return $data;
    }

    $anchor = $maxTimestamp ?? time();
    $windowEnd = $anchor;
    $windowStart = $anchor - $rangeSeconds;

    if ($period === 'previous') {
        $windowEnd = $anchor - $rangeSeconds;
        $windowStart = $anchor - (2 * $rangeSeconds);
    }

    foreach ($rows as $rowData) {
        $entryTimestamp = $rowData['timestamp'];
        if ($entryTimestamp === null) {
            continue;
        }
        if ($entryTimestamp >= $windowStart && $entryTimestamp <= $windowEnd) {
            $data[] = $rowData['entry'];
        }
    }

    return $data;
}

// Serve data based on endpoint
header('Content-Type: application/json');
switch ($endpoint) {
    case 'cpu':
        echo json_encode(readCsvAsJson("$csvDir/cpu_usage.csv", $range, $period));
        break;
    case 'ram':
        echo json_encode(readCsvAsJson("$csvDir/ram_usage.csv", $range, $period));
        break;
    case 'disk_usage':
        echo json_encode(readCsvAsJson("$csvDir/disk_usage.csv", $range, $period));
        break;
    case 'disk_io':
        $disk = isset($_GET['disk']) ? $_GET['disk'] : 'sda';
        echo json_encode(readCsvAsJson("$csvDir/disk_io_$disk.csv", $range, $period));
        break;
    case 'bandwidth':
        $iface = isset($_GET['iface']) ? $_GET['iface'] : 'eth0';
        echo json_encode(readCsvAsJson("$csvDir/bandwidth_$iface.csv", $range, $period));
        break;
    case 'apache_request_rate':
        echo json_encode(readCsvAsJson("$csvDir/apache_request_rate.csv", $range, $period));
        break;
    default:
        echo json_encode(['error' => 'Invalid endpoint. Use: cpu, ram, disk_usage, disk_io, bandwidth, apache_request_rate']);
}
?>


```
**auth_config.php**
```php
<?php
return [
    'username' => 'agus',
    'password' => 'agus',
];

```
**grafica3.php**
```php
<?php
/**
 * grafica3.php (MetricDeck theme)
 *
 * Expects:
 *   $pieOptions = [
 *       'id'         => 'chart_1',
 *       'width'      => 240,
 *       'showLegend' => true,
 *       'type'       => 'pie' | 'bar' | 'line',
 *       'dataUrl'    => 'api.php?endpoint=cpu',
 *       'auth'       => 'base64_encoded_username:password'
 *   ];
 */

$pieOptions  = isset($pieOptions) && is_array($pieOptions) ? $pieOptions : [];
$baseId      = $pieOptions['id'] ?? uniqid('chart_');
$width       = isset($pieOptions['width']) ? (int)$pieOptions['width'] : 240;
$showLegend  = array_key_exists('showLegend', $pieOptions) ? (bool)$pieOptions['showLegend'] : true;
$chartType   = isset($pieOptions['type']) ? (string)$pieOptions['type'] : 'pie';
$dataUrl     = isset($pieOptions['dataUrl']) ? (string)$pieOptions['dataUrl'] : null;
$auth        = isset($pieOptions['auth']) ? (string)$pieOptions['auth'] : null;

$svgId        = $baseId . '_svg';
$legendId     = $baseId . '_legend';
$tooltipId    = $baseId . '_tooltip';
$containerId  = $baseId . '_container';

if (!defined('METRICDECK_SVG_CSS_PRINTED')) {
  define('METRICDECK_SVG_CSS_PRINTED', true);
  echo '<style>
    :root{
      --md-bg: #F3F3F1;
      --md-card: #E2DFD7;
      --md-border: #DAC7DC;
      --md-accent: #ED5D5F;
      --md-accent2: #E590B5;
      --md-text: #1f2933;
      --md-muted: #6b7280;
    }

    .md-chart{
      width:100%;
      height:100%;
      display:flex;
      align-items:center;
      justify-content:center;
      gap:12px;
      padding: 10px 12px;
    }

    .md-chart svg{
      flex: 0 0 auto;
      height: 100%;
      max-height: 100%;
      overflow: visible;
    }

    .md-legend{
      flex: 1 1 auto;
      min-width: 140px;
      max-width: 260px;
      font-size: 12px;
      color: rgba(31,41,51,.78);
      max-height: 100%;
      overflow: hidden;
      padding-right: 6px;
    }

    .md-legend-item{
      display:flex;
      align-items:center;
      gap: 10px;
      margin: 6px 0;
      white-space:nowrap;
      overflow:hidden;
      text-overflow:ellipsis;
    }

    .md-legend-color{
      width: 10px;
      height: 10px;
      border-radius: 3px;
      border: 1px solid rgba(218,199,220,.95);
      box-shadow: 0 6px 14px rgba(0,0,0,.08);
      flex: 0 0 auto;
    }

    .md-legend-item span{
      overflow:hidden;
      text-overflow:ellipsis;
    }

    .md-tooltip{
      position: fixed;
      pointer-events: none;
      padding: 10px 14px;
      background: rgba(31,41,51,.96);
      color: rgba(243,243,241,.98);
      border-radius: 8px;
      font-size: 13px;
      font-weight: 500;
      white-space: nowrap;
      z-index: 10000;
      border: 1px solid rgba(255,255,255,.08);
      box-shadow: 0 8px 24px rgba(0,0,0,.28), 0 2px 8px rgba(0,0,0,.16);
      backdrop-filter: blur(12px);
      opacity: 0;
      transition: opacity .15s ease;
      will-change: opacity, left, top;
      /* Start hidden */
      visibility: hidden;
    }
    
    .md-tooltip.visible{
      opacity: 1;
      visibility: visible;
    }

    .md-grid line{
      stroke: rgba(218,199,220,.45);
      stroke-width: 1;
      shape-rendering: crispEdges;
    }
    .md-axis line{
      stroke: rgba(31,41,51,.20);
      stroke-width: 1.2;
      shape-rendering: crispEdges;
    }

    .md-slice, .md-bar, .md-point{
      cursor: pointer;
      transition: transform .2s cubic-bezier(0.4, 0, 0.2, 1), 
                  opacity .2s ease, 
                  filter .2s ease,
                  stroke-width .2s ease;
      transform-box: fill-box;
      transform-origin: 50% 50%;
    }
    .md-slice:hover, .md-bar:hover{
      transform: scale(1.05);
      opacity: .88;
      filter: brightness(1.08) saturate(1.1);
    }
    .md-point:hover{
      transform: scale(1.5);
      filter: brightness(1.15) saturate(1.15);
    }
    .md-slice:active, .md-bar:active, .md-point:active{
      transform: scale(0.98);
    }

    .md-line{ 
      opacity: .92; 
      transition: stroke-width .2s ease, opacity .2s ease;
    }
    
    .md-point-focus{
      filter: drop-shadow(0 0 8px rgba(237,93,95,.5));
    }
    
    /* Mejora para touch devices */
    @media (hover: none) {
      .md-slice, .md-bar, .md-point{
        min-width: 44px;
        min-height: 44px;
      }
    }
  </style>';
}
?>

<div id="<?php echo htmlspecialchars($containerId, ENT_QUOTES); ?>" class="md-chart">
  <svg id="<?php echo htmlspecialchars($svgId, ENT_QUOTES); ?>"
       viewBox="0 0 320 320"
       width="<?php echo $width; ?>"
       height="<?php echo $width; ?>"
       aria-label="MetricDeck chart"></svg>

  <?php if ($showLegend): ?>
    <div id="<?php echo htmlspecialchars($legendId, ENT_QUOTES); ?>" class="md-legend" aria-label="Legend"></div>
  <?php endif; ?>
</div>

<!-- Tooltip fuera del contenedor para que no sea recortado -->
<div id="<?php echo htmlspecialchars($tooltipId, ENT_QUOTES); ?>" class="md-tooltip"></div>

<script>
(function () {
  const svgId      = <?php echo json_encode($svgId); ?>;
  const legendId   = <?php echo json_encode($legendId); ?>;
  const tooltipId  = <?php echo json_encode($tooltipId); ?>;
  const baseId     = <?php echo json_encode($baseId); ?>;
  const showLegend = <?php echo $showLegend ? 'true' : 'false'; ?>;
  const chartType  = <?php echo json_encode($chartType); ?>;
  const dataUrl    = <?php echo json_encode($dataUrl); ?>;
  const auth       = <?php echo json_encode($auth); ?>;

  const svg     = document.getElementById(svgId);
  const legend  = showLegend ? document.getElementById(legendId) : null;
  const tooltip = document.getElementById(tooltipId);
  const deltaBadge = document.getElementById(baseId + "_delta");

  if (!svg || !tooltip || !dataUrl) return;

  // Mover el tooltip al body para evitar problemas de overflow
  document.body.appendChild(tooltip);
  console.log("Tooltip moved to body:", tooltip); // DEBUG

  // MetricDeck palette (tus colores)
  const palette = ["#ED5D5F", "#E590B5", "#DAC7DC", "#E2DFD7"];
  let lastRawData = null;

  function getCurrentRange() {
    const selected = typeof window.metricDeckTimeRange === "string" ? window.metricDeckTimeRange : "1d";
    return ["1h", "1d", "1w", "1m"].includes(selected) ? selected : "1d";
  }

  function buildDataUrl(baseUrl, period) {
    const url = new URL(baseUrl, window.location.href);
    url.searchParams.set("range", getCurrentRange());
    url.searchParams.set("period", period || "current");
    return url.toString();
  }

  function setDeltaBadgeText(text, className) {
    if (!deltaBadge) return;
    deltaBadge.textContent = text;
    deltaBadge.classList.remove("delta-up", "delta-down", "delta-flat");
    deltaBadge.classList.add(className);
  }

  function getLastNumericValue(items) {
    for (let i = items.length - 1; i >= 0; i--) {
      const value = Number(items[i] && items[i].value);
      if (!Number.isNaN(value)) return value;
    }
    return null;
  }

  function updateDeltaBadge(currentItems, previousItems) {
    if (!deltaBadge) return;

    const currentLast = getLastNumericValue(currentItems || []);
    const previousLast = getLastNumericValue(previousItems || []);

    if (currentLast === null || previousLast === null) {
      setDeltaBadgeText("Δ s/comp", "delta-flat");
      return;
    }

    if (previousLast === 0) {
      if (currentLast === 0) {
        setDeltaBadgeText("Δ 0.0%", "delta-flat");
      } else {
        setDeltaBadgeText("Δ n/a", "delta-flat");
      }
      return;
    }

    const deltaPct = ((currentLast - previousLast) / Math.abs(previousLast)) * 100;
    if (deltaPct > 0.05) {
      setDeltaBadgeText("Δ ↑ " + Math.abs(deltaPct).toFixed(1) + "%", "delta-up");
    } else if (deltaPct < -0.05) {
      setDeltaBadgeText("Δ ↓ " + Math.abs(deltaPct).toFixed(1) + "%", "delta-down");
    } else {
      setDeltaBadgeText("Δ 0.0%", "delta-flat");
    }
  }

  function mapRawRows(raw) {
    return raw.map(function (row, idx) {
      const keys = Object.keys(row || {});
      const valueKey = keys.find(k => k !== "date");
      const value = valueKey ? Number(row[valueKey]) : 0;

      let label = "";
      if (row.date) {
        label = formatLabelByRange(row.date);
      }
      if (!label) label = "Item " + (idx + 1);

      return { label, value, color: palette[idx % palette.length] };
    });
  }

  function formatLabelByRange(rawDate) {
    const d = new Date(rawDate);
    if (Number.isNaN(d.getTime())) return String(rawDate);

    const range = getCurrentRange();
    if (range === "1h") {
      return d.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit", second: "2-digit" });
    }

    if (range === "1d") {
      return d.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
    }

    return d.toLocaleString([], {
      day: "2-digit",
      month: "2-digit",
      hour: "2-digit",
      minute: "2-digit",
    });
  }

  function clearChart() {
    while (svg.firstChild) svg.removeChild(svg.firstChild);
    if (legend) while (legend.firstChild) legend.removeChild(legend.firstChild);
  }

  function showTooltip(text, x, y) {
    if (!tooltip) return;
    
    console.log("Showing tooltip:", text, "at", x, y); // DEBUG
    
    tooltip.textContent = text;
    tooltip.classList.add("visible");
    
    // Pequeño delay para medir después de que el contenido se actualice
    requestAnimationFrame(function() {
      const rect = tooltip.getBoundingClientRect();
      const offsetX = 10;
      const offsetY = 10;
      
      // Calcular posición inicial (arriba derecha del cursor)
      let left = x + offsetX;
      let top = y - rect.height - offsetY;
      
      // Ajustar si se sale por la derecha
      if (left + rect.width > window.innerWidth - 10) {
        left = x - rect.width - offsetX;
      }
      
      // Ajustar si se sale por arriba
      if (top < 10) {
        top = y + offsetY;
      }
      
      // Ajustar si se sale por la izquierda
      if (left < 10) {
        left = 10;
      }
      
      tooltip.style.left = left + "px";
      tooltip.style.top = top + "px";
      
      console.log("Tooltip positioned at:", left, top, "opacity:", window.getComputedStyle(tooltip).opacity); // DEBUG
    });
  }
  
  function hideTooltip() {
    if (!tooltip) return;
    tooltip.classList.remove("visible");
  }

  function attachTooltip(el, label, value, extraText) {
    if (!el || !tooltip) return;
    
    el.addEventListener("mouseenter", function (evt) {
      const text = (label || "(sin etiqueta)") + ": " + value.toFixed(1) + (extraText ? (" " + extraText) : "");
      showTooltip(text, evt.clientX, evt.clientY);
    });
    
    el.addEventListener("mousemove", function (evt) {
      if (!tooltip.classList.contains("visible")) return;
      
      const rect = tooltip.getBoundingClientRect();
      const offsetX = 10;
      const offsetY = 10;
      
      let left = evt.clientX + offsetX;
      let top = evt.clientY - rect.height - offsetY;
      
      // Ajustar límites
      if (left + rect.width > window.innerWidth - 10) {
        left = evt.clientX - rect.width - offsetX;
      }
      if (top < 10) {
        top = evt.clientY + offsetY;
      }
      if (left < 10) {
        left = 10;
      }
      
      tooltip.style.left = left + "px";
      tooltip.style.top = top + "px";
    });
    
    el.addEventListener("mouseleave", hideTooltip);
    
    // Touch support para móviles
    el.addEventListener("touchstart", function (evt) {
      evt.preventDefault();
      const touch = evt.touches[0];
      const text = (label || "(sin etiqueta)") + ": " + value.toFixed(1) + (extraText ? (" " + extraText) : "");
      showTooltip(text, touch.clientX, touch.clientY);
    });
    
    el.addEventListener("touchend", function () {
      setTimeout(hideTooltip, 1500);
    });
  }

  function polarToCartesian(cx, cy, r, angleRad) {
    return { x: cx + r * Math.cos(angleRad), y: cy + r * Math.sin(angleRad) };
  }

  function createSlicePath(cx, cy, r, startAngle, endAngle) {
    const start = polarToCartesian(cx, cy, r, startAngle);
    const end   = polarToCartesian(cx, cy, r, endAngle);
    const largeArcFlag = (endAngle - startAngle) > Math.PI ? 1 : 0;
    return [
      "M " + cx + " " + cy,
      "L " + start.x + " " + start.y,
      "A " + r + " " + r + " 0 " + largeArcFlag + " 1 " + end.x + " " + end.y,
      "Z"
    ].join(" ");
  }

  function normalizeData(raw) {
    return raw.map(function (item, index) {
      const value = Number(item.value) || 0;
      const color = item.color || palette[index % palette.length];
      const label = item.label || "";
      return { label, value, color };
    });
  }

  function buildLegend(items, total, showPercent) {
    if (!legend) return;
    items.forEach(function (item) {
      const pct = total > 0 ? (item.value / total * 100) : 0;

      const row = document.createElement("div");
      row.className = "md-legend-item";

      const swatch = document.createElement("div");
      swatch.className = "md-legend-color";
      swatch.style.background = item.color;

      const label = document.createElement("span");
      label.textContent =
        (item.label || "(sin etiqueta)") +
        " — " + item.value.toFixed(1) +
        (showPercent ? (" (" + pct.toFixed(1) + "%)") : "");

      row.appendChild(swatch);
      row.appendChild(label);
      legend.appendChild(row);
    });
  }

  function renderPieChart(items, total) {
    const cx = 160, cy = 160, r = 110;
    let startAngle = -Math.PI / 2;

    items.forEach(function (item) {
      const value = item.value;
      if (value <= 0) return;

      const angle = (value / total) * 2 * Math.PI;
      const endAngle = startAngle + angle;
      const d = createSlicePath(cx, cy, r, startAngle, endAngle);

      const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
      path.setAttribute("d", d);
      path.setAttribute("fill", item.color);
      path.setAttribute("stroke", "rgba(243,243,241,.85)");
      path.setAttribute("stroke-width", "1.2");
      path.classList.add("md-slice");

      const pct = (value / total * 100);
      attachTooltip(path, item.label, value, "(" + pct.toFixed(1) + "%)");

      svg.appendChild(path);
      startAngle = endAngle;
    });
  }

  function renderBarChart(items, total) {
    const top = 28, bottom = 286, left = 38, right = 304;
    const h = bottom - top, w = right - left;

    const maxValue = items.reduce((m, it) => Math.max(m, it.value), 0);
    if (maxValue <= 0) return;

    const grid = document.createElementNS("http://www.w3.org/2000/svg", "g");
    grid.setAttribute("class", "md-grid");
    const steps = 4;
    for (let i = 0; i <= steps; i++) {
      const y = top + (h / steps) * i;
      const line = document.createElementNS("http://www.w3.org/2000/svg", "line");
      line.setAttribute("x1", left);
      line.setAttribute("y1", y);
      line.setAttribute("x2", right);
      line.setAttribute("y2", y);
      grid.appendChild(line);
    }
    svg.appendChild(grid);

    const axis = document.createElementNS("http://www.w3.org/2000/svg", "g");
    axis.setAttribute("class", "md-axis");
    const xAxis = document.createElementNS("http://www.w3.org/2000/svg", "line");
    xAxis.setAttribute("x1", left);
    xAxis.setAttribute("y1", bottom);
    xAxis.setAttribute("x2", right);
    xAxis.setAttribute("y2", bottom);
    axis.appendChild(xAxis);
    svg.appendChild(axis);

    const n = items.length;
    const slot = w / Math.max(n, 1);
    const barW = slot * 0.58;

    items.forEach(function (item, i) {
      const v = item.value;
      const barH = (v / maxValue) * h;
      const x = left + i * slot + (slot - barW) / 2;
      const y = bottom - barH;

      const rect = document.createElementNS("http://www.w3.org/2000/svg", "rect");
      rect.setAttribute("x", x);
      rect.setAttribute("y", y);
      rect.setAttribute("width", barW);
      rect.setAttribute("height", Math.max(0, barH));
      rect.setAttribute("rx", 6);
      rect.setAttribute("fill", item.color);
      rect.setAttribute("opacity", "0.92");
      rect.classList.add("md-bar");

      attachTooltip(rect, item.label, v, "");
      svg.appendChild(rect);
    });
  }

  function renderLineChart(items, total) {
    const top = 28, bottom = 286, left = 38, right = 304;
    const h = bottom - top, w = right - left;

    const maxValue = items.reduce((m, it) => Math.max(m, it.value), 0);
    if (maxValue <= 0) return;

    const grid = document.createElementNS("http://www.w3.org/2000/svg", "g");
    grid.setAttribute("class", "md-grid");
    const steps = 4;
    for (let i = 0; i <= steps; i++) {
      const y = top + (h / steps) * i;
      const line = document.createElementNS("http://www.w3.org/2000/svg", "line");
      line.setAttribute("x1", left);
      line.setAttribute("y1", y);
      line.setAttribute("x2", right);
      line.setAttribute("y2", y);
      grid.appendChild(line);
    }
    svg.appendChild(grid);

    const n = items.length;
    const spacing = n > 1 ? w / (n - 1) : 0;

    let pts = "";
    items.forEach(function (item, idx) {
      const x = left + spacing * idx;
      const y = top + (1 - (item.value / maxValue)) * h;
      pts += x + "," + y + " ";
    });

    const lineColor = items[0] ? items[0].color : palette[0];

    const polyline = document.createElementNS("http://www.w3.org/2000/svg", "polyline");
    polyline.setAttribute("points", pts.trim());
    polyline.setAttribute("fill", "none");
    polyline.setAttribute("stroke", lineColor);
    polyline.setAttribute("stroke-width", 2.8);
    polyline.setAttribute("stroke-linejoin", "round");
    polyline.setAttribute("stroke-linecap", "round");
    polyline.classList.add("md-line");
    svg.appendChild(polyline);

    items.forEach(function (item, idx) {
      const x = left + spacing * idx;
      const y = top + (1 - (item.value / maxValue)) * h;

      const c = document.createElementNS("http://www.w3.org/2000/svg", "circle");
      c.setAttribute("cx", x);
      c.setAttribute("cy", y);
      c.setAttribute("r", 5);
      c.setAttribute("fill", item.color);
      c.setAttribute("stroke", "rgba(243,243,241,.95)");
      c.setAttribute("stroke-width", "2");
      c.classList.add("md-point");

      attachTooltip(c, item.label, item.value, "");
      svg.appendChild(c);
    });
  }

  function renderChart(raw) {
    clearChart();
    hideTooltip();

    const items = normalizeData(raw);
    const total = items.reduce((s, it) => s + it.value, 0);

    if (total === 0) {
      if (legend) {
        const msg = document.createElement("div");
        msg.textContent = "Sin datos (total = 0).";
        legend.appendChild(msg);
      }
      return;
    }

    if (chartType === "bar") renderBarChart(items, total);
    else if (chartType === "line") renderLineChart(items, total);
    else renderPieChart(items, total);

    // % solo para pie (tiene sentido)
    buildLegend(items, total, chartType === "pie");
  }

  function animateTransition(fromRaw, toRaw, durationMs) {
    const from = normalizeData(fromRaw);
    const to = normalizeData(toRaw);
    const maxLen = Math.max(from.length, to.length);

    const fromP = [];
    const toP = [];
    for (let i = 0; i < maxLen; i++) {
      const f = from[i] || { label: (to[i] ? to[i].label : ""), value: 0, color: (to[i] ? to[i].color : palette[i % palette.length]) };
      const t = to[i]   || { label: (from[i] ? from[i].label : ""), value: 0, color: (from[i] ? from[i].color : palette[i % palette.length]) };
      fromP.push(f);
      toP.push(t);
    }

    const start = performance.now();
    function frame(now) {
      const elapsed = now - start;
      const tNorm = Math.min(1, elapsed / durationMs);

      const current = fromP.map((f, i) => ({
        label: toP[i].label,
        value: f.value + (toP[i].value - f.value) * tNorm,
        color: toP[i].color
      }));

      renderChart(current);
      if (tNorm < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }

  async function loadAndRender() {
    try {
      const headers = {};
      if (auth) headers["Authorization"] = "Basic " + auth;

      const currentUrl = buildDataUrl(dataUrl, "current");
      const previousUrl = buildDataUrl(dataUrl, "previous");

      const [currentRes, previousRes] = await Promise.all([
        fetch(currentUrl, { headers, cache: "no-store" }),
        fetch(previousUrl, { headers, cache: "no-store" })
      ]);

      if (!currentRes.ok) return;

      const raw = await currentRes.json();
      const previousRaw = previousRes.ok ? await previousRes.json() : [];

      if (Array.isArray(raw)) {
        const formatted = mapRawRows(raw);
        const previousFormatted = Array.isArray(previousRaw) ? mapRawRows(previousRaw) : [];
        updateDeltaBadge(formatted, previousFormatted);

        if (!lastRawData) {
          lastRawData = formatted;
          renderChart(formatted);
        } else {
          animateTransition(lastRawData, formatted, 420);
          lastRawData = formatted;
        }
      } else if (raw && typeof raw === "object" && raw.error) {
        clearChart();
        setDeltaBadgeText("Δ s/comp", "delta-flat");
        if (legend) {
          const msg = document.createElement("div");
          msg.textContent = raw.error;
          legend.appendChild(msg);
        }
      }
    } catch (e) {
      setDeltaBadgeText("Δ s/comp", "delta-flat");
      // Silencioso en UI
    }
  }

  loadAndRender();
  setInterval(loadAndRender, 10000);
  document.addEventListener("metricdeck:range-changed", function () {
    lastRawData = null;
    loadAndRender();
  });
})();
</script>

```
**index.php**
```php
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>MetricDeck</title>
  <link rel="icon" type="image/png" href="logo_azul.png">
  <link rel="apple-touch-icon" href="logo_azul.png">

  <style>
    :root{
      /* Paleta */
      --bg: #F3F3F1;
      --card: #E2DFD7;
      --border: #DAC7DC;
      --accent: #ED5D5F;
      --accent2: #E590B5;

      /* Neutros */
      --text: #1f2933;
      --muted: #6b7280;

      --gap: 16px;
      --radius: 12px;
    }

    * { box-sizing: border-box; }
    
    html { scroll-behavior: smooth; }

    body{
      margin:0;
      min-height:100vh;
      background: var(--bg);
      color: var(--text);
      font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      font-weight: 400;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* Topbar */
    .topbar{
      position: sticky;
      top: 0;
      z-index: 20;
      backdrop-filter: blur(12px) saturate(180%);
      background: rgba(243,243,241,.90);
      border-bottom: 1px solid rgba(218,199,220,.4);
      box-shadow: 0 1px 0 0 rgba(255,255,255,.5);
    }
    .topbar-inner{
      padding: 18px 20px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap: 16px;
      margin: 0;
      max-width: 1600px;
      margin: 0 auto;
    }

    .brand{
      display:flex;
      align-items:center;
      gap: 12px;
      min-width: 220px;
    }
    .brand-mark{
      width: 38px;
      height: 38px;
      border-radius: 11px;
      background:
        radial-gradient(circle at 30% 25%, rgba(237,93,95,.45), transparent 60%),
        radial-gradient(circle at 70% 75%, rgba(229,144,181,.40), transparent 60%),
        linear-gradient(135deg, rgba(218,199,220,.5), rgba(226,223,215,.7));
      border: 1px solid rgba(218,199,220,.6);
      box-shadow: 0 2px 8px rgba(0,0,0,.06), inset 0 1px 0 rgba(255,255,255,.3);
    }
    .brand-title{
      line-height: 1.3;
    }
    .brand-title strong{
      display:block;
      font-size: 15px;
      letter-spacing: -.01em;
      font-weight: 600;
      color: var(--text);
    }
    .brand-title span{
      display:block;
      margin-top: 1px;
      font-size: 12px;
      color: #52606D;
      font-weight: 400;
    }

    .topbar-right{
      display:flex;
      align-items:center;
      gap: 12px;
      flex-wrap: wrap;
    }
    .pill{
      display:inline-flex;
      align-items:center;
      gap: 8px;
      padding: 7px 12px;
      border-radius: 8px;
      background: rgba(226,223,215,.45);
      border: 1px solid rgba(218,199,220,.5);
      color: var(--text);
      font-size: 12px;
      font-weight: 500;
      white-space: nowrap;
      cursor: default;
      user-select: none;
    }
    .pill-select{
      appearance: none;
      border: 1px solid rgba(218,199,220,.5);
      background: rgba(255,255,255,.6);
      color: var(--text);
      border-radius: 6px;
      padding: 5px 10px;
      font-size: 12px;
      font-weight: 500;
      outline: none;
      cursor: pointer;
      transition: all .15s ease;
      min-height: 32px;
      -webkit-tap-highlight-color: transparent;
    }
    .pill-select:hover{
      background: rgba(255,255,255,.8);
      border-color: rgba(218,199,220,.7);
    }
    .pill-select:active{
      transform: scale(0.98);
    }
    .pill-select:focus{
      border-color: var(--accent2);
      box-shadow: 0 0 0 3px rgba(229,144,181,.2);
    }
    .pill-select:focus-visible{
      outline: 2px solid var(--accent2);
      outline-offset: 2px;
    }
    .dot{
      width: 7px;
      height: 7px;
      border-radius: 99px;
      background: var(--accent);
      box-shadow: 0 0 0 3px rgba(237,93,95,.15);
      animation: pulse 2s ease-in-out infinite;
    }
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: .6; }
    }

    /* Wrapper */
    .wrap{
      min-height:100vh;
      margin: 0 auto;
      padding: 20px;
      max-width: 1600px;
    }

    .headline{
      display:flex;
      align-items:flex-end;
      justify-content:space-between;
      gap: 20px;
      padding: 16px 0 12px;
    }
    .headline h1{
      margin: 0;
      font-size: 24px;
      font-weight: 600;
      letter-spacing: -.02em;
      color: var(--text);
    }
    .headline p{
      margin: 8px 0 0;
      color: var(--muted);
      font-size: 14px;
      line-height: 1.5;
      max-width: 70ch;
    }

    /* Grid con más respiro */
    .grid{
      display:grid;
      grid-template-columns: repeat(5, 1fr);
      grid-auto-rows: 220px;
      grid-auto-flow: dense;
      gap: var(--gap);
      padding: 12px 0 32px;
    }

    /* Cards minimalistas */
    .card{
      position: relative;
      background: var(--card);
      border-radius: var(--radius);
      border: 1px solid rgba(218,199,220,.5);
      box-shadow: 0 2px 8px rgba(0,0,0,.04), 0 1px 2px rgba(0,0,0,.06);
      overflow:hidden;
      isolation:isolate;
      transition: all .2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Textura sutil y minimalista */
    .card::before{
      content:"";
      position:absolute;
      inset:0;
      background:
        radial-gradient(circle at 25% 20%, rgba(237,93,95,.04), transparent 65%),
        radial-gradient(circle at 75% 80%, rgba(229,144,181,.04), transparent 65%);
      pointer-events:none;
      opacity:1;
    }

    .card:hover{
      transform: translateY(-2px);
      box-shadow: 0 8px 16px rgba(0,0,0,.08), 0 2px 4px rgba(0,0,0,.06);
      border-color: rgba(218,199,220,.7);
    }

    .card-header{
      position:absolute;
      top: 14px;
      left: 14px;
      right: 14px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap: 10px;
      z-index: 2;
      pointer-events:none;
    }

    .label{
      display:inline-flex;
      align-items:center;
      gap: 7px;
      padding: 6px 11px;
      border-radius: 8px;
      font-size: 10px;
      letter-spacing: .12em;
      text-transform: uppercase;
      font-weight: 600;
      color: var(--text);
      background: rgba(243,243,241,.85);
      border: 1px solid rgba(218,199,220,.5);
      backdrop-filter: blur(8px);
      user-select: none;
      -webkit-user-select: none;
    }
    .label .mini{
      width: 6px;
      height: 6px;
      border-radius: 99px;
      background: var(--accent2);
      box-shadow: 0 0 0 2px rgba(229,144,181,.15);
    }

    .meta{
      display:flex;
      align-items:center;
      gap: 7px;
      font-size: 11px;
      color: var(--muted);
    }
    .meta b{
      color: var(--text);
      font-weight: 600;
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: .05em;
    }
    @media(max-width: 600px){
      .meta b{ display: none; }
    }
    .delta-badge{
      padding: 4px 7px;
      border-radius: 6px;
      border: 1px solid rgba(218,199,220,.4);
      background: rgba(243,243,241,.7);
      color: #52606D;
      font-size: 10px;
      font-weight: 600;
      line-height: 1;
    }
    .delta-up{
      color: #C7548C;
      border-color: rgba(229,144,181,.4);
      background: rgba(229,144,181,.15);
    }
    .delta-down{
      color: #D84547;
      border-color: rgba(237,93,95,.4);
      background: rgba(237,93,95,.15);
    }
    .delta-flat{
      color: #52606D;
    }

    .card-body{
      position:relative;
      z-index: 1;
      width:100%;
      height:100%;
      padding: 50px 12px 12px;
      display:flex;
      align-items:center;
      justify-content:center;
    }

    /* Estados de carga */
    .card.loading::after{
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(243,243,241,.6);
      backdrop-filter: blur(2px);
      z-index: 10;
      animation: fadeIn .3s ease;
    }
    
    /* Skeleton loader */
    .card-body.skeleton{
      position: relative;
      overflow: hidden;
    }
    .card-body.skeleton::before{
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(
        90deg,
        transparent 0%,
        rgba(218,199,220,.2) 50%,
        transparent 100%
      );
      animation: shimmer 1.5s infinite;
    }
    @keyframes shimmer {
      0% { transform: translateX(-100%); }
      100% { transform: translateX(100%); }
    }
    
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    /* Mejoras de accesibilidad */
    *:focus-visible {
      outline: 2px solid var(--accent2);
      outline-offset: 2px;
    }
    
    /* Reducir animaciones si el usuario lo prefiere */
    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
      html { scroll-behavior: auto; }
    }

    /* Responsive */
    @media(max-width: 1200px){
      .grid{ grid-template-columns: repeat(3, 1fr); }
    }
    @media(max-width: 1000px){
      .grid{ grid-template-columns: repeat(2, 1fr); }
      .wrap{ padding: 16px; }
    }
    @media(max-width: 600px){
      .grid{ 
        grid-template-columns: 1fr; 
        grid-auto-rows: 260px;
      }
      .topbar-inner{ 
        padding: 14px 16px;
      }
      .topbar-right{
        width: 100%;
        justify-content: flex-start;
      }
      .headline{ 
        flex-direction: column; 
        align-items:flex-start;
        padding: 12px 0 8px;
      }
      .headline h1{
        font-size: 22px;
      }
      .headline p{
        font-size: 13px;
      }
      .wrap{ padding: 12px; }
      .card-header{
        top: 12px;
        left: 12px;
        right: 12px;
      }
      .pill{
        font-size: 11px;
        padding: 6px 10px;
        min-height: 36px;
      }
      .pill-select{
        min-height: 40px;
        padding: 8px 12px;
      }
    }
  </style>
</head>

<body>
  <header class="topbar">
    <div class="topbar-inner">
      <div class="brand">
        <div class="brand-mark" aria-hidden="true"></div>
        <div class="brand-title">
          <strong>MetricDeck</strong>
          <span>Server monitoring dashboard</span>
        </div>
      </div>

      <div class="topbar-right">
        <div class="pill" role="status" aria-live="polite" aria-label="Estado del servidor">
          <span class="dot"></span> Live
        </div>
        <div class="pill" aria-label="Tiempo de actualización automática">
          Auto-refresh: <b>10s</b>
        </div>
        <div class="pill">
          Rango:
          <select id="timeRangeSelect" class="pill-select" aria-label="Seleccionar rango de tiempo">
            <option value="1h">1 hora</option>
            <option value="1d">1 día</option>
            <option value="1w">1 semana</option>
            <option value="1m">1 mes</option>
          </select>
        </div>
      </div>
    </div>
  </header>

  <main class="wrap" role="main">
    <section class="headline">
      <div>
        <h1>Panel de métricas</h1>
        <p>Dashboard para monitorizar métricas del servidor en tiempo real.</p>
      </div>
    </section>

    <section class="grid" role="region" aria-label="Gráficos de monitoreo">
      <?php
        $endpoints = [
          ['endpoint' => 'cpu', 'type' => 'line', 'label' => 'CPU'],
          ['endpoint' => 'ram', 'type' => 'bar', 'label' => 'RAM'],
          ['endpoint' => 'disk_usage', 'type' => 'pie', 'label' => 'DISK'],
          ['endpoint' => 'disk_io', 'type' => 'line', 'label' => 'DISK I/O', 'disk' => 'sda'],
          ['endpoint' => 'bandwidth', 'type' => 'bar', 'label' => 'BANDWIDTH', 'iface' => 'eth0'],
          ['endpoint' => 'apache_request_rate', 'type' => 'line', 'label' => 'REQUEST RATE'],
        ];

        $apiBaseUrl = 'api.php?endpoint=';

        $authConfig = require __DIR__ . '/auth_config.php';
        $username = (string)($authConfig['username'] ?? '');
        $password = (string)($authConfig['password'] ?? '');

        // Tamaños (como tu versión original, pero “controlados”)
        $sizes = [
          ['c'=>1,'r'=>1],
          ['c'=>2,'r'=>1],
          ['c'=>1,'r'=>2],
          ['c'=>2,'r'=>2],
        ];

        foreach ($endpoints as $index => $endpoint) {
          $endpointUrl = $apiBaseUrl . $endpoint['endpoint'];
          if (isset($endpoint['disk'])) $endpointUrl .= '&disk=' . $endpoint['disk'];
          if (isset($endpoint['iface'])) $endpointUrl .= '&iface=' . $endpoint['iface'];

          $pieOptions = [
            'id'         => 'chart_' . $index,
            'width'      => 240,
            'showLegend' => true,
            'type'       => $endpoint['type'],
            'dataUrl'    => $endpointUrl,
            'auth'       => base64_encode("$username:$password"),
          ];

          $size = $sizes[array_rand($sizes)];

          echo '<article class="card"
              style="grid-column: span ' . $size['c'] . '; grid-row: span ' . $size['r'] . ';"
              role="article"
              aria-label="Gráfico de ' . htmlspecialchars($endpoint["label"]) . '">
                <div class="card-header">
                  <div class="label"><span class="mini"></span>' . htmlspecialchars($endpoint["label"]) . '</div>
                  <div class="meta"><b>' . htmlspecialchars($endpoint["type"]) . '</b><span id="chart_' . $index . '_delta" class="delta-badge delta-flat" aria-live="polite">—</span></div>
                </div>
                <div class="card-body">';

          include "grafica3.php";

          echo '  </div>
              </article>';
        }
      ?>
    </section>
  </main>

  <script>
    (function () {
      const selector = document.getElementById("timeRangeSelect");
      if (!selector) return;

      const storageKey = "metricdeck_time_range";
      const validRanges = new Set(["1h", "1d", "1w", "1m"]);
      const savedRange = localStorage.getItem(storageKey);
      const initialRange = validRanges.has(savedRange) ? savedRange : "1d";

      selector.value = initialRange;
      window.metricDeckTimeRange = initialRange;

      selector.addEventListener("change", function () {
        const selected = validRanges.has(selector.value) ? selector.value : "1d";
        window.metricDeckTimeRange = selected;
        localStorage.setItem(storageKey, selected);
        document.dispatchEvent(new CustomEvent("metricdeck:range-changed", { detail: { range: selected } }));
      });
    })();
  </script>
</body>
</html>

```
**server_monitor.py**
```python
# server_monitor.py
import psutil
import csv
from datetime import datetime, timedelta
import re
import os
from pytz import timezone  # You may need to install pytz: pip install pytz

# --- Config ---
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
CSV_DIR = os.path.join(BASE_DIR, "monitor_data")
os.makedirs(CSV_DIR, exist_ok=True)

# --- Helper Functions ---
def sanitize_filename(filename):
    """Remove or replace invalid characters for Windows filenames."""
    # Invalid characters in Windows: < > : " / \ | ? *
    invalid_chars = '<>:"/\\|?*'
    for char in invalid_chars:
        filename = filename.replace(char, '_')
    return filename

def save_to_csv(filename, headers, data):
    """Saves data to CSV, creating headers if the file doesn't exist."""
    filename = sanitize_filename(filename)
    filepath = os.path.join(CSV_DIR, filename)
    file_exists = os.path.isfile(filepath)
    with open(filepath, 'a', newline='') as f:
        writer = csv.writer(f)
        if not file_exists:
            writer.writerow(headers)
        writer.writerow(data)

# --- CPU Monitoring ---
def monitor_cpu():
    cpu_usage = psutil.cpu_percent(interval=1)
    save_to_csv('cpu_usage.csv', ['date', 'cpu_usage'], [datetime.now().strftime('%Y-%m-%d %H:%M:%S'), cpu_usage])

# --- RAM Monitoring ---
def monitor_ram():
    ram = psutil.virtual_memory()
    save_to_csv('ram_usage.csv', ['date', 'ram_usage_percent', 'ram_total_gb'],
                [datetime.now().strftime('%Y-%m-%d %H:%M:%S'), ram.percent, round(ram.total / (1024 ** 3), 2)])

# --- Disk I/O Monitoring ---
def monitor_disk_io():
    disk_io_counters = psutil.disk_io_counters(perdisk=True)  # Fixed: Added this line
    for disk, io in disk_io_counters.items():
        busy_time = getattr(io, 'busy_time', None)
        save_to_csv(f'disk_io_{disk}.csv',
                    ['date', 'read_bytes', 'write_bytes', 'read_ops', 'write_ops', 'read_time_ms', 'write_time_ms', 'busy_time_ms'],
                    [datetime.now().strftime('%Y-%m-%d %H:%M:%S'), io.read_bytes, io.write_bytes, io.read_count, io.write_count, io.read_time, io.write_time, busy_time])

# --- Disk Usage Monitoring ---
def monitor_disk_usage():
    disk_usage = psutil.disk_usage('/')
    save_to_csv('disk_usage.csv',
                ['date', 'disk_usage_percent', 'disk_total_gb', 'disk_free_gb'],
                [datetime.now().strftime('%Y-%m-%d %H:%M:%S'), disk_usage.percent, round(disk_usage.total / (1024 ** 3), 2), round(disk_usage.free / (1024 ** 3), 2)])

# --- Bandwidth Monitoring ---
def monitor_bandwidth():
    net_io = psutil.net_io_counters(pernic=True)
    for iface, io in net_io.items():
        save_to_csv(f'bandwidth_{iface}.csv',
                    ['date', 'bytes_sent', 'bytes_recv', 'packets_sent', 'packets_recv'],
                    [datetime.now().strftime('%Y-%m-%d %H:%M:%S'), io.bytes_sent, io.bytes_recv, io.packets_sent, io.packets_recv])

# --- Apache2 Request Rate Monitoring ---
def monitor_apache_request_rate():
    ACCESS_LOG = '/var/log/apache2/access.log'
    if not os.path.exists(ACCESS_LOG):
        return
    request_counts = {}
    current_time = datetime.now(timezone('UTC'))  # Make current_time timezone-aware
    time_window = timedelta(minutes=1)

    with open(ACCESS_LOG, 'r') as f:
        for line in f:
            match = re.search(r'\[([^\]]+)\]', line)
            if match:
                timestamp_str = match.group(1)
                timestamp = datetime.strptime(timestamp_str, '%d/%b/%Y:%H:%M:%S %z')  # Already timezone-aware
                if (current_time - timestamp) <= time_window:
                    minute_key = timestamp.strftime('%Y-%m-%d %H:%M')
                    request_counts[minute_key] = request_counts.get(minute_key, 0) + 1

    for minute, count in request_counts.items():
        save_to_csv('apache_request_rate.csv', ['date', 'requests_per_minute'], [minute, count])

# --- Main ---
if __name__ == '__main__':
    monitor_cpu()
    monitor_ram()
    monitor_disk_io()
    monitor_disk_usage()
    monitor_bandwidth()
    monitor_apache_request_rate()
    print("Monitoring data saved.")


```
## monitor_data