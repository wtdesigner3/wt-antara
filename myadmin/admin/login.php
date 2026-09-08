<?php
@session_start();
if (@$_SESSION['admin_ses'] == 'hvrs@#p9w84r' . session_id()) {
    header("location:index.php");
    exit();
}
require('../inc/function.php');

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username'])); 
    $password = mysqli_real_escape_string($conn, trim($_POST['password'])); 
    $password_md5 = md5($password);
    
    $data = mysqli_query($conn, "SELECT * FROM `tbl_admin` WHERE `username`='$username' AND `password`='$password_md5'");
    
    if ($data && mysqli_num_rows($data) > 0) {
        $_SESSION['admin_ses'] = "hvrs@#p9w84r" . session_id();
        $_SESSION['admin_email'] = $username;
        $_SESSION['success'] = "Welcome back to Antara Globale Admin!";
        header('location:index.php');
        exit();
    } else {
        $error = "Invalid credentials. Please verify your username and password.";
    }
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign In | Antara Globale Control Center</title>
	<link rel="shortcut icon" href="../../assets/img/logo/favicon.svg">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<style>
		body {
			margin: 0;
			padding: 0;
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			background: linear-gradient(135deg, #091C14 0%, #123023 50%, #06150E 100%);
			font-family: 'Plus Jakarta Sans', sans-serif;
			position: relative;
			overflow: hidden;
		}
		body::before {
			content: '';
			position: absolute;
			inset: 0;
			background: radial-gradient(circle at 70% 20%, rgba(197, 160, 89, 0.15), transparent 45%),
			            radial-gradient(circle at 20% 80%, rgba(27, 77, 62, 0.35), transparent 50%);
			pointer-events: none;
		}
		.login-card {
			position: relative;
			z-index: 2;
			width: 100%;
			max-width: 440px;
			background: rgba(18, 48, 35, 0.85);
			backdrop-filter: blur(20px);
			-webkit-backdrop-filter: blur(20px);
			border: 1px solid rgba(197, 160, 89, 0.3);
			border-radius: 24px;
			padding: 42px 36px;
			box-shadow: 0 24px 60px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.05);
			color: #FFFFFF;
		}
		.login-logo {
			display: block;
			max-width: 180px;
			margin: 0 auto 24px;
		}
		.form-label {
			font-size: 13px;
			font-weight: 600;
			color: rgba(255, 255, 255, 0.85);
			text-transform: uppercase;
			letter-spacing: 0.5px;
			margin-bottom: 8px;
		}
		.form-control {
			background: rgba(255, 255, 255, 0.07);
			border: 1px solid rgba(255, 255, 255, 0.15);
			border-radius: 12px;
			color: #FFFFFF !important;
			padding: 12px 16px;
			font-size: 14.5px;
			transition: all 0.25s ease;
		}
		.form-control:focus {
			background: rgba(255, 255, 255, 0.12);
			border-color: #C5A059;
			box-shadow: 0 0 0 4px rgba(197, 160, 89, 0.2);
		}
		.form-control::placeholder {
			color: rgba(255, 255, 255, 0.35);
		}
		.btn-login {
			width: 100%;
			padding: 14px;
			background: #C5A059;
			color: #0A1C14;
			border: none;
			border-radius: 12px;
			font-size: 15px;
			font-weight: 700;
			letter-spacing: 0.5px;
			text-transform: uppercase;
			cursor: pointer;
			transition: all 0.3s ease;
			margin-top: 10px;
		}
		.btn-login:hover {
			background: #D4B06A;
			box-shadow: 0 8px 24px rgba(197, 160, 89, 0.4);
			transform: translateY(-2px);
		}
	</style>
</head>
<body>
	<div class="login-card">
		<div class="text-center mb-4">
			<img src="../../assets/img/logo/antara-logo-white.svg" alt="Antara Globale" class="login-logo">
			<h4 class="fw-bold mb-1" style="font-family: 'Instrument Sans'; color: #FFFFFF;">Admin Control Center</h4>
			<p class="small mb-0" style="color: rgba(255, 255, 255, 0.65);">Sign in to manage catalog, leads & trade desk</p>
		</div>

		<?php if ($error != ""): ?>
			<div class="alert alert-danger py-2 px-3 small rounded-3 mb-4" style="background: rgba(220, 53, 69, 0.2); border: 1px solid rgba(220, 53, 69, 0.4); color: #FFA8B0;">
				<i class="fa-solid fa-triangle-exclamation me-1"></i> <?= $error ?>
			</div>
		<?php endif; ?>

		<form method="POST" action="login.php" autocomplete="off">
			<div class="mb-3">
				<label class="form-label">Username</label>
				<div class="position-relative">
					<input type="text" name="username" class="form-control" placeholder="Enter admin username" required autofocus autocomplete="username">
				</div>
			</div>

			<div class="mb-4">
				<label class="form-label">Password</label>
				<input type="password" name="password" class="form-control" placeholder="Enter admin password" required autocomplete="current-password">
			</div>

			<button type="submit" name="login" class="btn-login">
				<i class="fa-solid fa-lock-open me-2"></i> Sign In to Console
			</button>

			<div class="text-center mt-4">
				<a href="../../index.php" class="text-decoration-none small" style="color: rgba(255, 255, 255, 0.6);">
					<i class="fa-solid fa-arrow-left me-1"></i> Return to Public Website
				</a>
			</div>
		</form>
	</div>
</body>
</html>
