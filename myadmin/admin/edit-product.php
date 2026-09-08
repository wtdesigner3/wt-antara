<?php 
require('checksession.php'); 
require('../inc/function.php');

$msg = "";
$error = "";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product_q = mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE `id`=$id LIMIT 1");
if (!$product_q || mysqli_num_rows($product_q) == 0) {
    header("Location: manage-products.php");
    exit();
}
$p = mysqli_fetch_assoc($product_q);

if (isset($_POST['update_product'])) {
    $division = mysqli_real_escape_string($conn, $_POST['division']);
    $cat_id = ($division == 'export') ? 1 : 2;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = mysqli_real_escape_string($conn, strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['slug'] ?: $_POST['name']))));
    $tagline = mysqli_real_escape_string($conn, $_POST['tagline']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $varieties = mysqli_real_escape_string($conn, $_POST['available_varieties']);
    $brands = mysqli_real_escape_string($conn, $_POST['brands']);
    $specifications = mysqli_real_escape_string($conn, $_POST['specifications']);
    $packaging = mysqli_real_escape_string($conn, $_POST['packaging']);
    $moq = mysqli_real_escape_string($conn, $_POST['moq']);
    $applications = mysqli_real_escape_string($conn, $_POST['applications']);
    $badge1_title = mysqli_real_escape_string($conn, trim($_POST['badge1_title'] ?? ''));
    $badge1_desc  = mysqli_real_escape_string($conn, trim($_POST['badge1_desc'] ?? ''));
    $badge2_title = mysqli_real_escape_string($conn, trim($_POST['badge2_title'] ?? ''));
    $badge2_desc  = mysqli_real_escape_string($conn, trim($_POST['badge2_desc'] ?? ''));
    $badge3_title = mysqli_real_escape_string($conn, trim($_POST['badge3_title'] ?? ''));
    $badge3_desc  = mysqli_real_escape_string($conn, trim($_POST['badge3_desc'] ?? ''));
    $sort = (int)$_POST['sort'];
    $status = isset($_POST['status']) ? 1 : 0;

    $image = $p['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploaded = upload_image('image', '../../uploads/');
        if ($uploaded) {
            $image = "uploads/" . $uploaded;
        }
    }

    $banner_image = $p['banner_image'];
    if (isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] == 0) {
        $uploaded_banner = upload_image('banner_image', '../../uploads/');
        if ($uploaded_banner) {
            $banner_image = "uploads/" . $uploaded_banner;
        }
    }

    // Handle Badge Icons Upload
    $badge1_icon = $p['badge1_icon'] ?? 'assets/img/icons/pillar-2-quality.svg';
    if (isset($_FILES['badge1_icon']) && $_FILES['badge1_icon']['error'] == 0) {
        $uploaded_b1 = upload_image('badge1_icon', '../../uploads/');
        if ($uploaded_b1) {
            $badge1_icon = "uploads/" . $uploaded_b1;
        }
    }

    $badge2_icon = $p['badge2_icon'] ?? 'assets/img/icons/pillar-3-logistics.svg';
    if (isset($_FILES['badge2_icon']) && $_FILES['badge2_icon']['error'] == 0) {
        $uploaded_b2 = upload_image('badge2_icon', '../../uploads/');
        if ($uploaded_b2) {
            $badge2_icon = "uploads/" . $uploaded_b2;
        }
    }

    $badge3_icon = $p['badge3_icon'] ?? 'assets/img/icons/partnership-trust.svg';
    if (isset($_FILES['badge3_icon']) && $_FILES['badge3_icon']['error'] == 0) {
        $uploaded_b3 = upload_image('badge3_icon', '../../uploads/');
        if ($uploaded_b3) {
            $badge3_icon = "uploads/" . $uploaded_b3;
        }
    }

    $sql = "UPDATE `tbl_product` SET 
            `category_id`=$cat_id,
            `division`='$division',
            `name`='$name',
            `slug`='$slug',
            `tagline`='$tagline',
            `description`='$description',
            `image`='$image',
            `banner_image`='$banner_image',
            `available_varieties`='$varieties',
            `brands`='$brands',
            `specifications`='$specifications',
            `packaging`='$packaging',
            `moq`='$moq',
            `applications`='$applications',
            `badge1_icon`='$badge1_icon',
            `badge1_title`='$badge1_title',
            `badge1_desc`='$badge1_desc',
            `badge2_icon`='$badge2_icon',
            `badge2_title`='$badge2_title',
            `badge2_desc`='$badge2_desc',
            `badge3_icon`='$badge3_icon',
            `badge3_title`='$badge3_title',
            `badge3_desc`='$badge3_desc',
            `sort`=$sort,
            `status`=$status 
            WHERE `id`=$id";
    
    if (mysqli_query($conn, $sql)) {
        $msg = "Product updated successfully!";
        // Refresh product data
        $p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE `id`=$id LIMIT 1"));
    } else {
        $error = "Error updating product: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php'); ?>
<body>
	<div id="page-container" class="page-sidebar-fixed page-header-fixed show">
		<?php require('includes/header.php'); ?>
		<?php require('includes/left.php'); ?>
		
		<div id="content" class="content">
			<div class="d-flex align-items-center justify-content-between mb-4">
				<div>
					<h1 class="page-header mb-1" style="font-size: 26px;">Edit Product: <?= htmlspecialchars($p['name']) ?></h1>
					<p class="text-muted mb-0">Modify specifications, varieties, and packaging for this item.</p>
				</div>
				<div class="d-flex gap-2">
					<a href="../../product-detail.php?slug=<?= $p['slug'] ?>" target="_blank" class="btn btn-outline-secondary">
						<i class="fa-solid fa-eye me-1"></i> Preview Live
					</a>
					<a href="manage-products.php" class="btn btn-outline-secondary">
						<i class="fa-solid fa-arrow-left me-1"></i> Back to Catalog
					</a>
				</div>
			</div>

			<?php if ($msg != ""): ?>
				<div class="alert alert-success alert-dismissible fade show"><?= $msg ?></div>
			<?php endif; ?>

			<?php if ($error != ""): ?>
				<div class="alert alert-danger alert-dismissible fade show"><?= $error ?></div>
			<?php endif; ?>

			<div class="panel">
				<div class="panel-body p-4">
					<form method="POST" action="edit-product.php?id=<?= $id ?>" enctype="multipart/form-data">
						<div class="row g-4">
							<div class="col-md-6">
								<label class="form-label fw-bold">Division <span class="text-danger">*</span></label>
								<select name="division" class="form-select" required>
									<option value="horeca" <?= ($p['division'] == 'horeca') ? 'selected' : '' ?>>Restaurant & Café Supplies (HORECA)</option>
									<option value="export" <?= ($p['division'] == 'export') ? 'selected' : '' ?>>Export Agricultural Commodities</option>
								</select>
							</div>

							<div class="col-md-6">
								<label class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
								<input type="text" name="name" class="form-control" value="<?= htmlspecialchars($p['name']) ?>" required>
							</div>

							<div class="col-md-6">
								<label class="form-label fw-bold">URL Slug</label>
								<input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($p['slug']) ?>" required>
							</div>

							<div class="col-md-6">
								<label class="form-label fw-bold">Tagline / Subheading (Optional)</label>
								<input type="text" name="tagline" class="form-control" value="<?= htmlspecialchars($p['tagline']) ?>" placeholder="e.g. High Altitude Arabica (Leave blank to hide)">
								<small class="text-muted">Leave blank to hide tagline on frontend.</small>
							</div>

							<div class="col-12">
								<label class="form-label fw-bold">Commercial Description (Rich Text CKEditor - Optional)</label>
								<textarea name="description" id="editor_edit_desc" class="form-control ckeditor" rows="6"><?= htmlspecialchars($p['description']) ?></textarea>
								<small class="text-muted">Leave blank to hide description on frontend.</small>
							</div>

							<div class="col-md-6">
								<label class="form-label fw-bold">Available Varieties / Grades (Optional)</label>
								<input type="text" name="available_varieties" class="form-control" value="<?= htmlspecialchars($p['available_varieties']) ?>" placeholder="e.g. Plantation AA, Plantation A (Leave blank to hide block)">
								<small class="text-muted">Leave blank to hide the Varieties & Grades block on the product page.</small>
							</div>

							<div class="col-md-6">
								<label class="form-label fw-bold">Brands Available (Optional)</label>
								<input type="text" name="brands" class="form-control" value="<?= htmlspecialchars($p['brands']) ?>" placeholder="e.g. Antara Globale Sourced (Leave blank to hide block)">
								<small class="text-muted">Leave blank to hide the Brands block on the product page.</small>
							</div>

							<div class="col-12">
								<label class="form-label fw-bold">Technical Specifications (Rich Text CKEditor - Optional)</label>
								<textarea name="specifications" id="editor_edit_specs" class="form-control ckeditor" rows="5"><?= htmlspecialchars($p['specifications']) ?></textarea>
								<small class="text-muted">Leave blank to hide the Specifications table on the product page.</small>
							</div>

							<div class="col-12">
								<label class="form-label fw-bold">Commercial Applications / Use Cases (Optional)</label>
								<textarea name="applications" class="form-control" rows="3" placeholder="e.g. Specialty Cafés, Commercial Bakeries, Beverage Bottling, Industrial Extraction (Leave blank to hide block)"><?= htmlspecialchars($p['applications'] ?? '') ?></textarea>
								<small class="text-muted">Comma-separated or bulleted items. If left blank, the "Commercial Applications" block will not appear on the product page.</small>
							</div>

							<div class="col-md-4">
								<label class="form-label fw-bold">Packaging Options (Optional)</label>
								<input type="text" name="packaging" class="form-control" value="<?= htmlspecialchars($p['packaging']) ?>" placeholder="e.g. 60 kg Jute Bags (Leave blank to hide)">
							</div>

							<div class="col-md-4">
								<label class="form-label fw-bold">Minimum Order Quantity - MOQ (Optional)</label>
								<input type="text" name="moq" class="form-control" value="<?= htmlspecialchars($p['moq']) ?>" placeholder="e.g. 1 x 20ft FCL (Leave blank to hide)">
							</div>

							<div class="col-md-4">
								<label class="form-label fw-bold">Sort Order</label>
								<input type="number" name="sort" class="form-control" value="<?= (int)$p['sort'] ?>">
							</div>

							<div class="col-12">
								<div class="card border border-light-subtle shadow-none bg-light p-3 rounded-3">
									<h5 class="fw-bold mb-1" style="color: #123023;"><i class="fa-solid fa-shield-halved text-warning me-2"></i> Sourcing Assurance &amp; Trust Badges (Bottom 3 Feature Cards)</h5>
									<p class="text-muted small mb-3">These 3 trust cards appear below the commercial section. Leave any card's title and description blank to hide that individual card. If all 3 are left blank, the entire trust badges block will be hidden on the product page.</p>
									<div class="row g-3">
										<div class="col-md-4">
											<div class="bg-white p-3 rounded border h-100">
												<div class="fw-bold text-success mb-2"><i class="fa-solid fa-certificate me-1"></i> Badge 1 (Quality / QA)</div>
												<div class="mb-2">
													<label class="form-label small fw-semibold">Icon / Image</label>
													<div class="d-flex align-items-center gap-2 mb-1">
														<div style="width: 36px; height: 36px; background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 6px; display: flex; align-items: center; justify-content: center; padding: 4px; flex-shrink: 0;">
															<img src="../../<?= htmlspecialchars(!empty($p['badge1_icon']) ? $p['badge1_icon'] : 'assets/img/icons/pillar-2-quality.svg') ?>" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
														</div>
														<input type="file" name="badge1_icon" class="form-control form-control-sm" accept="image/*,.svg">
													</div>
													<small class="text-muted" style="font-size: 11px;">Upload PNG, SVG, or JPG icon.</small>
												</div>
												<label class="form-label small fw-semibold">Title</label>
												<input type="text" name="badge1_title" class="form-control form-control-sm mb-2" value="<?= htmlspecialchars($p['badge1_title'] ?? '') ?>" placeholder="e.g. Batch Verified">
												<label class="form-label small fw-semibold">Description</label>
												<textarea name="badge1_desc" class="form-control form-control-sm no-ckeditor" data-no-ckeditor="true" rows="3" placeholder="e.g. Strict QA check on moisture, grading &amp; packaging."><?= htmlspecialchars($p['badge1_desc'] ?? '') ?></textarea>
											</div>
										</div>
										<div class="col-md-4">
											<div class="bg-white p-3 rounded border h-100">
												<div class="fw-bold text-success mb-2"><i class="fa-solid fa-truck-fast me-1"></i> Badge 2 (Logistics / Delivery)</div>
												<div class="mb-2">
													<label class="form-label small fw-semibold">Icon / Image</label>
													<div class="d-flex align-items-center gap-2 mb-1">
														<div style="width: 36px; height: 36px; background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 6px; display: flex; align-items: center; justify-content: center; padding: 4px; flex-shrink: 0;">
															<img src="../../<?= htmlspecialchars(!empty($p['badge2_icon']) ? $p['badge2_icon'] : 'assets/img/icons/pillar-3-logistics.svg') ?>" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
														</div>
														<input type="file" name="badge2_icon" class="form-control form-control-sm" accept="image/*,.svg">
													</div>
													<small class="text-muted" style="font-size: 11px;">Upload PNG, SVG, or JPG icon.</small>
												</div>
												<label class="form-label small fw-semibold">Title</label>
												<input type="text" name="badge2_title" class="form-control form-control-sm mb-2" value="<?= htmlspecialchars($p['badge2_title'] ?? '') ?>" placeholder="e.g. Dependable Logistics">
												<label class="form-label small fw-semibold">Description</label>
												<textarea name="badge2_desc" class="form-control form-control-sm no-ckeditor" data-no-ckeditor="true" rows="3" placeholder="e.g. Timely port freight &amp; domestic dispatch."><?= htmlspecialchars($p['badge2_desc'] ?? '') ?></textarea>
											</div>
										</div>
										<div class="col-md-4">
											<div class="bg-white p-3 rounded border h-100">
												<div class="fw-bold text-success mb-2"><i class="fa-solid fa-handshake me-1"></i> Badge 3 (Pricing / Contracts)</div>
												<div class="mb-2">
													<label class="form-label small fw-semibold">Icon / Image</label>
													<div class="d-flex align-items-center gap-2 mb-1">
														<div style="width: 36px; height: 36px; background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 6px; display: flex; align-items: center; justify-content: center; padding: 4px; flex-shrink: 0;">
															<img src="../../<?= htmlspecialchars(!empty($p['badge3_icon']) ? $p['badge3_icon'] : 'assets/img/icons/partnership-trust.svg') ?>" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
														</div>
														<input type="file" name="badge3_icon" class="form-control form-control-sm" accept="image/*,.svg">
													</div>
													<small class="text-muted" style="font-size: 11px;">Upload PNG, SVG, or JPG icon.</small>
												</div>
												<label class="form-label small fw-semibold">Title</label>
												<input type="text" name="badge3_title" class="form-control form-control-sm mb-2" value="<?= htmlspecialchars($p['badge3_title'] ?? '') ?>" placeholder="e.g. Commercial Pricing">
												<label class="form-label small fw-semibold">Description</label>
												<textarea name="badge3_desc" class="form-control form-control-sm no-ckeditor" data-no-ckeditor="true" rows="3" placeholder="e.g. Competitive volume rates for long-term partners."><?= htmlspecialchars($p['badge3_desc'] ?? '') ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<label class="form-label fw-bold">Product Showcase Image</label>
								<div class="d-flex align-items-center gap-3 mb-2">
									<img src="../../<?= htmlspecialchars($p['image']) ?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
									<small class="text-muted">Current image: <?= htmlspecialchars($p['image']) ?></small>
								</div>
								<input type="file" name="image" class="form-control" accept="image/*">
							</div>

							<div class="col-md-6">
								<label class="form-label fw-bold">Header Background Image</label>
								<div class="d-flex align-items-center gap-3 mb-2">
									<img src="../../<?= htmlspecialchars($p['banner_image']) ?>" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
									<small class="text-muted">Current banner: <?= htmlspecialchars($p['banner_image']) ?></small>
								</div>
								<input type="file" name="banner_image" class="form-control" accept="image/*">
							</div>

							<div class="col-12">
								<div class="form-check form-switch mt-2">
									<input class="form-check-input" type="checkbox" name="status" id="statusSwitch" <?= ($p['status'] == 1) ? 'checked' : '' ?>>
									<label class="form-check-label fw-bold" for="statusSwitch">Publish Active on Public Website</label>
								</div>
							</div>

							<div class="col-12 mt-4">
								<button type="submit" name="update_product" class="btn btn-antara-gold px-4 py-2">
									<i class="fa-solid fa-save me-1"></i> Save Changes
								</button>
								<a href="manage-products.php" class="btn btn-light px-4 py-2 ms-2">Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
		<?php require('includes/footer.php'); ?>
	</div>
</body>
</html>
