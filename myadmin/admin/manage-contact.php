<?php
require('checksession.php');
require('../inc/function.php');

$msg = "";
$error = "";

// Handle Contact Page Updates
if (isset($_POST['update_contact_page'])) {
    $phone1 = mysqli_real_escape_string($conn, trim($_POST['con_phone1']));
    $phone2 = mysqli_real_escape_string($conn, trim($_POST['con_phone2']));
    $email1 = mysqli_real_escape_string($conn, trim($_POST['con_email1']));
    $email2 = mysqli_real_escape_string($conn, trim($_POST['con_email2']));
    $whatsaap = mysqli_real_escape_string($conn, trim($_POST['con_whatsaap']));
    $address = mysqli_real_escape_string($conn, trim($_POST['con_address']));
    $map = mysqli_real_escape_string($conn, trim($_POST['con_map']));

    $upd = mysqli_query($conn, "UPDATE `tbl_contact` SET 
        `con_phone1`='$phone1',
        `con_phone2`='$phone2',
        `con_email1`='$email1',
        `con_email2`='$email2',
        `con_whatsaap`='$whatsaap',
        `con_address`='$address',
        `con_map`='$map'
        WHERE `con_id`=1");

    if ($upd) {
        $msg = "Contact details, address, and Google Map embed updated successfully!";
    } else {
        $error = "Failed to update contact settings: " . mysqli_error($conn);
    }
}

// Fetch Current Contact Record
$contact = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_contact` WHERE `con_id`=1"));
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
                        <li class="breadcrumb-item active">Contact Page CMS</li>
                    </ol>
                    <h1 class="page-header mb-0">
                        <i class="fa-solid fa-headset text-warning me-2"></i> Contact Page CMS
                    </h1>
                </div>
                <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                    <a href="../../contact.php" target="_blank" class="btn btn-outline-success btn-sm px-3">
                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> View Live Contact Page
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

            <div class="row g-4">
                <!-- Left Column: Form -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                            <h5 class="mb-0 fw-bold" style="color: #123023;"><i class="fa-solid fa-sliders text-success me-2"></i> Official Contact Desk Information</h5>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Live Synchronized</span>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST">
                                <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size: 11px; letter-spacing: 1px;">Phone & Communication Lines</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Primary Trade Desk Phone <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fa-solid fa-phone text-muted"></i></span>
                                            <input type="text" name="con_phone1" class="form-control" value="<?= htmlspecialchars($contact['con_phone1'] ?? '') ?>" placeholder="+91 98765 43210" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Secondary / Logistics Desk Phone</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fa-solid fa-phone-volume text-muted"></i></span>
                                            <input type="text" name="con_phone2" class="form-control" value="<?= htmlspecialchars($contact['con_phone2'] ?? '') ?>" placeholder="+91 91234 56789">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">WhatsApp Direct Trade Line</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fa-brands fa-whatsapp text-success"></i></span>
                                            <input type="text" name="con_whatsaap" class="form-control" value="<?= htmlspecialchars($contact['con_whatsaap'] ?? '') ?>" placeholder="+919876543210">
                                        </div>
                                        <small class="text-muted">Used for direct instant messaging and sample requests via WhatsApp.</small>
                                    </div>
                                </div>

                                <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size: 11px; letter-spacing: 1px;">Email Inboxes</h6>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Primary Inquiries Email <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fa-solid fa-envelope text-muted"></i></span>
                                            <input type="email" name="con_email1" class="form-control" value="<?= htmlspecialchars($contact['con_email1'] ?? '') ?>" placeholder="trade@antaraglobale.com" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Export Documentation Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fa-solid fa-envelope-open text-muted"></i></span>
                                            <input type="email" name="con_email2" class="form-control" value="<?= htmlspecialchars($contact['con_email2'] ?? '') ?>" placeholder="exports@antaraglobale.com">
                                        </div>
                                    </div>
                                </div>

                                <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size: 11px; letter-spacing: 1px;">Corporate Address & Google Map Embed</h6>
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Corporate Registered / Trade Address <span class="text-danger">*</span></label>
                                    <textarea name="con_address" class="form-control" rows="3" required><?= htmlspecialchars($contact['con_address'] ?? '') ?></textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Google Map Embed (URL or iframe)</label>
                                    <textarea name="con_map" class="form-control" rows="3" placeholder="https://www.google.com/maps/embed?pb=..."><?= htmlspecialchars($contact['con_map'] ?? '') ?></textarea>
                                    <small class="text-muted">Paste either the Google Maps embed URL (starts with <code>https://www.google.com/maps/embed...</code>) or the full <code>&lt;iframe&gt;</code> HTML code. It will render cleanly as full-width at the bottom of the contact page.</small>
                                </div>

                                <div class="text-end">
                                    <button type="submit" name="update_contact_page" class="btn btn-warning px-4 py-2 fw-bold">
                                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Contact Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Live Overview & Quick Links -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header bg-white py-3 border-bottom">
                            <h5 class="mb-0 fw-bold" style="color: #123023;"><i class="fa-solid fa-eye text-primary me-2"></i> Current Live Preview</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded bg-light">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div>
                                    <div class="fw-bold" style="font-size: 13px;">Registered Office</div>
                                    <div class="small text-muted"><?= nl2br(htmlspecialchars($contact['con_address'] ?? '')) ?></div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded bg-light">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div>
                                    <div class="fw-bold" style="font-size: 13px;">Direct Telephones</div>
                                    <div class="small text-muted"><?= htmlspecialchars($contact['con_phone1'] ?? '') ?></div>
                                    <div class="small text-muted"><?= htmlspecialchars($contact['con_phone2'] ?? '') ?></div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3 mb-3 p-3 rounded bg-light">
                                <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div>
                                    <div class="fw-bold" style="font-size: 13px;">Inquiries & Quotes</div>
                                    <div class="small text-muted"><?= htmlspecialchars($contact['con_email1'] ?? '') ?></div>
                                    <div class="small text-muted"><?= htmlspecialchars($contact['con_email2'] ?? '') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-white py-3 border-bottom">
                            <h5 class="mb-0 fw-bold" style="color: #123023;"><i class="fa-solid fa-share-nodes text-warning me-2"></i> Social Handles</h5>
                        </div>
                        <div class="card-body p-4">
                            <p class="small text-muted mb-3">To update LinkedIn, Instagram, Twitter, and Facebook handles, visit the Branding & Settings dashboard.</p>
                            <a href="manage-settings.php#tab-social" class="btn btn-outline-primary btn-sm w-100">
                                <i class="fa-solid fa-arrow-right me-1"></i> Manage Social Handles
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
