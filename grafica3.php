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
      padding: 8px 10px;
      background: rgba(243,243,241,.96);
      color: rgba(31,41,51,.92);
      border-radius: 10px;
      font-size: 12px;
      transform: translate(-50%, -130%);
      white-space: nowrap;
      display: none;
      z-index: 9999;
      border: 1px solid rgba(218,199,220,.95);
      box-shadow: 0 14px 30px rgba(0,0,0,.18);
      backdrop-filter: blur(10px);
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
      transition: transform .16s ease, opacity .16s ease, filter .16s ease;
      transform-box: fill-box;
      transform-origin: 50% 50%;
    }
    .md-slice:hover, .md-bar:hover, .md-point:hover{
      transform: scale(1.03);
      opacity: .92;
      filter: saturate(1.05);
    }

    .md-line{ opacity: .96; }
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

  <div id="<?php echo htmlspecialchars($tooltipId, ENT_QUOTES); ?>" class="md-tooltip"></div>
</div>

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
    tooltip.textContent = text;
    tooltip.style.left = x + "px";
    tooltip.style.top  = y + "px";
    tooltip.style.display = "block";
  }
  function hideTooltip() {
    tooltip.style.display = "none";
  }

  function attachTooltip(el, label, value, extraText) {
    if (!el) return;
    el.addEventListener("mouseenter", function (evt) {
      const text = (label || "(sin etiqueta)") + ": " + value.toFixed(1) + (extraText ? (" " + extraText) : "");
      showTooltip(text, evt.clientX, evt.clientY - 10);
    });
    el.addEventListener("mousemove", function (evt) {
      tooltip.style.left = evt.clientX + "px";
      tooltip.style.top  = (evt.clientY - 10) + "px";
    });
    el.addEventListener("mouseleave", hideTooltip);
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
      rect.setAttribute("rx", 8);
      rect.setAttribute("fill", item.color);
      rect.setAttribute("opacity", "0.95");
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
    polyline.setAttribute("stroke-width", 2.2);
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
      c.setAttribute("r", 4.2);
      c.setAttribute("fill", item.color);
      c.setAttribute("stroke", "rgba(243,243,241,.95)");
      c.setAttribute("stroke-width", "1.2");
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
