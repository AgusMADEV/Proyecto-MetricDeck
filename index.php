<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>MetricDeck</title>

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
