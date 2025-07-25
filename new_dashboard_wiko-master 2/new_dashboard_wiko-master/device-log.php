<?php
$logFile = 'device_status.log';
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage = isset($_GET['per_page']) ? max(1, intval($_GET['per_page'])) : 20;
if (file_exists($logFile)) {
    $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $logs = [];
    foreach ($lines as $line) {
        // Format: [timestamp] [device_name] [status]
        if (preg_match('/^(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}) (.+) (ONLINE|OFFLINE)$/', $line, $matches)) {
            $logs[] = [
                'timestamp' => $matches[1],
                'device' => $matches[2],
                'status' => $matches[3]
            ];
        }
    }
    $logs = array_reverse($logs); // terbaru di atas
    $total = count($logs);
    $totalPages = ceil($total / $perPage);
    $start = ($page - 1) * $perPage;
    $pagedLogs = array_slice($logs, $start, $perPage);
    echo json_encode([
        'logs' => $pagedLogs,
        'total' => $total,
        'total_pages' => $totalPages,
        'page' => $page,
        'per_page' => $perPage
    ]);
} else {
    echo json_encode([
        'logs' => [],
        'total' => 0,
        'total_pages' => 0,
        'page' => $page,
        'per_page' => $perPage
    ]);
}
