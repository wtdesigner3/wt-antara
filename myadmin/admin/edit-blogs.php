<?php 
require('checksession.php'); 
require('../inc/function.php');

$msg = "";
$error = "";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header("Location: manage-blogs.php");
    exit();
}

$upload_dir = __DIR__ . '/../../uploads/blogs/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Fetch Existing Record
$art = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_blogs` WHERE `b_id` = $id"));
if (!$art) {
    header("Location: manage-blogs.php");
    exit();
}

if (isset($_POST['update_blog'])) {
    $title         = mysqli_real_escape_string($conn, trim($_POST['b_title'] ?? ''));
    $url_input     = trim($_POST['b_url'] ?? '');
    
    if (empty($url_input)) {
        $url_input = $title;
    }
    $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', trim($url_input)));
    $slug = trim($slug, '-');
    $slug = mysqli_real_escape_string($conn, $slug);

    $category      = mysqli_real_escape_string($conn, trim($_POST['b_category'] ?? 'Export Insights'));
    $author        = "Antara Trade Desk";
    $read_time     = mysqli_real_escape_string($conn, trim($_POST['read_time'] ?? '5 min read'));
    $date          = !empty($_POST['b_date']) ? mysqli_real_escape_string($conn, $_POST['b_date']) : date('Y-m-d');
    $short_desc    = mysqli_real_escape_string($conn, trim($_POST['b_short_desc'] ?? ''));
    $description   = mysqli_real_escape_string($conn, trim($_POST['b_description'] ?? ''));
    $quote         = "";
    $quote_author  = "";
    $tags          = "";
    $status        = isset($_POST['b_status']) ? 1 : 0;
    $sort          = intval($_POST['b_sort'] ?? 0);

    $metatag       = mysqli_real_escape_string($conn, trim($_POST['metatag'] ?? ''));
    $metakeyword   = mysqli_real_escape_string($conn, trim($_POST['metakeyword'] ?? ''));
    $metadesc      = mysqli_real_escape_string($conn, trim($_POST['metadesc'] ?? ''));

    // Handle Featured Image Upload
    $b_image = $art['b_image'];
    if (isset($_FILES['b_image']) && $_FILES['b_image']['error'] == 0) {
        $uploaded = upload_image('b_image', '../../uploads/blogs/');
        if ($uploaded) {
            $b_image = "uploads/blogs/" . $uploaded;
        } else {
            $file_ext = strtolower(pathinfo($_FILES['b_image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
            if (in_array($file_ext, $allowed)) {
                $new_name = 'blog_' . time() . '_' . rand(1000, 9999) . '.' . $file_ext;
                if (move_uploaded_file($_FILES['b_image']['tmp_name'], $upload_dir . $new_name)) {
                    $b_image = "uploads/blogs/" . $new_name;
                }
            }
        }
    }

    if (empty($title)) {
        $error = "Please provide an article title.";
    } else {
        // Check slug uniqueness excluding current id
        $chk_slug = mysqli_query($conn, "SELECT `b_id` FROM `tbl_blogs` WHERE `b_url` = '$slug' AND `b_id` != $id");
        if (mysqli_num_rows($chk_slug) > 0) {
            $slug .= '-' . time();
        }

        $update_sql = "UPDATE `tbl_blogs` SET 
            `b_title` = '$title',
            `b_url` = '$slug',
            `b_category` = '$category',
            `author` = '$author',
            `b_image` = '$b_image',
            `b_short_desc` = '$short_desc',
            `b_description` = '$description',
            `b_quote` = '$quote',
            `b_quote_author` = '$quote_author',
            `b_tags` = '$tags',
            `read_time` = '$read_time',
            `b_date` = '$date',
            `b_status` = '$status',
            `b_sort` = '$sort',
            `metatag` = '$metatag',
            `metakeyword` = '$metakeyword',
            `metadesc` = '$metadesc'
            WHERE `b_id` = $id";

        if (mysqli_query($conn, $update_sql)) {
            $msg = "Article updated successfully!";
            // Refresh record
            $art = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `tbl_blogs` WHERE `b_id` = $id"));
        } else {
            $error = "Error updating article: " . mysqli_error($conn);
        }
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
					<h1 class="page-header mb-1" style="font-size: 26px;">Edit Article: <?= htmlspecialchars($art['b_title']) ?></h1>
					<p class="text-muted mb-0">Modify content, featured image, SEO settings, or publish status.</p>
				</div>
				<div class="d-flex gap-2">
					<a href="../../blog-detail.php?url=<?= urlencode($art['b_url']) ?>" target="_blank" class="btn btn-outline-success">
						<i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Preview Live
					</a>
					<a href="manage-blogs.php" class="btn btn-outline-secondary">
						<i class="fa-solid fa-arrow-left me-1"></i> Back to Articles
					</a>
				</div>
			</div>

			<?php if ($msg != ""): ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="fa-solid fa-circle-check me-2"></i> <?= $msg ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif; ?>

			<?php if ($error != ""): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<i class="fa-solid fa-triangle-exclamation me-2"></i> <?= $error ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif; ?>

			<div class="panel">
				<div class="panel-body p-4">
					<form method="POST" action="edit-blogs.php?id=<?= $art['b_id'] ?>" enctype="multipart/form-data">
						<div class="row g-4">
							<div class="col-md-8">
								<label class="form-label fw-bold">Article Title <span class="text-danger">*</span></label>
								<input type="text" name="b_title" class="form-control" value="<?= htmlspecialchars($art['b_title']) ?>" required>
							</div>

							<div class="col-md-4">
								<label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
								<?php
								$existing_cats = [];
								$cat_q = mysqli_query($conn, "SELECT DISTINCT `b_category` FROM `tbl_blogs` WHERE `b_category` IS NOT NULL AND `b_category` != '' ORDER BY `b_category` ASC");
								if ($cat_q) {
									while ($crow = mysqli_fetch_assoc($cat_q)) {
										if (!empty(trim($crow['b_category']))) {
											$existing_cats[] = trim($crow['b_category']);
										}
									}
								}
								$default_suggestions = ['Export Insights', 'Coffee Insights', 'Spice Trade', 'HORECA Supply', 'Tea Industry', 'Supply Chain & Logistics', 'Quality & Compliance', 'Market Trends'];
								$all_suggestions = array_unique(array_merge($existing_cats, $default_suggestions));
								?>
								<input type="text" name="b_category" list="categorySuggestions" class="form-control" placeholder="Select or type new category..." value="<?= htmlspecialchars($art['b_category']) ?>" required>
								<datalist id="categorySuggestions">
									<?php foreach ($all_suggestions as $cat_opt): ?>
										<option value="<?= htmlspecialchars($cat_opt) ?>"></option>
									<?php endforeach; ?>
								</datalist>
								<small class="text-muted">Type any new category name or pick from existing suggestions.</small>
							</div>

							<div class="col-md-6">
								<label class="form-label fw-bold">URL Slug (Permalink)</label>
								<input type="text" name="b_url" class="form-control" value="<?= htmlspecialchars($art['b_url']) ?>" required>
								<small class="text-muted">Direct permalink on the frontend: /blog-detail.php?url=<?= htmlspecialchars($art['b_url']) ?></small>
							</div>

							<div class="col-md-3">
								<label class="form-label fw-bold">Estimated Read Time</label>
								<input type="text" name="read_time" class="form-control" value="<?= htmlspecialchars($art['read_time'] ?? '5 min read') ?>">
							</div>

							<div class="col-md-3">
								<label class="form-label fw-bold">Publication Date</label>
								<input type="date" name="b_date" class="form-control" value="<?= htmlspecialchars($art['b_date']) ?>">
							</div>

							<div class="col-12">
								<label class="form-label fw-bold">Featured Image</label>
								<?php if (!empty($art['b_image'])): ?>
									<?php 
									$img_src = (strpos($art['b_image'], 'assets/') === 0) ? '../../' . $art['b_image'] : '../../' . $art['b_image'];
									?>
									<div class="d-flex align-items-center gap-3 mb-2 p-2 bg-light rounded border">
										<img src="<?= htmlspecialchars($img_src) ?>" alt="" style="width: 70px; height: 50px; object-fit: cover; border-radius: 4px;">
										<small class="text-muted font-monospace"><?= htmlspecialchars(basename($art['b_image'])) ?></small>
									</div>
								<?php endif; ?>
								<input type="file" name="b_image" class="form-control" accept="image/*">
								<small class="text-muted">Upload a new image to replace current.</small>
							</div>

							<div class="col-12">
								<label class="form-label fw-bold">Short Summary / Card Excerpt (Optional)</label>
								<textarea name="b_short_desc" class="form-control" rows="3"><?= htmlspecialchars($art['b_short_desc'] ?? '') ?></textarea>
								<small class="text-muted">Displayed on the blog archive cards as a teaser.</small>
							</div>

							<div class="col-12">
								<label class="form-label fw-bold">Full Article Content (Rich Text / HTML)</label>
								<textarea name="b_description" id="editor_blog_content" class="form-control ckeditor" rows="12"><?= htmlspecialchars($art['b_description'] ?? '') ?></textarea>
							</div>

							<!-- SEO Meta Settings -->
							<div class="col-md-4">
								<label class="form-label fw-bold">Meta Title (SEO)</label>
								<input type="text" name="metatag" class="form-control" value="<?= htmlspecialchars($art['metatag'] ?? '') ?>">
							</div>

							<div class="col-md-4">
								<label class="form-label fw-bold">Meta Keywords (SEO)</label>
								<input type="text" name="metakeyword" class="form-control" value="<?= htmlspecialchars($art['metakeyword'] ?? '') ?>">
							</div>

							<div class="col-md-4">
								<label class="form-label fw-bold">Meta Description (SEO)</label>
								<input type="text" name="metadesc" class="form-control" value="<?= htmlspecialchars($art['metadesc'] ?? '') ?>">
							</div>

							<div class="col-md-6">
								<label class="form-label fw-bold">Display Sort Order</label>
								<input type="number" name="b_sort" class="form-control" value="<?= htmlspecialchars($art['b_sort'] ?? '0') ?>">
								<small class="text-muted">Lower numbers display first.</small>
							</div>

							<div class="col-md-6">
								<label class="form-label fw-bold">Publish Status</label>
								<div class="form-check form-switch mt-2">
									<input class="form-check-input" type="checkbox" role="switch" id="b_status" name="b_status" value="1" <?= ($art['b_status'] == 1) ? 'checked' : '' ?> style="cursor: pointer; transform: scale(1.2);">
									<label class="form-check-label ms-2 fw-semibold" for="b_status">Published Live</label>
								</div>
							</div>

							<!-- Form Action Buttons -->
							<div class="col-12 mt-4 pt-3 border-top d-flex align-items-center justify-content-between">
								<a href="manage-blogs.php" class="btn btn-outline-secondary px-4 py-2">Cancel</a>
								<button type="submit" name="update_blog" class="btn btn-warning fw-bold shadow-sm px-5 py-2">
									<i class="fa-solid fa-save me-1"></i> Save Changes
								</button>
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
