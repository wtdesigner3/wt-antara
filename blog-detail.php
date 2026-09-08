<?php
require_once __DIR__ . '/inc/db.php';

$article_url = isset($_GET['url']) ? trim($_GET['url']) : '';
$article_id  = isset($_GET['id']) ? intval($_GET['id']) : 0;

$post = null;
if (!empty($article_url)) {
    $post = get_blog_by_url($article_url);
} elseif ($article_id > 0) {
    $post = get_blog_by_id($article_id);
}

// Fallback: If no parameters provided or not found, grab the latest article
if (!$post) {
    $latest = get_blogs('', '', '', 1);
    if (!empty($latest)) {
        $post = $latest[0];
    } else {
        header("Location: blog.php");
        exit();
    }
}

// Fetch related articles for the sticky right sidebar
$related_posts = get_recent_blogs(6, $post['b_id']);

// Page Meta & SEO
$page_title = !empty($post['metatag']) ? $post['metatag'] : clean_output($post['b_title']) . " | Antara Globale Insights";
$page_desc  = !empty($post['metadesc']) ? $post['metadesc'] : clean_output($post['b_short_desc']);
$active_nav = 'blog';

$post_img = get_blog_image_url($post['b_image'] ?? '');
$post_date = !empty($post['b_date']) ? date('F d, Y', strtotime($post['b_date'])) : 'Recent';
$read_time = !empty($post['read_time']) ? $post['read_time'] : '5 min read';
$category = !empty($post['b_category']) ? $post['b_category'] : 'Trade Insights';

// Share URLs
$current_full_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$encoded_url = urlencode($current_full_url);
$encoded_title = urlencode($post['b_title']);

require_once __DIR__ . '/inc/header.php';
?>

<!-- Dynamic Header Breadcrumb Section Start -->
<div class="breadcrumb-wrapper bg-cover header-bg-blog">
    <div class="container">
        <div class="page-heading text-center">
            <div class="breadcrumb-sub-title">
                <h1 class="text-white wow fadeInUp" data-wow-delay=".3s" style="font-size: clamp(26px, 3.5vw, 44px); max-width: 950px; margin-inline: auto; line-height: 1.35;">
                    <?= clean_output($post['b_title']) ?>
                </h1>
            </div>
            <ul class="breadcrumb-items wow fadeInUp d-flex justify-content-center gap-2 list-unstyled mt-3" data-wow-delay=".5s" style="color: #E0E7E1;">
                <li><a href="index.php" class="text-white"><i class="fa-solid fa-house"></i> Home</a></li>
                <li>/</li>
                <li><a href="blog.php" class="text-white">Insights</a></li>
                <li>/</li>
                <li class="text-warning">Article</li>
            </ul>
        </div>
    </div>
</div>

<!-- Main Article Detail Section Start -->
<section class="news-details-section section-padding py-5" style="background-color: #F8FAF9; overflow: visible !important;">
    <div class="container" style="overflow: visible !important;">
        <div class="row g-4" style="overflow: visible !important; position: relative;">
            
            <!-- Left Column: Article Body (8 Cols) -->
            <div class="col-lg-8">
                <article class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-4 p-md-5">
                    
                    <!-- Featured Hero Image -->
                    <div class="mb-4 rounded-4 overflow-hidden position-relative shadow-sm" style="max-height: 480px;">
                        <img src="<?= htmlspecialchars($post_img) ?>" alt="<?= clean_output($post['b_title']) ?>" class="img-fluid w-100 object-fit-cover" style="max-height: 460px; object-fit: cover;">
                    </div>

                    <!-- Article Lead Excerpt -->
                    <?php 
                    $detail_excerpt = clean_output(strip_tags(html_entity_decode($post['b_short_desc'] ?? '')));
                    if (!empty($detail_excerpt)): 
                    ?>
                        <div class="p-3 p-md-4 rounded-3 mb-4" style="background-color: #F3F7F5; border-left: 4px solid #123023;">
                            <p class="lead mb-0 fw-semibold" style="font-size: 16.5px; line-height: 1.65; color: #123023;">
                                <?= $detail_excerpt ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <!-- Main Rich Text Content -->
                    <div class="article-content-body text-dark" style="font-size: 15.5px; line-height: 1.85;">
                        <?= $post['b_description'] ?>
                    </div>
                </article>
            </div>

            <!-- Right Column: ONLY Related Blogs Block (Sticky Sidebar) -->
            <div class="col-lg-4" style="overflow: visible !important;">
                <div class="sticky-sidebar-wrapper" style="position: -webkit-sticky; position: sticky; top: 100px; z-index: 10;">
                    <?php if (!empty($related_posts)): ?>
                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                                <h4 class="fw-bold mb-0" style="font-size: 18px; color: #123023;">
                                    <i class="fa-solid fa-newspaper text-warning me-2"></i> Related Insights
                                </h4>
                                <a href="blog.php" class="text-success small fw-semibold text-decoration-none">
                                    View All <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>

                            <div class="d-flex flex-column gap-3">
                                <?php foreach ($related_posts as $rec): ?>
                                    <?php
                                    $rec_img = get_blog_image_url($rec['b_image'] ?? '');
                                    $rec_url = 'blog-detail.php?url=' . urlencode($rec['b_url']);
                                    $rec_date = !empty($rec['b_date']) ? date('M d, Y', strtotime($rec['b_date'])) : '';
                                    ?>
                                    <div class="d-flex align-items-center gap-3 p-2 rounded-3 hover-bg-light transition-all">
                                        <a href="<?= $rec_url ?>" class="flex-shrink-0 d-block overflow-hidden rounded-3" style="width: 75px; height: 62px;">
                                            <img src="<?= htmlspecialchars($rec_img) ?>" alt="<?= clean_output($rec['b_title']) ?>" class="w-100 h-100 object-fit-cover">
                                        </a>
                                        <div class="flex-grow-1">
                                            <div class="text-muted small mb-1" style="font-size: 11.5px;">
                                                <i class="fa-regular fa-calendar text-warning me-1"></i> <?= htmlspecialchars($rec_date) ?>
                                            </div>
                                            <h5 class="mb-0 fw-semibold" style="font-size: 13.5px; line-height: 1.4;">
                                                <a href="<?= $rec_url ?>" class="text-dark text-decoration-none hover-primary">
                                                    <?= clean_output($rec['b_title']) ?>
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php require_once __DIR__ . '/inc/footer.php'; ?>
