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

