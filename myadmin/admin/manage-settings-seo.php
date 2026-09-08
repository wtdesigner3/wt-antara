<?php
require('checksession.php');
require('../inc/function.php');

$msg = "";
$error = "";

// Handle SEO & Footer Update
if (isset($_POST['update_seo_footer'])) {
    $pro_keyword = mysqli_real_escape_string($conn, trim($_POST['pro_keyword']));
    $pro_detail = mysqli_real_escape_string($conn, trim($_POST['pro_detail']));
    $pro_footer_desc = mysqli_real_escape_string($conn, trim($_POST['pro_footer_desc']));
    $pro_copyright = mysqli_real_escape_string($conn, trim($_POST['pro_copyright']));

    $upd = mysqli_query($conn, "UPDATE `tbl_profile` SET 
        `pro_keyword`='$pro_keyword',
        `pro_detail`='$pro_detail',
        `pro_footer_desc`='$pro_footer_desc',
        `pro_copyright`='$pro_copyright'
        WHERE `pro_id`=1");

    if ($upd) {
        $msg = "Global SEO metadata, footer summary, and copyright updated successfully!";
    } else {
        $error = "Failed to update SEO & footer settings: " . mysqli_error($conn);
    }
}

// Fetch Current Records
$profile = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_profile` WHERE `pro_id`=1"));
?>
<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php'); ?>
<body>
    <div id="page-container" class="page-sidebar-fixed page-header-fixed show">
        <?php require('includes/header.php'); ?>
        <?php require('includes/left.php'); ?>
        
        <div id="content" class="content">
            <!-- Header Bar -->
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 pb-2 border-bottom">
                <div>
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="manage-settings-branding.php">Settings</a></li>
                        <li class="breadcrumb-item active">Global SEO & Footers</li>
                    </ol>
                    <h1 class="page-header mb-0">
                        <i class="fa-solid fa-magnifying-glass-chart text-warning me-2"></i> Global SEO & Footer Configuration
                    </h1>
                </div>
                <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                    <a href="../../index.php" target="_blank" class="btn btn-outline-success btn-sm px-3">
                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> View Live Website
                    </a>
                </div>
            </div>

            <!-- Modern Sub-Menu Switcher Pills -->
            <div class="cms-subnav-strip mb-3">
                <a href="manage-settings-branding.php" class="cms-subnav-pill">
                    <i class="fa-solid fa-palette"></i> Brand Logos & Favicon
                </a>
                <a href="manage-settings-seo.php" class="cms-subnav-pill active">
                    <i class="fa-solid fa-magnifying-glass-chart"></i> Global SEO & Footers
                </a>
                <a href="manage-settings-social.php" class="cms-subnav-pill">
                    <i class="fa-solid fa-share-nodes"></i> Social Media Handles
                </a>
                <a href="manage-settings-widgets.php" class="cms-subnav-pill">
                    <i class="fa-solid fa-phone-volume"></i> Floating Action Widgets
                </a>
                <div class="ms-auto">
                    <a href="../../index.php" target="_blank" class="cms-subnav-pill cms-subnav-preview">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Preview Live
                    </a>
                </div>
            </div>

            <!-- Alerts -->
            <?php if (!empty($msg)): ?>
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fa-solid fa-circle-check fs-4 me-3 text-success"></i>
                    <div><strong>Success!</strong> <?= htmlspecialchars($msg) ?></div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fa-solid fa-triangle-exclamation fs-4 me-3 text-danger"></i>
                    <div><strong>Error!</strong> <?= htmlspecialchars($error) ?></div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="row g-4">
                    <!-- Global SEO Card -->
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 fw-bold" style="color: #123023;">
                                    <i class="fa-solid fa-search text-warning me-2"></i> Search Engine Optimization (SEO)
                                </h5>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Meta Tags</span>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Meta Keywords (Comma separated)</label>
                                    <textarea name="pro_keyword" class="form-control" rows="4" placeholder="indian spices exporter, bulk coffee beans supplier, ctc tea exporter..."><?= htmlspecialchars($profile['pro_keyword'] ?? '') ?></textarea>
                                    <small class="text-muted">Keywords indexed by web search engines to rank international trade searches.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Meta Description (Snippet in search results)</label>
                                    <textarea name="pro_detail" class="form-control" rows="5" placeholder="Antara Globale is a premier Indian agricultural exporter..."><?= htmlspecialchars($profile['pro_detail'] ?? '') ?></textarea>
                                    <small class="text-muted">Recommended length: 150-160 characters for optimal Google and Bing indexing.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Identity Card -->
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 fw-bold" style="color: #123023;">
                                    <i class="fa-solid fa-table-cells-row-unlock text-success me-2"></i> Corporate Footer Identity
                                </h5>
                                <span class="badge bg-success-subtle text-success border border-success-subtle">Global Footer</span>
                            </div>
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Corporate Footer Description / Summary</label>
                                    <textarea name="pro_footer_desc" class="form-control" rows="4" placeholder="Antara Globale is a premier Indian merchant exporter..."><?= htmlspecialchars($profile['pro_footer_desc'] ?? '') ?></textarea>
                                    <small class="text-muted">Displayed in Column 1 of the website footer underneath the white brand logo.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Dynamic Copyright Notice</label>
                                    <input type="text" name="pro_copyright" class="form-control" value="<?= htmlspecialchars($profile['pro_copyright'] ?? '') ?>" placeholder="© Copyright 2026 Antara Globale. All Rights Reserved.">
                                    <small class="text-muted">Rendered across the bottom bar of all public pages.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" name="update_seo_footer" class="btn btn-warning btn-lg px-5 fw-bold shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Save SEO & Footer Settings
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/apps.min.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
</body>
</html>
