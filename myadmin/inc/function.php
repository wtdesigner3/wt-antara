<?php
/**
 * Antara Globale Admin CMS - Database Bridge & Function Helpers
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../inc/db_config.php';

// Define site constants used across admin panel
if (!defined('SITE_NAME')) define('SITE_NAME', 'Antara Globale');
if (!defined('SITE_URL')) define('SITE_URL', '../../');
if (!defined('ADMIN_URL')) define('ADMIN_URL', 'index.php');

// Fetch current admin user details if session is active
$adminrec = [
    'name' => 'Antara Admin',
    'email' => 'trade@antaraglobale.com',
    'image' => 'antara-logo-dark.svg'
];

if (isset($_SESSION['admin_email'])) {
    $em = mysqli_real_escape_string($conn, $_SESSION['admin_email']);
    $ad_res = mysqli_query($conn, "SELECT * FROM `tbl_admin` WHERE `username`='$em' OR `email`='$em' LIMIT 1");
    if ($ad_res && mysqli_num_rows($ad_res) > 0) {
        $adminrec = mysqli_fetch_assoc($ad_res);
    }
}

/**
 * Image Upload Helper
 */
function upload_image($file_input_name, $target_dir = "../../uploads/") {
    if (!isset($_FILES[$file_input_name]) || $_FILES[$file_input_name]['error'] !== UPLOAD_ERR_OK) {
        return false;
    }
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', basename($_FILES[$file_input_name]['name']));
    $target_file = rtrim($target_dir, '/') . '/' . $filename;
    if (move_uploaded_file($_FILES[$file_input_name]['tmp_name'], $target_file)) {
        return $filename;
    }
    return false;
}
?>
