<?php 
require('checksession.php'); 
require('../inc/function.php');

// Fetch CMS Metrics
$total_products_q = mysqli_query($conn, "SELECT count(*) as cnt FROM `tbl_product` WHERE `status`=1");
$total_products = mysqli_fetch_assoc($total_products_q)['cnt'] ?? 0;

$export_products_q = mysqli_query($conn, "SELECT count(*) as cnt FROM `tbl_product` WHERE `division`='export' AND `status`=1");
$export_products = mysqli_fetch_assoc($export_products_q)['cnt'] ?? 0;

$horeca_products_q = mysqli_query($conn, "SELECT count(*) as cnt FROM `tbl_product` WHERE `division`='horeca' AND `status`=1");
$horeca_products = mysqli_fetch_assoc($horeca_products_q)['cnt'] ?? 0;

$total_testimonials_q = mysqli_query($conn, "SELECT count(*) as cnt FROM `tbl_testimonial` WHERE `tt_status`=1");
$total_testimonials = mysqli_fetch_assoc($total_testimonials_q)['cnt'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php'); ?>
<body>
	<div id="page-container" class="page-sidebar-fixed page-header-fixed show">
		<?php require('includes/header.php'); ?>
		<?php require('includes/left.php'); ?>
		
		<div id="content" class="content">
			<!-- Header & Health Status Banner -->
			<div class="d-flex flex-wrap align-items-center justify-content-between mb-3 pb-2 border-bottom">
				<div>
					<ol class="breadcrumb mb-1">
						<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
						<li class="breadcrumb-item active">CMS Overview</li>
					</ol>
					<h1 class="page-header mb-0">
						<i class="fa-solid fa-gauge-high text-warning me-2"></i> Executive CMS Management Console
					</h1>
				</div>
				<div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
					<a href="../../index.php" target="_blank" class="btn btn-warning fw-bold shadow-sm btn-sm px-3">
						<i class="fa-solid fa-globe me-1"></i> Preview Live Website
					</a>
				</div>
			</div>

			<!-- Quick Welcome & Performance Banner -->
			<div class="quick-action-banner mb-4">
				<div>
					<div class="d-flex align-items-center gap-2 mb-2">
						<span class="badge bg-warning text-dark px-2 py-1 fw-bold">CMS 2.0</span>
						<h3 class="text-white mb-0 fw-bold">Antara Globale Digital Content Center</h3>
					</div>
					<p class="mb-0 text-white-50" style="max-width: 680px;">
						Full content management control over homepage banners, rich-text founding heritage narratives, dual-division product catalogs, client reviews, and global SEO metadata.
					</p>
				</div>
				<div class="d-none d-md-flex align-items-center gap-3">
					<a href="manage-home-hero.php" class="btn btn-light fw-bold text-dark px-3 py-2">
						<i class="fa-solid fa-image text-warning me-1"></i> Manage Hero Banners
					</a>
					<a href="add-product.php" class="btn btn-warning fw-bold shadow-sm px-3 py-2 ms-2">
						<i class="fa-solid fa-plus-circle me-1"></i> Add New Product
					</a>
				</div>
			</div>
			
			<!-- CMS KPI Metric Cards Grid -->
			<div class="row g-4 mb-4">
				<div class="col-xl-3 col-md-6">
					<a href="manage-products.php" class="text-decoration-none">
						<div class="kpi-card">
							<div class="kpi-icon emerald">
								<i class="fa-solid fa-boxes-stacked"></i>
							</div>
							<div>
								<div class="kpi-val"><?= $total_products ?></div>
								<div class="kpi-label">Active Catalog Items</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-xl-3 col-md-6">
					<a href="manage-products.php?division=horeca" class="text-decoration-none">
						<div class="kpi-card">
							<div class="kpi-icon gold">
								<i class="fa-solid fa-mug-hot"></i>
							</div>
							<div>
								<div class="kpi-val text-warning"><?= $horeca_products ?></div>
								<div class="kpi-label">HORECA Supplies (<?= $horeca_products ?>)</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-xl-3 col-md-6">
					<a href="manage-products.php?division=export" class="text-decoration-none">
						<div class="kpi-card">
							<div class="kpi-icon blue">
								<i class="fa-solid fa-ship"></i>
							</div>
							<div>
								<div class="kpi-val"><?= $export_products ?></div>
								<div class="kpi-label">Export Commodities (<?= $export_products ?>)</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-xl-3 col-md-6">
					<a href="manage-testimonial.php" class="text-decoration-none">
						<div class="kpi-card">
							<div class="kpi-icon amber">
								<i class="fa-solid fa-star"></i>
							</div>
							<div>
								<div class="kpi-val"><?= $total_testimonials ?></div>
								<div class="kpi-label">Client Testimonials</div>
							</div>
						</div>
					</a>
				</div>
			</div>

		</div>
		
		<?php require('includes/footer.php'); ?>
	</div>
</body>
</html>
