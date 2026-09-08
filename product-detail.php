<?php
require_once __DIR__ . '/inc/db.php';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : (isset($_GET['id']) ? trim($_GET['id']) : 'supply-coffee');
$product = get_product($slug);

// Fallback if product not found
if (!$product) {
    // Default to first product
    $product = get_product('supply-coffee');
}

$page_title = $product['name'] . ' | ' . (($product['division'] == 'export') ? 'Indian Commodity Export' : 'Restaurant & Café Supply') . ' | Antara Globale';
$page_description = $product['tagline'] . ' - ' . substr(strip_tags($product['description']), 0, 155);

require_once __DIR__ . '/inc/header.php';

// Parse Available Varieties
$varieties_list = array_map('trim', explode(',', $product['available_varieties']));

// Parse Specifications (split by semicolon if present)
$raw_specs = strip_tags(html_entity_decode($product['specifications'] ?? ''));
$specs_array = [];
if (strpos($raw_specs, ';') !== false) {
    $pairs = explode(';', $raw_specs);
    foreach ($pairs as $pair) {
        if (strpos($pair, ':') !== false) {
            list($k, $v) = explode(':', $pair, 2);
            $clean_k = trim($k);
            $clean_v = trim($v);
            if (!empty($clean_k)) {
                $specs_array[$clean_k] = $clean_v;
            }
        }
    }
}

// Fetch Related Products: prioritize current division, supplement with other division to ensure rich carousel
$related_products = [];
$rel_res = mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE `division`='{$product['division']}' AND `id` != {$product['id']} AND `status`=1 ORDER BY `sort` ASC");
if ($rel_res) {
    while ($r = mysqli_fetch_assoc($rel_res)) {
        $related_products[] = $r;
    }
}
// If fewer than 6 related products in same division, supplement with products from other division for rich carousel
if (count($related_products) < 6) {
    $needed = 8 - count($related_products);
    $supp_res = mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE `id` != {$product['id']} AND `division` != '{$product['division']}' AND `status`=1 ORDER BY `sort` ASC LIMIT $needed");
    if ($supp_res) {
        while ($r = mysqli_fetch_assoc($supp_res)) {
            $related_products[] = $r;
        }
    }
}
?>

    <div id="smooth-wrapper" style="overflow: visible !important;">
        <div id="smooth-content" style="overflow: visible !important;">

            <!-- Dynamic Header Section Start -->
            <div class="breadcrumb-wrapper bg-cover" style="background-image: url('<?= clean_output($product['banner_image']) ?>') !important;">
                <div class="container">
                    <div class="page-heading text-center">
                        <div class="breadcrumb-sub-title">
                            <h1 class="text-white wow fadeInUp" data-wow-delay=".3s" style="font-size: 46px;">
                                <?= clean_output($product['name']) ?>
                            </h1>
                        </div>
                        <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                            <li><a href="index.php"><i class="fa-solid fa-house"></i> Home</a></li>
                            <li>/</li>
                            <li>
                                <span class="text-white-50">
                                    <?= ($product['division'] == 'export') ? 'Export &amp; Supply' : 'Restaurant &amp; Café' ?>
                                </span>
                            </li>
                            <li>/</li>
                            <li class="text-warning"><?= clean_output($product['name']) ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Product Detail Content Section Start -->
            <section class="section-padding product-detail-main-section" style="overflow: visible !important;">
                <div class="container" style="overflow: visible !important;">
                    <div class="row g-5 align-items-start" style="overflow: visible !important; position: relative;">
                        
                        <!-- Left Column: Product Showcase & Specifications Sticky Sidebar -->
                        <div class="col-lg-5 product-detail-left-col" style="position: sticky; top: 100px; z-index: 10;">
                            <div class="product-sticky-sidebar">
                                <div class="product-detail-img mb-3" style="border-radius: 18px; overflow: hidden; box-shadow: 0 12px 30px rgba(0,0,0,0.08); border: 1px solid var(--border);">
                                    <img src="<?= clean_output($product['image']) ?>" alt="<?= clean_output($product['name']) ?>" style="width: 100%; height: 330px; object-fit: cover; display: block;">
                                </div>
                                
                                <!-- Available Varieties / Grades Box -->
                                <?php 
                                $has_varieties = !empty(trim($product['available_varieties'] ?? ''));
                                if ($has_varieties): 
                                    $v_list = array_filter(array_map('trim', explode(',', $product['available_varieties'])));
                                    if (!empty($v_list)):
                                ?>
                                    <div class="region-card mb-3 p-3 rounded-3" style="background: #F9FAF9; border: 1.5px solid rgba(27, 77, 62, 0.12);">
                                        <h5 class="fw-bold mb-2 d-flex align-items-center gap-2" style="color: #123023; font-size: 16px;">
                                            <i class="fa-solid fa-layer-group text-warning"></i> Available Varieties &amp; Grades
                                        </h5>
                                        <div class="d-flex flex-wrap gap-2">
                                            <?php foreach ($v_list as $variety): ?>
                                                <span class="badge px-3 py-2 fw-semibold" style="background: rgba(18, 48, 35, 0.08); color: #123023; border: 1px solid rgba(18, 48, 35, 0.15); border-radius: 8px; font-size: 12.5px;">
                                                    <?= clean_output($variety) ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; endif; ?>

                                <!-- Brands Available Card -->
                                <?php if (!empty(trim($product['brands'] ?? ''))): ?>
                                    <div class="p-3 rounded-3 mb-3" style="background: #123023; color: #FFFFFF; border: 1px solid rgba(197, 160, 89, 0.3);">
                                        <h5 class="text-white fw-bold mb-2 d-flex align-items-center gap-2" style="font-size: 15px;">
                                            <i class="fa-solid fa-certificate text-warning"></i> Brand Sourcing
                                        </h5>
                                        <p class="mb-0 text-white text-opacity-80 small">
                                            <?= clean_output($product['brands']) ?>
                                        </p>
                                    </div>
                                <?php endif; ?>

                                <!-- Packaging & MOQ Specs Summary Box -->
                                <?php 
                                $has_packaging = !empty(trim($product['packaging'] ?? ''));
                                $has_moq = !empty(trim($product['moq'] ?? ''));
                                if ($has_packaging || $has_moq):
                                ?>
                                    <div class="p-3 rounded-3 mb-3" style="background: #FFFFFF; border: 1px solid var(--border); box-shadow: 0 4px 14px rgba(0,0,0,0.03);">
                                        <?php if ($has_packaging): ?>
                                            <div class="d-flex align-items-start gap-3 <?= $has_moq ? 'mb-2' : '' ?>">
                                                <div style="width: 38px; height: 38px; border-radius: 8px; background: rgba(197, 160, 89, 0.15); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                    <img src="assets/img/icons/export-packaging.svg" alt="Commercial Packaging" style="width: 24px; height: 24px; object-fit: contain;">
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 14px;">Commercial Packaging</h6>
                                                    <p class="mb-0 text-muted small"><?= clean_output($product['packaging']) ?></p>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($has_moq): ?>
                                            <div class="d-flex align-items-start gap-3">
                                                <div style="width: 38px; height: 38px; border-radius: 8px; background: rgba(27, 77, 62, 0.1); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                    <img src="assets/img/icons/seaport-logistics.svg" alt="Minimum Order Quantity" style="width: 24px; height: 24px; object-fit: contain;">
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 14px;">Minimum Order Quantity (MOQ)</h6>
                                                    <p class="mb-0 text-muted small"><?= clean_output($product['moq']) ?></p>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Direct Enquiry Trigger Card -->
                                <div class="p-4 rounded-3 text-white mb-4" style="background: linear-gradient(135deg, #123023 0%, #0A1C14 100%);">
                                    <h5 class="text-white fw-bold mb-2">Contract &amp; Volume Pricing</h5>
                                    <p class="small mb-3 text-white-50">Direct origin container consignments (FCL) or wholesale pallet dispatches customized to your import specifications.</p>
                                    <button type="button" class="theme-btn gold-btn w-100 justify-content-center" data-bs-toggle="modal" data-bs-target="#b2bEnquiryModal" data-product="<?= clean_output($product['name']) ?>" data-division="<?= clean_output($product['division']) ?>">
                                        Enquire About <?= clean_output($product['name']) ?> <i class="fa-solid fa-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Description, Technical Specs & Culinary Applications -->
                        <div class="col-lg-7">
                            <div class="mb-4">
                                <span class="badge px-3 py-2 text-uppercase mb-3 fw-bold" style="background: rgba(197, 160, 89, 0.15); color: #916E27; border: 1px solid rgba(197, 160, 89, 0.3); font-size: 11.5px; letter-spacing: 1px;">
                                    <?= ($product['division'] == 'export') ? 'Export Supply Chain' : 'HORECA Supply Division' ?>
                                </span>
                                <?php if (!empty(trim($product['tagline'] ?? ''))): ?>
                                    <h2 class="mb-3" style="font-size: 34px; font-weight: 700; color: #123023; font-family: 'Instrument Sans', sans-serif;">
                                        <?= clean_output($product['tagline']) ?>
                                    </h2>
                                <?php endif; ?>
                                <?php if (!empty(trim(strip_tags($product['description'] ?? '')))): ?>
                                    <div class="product-description-content mb-4" style="font-size: 16px; line-height: 1.8; color: #3A473B;">
                                        <?= (strpos($product['description'], '<p') !== false || strpos($product['description'], '<div') !== false) ? $product['description'] : '<p>' . nl2br(clean_output($product['description'])) . '</p>' ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Technical Specifications Table -->
                            <?php 
                            $has_specs = !empty($specs_array) || !empty(trim(strip_tags($product['specifications'] ?? '')));
                            if ($has_specs):
                            ?>
                                <div class="mb-5">
                                    <h4 class="mb-3 fw-bold" style="font-size: 22px; color: #123023; font-family: 'Instrument Sans';">
                                        <i class="fa-solid fa-table-list text-warning me-2"></i> Technical &amp; Quality Parameters
                                    </h4>
                                    
                                    <div class="spec-table-container shadow-sm border rounded-3 overflow-hidden">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <tr style="background-color: #F4F6F5;">
                                                    <th class="py-3 px-4 text-uppercase small fw-bold" style="width: 35%;">Parameter</th>
                                                    <th class="py-3 px-4 text-uppercase small fw-bold">Commercial Specification</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="py-3 px-4 fw-semibold text-muted">Product Name</td>
                                                    <td class="py-3 px-4 fw-bold text-dark"><?= clean_output($product['name']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-3 px-4 fw-semibold text-muted">Division</td>
                                                    <td class="py-3 px-4 text-dark"><?= ($product['division'] == 'export') ? 'Global Export Sourcing' : 'Restaurant, Café &amp; Hospitality Supply' ?></td>
                                                </tr>
                                                <?php if (!empty($specs_array)): ?>
                                                    <?php foreach ($specs_array as $param => $val): ?>
                                                        <tr>
                                                            <td class="py-3 px-4 fw-semibold text-muted"><?= clean_output($param) ?></td>
                                                            <td class="py-3 px-4 text-dark"><?= clean_output($val) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td class="py-3 px-4 fw-semibold text-muted">Specifications</td>
                                                        <td class="py-3 px-4 text-dark"><?= clean_output($product['specifications']) ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php if (!empty(trim($product['packaging'] ?? ''))): ?>
                                                    <tr>
                                                        <td class="py-3 px-4 fw-semibold text-muted">Packaging Format</td>
                                                        <td class="py-3 px-4 text-dark"><?= clean_output($product['packaging']) ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                                <?php if (!empty(trim($product['moq'] ?? ''))): ?>
                                                    <tr>
                                                        <td class="py-3 px-4 fw-semibold text-muted">Minimum Order Quantity</td>
                                                        <td class="py-3 px-4 fw-bold text-success"><?= clean_output($product['moq']) ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Commercial Applications & Usage -->
                            <?php if (!empty(trim($product['applications'] ?? ''))): ?>
                                <div class="mb-5">
                                    <h4 class="mb-3 fw-bold" style="font-size: 22px; color: #123023; font-family: 'Instrument Sans';">
                                        <i class="fa-solid fa-utensils text-warning me-2"></i> Commercial Applications &amp; Use Cases
                                    </h4>
                                    <div class="p-4 rounded-3" style="background: #F9FAF9; border: 1px solid var(--border);">
                                        <p class="mb-0 text-dark" style="line-height: 1.8; font-size: 15px;">
                                            <?= clean_output($product['applications']) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Sourcing Assurance & Trust Badges -->
                            <?php
                            $trust_badges = [];
                            if (!empty(trim($product['badge1_title'] ?? '')) || !empty(trim($product['badge1_desc'] ?? ''))) {
                                $b1_icon = !empty($product['badge1_icon']) ? $product['badge1_icon'] : 'assets/img/icons/pillar-2-quality.svg';
                                $trust_badges[] = [
                                    'icon' => $b1_icon,
                                    'title' => $product['badge1_title'] ?? '',
                                    'desc' => $product['badge1_desc'] ?? ''
                                ];
                            }
                            if (!empty(trim($product['badge2_title'] ?? '')) || !empty(trim($product['badge2_desc'] ?? ''))) {
                                $b2_icon = !empty($product['badge2_icon']) ? $product['badge2_icon'] : 'assets/img/icons/pillar-3-logistics.svg';
                                $trust_badges[] = [
                                    'icon' => $b2_icon,
                                    'title' => $product['badge2_title'] ?? '',
                                    'desc' => $product['badge2_desc'] ?? ''
                                ];
                            }
                            if (!empty(trim($product['badge3_title'] ?? '')) || !empty(trim($product['badge3_desc'] ?? ''))) {
                                $b3_icon = !empty($product['badge3_icon']) ? $product['badge3_icon'] : 'assets/img/icons/partnership-trust.svg';
                                $trust_badges[] = [
                                    'icon' => $b3_icon,
                                    'title' => $product['badge3_title'] ?? '',
                                    'desc' => $product['badge3_desc'] ?? ''
                                ];
                            }
                            if (!empty($trust_badges)):
                                $b_count = count($trust_badges);
                                $b_col = ($b_count >= 3) ? 'col-md-4' : (($b_count == 2) ? 'col-md-6' : 'col-12');
                            ?>
                            <div class="row g-3 justify-content-center">
                                <?php foreach ($trust_badges as $tb): ?>
                                    <div class="<?= $b_col ?>">
                                        <div class="p-3 rounded-3 text-center border bg-white h-100">
                                            <div style="width: 48px; height: 48px; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center;">
                                                <img src="<?= clean_output($tb['icon']) ?>" alt="<?= clean_output($tb['title']) ?>" style="width: 40px; height: 40px; object-fit: contain;">
                                            </div>
                                            <?php if (!empty($tb['title'])): ?>
                                                <h6 class="fw-bold mb-1"><?= clean_output($tb['title']) ?></h6>
                                            <?php endif; ?>
                                            <?php if (!empty($tb['desc'])): ?>
                                                <small class="text-muted"><?= clean_output($tb['desc']) ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </section>

            <!-- Related Products Section (Homepage Card Design with Carousel) -->
            <?php if (!empty($related_products)): ?>
                <section class="section-padding fix section-bg-3" style="background-color: var(--bg3);" data-aos="fade-up" data-aos-duration="850">
                    <div class="container">
                        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 pb-2" data-aos="fade-up">
                            <div>
                                <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">
                                    <?= ($product['division'] == 'export') ? 'Complementary Export Portfolio' : 'Related Restaurant &amp; Café Supplies' ?>
                                </span>
                                <h2 style="font-size: 36px; font-weight: 700; color: #123023;" class="mb-1">
                                    Related Products &amp; Sourcing Categories
                                </h2>
                                <p class="text-muted mb-0" style="max-width: 650px; font-size: 15.5px;">
                                    Explore complementary agricultural commodities and foodservice supplies available for commercial supply.
                                </p>
                            </div>
                            <div class="product-slider-ctrl mt-3 mt-md-0">
                                <div class="product-slider-btn related-slider-prev" aria-label="Previous Related Product">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </div>
                                <div class="product-slider-btn related-slider-next" aria-label="Next Related Product">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Swiper Carousel Container -->
                        <div class="product-swiper-container" data-aos="fade-up" data-aos-delay="150">
                            <div class="swiper related-product-swiper-active">
                                <div class="swiper-wrapper">
                                    <?php foreach ($related_products as $rel): ?>
                                        <div class="swiper-slide">
                                            <div class="b2b-product-card">
                                                <div class="b2b-card-bg">
                                                    <img src="<?= clean_output($rel['image']) ?>" alt="<?= clean_output($rel['name']) ?>">
                                                </div>
                                                <a href="product-detail.php?slug=<?= clean_output($rel['slug']) ?>" class="b2b-card-circle-btn" title="View Specifications">
                                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                </a>
                                                <div class="b2b-card-glass-bottom">
                                                    <h3 class="b2b-card-glass-title">
                                                        <a href="product-detail.php?slug=<?= clean_output($rel['slug']) ?>"><?= clean_output($rel['name']) ?></a>
                                                    </h3>
                                                    <div class="b2b-card-glass-sub">
                                                        <i class="fa-solid <?= ($rel['division'] == 'export') ? 'fa-location-dot' : 'fa-utensils' ?> text-warning me-1"></i> <?= clean_output($rel['tagline']) ?>
                                                    </div>
                                                    <a href="product-detail.php?slug=<?= clean_output($rel['slug']) ?>" class="b2b-btn-white-pill">
                                                        View Product <i class="fa-solid fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="related-slider-pagination product-slider-pagination"></div>
                            </div>
                        </div>
                    </div>
                </section>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        if (typeof Swiper !== 'undefined' && document.querySelector('.related-product-swiper-active')) {
                            if (!document.querySelector('.related-product-swiper-active').swiper) {
                                new Swiper('.related-product-swiper-active', {
                                    slidesPerView: 1,
                                    spaceBetween: 24,
                                    loop: true,
                                    speed: 800,
                                    autoplay: {
                                        delay: 4200,
                                        disableOnInteraction: false,
                                        pauseOnMouseEnter: true
                                    },
                                    navigation: {
                                        nextEl: '.related-slider-next',
                                        prevEl: '.related-slider-prev',
                                    },
                                    pagination: {
                                        el: '.related-slider-pagination',
                                        clickable: true,
                                    },
                                    breakpoints: {
                                        640: {
                                            slidesPerView: 1.3,
                                            spaceBetween: 18
                                        },
                                        768: {
                                            slidesPerView: 2,
                                            spaceBetween: 20
                                        },
                                        1024: {
                                            slidesPerView: 3,
                                            spaceBetween: 24
                                        },
                                        1200: {
                                            slidesPerView: 4,
                                            spaceBetween: 24
                                        }
                                    }
                                });
                            }
                        }
                    });
                </script>
            <?php endif; ?>

<?php require_once __DIR__ . '/inc/footer.php'; ?>
