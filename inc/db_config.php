<?php
/**
 * Antara Globale - Dynamic Database Configuration
 * Supports Local Development (XAMPP) & Production (Hostinger hPanel / cPanel)
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Disable fatal mysqli exceptions in PHP 8+ so we can handle errors gracefully
if (function_exists('mysqli_report')) {
    mysqli_report(MYSQLI_REPORT_OFF);
}

// 1. Check for custom production override config
$prod_config_found = false;
$prod_paths = [
    __DIR__ . '/db_config.prod.php',
    __DIR__ . '/../db_config.prod.php',
    dirname(__DIR__) . '/db_config.prod.php'
];

foreach ($prod_paths as $p) {
    if (file_exists($p)) {
        require_once $p;
        $prod_config_found = true;
        break;
    }
}

if (!$prod_config_found) {
    // 2. Environment Variables or Automatic Host Detection
    $is_localhost = in_array($_SERVER['SERVER_NAME'] ?? 'localhost', ['localhost', '127.0.0.1', '::1']) 
                    || php_sapi_name() === 'cli';

    if ($is_localhost) {
        $db_host = getenv('DB_HOST') ?: 'localhost';
        $db_user = getenv('DB_USER') ?: 'root';
        $db_pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
        $db_name = getenv('DB_NAME') ?: 'anahat_db';
    } else {
        // Fallback production default credentials for Hostinger
        $db_host = getenv('DB_HOST') ?: 'localhost';
        $db_user = getenv('DB_USER') ?: 'u345262298_antara_user';
        $db_pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
        $db_name = getenv('DB_NAME') ?: 'u345262298_antara';
    }
}

// Ensure variables are defined
$db_host = $db_host ?? 'localhost';
$db_user = $db_user ?? 'root';
$db_pass = $db_pass ?? '';
$db_name = $db_name ?? 'anahat_db';

// 3. Establish Shared MySQLi Connection
if (!isset($conn) || !$conn) {
    $conn = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        $err = mysqli_connect_error();
        $errno = mysqli_connect_errno();
        
        // Render a clean diagnostic message
        http_response_code(500);
        echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>Database Setup - Antara Globale</title>";
        echo "<style>body{font-family:Segoe UI,Roboto,sans-serif;background:#0A1C14;color:#FFF;padding:40px;text-align:center;}";
        echo ".box{background:#112A1E;border:1px solid #C5A059;padding:30px;border-radius:12px;max-width:620px;margin:40px auto;text-align:left;box-shadow:0 8px 30px rgba(0,0,0,0.5);}";
        echo "h2{color:#C5A059;margin-top:0;font-size:22px;}pre{background:#06100B;padding:14px;border-radius:6px;color:#A3E635;overflow-x:auto;font-size:13px;}";
        echo "code{color:#F59E0B;background:rgba(0,0,0,0.3);padding:2px 6px;border-radius:4px;}</style></head><body>";
        echo "<div class='box'>";
        echo "<h2>Antara Globale &bull; Database Connection Needed</h2>";
        echo "<p>Could not connect to database <code>" . htmlspecialchars($db_name) . "</code> using user <code>" . htmlspecialchars($db_user) . "</code>.</p>";
        echo "<p><strong>Error Message:</strong> (" . htmlspecialchars((string)$errno) . ") " . htmlspecialchars((string)$err) . "</p>";
        echo "<hr style='border:none;border-top:1px solid rgba(255,255,255,0.1);margin:20px 0;'>";
        echo "<p><strong>How to fix on Hostinger File Manager:</strong></p>";
        echo "<ol style='line-height:1.9;padding-left:20px;'>";
        echo "<li>Go to Hostinger <strong>File Manager</strong> &rarr; open <code>public_html/inc/</code></li>";
        echo "<li>Create or edit file <code>db_config.prod.php</code> with:</li>";
        echo "</ol>";
        echo "<pre>&lt;?php\n\$db_host = 'localhost';\n\$db_name = '" . htmlspecialchars($db_name) . "';\n\$db_user = '" . htmlspecialchars($db_user) . "';\n\$db_pass = 'YOUR_HOSTINGER_PASSWORD_HERE';\n</pre>";
        echo "</div></body></html>";
        exit;
    }

    mysqli_set_charset($conn, "utf8mb4");
}
