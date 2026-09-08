<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../inc/db.php';

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
$product_interest = mysqli_real_escape_string($conn, trim($_POST['product_interest'] ?? ''));
if (empty($product_interest)) {
    $product_interest = 'General Commodity Sourcing';
}
$volume = mysqli_real_escape_string($conn, trim($_POST['volume_requirement'] ?? ''));
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
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your inquiry has been received by our commercial trade desk. Our team will contact you shortly.'
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . mysqli_error($conn)]);
}
?>
