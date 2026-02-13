<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>MetricDeck</title>

  <style>
    :root{
      /* Paleta (la tuya) */
      --bg: #F3F3F1;
      --card: #E2DFD7;
      --border: #DAC7DC;
      --accent: #ED5D5F;
      --accent2: #E590B5;

      /* Neutros */
      --text: #1f2933;
      --muted: #6b7280;

      --gap: 12px;
      --radius: 16px;
    }

    * { box-sizing: border-box; }

    body{
      margin:0;
      min-height:100vh;
      background: var(--bg);
      color: var(--text);
      font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    /* Topbar */
    .topbar{
      position: sticky;
      top: 0;
      z-index: 20;
      backdrop-filter: blur(10px);
      background: rgba(243,243,241,.82);
      border-bottom: 1px solid rgba(218,199,220,.75);
    }
    .topbar-inner{
      padding: 14px 14px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap: 12px;
      margin: 0;
    }

    .brand{
      display:flex;
      align-items:center;
      gap: 10px;
      min-width: 220px;
    }
    .brand-mark{
      width: 34px;
      height: 34px;
      border-radius: 10px;
      background:
        radial-gradient(circle at 30% 25%, rgba(237,93,95,.60), transparent 55%),
        radial-gradient(circle at 70% 75%, rgba(229,144,181,.55), transparent 55%),
        linear-gradient(135deg, rgba(218,199,220,.7), rgba(226,223,215,.85));
      border: 1px solid rgba(218,199,220,.95);
      box-shadow: 0 8px 20px rgba(0,0,0,.08);
    }
    .brand-title{
      line-height: 1.05;
    }
    .brand-title strong{
      display:block;
      font-size: 14px;
      letter-spacing: .02em;
    }
    .brand-title span{
      display:block;
      margin-top: 2px;
      font-size: 12px;
      color: var(--muted);
    }

    .topbar-right{
      display:flex;
      align-items:center;
      gap: 10px;
    }
    .pill{
      display:inline-flex;
      align-items:center;
      gap: 8px;
      padding: 8px 10px;
      border-radius: 999px;
      background: rgba(226,223,215,.65);
      border: 1px solid rgba(218,199,220,.90);
      color: var(--muted);
      font-size: 12px;
      white-space: nowrap;
    }
    .dot{
      width: 9px;
      height: 9px;
      border-radius: 99px;
      background: var(--accent);
      box-shadow: 0 0 0 4px rgba(237,93,95,.14);
    }

    /* Wrapper */
    .wrap{
      min-height:100vh;
      margin: 0;
      padding: 14px;
    }

    .headline{
      display:flex;
      align-items:flex-end;
      justify-content:space-between;
      gap: 14px;
      padding: 10px 0 6px;
    }
    .headline h1{
      margin: 0;
      font-size: 20px;
      letter-spacing: .01em;
    }
    .headline p{
      margin: 6px 0 0;
      color: var(--muted);
      font-size: 13px;
      max-width: 70ch;
    }

    /* ✅ Grid ORIGINAL (denso y libre) */
    .grid{
      display:grid;
      grid-template-columns: repeat(5, 1fr);
      grid-auto-rows: 220px;
      grid-auto-flow: dense;
      gap: var(--gap);
      padding: 10px 0 24px;
    }

    /* Cards */
    .card{
      position: relative;
      background: var(--card);
      border-radius: var(--radius);
      border: 1px solid rgba(218,199,220,.95);
      box-shadow: 0 10px 26px rgba(0,0,0,.10);
      overflow:hidden;
      isolation:isolate;
      transition: transform .18s ease, box-shadow .18s ease;
    }

    /* Cinematic texture */
    .card::before{
      content:"";
      position:absolute;
      inset:0;
      background:
        radial-gradient(circle at 20% 15%, rgba(237,93,95,.10), transparent 58%),
        radial-gradient(circle at 80% 80%, rgba(229,144,181,.10), transparent 58%);
      pointer-events:none;
      opacity:.9;
      mix-blend-mode:multiply;
    }
    .card::after{
      content:"";
      position:absolute;
      inset:0;
      background:
        repeating-linear-gradient(
          135deg,
          rgba(31,41,51,.04) 0 1px,
          transparent 1px 6px
        );
      opacity:.22;
      pointer-events:none;
    }

    .card:hover{
      transform: translateY(-1px);
      box-shadow: 0 16px 34px rgba(0,0,0,.14);
    }

    .card-header{
      position:absolute;
      top: 12px;
      left: 12px;
      right: 12px;
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
      gap: 8px;
      padding: 7px 10px;
      border-radius: 999px;
      font-size: 11px;
      letter-spacing: .14em;
      text-transform: uppercase;
      color: rgba(31,41,51,.78);
      background: rgba(243,243,241,.74);
      border: 1px solid rgba(218,199,220,.95);
      backdrop-filter: blur(6px);
    }
    .label .mini{
      width: 8px;
      height: 8px;
      border-radius: 99px;
      background: var(--accent2);
      box-shadow: 0 0 0 4px rgba(229,144,181,.16);
    }

    .meta{
      display:flex;
      align-items:center;
      gap: 8px;
      font-size: 12px;
      color: var(--muted);
    }
    .meta b{
      color: rgba(31,41,51,.85);
      font-weight: 600;
    }

    .card-body{
      position:relative;
      z-index: 1;
      width:100%;
      height:100%;
      padding: 48px 10px 10px; /* espacio para la etiqueta */
      display:flex;
      align-items:center;
      justify-content:center;
    }

    /* Responsive */
    @media(max-width: 1000px){
      .grid{ grid-template-columns: repeat(2, 1fr); }
    }
    @media(max-width: 600px){
      .grid{ grid-template-columns: 1fr; }
      .topbar-inner{ flex-direction: column; align-items:flex-start; }
      .headline{ flex-direction: column; align-items:flex-start; }
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
        <div class="pill"><span class="dot"></span> Live</div>
        <div class="pill">Auto-refresh: <b>10s</b></div>
      </div>
    </div>
  </header>

  <main class="wrap">
    <section class="headline">
      <div>
        <h1>Panel de métricas</h1>
        <p>Dashboard para monitorizar métricas del servidor en tiempo real.</p>
      </div>
    </section>

    <section class="grid">
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
              style="grid-column: span ' . $size['c'] . '; grid-row: span ' . $size['r'] . ';">
                <div class="card-header">
                  <div class="label"><span class="mini"></span>' . htmlspecialchars($endpoint["label"]) . '</div>
                  <div class="meta">' . htmlspecialchars($endpoint["type"]) . '</b></div>
                </div>
                <div class="card-body">';

          include "grafica3.php";

          echo '  </div>
              </article>';
        }
      ?>
    </section>
  </main>
</body>
</html>
