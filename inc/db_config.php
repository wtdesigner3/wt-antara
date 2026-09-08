<?php
/**
 * Antara Globale - Dynamic Database Configuration
 * Supports Local Development (XAMPP) & Production (cPanel / Live Server)
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Check for custom production override config (which is ignored by Git)
if (file_exists(__DIR__ . '/db_config.prod.php')) {
    require_once __DIR__ . '/db_config.prod.php';
} elseif (file_exists(__DIR__ . '/../db_config.prod.php')) {
    require_once __DIR__ . '/../db_config.prod.php';
} else {
    // 2. Environment Variables or Automatic Host Detection
    $is_localhost = in_array($_SERVER['SERVER_NAME'] ?? 'localhost', ['localhost', '127.0.0.1', '::1']) 
                    || php_sapi_name() === 'cli';

    if ($is_localhost) {
        // Local XAMPP Environment
        $db_host = getenv('DB_HOST') ?: 'localhost';
        $db_user = getenv('DB_USER') ?: 'root';
        $db_pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
        $db_name = getenv('DB_NAME') ?: 'anahat_db';
    } else {
        // Default Live cPanel Server Configuration (can also be set via db_config.prod.php)
        $db_host = getenv('DB_HOST') ?: 'localhost';
        $db_user = getenv('DB_USER') ?: 'root';
        $db_pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
        $db_name = getenv('DB_NAME') ?: 'anahat_db';
    }
}

// 3. Establish Shared MySQLi Connection
if (!isset($conn) || !$conn) {
    $conn = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Database Connection Error: " . mysqli_connect_error() . "<br><small>Please verify your database credentials in <code>inc/db_config.prod.php</code> on cPanel.</small>");
    }

    mysqli_set_charset($conn, "utf8mb4");
}
