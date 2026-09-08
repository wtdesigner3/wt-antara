<?php 
require('checksession.php'); 
require('../inc/function.php');

$msg = "";
$error = "";

// Ensure upload directory exists
$upload_dir = __DIR__ . '/../../uploads/blogs/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if (isset($_POST['add_blog'])) {
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
    $b_image = "assets/img/inner-page/news/01.jpg"; // default
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
        // Ensure slug uniqueness
        $chk_slug = mysqli_query($conn, "SELECT `b_id` FROM `tbl_blogs` WHERE `b_url` = '$slug'");
        if (mysqli_num_rows($chk_slug) > 0) {
            $slug .= '-' . time();
        }

        $insert_sql = "INSERT INTO `tbl_blogs` 
            (`b_title`, `b_url`, `b_category`, `author`, `b_image`, `b_short_desc`, `b_description`, `b_quote`, `b_quote_author`, `b_tags`, `read_time`, `b_date`, `b_status`, `b_sort`, `metatag`, `metakeyword`, `metadesc`)
            VALUES 
            ('$title', '$slug', '$category', '$author', '$b_image', '$short_desc', '$description', '$quote', '$quote_author', '$tags', '$read_time', '$date', '$status', '$sort', '$metatag', '$metakeyword', '$metadesc')";

        if (mysqli_query($conn, $insert_sql)) {
            header("Location: manage-blogs.php?msg=" . urlencode("Article published successfully!"));
            exit();
        } else {
            $error = "Error adding article: " . mysqli_error($conn);
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
					<h1 class="page-header mb-1" style="font-size: 26px;">Create New Article / Report</h1>
					<p class="text-muted mb-0">Publish a new industry insight, commodity harvest report, or market update.</p>
				</div>
				<a href="manage-blogs.php" class="btn btn-outline-secondary">
					<i class="fa-solid fa-arrow-left me-1"></i> Back to Articles
				</a>
			</div>

			<?php if ($error != ""): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<i class="fa-solid fa-triangle-exclamation me-2"></i> <?= $error ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif; ?>

			<div class="panel">
				<div class="panel-body p-4">
					<form method="POST" action="add-blogs.php" enctype="multipart/form-data">
						<div class="row g-4">
							<div class="col-md-8">
								<label class="form-label fw-bold">Article Title <span class="text-danger">*</span></label>
								<input type="text" name="b_title" id="articleTitle" class="form-control" placeholder="e.g. Navigating Indian Arabica Harvests & Export Quality..." required>
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
								<input type="text" name="b_category" list="categorySuggestions" class="form-control" placeholder="Select or type new category..." value="Export Insights" required>
								<datalist id="categorySuggestions">
									<?php foreach ($all_suggestions as $cat_opt): ?>
										<option value="<?= htmlspecialchars($cat_opt) ?>"></option>
									<?php endforeach; ?>
								</datalist>
								<small class="text-muted">Type any new category name to create it, or pick from suggestions.</small>
							</div>

							<div class="col-md-6">
								<label class="form-label fw-bold">URL Slug (Permalink)</label>
								<input type="text" name="b_url" id="articleSlug" class="form-control" placeholder="e.g. indian-arabica-harvest-report (auto-generated if empty)">
								<small class="text-muted">Unique SEO slug used in /blog-detail.php?url=slug</small>
							</div>

							<div class="col-md-3">
								<label class="form-label fw-bold">Estimated Read Time</label>
								<input type="text" name="read_time" class="form-control" value="5 min read" placeholder="e.g. 5 min read">
							</div>

							<div class="col-md-3">
								<label class="form-label fw-bold">Publication Date</label>
								<input type="date" name="b_date" class="form-control" value="<?= date('Y-m-d') ?>">
							</div>

							<div class="col-12">
								<label class="form-label fw-bold">Featured Image</label>
								<input type="file" name="b_image" class="form-control" accept="image/*">
								<small class="text-muted">Recommended resolution: 1200 &times; 675 px (JPG, PNG, WebP).</small>
							</div>

							<div class="col-12">
								<label class="form-label fw-bold">Short Summary / Card Excerpt (Optional)</label>
								<textarea name="b_short_desc" class="form-control" rows="3" placeholder="Brief 1-2 sentence overview for the blog cards and Google snippets... (Leave blank to hide)"></textarea>
								<small class="text-muted">Displayed on the blog archive cards as a teaser.</small>
							</div>

							<div class="col-12">
								<label class="form-label fw-bold">Full Article Content (Rich Text / HTML)</label>
								<textarea name="b_description" id="editor_blog_content" class="form-control ckeditor" rows="12" placeholder="Write full article body content (supports paragraphs, headings, bulleted lists, bold text)..."></textarea>
							</div>

							<!-- SEO Meta Settings -->
							<div class="col-md-4">
								<label class="form-label fw-bold">Meta Title (SEO)</label>
								<input type="text" name="metatag" class="form-control" placeholder="Custom SEO browser title">
							</div>

							<div class="col-md-4">
								<label class="form-label fw-bold">Meta Keywords (SEO)</label>
								<input type="text" name="metakeyword" class="form-control" placeholder="coffee, spices, export, horeca">
							</div>

							<div class="col-md-4">
								<label class="form-label fw-bold">Meta Description (SEO)</label>
								<input type="text" name="metadesc" class="form-control" placeholder="Concise summary for search engines">
							</div>

							<div class="col-md-6">
								<label class="form-label fw-bold">Display Sort Order</label>
								<input type="number" name="b_sort" class="form-control" value="0">
								<small class="text-muted">Lower numbers display first.</small>
							</div>

							<div class="col-md-6">
								<label class="form-label fw-bold">Publish Status</label>
								<div class="form-check form-switch mt-2">
									<input class="form-check-input" type="checkbox" role="switch" id="b_status" name="b_status" value="1" checked style="cursor: pointer; transform: scale(1.2);">
									<label class="form-check-label ms-2 fw-semibold" for="b_status">Published Live</label>
								</div>
							</div>

							<!-- Form Action Buttons -->
							<div class="col-12 mt-4 pt-3 border-top d-flex align-items-center justify-content-between">
								<a href="manage-blogs.php" class="btn btn-outline-secondary px-4 py-2">Cancel</a>
								<button type="submit" name="add_blog" class="btn btn-warning fw-bold shadow-sm px-5 py-2">
									<i class="fa-solid fa-plus-circle me-1"></i> Publish Article
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php require('includes/footer.php'); ?>
	</div>

	<script>
		// Real-time slug auto-generator
		document.getElementById('articleTitle')?.addEventListener('input', function() {
			const slugInput = document.getElementById('articleSlug');
			if (slugInput && (!slugInput.value || slugInput.dataset.auto !== 'false')) {
				const title = this.value;
				const slug = title.toLowerCase()
					.replace(/[^a-z0-9\s-]/g, '')
					.replace(/\s+/g, '-')
					.replace(/-+/g, '-');
				slugInput.value = slug;
			}
		});
		document.getElementById('articleSlug')?.addEventListener('input', function() {
			this.dataset.auto = 'false';
		});
	</script>
</body>
</html>
