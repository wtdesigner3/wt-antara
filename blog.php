<?php
require_once __DIR__ . '/inc/db.php';

// Fetch all active blogs
$blogs = get_blogs('', '', '', 24, 0);
$total_blogs = get_blogs_count();

// Dynamic Page Meta
$page_title = "Market Insights & Trade Intelligence | Antara Globale";
$page_desc  = "Export market reports, quality standards, harvest updates, and supply chain insights for Indian green coffee beans, spices, tea, and HORECA ingredients.";
$active_nav = 'blog';

require_once __DIR__ . '/inc/header.php';
?>

<style>
/* Card Hover Elevation */
.blog-card-box {
    transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    border: 1px solid #E9EFEA !important;
}
.blog-card-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 34px rgba(18, 48, 35, 0.1) !important;
    border-color: #C2D8CD !important;
}
.blog-card-box:hover img {
    transform: scale(1.05);
}
.blog-card-box img {
    transition: transform 0.5s ease;
}
</style>

<!-- Dynamic Header Breadcrumb Section Start -->
<div class="breadcrumb-wrapper bg-cover header-bg-blog">
    <div class="container">
        <div class="page-heading text-center">
            <div class="breadcrumb-sub-title">
                <h1 class="text-white wow fadeInUp" data-wow-delay=".3s" style="font-size: 46px;">
                    Market Insights &amp; Trade Intelligence
                </h1>
            </div>
            <ul class="breadcrumb-items wow fadeInUp d-flex justify-content-center gap-2 list-unstyled mt-3" data-wow-delay=".5s" style="color: #E0E7E1;">
                <li><a href="index.php" class="text-white"><i class="fa-solid fa-house"></i> Home</a></li>
                <li>/</li>
                <li class="text-warning">Insights</li>
            </ul>
        </div>
    </div>
</div>

<!-- Main Blog Section Start (Full-Width 4-Cards Grid) -->
<section class="section-padding py-5" style="background-color: #F8FAF9;">
    <div class="container-fluid px-lg-5">
        
        <!-- 4-Cards Per Row Grid -->
        <?php if (!empty($blogs)): ?>
            <div class="row g-4">
                <?php foreach ($blogs as $post): ?>
                    <?php
                    $post_img = get_blog_image_url($post['b_image'] ?? '');
                    $post_url = 'blog-detail.php?url=' . urlencode($post['b_url']);
                    $post_date = !empty($post['b_date']) ? date('M d, Y', strtotime($post['b_date'])) : 'Recent';
                    $read_time = !empty($post['read_time']) ? $post['read_time'] : '5 min read';
                    $excerpt = clean_output(strip_tags(html_entity_decode($post['b_short_desc'] ?? '')));
                    ?>
                    <!-- 4 Columns per Row (col-xl-3 col-lg-4 col-md-6 col-12) -->
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 d-flex">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white w-100 d-flex flex-column blog-card-box">
                            <!-- Card Image -->
                            <div class="position-relative overflow-hidden" style="height: 220px;">
                                <a href="<?= $post_url ?>" class="d-block w-100 h-100">
                                    <img src="<?= htmlspecialchars($post_img) ?>" alt="<?= clean_output($post['b_title']) ?>" class="w-100 h-100 object-fit-cover">
                                </a>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body p-4 d-flex flex-column flex-grow-1">
                                <!-- Meta: Date & Read Time -->
                                <div class="d-flex align-items-center justify-content-between text-muted small mb-2" style="font-size: 12px;">
                                    <span><i class="fa-regular fa-calendar text-warning me-1"></i> <?= htmlspecialchars($post_date) ?></span>
                                    <span><i class="fa-regular fa-clock text-warning me-1"></i> <?= clean_output($read_time) ?></span>
                                </div>

                                <!-- Title -->
                                <h3 class="h5 fw-bold mb-2" style="font-size: 16px; line-height: 1.45;">
                                    <a href="<?= $post_url ?>" class="text-dark text-decoration-none hover-primary">
                                        <?= clean_output($post['b_title']) ?>
                                    </a>
                                </h3>

                                <!-- Short Excerpt (if present) -->
                                <?php if (!empty($excerpt)): ?>
                                    <p class="text-muted small mb-3 flex-grow-1" style="font-size: 13.5px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                        <?= $excerpt ?>
                                    </p>
                                <?php endif; ?>

                                <!-- Card Footer Action -->
                                <div class="pt-3 border-top border-light mt-auto">
                                    <a href="<?= $post_url ?>" class="fw-bold text-success text-decoration-none small d-inline-flex align-items-center gap-1">
                                        Read Full Report <i class="fa-solid fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fa-solid fa-newspaper text-muted display-4 mb-3 d-block"></i>
                <h4 class="text-dark">No Articles Found</h4>
                <p class="text-muted">Check back soon for new trade insights, harvest reports, and market updates.</p>
                <a href="index.php" class="btn btn-warning fw-bold px-4">Back to Home</a>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php require_once __DIR__ . '/inc/footer.php'; ?>
