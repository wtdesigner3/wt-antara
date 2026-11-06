<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../inc/db.php';
require_once __DIR__ . '/../inc/mail.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit();
}

$full_name = mysqli_real_escape_string($conn, trim($_POST['full_name'] ?? ''));
$company_name = mysqli_real_escape_string($conn, trim($_POST['company_name'] ?? ''));
$email = mysqli_real_escape_string($conn, trim($_POST['email'] ?? ''));
$phone = mysqli_real_escape_string($conn, trim($_POST['phone'] ?? ''));
$country = mysqli_real_escape_string($conn, trim($_POST['country'] ?? ''));
if (empty($country)) {
    $country = 'International / CIF';
}
$division = mysqli_real_escape_string($conn, trim($_POST['division'] ?? ''));
if (empty($division)) {
    $division = 'export';
}

// Support both modal & contact page input field names
$product_raw = trim($_POST['product_interest'] ?? $_POST['product_name'] ?? '');
$product_interest = mysqli_real_escape_string($conn, !empty($product_raw) ? $product_raw : 'General Commodity Sourcing');

$volume_raw = trim($_POST['volume_requirement'] ?? $_POST['quantity'] ?? '');
$volume = mysqli_real_escape_string($conn, $volume_raw);

$message = mysqli_real_escape_string($conn, trim($_POST['message'] ?? ''));
$ip = $_SERVER['REMOTE_ADDR'] ?? '';

if (empty($full_name) || empty($email) || empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Please provide your Full Name, Email, and Phone/WhatsApp.']);
    exit();
}

$sql = "INSERT INTO `tbl_enquiry` 
        (`full_name`, `company_name`, `email`, `phone`, `country`, `division`, `product_interest`, `volume_requirement`, `message`, `status`, `ip_address`) 
        VALUES 
        ('$full_name', '$company_name', '$email', '$phone', '$country', '$division', '$product_interest', '$volume', '$message', 'pending', '$ip')";

if (mysqli_query($conn, $sql)) {
    // Dispatch Email Notification to Trade Desk via Hostinger SMTP
    send_enquiry_notification([
        'full_name'        => $full_name,
        'company_name'     => $company_name,
        'email'            => $email,
        'phone'            => $phone,
        'country'          => $country,
        'division'         => $division,
        'product_interest' => $product_interest,
        'volume'           => $volume,
        'message'          => $message,
        'ip'               => $ip
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your inquiry has been received by our commercial trade desk. Our team will contact you shortly.'
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
}
?>
