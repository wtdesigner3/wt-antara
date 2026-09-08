<?php 
$email = $_SESSION['admin_email'] ?? 'admin';
$query = mysqli_query($conn, "SELECT * FROM `tbl_admin` WHERE `username` = '$email' OR `email` = '$email'");
$adminrec = mysqli_fetch_array($query);
if (!$adminrec) {
    $adminrec = ['name' => 'Antara Admin', 'image' => 'antara-logo-dark.svg'];
}

$sqqll = "SELECT `pro_id`, `pro_logo`,`pro_dark_logo`, `pro_favicon` , `pro_title` FROM `tbl_profile` LIMIT 1";
$resulltt = $conn->query($sqqll);
$rowww = $resulltt ? $resulltt->fetch_assoc() : [];
?>
<div id="header" class="header navbar navbar-default navbar-fixed-top admin-header-bar d-flex align-items-center justify-content-between px-3 px-md-4">
	<!-- Left Brand Area (Aligned with 220px Sidebar) -->
	<div class="header-brand-box d-flex align-items-center justify-content-between">
		<a href="index.php" class="header-brand-link d-flex align-items-center gap-2">
			<?php 
			$adminLogo = '../../assets/img/logo/antara-logo-dark.svg';
			if (!empty($rowww['pro_dark_logo']) && file_exists('../../uploads/' . $rowww['pro_dark_logo'])) {
				$adminLogo = '../../uploads/' . $rowww['pro_dark_logo'];
			} elseif (!empty($rowww['pro_logo']) && file_exists('../../uploads/' . $rowww['pro_logo'])) {
				$adminLogo = '../../uploads/' . $rowww['pro_logo'];
			}
			?>
			<img src="<?= $adminLogo ?>" alt="Antara Globale" class="header-logo-img" />
		</a>
		<button type="button" class="navbar-toggle btn-sidebar-mobile d-md-none ms-auto" data-click="sidebar-toggled" aria-label="Toggle Navigation">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>

	<!-- Right Utility Controls -->
	<div class="header-actions d-flex align-items-center gap-2 gap-sm-3 ms-auto">
		<a href="../../index.php" target="_blank" class="btn-view-live-site d-none d-sm-inline-flex align-items-center gap-2">
			<i class="fa-solid fa-arrow-up-right-from-square"></i>
			<span>View Site</span>
		</a>

		<div class="dropdown navbar-user">
			<a href="#" class="dropdown-toggle user-profile-pill d-flex align-items-center gap-2 text-decoration-none" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<div class="user-avatar-circle">
					<?= strtoupper(substr($adminrec['name'], 0, 1)) ?>
				</div>
				<div class="d-none d-md-flex flex-column text-start">
					<span class="user-name-text"><?= htmlspecialchars($adminrec['name']); ?></span>
					<span class="user-role-text">Administrator</span>
				</div>
				<i class="fa-solid fa-chevron-down user-caret-icon ms-1"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-end shadow-lg border-0 modern-user-dropdown mt-2">
				<div class="dropdown-header text-uppercase fw-bold px-3 pt-2 pb-1" style="font-size: 10.5px; color: #8C9E94; letter-spacing: 0.5px;">Executive Desk</div>
				<a href="manage-profile.php" class="dropdown-item py-2 px-3 d-flex align-items-center gap-2">
					<i class="fa-solid fa-shield-halved text-muted" style="width: 16px;"></i>
					<span>Admin Security</span>
				</a>
				<a href="manage-products.php" class="dropdown-item py-2 px-3 d-flex align-items-center gap-2">
					<i class="fa-solid fa-boxes-stacked text-muted" style="width: 16px;"></i>
					<span>Product Catalog</span>
				</a>
				<a href="manage-contact.php" class="dropdown-item py-2 px-3 d-flex align-items-center gap-2">
					<i class="fa-solid fa-sliders text-muted" style="width: 16px;"></i>
					<span>Trade Desk & Contacts</span>
				</a>
				<div class="dropdown-divider my-1"></div>
				<a href="includes/logout.php" onClick="return confirm('Are you sure you want to log out?');" class="dropdown-item py-2 px-3 d-flex align-items-center gap-2 text-danger fw-semibold">
					<i class="fa-solid fa-right-from-bracket" style="width: 16px;"></i>
					<span>Sign Out</span>
				</a>
			</div>
		</div>
	</div>
</div>