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