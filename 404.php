<?php
http_response_code(404);
require_once __DIR__ . '/inc/db.php';
$site_title = "404 - Page Not Found | Antara Globale";
$page_title = "Page Not Found";
require_once __DIR__ . '/inc/header.php';
?>

<!-- 404 Hero Banner -->
<section class="breadcrumb-wrapper bg-cover text-center py-5" style="background-color: var(--theme-dark, #0B2418); padding: 120px 0 80px;">
    <div class="container">
        <div class="page-heading">
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-semibold mb-3">Error 404</span>
            <h1 class="text-white fw-bold display-4 mb-3" style="font-family: 'Instrument Sans', sans-serif;">Page Not Found</h1>
            <p class="text-white-50 mx-auto" style="max-width: 600px; font-size: 1.1rem;">
                The commodity, page, or document you are looking for might have been moved, updated, or is no longer available.
            </p>
        </div>
    </div>
</section>

<!-- 404 Content & Actions -->
<section class="py-5" style="background-color: var(--bg, #FAF8F5);">
    <div class="container text-center py-5">
        <div class="mb-4">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 120px; height: 120px; background: rgba(27, 77, 62, 0.08);">
                <i class="fa-solid fa-compass display-4" style="color: var(--theme, #1B4D3E);"></i>
            </div>
        </div>
        <h2 class="fw-bold mb-3" style="color: var(--theme-dark, #0B2418);">Looking for something specific?</h2>
        <p class="text-muted mx-auto mb-4" style="max-width: 520px; font-size: 1.05rem;">
            Explore our export commodities catalog, HORECA beverage supplies, or contact our trade desk directly.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="/" class="theme-btn gold-btn px-4 py-3">
                <i class="fa-solid fa-house me-2"></i> Return to Homepage
            </a>
            <a href="/export-supply" class="theme-btn border-btn px-4 py-3" style="border-color: var(--theme, #1B4D3E); color: var(--theme, #1B4D3E) !important;">
                <i class="fa-solid fa-ship me-2"></i> Export Commodities
            </a>
            <a href="/contact" class="theme-btn bg-dark text-white px-4 py-3">
                <i class="fa-solid fa-envelope me-2"></i> Contact Desk
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/inc/footer.php'; ?>
