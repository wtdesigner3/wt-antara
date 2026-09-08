<?php 
require_once 'inc/db.php';

$page_title = "Antara Globale | Premium Indian Agricultural Commodities Exporter & HORECA Supplier";
$page_desc = "Antara Globale is an Indian sourcing and trading company supplying premium green coffee beans, estate teas, Malabar spices, and comprehensive restaurant & café foodservice supplies.";

// Fetch Home Page CMS Content
$home = get_home_content();
$hero_slides = get_hero_slides();

// Fetch Export Commodities
$export_products = get_products_by_division('export');

// Fetch HORECA Supplies
$horeca_products = get_products_by_division('horeca');

// Fetch Testimonials
$testimonials = get_testimonials(6);

// Fetch Terroir Belts
$terroir_belts = get_terroir_belts();

require_once 'inc/header.php';
?>

<!-- 1. Hero Showcase Slider -->
<section class="hero-b2b-section fix">
    <div class="swiper hero-b2b-slider hero-slider-main">
        <div class="swiper-wrapper">

            <?php if (!empty($hero_slides)): ?>
                <?php foreach ($hero_slides as $idx => $slide): ?>
                    <div class="swiper-slide">
                        <div class="hero-slide-item" style="background-image: url('<?= clean_output(!empty($slide['image']) ? $slide['image'] : 'assets/img/commodities/hero-export-banner.jpg') ?>');">
                            <div class="hero-slide-overlay"></div>
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 col-lg-9">
                                        <div class="hero-b2b-content">
                                            <?php if (!empty($slide['badge_text'])): ?>
                                                <div class="hero-b2b-badge">
                                                    <i class="fa-solid <?= $idx % 2 == 0 ? 'fa-ship' : 'fa-mug-hot' ?>"></i> <?= clean_output($slide['badge_text']) ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($idx === 0): ?>
                                                <h1 class="hero-b2b-title">
                                                    <?= clean_output($slide['title']) ?>
                                                </h1>
                                            <?php else: ?>
                                                <h2 class="hero-b2b-title">
                                                    <?= clean_output($slide['title']) ?>
                                                </h2>
                                            <?php endif; ?>
                                            <?php if (!empty($slide['description'])): ?>
                                                <p class="hero-b2b-desc">
                                                    <?= strip_tags(html_entity_decode($slide['description'], ENT_QUOTES, 'UTF-8'), '<strong><b><em><i><span>') ?>
                                                </p>
                                            <?php endif; ?>
                                            <div class="hero-btn-group">
                                                <?php if (!empty($slide['btn1_text'])): ?>
                                                    <a href="<?= clean_output(!empty($slide['btn1_link']) ? $slide['btn1_link'] : 'products.php?division=export') ?>" class="theme-btn gold-btn">
                                                        <?= clean_output($slide['btn1_text']) ?> <i class="fa-solid fa-arrow-right ms-1"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (!empty($slide['btn2_text'])): ?>
                                                    <a href="<?= clean_output(!empty($slide['btn2_link']) ? $slide['btn2_link'] : 'contact.php') ?>" class="theme-btn border-btn">
                                                        <?= clean_output($slide['btn2_text']) ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

        <!-- Slider Navigation Arrows -->
        <div class="hero-slider-nav-btn hero-slider-prev" aria-label="Previous Slide">
            <i class="fa-solid fa-chevron-left"></i>
        </div>
        <div class="hero-slider-nav-btn hero-slider-next" aria-label="Next Slide">
            <i class="fa-solid fa-chevron-right"></i>
        </div>

        <!-- Slider Pagination Bullets -->
        <div class="hero-slider-pagination"></div>
    </div>
</section>

<!-- 2. Export Pillars Overview Strip -->
<?php
$default_pillar_icons = [
    1 => 'assets/img/icons/pillar-1-origin.svg',
    2 => 'assets/img/icons/pillar-2-quality.svg',
    3 => 'assets/img/icons/pillar-3-logistics.svg',
    4 => 'assets/img/icons/pillar-4-support.svg',
];

$active_pillars = [];
for ($pi = 1; $pi <= 3; $pi++) {
    $p_title = trim($home["pillar{$pi}_title"] ?? '');
    $p_desc  = trim($home["pillar{$pi}_desc"] ?? '');
    $p_img   = trim($home["pillar{$pi}_image"] ?? '');
    if (!empty($p_title) || !empty($p_desc)) {
        $icon_src = (!empty($p_img) && file_exists($p_img)) ? $p_img : ($default_pillar_icons[$pi] ?? 'assets/img/icons/pillar-1-origin.svg');
        $active_pillars[] = [
            'title' => $p_title,
            'desc'  => $p_desc,
            'img'   => $icon_src
        ];
    }
}
if (!empty($active_pillars)):
    $p_count = count($active_pillars);
    $pillar_col = ($p_count >= 3) ? 'col-lg-4 col-md-4 col-12' : (($p_count == 2) ? 'col-lg-6 col-md-6 col-12' : 'col-lg-8 mx-auto col-12');
?>
<div class="export-pillars-section">
    <div class="container">
        <div class="export-pillars-bar">
            <div class="row g-4 justify-content-center align-items-start">
                <?php foreach ($active_pillars as $idx => $p_item): ?>
                    <div class="<?= $pillar_col ?>" data-aos="fade-up" data-aos-delay="<?= ($idx + 1) * 100 ?>">
                        <div class="pillar-item text-center">
                            <div class="pillar-icon mb-2 mx-auto">
                                <img src="<?= clean_output($p_item['img']) ?>" alt="<?= clean_output($p_item['title']) ?>">
                            </div>
                            <div class="w-100 text-center">
                                <?php if (!empty($p_item['title'])): ?>
                                    <h5 class="fw-bold mb-2"><?= clean_output($p_item['title']) ?></h5>
                                <?php endif; ?>
                                <?php if (!empty($p_item['desc'])): ?>
                                    <p class="mb-0 text-muted" style="font-size: 13.5px; line-height: 1.5;"><?= clean_output($p_item['desc']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- 2.5 About Us Section -->
<?php
$has_home_about_head = !empty(trim($home['about_heading'] ?? ''));
$has_home_about_body = !empty(trim(strip_tags($home['about_content'] ?? '')));
$has_home_about_img  = !empty(trim($home['about_image'] ?? '')) && file_exists($home['about_image']);

if ($has_home_about_head || $has_home_about_body || $has_home_about_img):
    $home_story_col = $has_home_about_img ? 'col-lg-6' : 'col-12';
?>
<section class="about-section section-padding fix">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Left Image with Trust Badge -->
            <?php if ($has_home_about_img): ?>
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="900">
                    <div style="border-radius: 20px; overflow: hidden; box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12); border: 1px solid var(--border); position: relative;">
                        <img src="<?= clean_output($home['about_image']) ?>"
                            alt="Indian Sourcing &amp; Trading Company"
                            style="width: 100%; height: 480px; object-fit: cover; display: block;">
                        <?php 
                        $has_b_t = !empty(trim($home['about_badge_title'] ?? ''));
                        $has_b_e = !empty(trim($home['about_badge_exp'] ?? ''));
                        $has_b_v = !empty(trim($home['about_stat_vol'] ?? ''));
                        $has_b_p = !empty(trim($home['about_stat_ports'] ?? ''));
                        if ($has_b_t || $has_b_e || $has_b_v || $has_b_p):
                        ?>
                            <div style="position: absolute; bottom: 20px; left: 20px; right: 20px; background: rgba(18, 43, 34, 0.92); backdrop-filter: blur(8px); border-radius: 12px; padding: 16px 20px; color: #FFFFFF; border: 1px solid rgba(197, 160, 89, 0.4);">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(197, 160, 89, 0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <img src="assets/img/icons/partnership-trust.svg" alt="Sourcing &amp; Trading Desk" style="width: 28px; height: 28px; object-fit: contain;">
                                    </div>
                                    <div>
                                        <?php if ($has_b_t): ?>
                                            <h6 class="mb-0 text-white fw-bold"><?= clean_output($home['about_badge_title']) ?></h6>
                                        <?php endif; ?>
                                        <?php 
                                        $exp_line = $has_b_e ? clean_output($home['about_badge_exp']) : (trim(($has_b_v ? clean_output($home['about_stat_vol']) . ' monthly ' : '') . ($has_b_v && $has_b_p ? '&bull; ' : '') . ($has_b_p ? clean_output($home['about_stat_ports']) . ' global ports' : '')));
                                        if (!empty($exp_line)): ?>
                                            <small style="color: #D1DFD4;"><?= $exp_line ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Right About Content -->
            <div class="<?= $home_story_col ?>" data-aos="fade-left" data-aos-duration="900">
                <?php if (!empty(trim($home['about_subheading'] ?? ''))): ?>
                    <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">
                        <?= clean_output($home['about_subheading']) ?>
                    </span>
                <?php endif; ?>
                <?php if ($has_home_about_head): ?>
                    <h2 class="mb-3" style="font-size: 38px; line-height: 1.25;">
                        <?= clean_output($home['about_heading']) ?>
                    </h2>
                <?php endif; ?>
                
                <!-- CKEditor Rich Narrative -->
                <?php if ($has_home_about_body): ?>
                    <div class="home-about-rich-content mb-4" style="font-size: 15.5px; line-height: 1.75; color: #526058;">
                        <?= $home['about_content'] ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex flex-wrap gap-3">
                    <a href="about.php" class="theme-btn">
                        Read Full Company Profile <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                    <button type="button" class="theme-btn border-btn text-dark" style="border-color: var(--theme); color: var(--theme) !important;" data-bs-toggle="modal" data-bs-target="#b2bEnquiryModal">
                        Quick Enquiry
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 2.7 Industries We Serve Section -->
<section class="section-padding fix" style="background-color: #FAF7F2;" data-aos="fade-up">
    <div class="container">
        <div class="text-center mb-5">
            <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">
                Industries We Serve
            </span>
            <h2 style="font-size: 38px;">Procurement Solutions for Two Strategic Sectors</h2>
            <p class="text-muted mx-auto mb-0" style="max-width: 650px; font-size: 15.5px;">
                Supplying international bulk trading desks with agricultural commodities, and domestic hospitality chains with essential kitchen ingredients.
            </p>
        </div>

        <div class="row g-4">
            <!-- Industry 1: Export -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="b2b-industry-card">
                    <div class="b2b-industry-header">
                        <div class="b2b-industry-icon">
                            <img src="assets/img/icons/industry-export.svg" alt="International Trade Division">
                        </div>
                        <div>
                            <span class="b2b-industry-badge">International Trade Division</span>
                            <h3>Export Sector</h3>
                        </div>
                    </div>
                    <p class="text-muted mb-4" style="font-size: 15px; line-height: 1.7;">
                        Supplying international commodity buyers with origin-graded coffee, estate teas, and culinary spices backed by phytosanitary compliance and seaport dispatch.
                    </p>
                    <h6 class="fw-bold mb-3" style="color: var(--header); font-size: 13.5px; text-transform: uppercase; letter-spacing: 0.5px;">Who We Supply:</h6>
                    <div class="industry-client-list">
                        <span class="industry-client-chip"><i class="fa-solid fa-check"></i> Importers</span>
                        <span class="industry-client-chip"><i class="fa-solid fa-check"></i> Distributors</span>
                        <span class="industry-client-chip"><i class="fa-solid fa-check"></i> Wholesalers</span>
                        <span class="industry-client-chip"><i class="fa-solid fa-check"></i> Retail Brands</span>
                        <span class="industry-client-chip"><i class="fa-solid fa-check"></i> Food Manufacturers</span>
                    </div>
                    <div class="mt-auto pt-3">
                        <a href="product-arabica.php" class="theme-btn btn-sm">
                            Explore Export Commodities <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Industry 2: HORECA -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="b2b-industry-card">
                    <div class="b2b-industry-header">
                        <div class="b2b-industry-icon">
                            <img src="assets/img/icons/industry-horeca.svg" alt="Hospitality &amp; Food Service">
                        </div>
                        <div>
                            <span class="b2b-industry-badge">Hospitality &amp; Food Service</span>
                            <h3>HORECA Sector</h3>
                        </div>
                    </div>
                    <p class="text-muted mb-4" style="font-size: 15px; line-height: 1.7;">
                        Dedicated wholesale supply delivering coffee beans, matcha, teas, condiments (Veeba), syrups, sugars, and custom food procurement to professional kitchens.
                    </p>
                    <h6 class="fw-bold mb-3" style="color: var(--header); font-size: 13.5px; text-transform: uppercase; letter-spacing: 0.5px;">Who We Supply:</h6>
                    <div class="industry-client-list">
                        <span class="industry-client-chip"><i class="fa-solid fa-check"></i> Hotels</span>
                        <span class="industry-client-chip"><i class="fa-solid fa-check"></i> Restaurants</span>
                        <span class="industry-client-chip"><i class="fa-solid fa-check"></i> Cafés</span>
                        <span class="industry-client-chip"><i class="fa-solid fa-check"></i> Caterers</span>
                        <span class="industry-client-chip"><i class="fa-solid fa-check"></i> Cloud Kitchens</span>
                    </div>
                    <div class="mt-auto pt-3">
                        <a href="supply-coffee.php" class="theme-btn gold-btn btn-sm">
                            Explore Foodservice Products <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Dynamic Export Commodity Carousel Section (Live from MySQL) -->
<section class="section-padding fix section-bg-3" style="background-color: var(--bg3);" data-aos="fade-up" data-aos-duration="850">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 pb-2" data-aos="fade-up">
            <div>
                <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">
                    Core Commodity Portfolio
                </span>
                <h2 style="font-size: 38px;" class="mb-1">
                    Export-Grade Agricultural Commodities
                </h2>
                <p class="text-muted mb-0" style="max-width: 650px; font-size: 15.5px;">
                    Sourced directly from leading cultivation belts across India for roasters, importers, blenders, and commercial buyers.
                </p>
            </div>
            <div class="product-slider-ctrl mt-3 mt-md-0">
                <div class="product-slider-btn product-slider-prev" aria-label="Previous Commodity">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>
                <div class="product-slider-btn product-slider-next" aria-label="Next Commodity">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </div>

        <!-- Swiper Carousel Container -->
        <div class="product-swiper-container" data-aos="fade-up" data-aos-delay="150">
            <div class="swiper product-swiper-active">
                <div class="swiper-wrapper">

                    <?php foreach ($export_products as $prod): ?>
                        <div class="swiper-slide">
                            <div class="b2b-product-card">
                                <div class="b2b-card-bg">
                                    <img src="<?= htmlspecialchars($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>">
                                </div>
                                <a href="product-detail.php?slug=<?= htmlspecialchars($prod['slug']) ?>" class="b2b-card-circle-btn" title="View Specifications">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                                <div class="b2b-card-glass-bottom">
                                    <h3 class="b2b-card-glass-title">
                                        <a href="product-detail.php?slug=<?= htmlspecialchars($prod['slug']) ?>"><?= htmlspecialchars($prod['name']) ?></a>
                                    </h3>
                                    <div class="b2b-card-glass-sub">
                                        <i class="fa-solid fa-location-dot text-warning me-1"></i> <?= htmlspecialchars($prod['tagline']) ?>
                                    </div>
                                    <a href="product-detail.php?slug=<?= htmlspecialchars($prod['slug']) ?>" class="b2b-btn-white-pill">
                                        View Product <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
                <div class="product-slider-pagination"></div>
            </div>
        </div>
    </div>
</section>

<!-- 3.5 Restaurant & Café Supplies Grid (All 8 Categories Live from MySQL) -->
<section class="section-padding fix" style="background-color: #FFFFFF;" data-aos="fade-up">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-5">
            <div>
                <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">
                    Hospitality &bull; HORECA Division
                </span>
                <h2 style="font-size: 38px;" class="mb-1">
                    Restaurant &amp; Café Foodservice Supplies
                </h2>
                <p class="text-muted mb-0" style="max-width: 650px; font-size: 15.5px;">
                    Commercial kitchen staples, barista ingredients, condiments, and customized food sourcing for hospitality chains.
                </p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="supply-coffee.php" class="theme-btn">
                    View Foodservice Catalog <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach ($horeca_products as $idx => $hp): ?>
                <div class="col-xl-3 col-lg-4 col-sm-6" data-aos="fade-up" data-aos-delay="<?= (($idx % 4) * 80) ?>">
                    <div class="b2b-product-card">
                        <div class="b2b-card-bg">
                            <img src="<?= htmlspecialchars($hp['image']) ?>" alt="<?= htmlspecialchars($hp['name']) ?>">
                        </div>
                        <a href="product-detail.php?slug=<?= htmlspecialchars($hp['slug']) ?>" class="b2b-card-circle-btn" title="View Product Details">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                        <div class="b2b-card-glass-bottom">
                            <h3 class="b2b-card-glass-title">
                                <a href="product-detail.php?slug=<?= htmlspecialchars($hp['slug']) ?>"><?= htmlspecialchars($hp['name']) ?></a>
                            </h3>
                            <div class="b2b-card-glass-sub">
                                <i class="fa-solid fa-utensils text-warning me-1"></i> <?= htmlspecialchars($hp['tagline']) ?>
                            </div>
                            <a href="product-detail.php?slug=<?= htmlspecialchars($hp['slug']) ?>" class="b2b-btn-white-pill">
                                View Product <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 3.8 Visual Indian Growing Belts Terroir Showcase -->
<section class="section-padding fix" style="background: linear-gradient(135deg, #143528 0%, #0F261D 100%); color: #FFFFFF;" data-aos="fade-up" data-aos-duration="850">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-5" data-aos="fade-up">
            <div>
                <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">
                    Indian Agricultural Terroir
                </span>
                <h2 style="font-size: 38px;" class="mb-1 text-white">
                    <?= clean_output($home['terroir_heading'] ?? 'Prime Sourcing Belts Across India') ?>
                </h2>
                <p class="text-white-50 mb-0" style="max-width: 650px; font-size: 15.5px;">
                    <?= clean_output($home['terroir_desc'] ?? 'Explore celebrated agricultural zones producing our export-grade coffee, teas, and spices with authentic geographic provenance.') ?>
                </p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="product-arabica.php" class="theme-btn border-btn">
                    Explore Origin Products <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            <?php if (!empty($terroir_belts)): ?>
                <?php foreach ($terroir_belts as $idx => $belt): 
                    $tags = array_filter(array_map('trim', explode(',', $belt['tags'] ?? '')));
                ?>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="<?= (($idx % 2) + 1) * 100 ?>">
                        <div class="growing-belt-card">
                            <img src="<?= clean_output(!empty($belt['image']) ? $belt['image'] : 'assets/img/commodities/hero-spices-export.jpg') ?>" alt="<?= clean_output($belt['title']) ?>">
                            <div class="belt-overlay">
                                <?php if (!empty($belt['badge'])): ?>
                                    <span class="badge bg-warning text-dark align-self-start px-2 py-1 mb-2 fw-bold" style="font-size: 11px;">
                                        <?= clean_output($belt['badge']) ?>
                                    </span>
                                <?php endif; ?>
                                <h4 class="belt-title"><?= clean_output($belt['title']) ?></h4>
                                <p class="belt-desc">
                                    <?= clean_output($belt['description']) ?>
                                </p>
                                <?php if (!empty($tags)): ?>
                                    <div class="belt-tags">
                                        <?php foreach ($tags as $tag): ?>
                                            <span><?= clean_output($tag) ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- 4. Why Choose Us / Export Advantages Section Start (Pure White Canvas) -->
<?php
$choose_subheading = trim($home['choose_subheading'] ?? '');
$choose_heading    = trim($home['choose_heading'] ?? '');
$choose_desc       = trim($home['choose_desc'] ?? '');
$choose_image      = trim($home['choose_image'] ?? '');
$has_choose_image  = !empty($choose_image) && file_exists($choose_image);

$choose_default_icons = [
    1 => 'assets/img/icons/pillar-1-origin.svg',
    2 => 'assets/img/icons/pillar-2-quality.svg',
    3 => 'assets/img/icons/pillar-3-logistics.svg',
    4 => 'assets/img/icons/pillar-4-support.svg',
];

$choose_cards = [];
for ($ci = 1; $ci <= 4; $ci++) {
    $c_title = trim($home["choose_card{$ci}_title"] ?? '');
    $c_desc  = trim($home["choose_card{$ci}_desc"] ?? '');
    $c_icon  = trim($home["choose_card{$ci}_icon"] ?? '');
    if (!empty($c_title) || !empty($c_desc)) {
        $choose_cards[] = [
            'index' => $ci,
            'title' => $c_title,
            'desc'  => $c_desc,
            'icon'  => (!empty($c_icon) && file_exists($c_icon)) ? $c_icon : ($choose_default_icons[$ci] ?? 'assets/img/icons/pillar-1-origin.svg')
        ];
    }
}

$has_choose_content = !empty($choose_heading) || !empty($choose_desc) || !empty($choose_cards) || $has_choose_image;

if ($has_choose_content):
    $choose_right_col = $has_choose_image ? 'col-lg-7' : 'col-12';
    $card_col = (count($choose_cards) == 1) ? 'col-12' : 'col-sm-6';
?>
<section class="section-padding fix" style="background-color: #FFFFFF;" data-aos="fade-up" data-aos-duration="850">
    <div class="container">
        <div class="row align-items-center g-5">
            
            <!-- Left: High-Impact Estate Photograph & Floating Badge -->
            <?php if ($has_choose_image): ?>
            <div class="col-lg-5" data-aos="fade-right" data-aos-duration="850">
                <div class="b2b-choose-img-wrapper">
                    <img src="<?= clean_output($choose_image) ?>" alt="<?= clean_output(!empty($choose_heading) ? $choose_heading : 'Antara Globale Origin Sourcing') ?>">
                    <?php if (!empty($home['choose_badge_title'])): ?>
                    <div class="b2b-choose-floating-stat">
                        <div class="icon-box">
                            <img src="assets/img/icons/certified-shield.svg" alt="<?= clean_output($home['choose_badge_title']) ?>">
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: var(--header); font-size: 15px;"><?= clean_output($home['choose_badge_title']) ?></h6>
                            <?php if (!empty($home['choose_badge_desc'])): ?>
                                <small class="text-muted" style="font-size: 13px;"><?= clean_output($home['choose_badge_desc']) ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Right: Minimalist & Clean Advantage Grid -->
            <div class="<?= $choose_right_col ?>" data-aos="fade-left" data-aos-duration="850">
                <?php if (!empty($choose_subheading)): ?>
                    <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">
                        <?= clean_output($choose_subheading) ?>
                    </span>
                <?php endif; ?>

                <?php if (!empty($choose_heading)): ?>
                    <h2 class="mb-3" style="font-size: 36px;">
                        <?= clean_output($choose_heading) ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($choose_desc)): ?>
                    <p class="text-muted mb-4" style="font-size: 15.5px; line-height: 1.65;">
                        <?= clean_output($choose_desc) ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($choose_cards)): ?>
                <div class="row g-3">
                    <?php foreach ($choose_cards as $c_idx => $c_item): ?>
                        <div class="<?= $card_col ?>" data-aos="fade-up" data-aos-delay="<?= ($c_idx + 1) * 100 ?>">
                            <div class="b2b-minimal-card">
                                <div class="card-icon d-flex align-items-center justify-content-center">
                                    <img src="<?= clean_output($c_item['icon']) ?>" alt="<?= clean_output($c_item['title']) ?>">
                                </div>
                                <div>
                                    <?php if (!empty($c_item['title'])): ?>
                                        <h5><?= clean_output($c_item['title']) ?></h5>
                                    <?php endif; ?>
                                    <?php if (!empty($c_item['desc'])): ?>
                                        <p><?= clean_output($c_item['desc']) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php 
                $has_btn1 = !empty(trim($home['choose_btn1_text'] ?? ''));
                $has_btn2 = !empty(trim($home['choose_btn2_text'] ?? ''));
                if ($has_btn1 || $has_btn2):
                ?>
                <div class="mt-4 pt-2 d-flex flex-wrap gap-3">
                    <?php if ($has_btn1): ?>
                        <?php 
                        $btn1_link = trim($home['choose_btn1_link'] ?? '#b2bEnquiryModal');
                        if (str_starts_with($btn1_link, '#')):
                        ?>
                            <button type="button" class="theme-btn" data-bs-toggle="modal" data-bs-target="<?= clean_output($btn1_link) ?>">
                                <?= clean_output($home['choose_btn1_text']) ?> <i class="fa-solid fa-arrow-right ms-1"></i>
                            </button>
                        <?php else: ?>
                            <a href="<?= clean_output($btn1_link) ?>" class="theme-btn">
                                <?= clean_output($home['choose_btn1_text']) ?> <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ($has_btn2): ?>
                        <a href="<?= clean_output(!empty($home['choose_btn2_link']) ? $home['choose_btn2_link'] : 'about.php') ?>" class="theme-btn border-btn text-dark" style="border-color: var(--theme); color: var(--theme) !important;">
                            <?= clean_output($home['choose_btn2_text']) ?>
                        </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
<?php endif; ?>

<!-- 5. Client Testimonials Section (Live from MySQL) -->
<?php if (!empty($testimonials)): ?>
<section class="section-padding fix section-bg-3" style="background-color: var(--bg3);" data-aos="fade-up">
    <div class="container">
        <div class="text-center mb-5">
            <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">
                Client Endorsements
            </span>
            <h2 style="font-size: 38px;">Trusted by Global Importers &amp; Domestic Cafés</h2>
            <p class="text-muted mx-auto mb-0" style="max-width: 650px; font-size: 15.5px;">
                Authentic feedback from international commodity roasters, blenders, and hospitality procurement heads.
            </p>
        </div>

        <div class="row g-4">
            <?php foreach ($testimonials as $t): ?>
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="p-4 bg-white rounded-4 border shadow-sm h-100 d-flex flex-column">
                        <div class="d-flex text-warning mb-3">
                            <?php 
                            $stars = isset($t['tt_rating']) ? (int)$t['tt_rating'] : 5;
                            for ($s = 1; $s <= 5; $s++): 
                            ?>
                                <i class="fa-<?= ($s <= $stars) ? 'solid' : 'regular' ?> fa-star"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="text-muted mb-4 fst-italic flex-grow-1" style="line-height: 1.7;">
                            &ldquo;<?= htmlspecialchars($t['tt_detail']) ?>&rdquo;
                        </p>
                        <div class="d-flex align-items-center gap-3 pt-3 border-top">
                            <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--bg3); display: flex; align-items: center; justify-content: center; font-weight: bold; color: var(--primary);">
                                <?= strtoupper(substr($t['tt_name'], 0, 1)) ?>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark"><?= htmlspecialchars($t['tt_name']) ?></h6>
                                <small class="text-muted"><?= htmlspecialchars($t['tt_location']) ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 6. Modern FAQ Section (Open Layout with Full-Fill Image) -->
<section class="section-padding fix b2b-faq-section" style="background-color: #FFFFFF;" data-aos="fade-up" data-aos-duration="850">
    <div class="container">
        <div class="row g-4 g-lg-5 align-items-stretch">
            
            <!-- Left Column: Title, Intro & Mint-Tinted Accordion Bars -->
            <div class="col-lg-7 d-flex flex-column justify-content-center">
                <div class="faq-modern-header mb-4">
                    <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold"
                        style="color: var(--gold); letter-spacing: 1.5px; font-size: 13.5px;">
                        Trade Clarifications
                    </span>
                    <h2 class="faq-modern-title mb-2">
                        Frequently Asked<br>Questions
                    </h2>
                    <p class="faq-modern-desc mb-0">
                        Explore our commodity export capabilities, strict technical grading, hermetic packaging options, and international maritime logistics.
                    </p>
                </div>

                <div class="accordion faq-modern-accordion" id="modernFaqAccordion">

                    <!-- FAQ 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqModernH1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqModernC1" aria-expanded="true"
                                aria-controls="faqModernC1">
                                <span>What are your standard export packaging options?</span>
                            </button>
                        </h2>
                        <div id="faqModernC1" class="accordion-collapse collapse show"
                            aria-labelledby="faqModernH1" data-bs-parent="#modernFaqAccordion">
                            <div class="accordion-body">
                                For green coffee beans, we supply export-grade 60 kg natural jute sacks, reinforced woven PP bags, and high-barrier GrainPro hermetic liners. Teas are packed in foil-lined multiwall sacks, and spices in 25 kg / 50 kg moisture-barrier bags.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqModernH2">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faqModernC2"
                                aria-expanded="false" aria-controls="faqModernC2">
                                <span>Can we request commodity samples prior to ordering?</span>
                            </button>
                        </h2>
                        <div id="faqModernC2" class="accordion-collapse collapse"
                            aria-labelledby="faqModernH2" data-bs-parent="#modernFaqAccordion">
                            <div class="accordion-body">
                                Yes. We dispatch representative harvest crop samples (250g &ndash; 1kg) via air courier (DHL/FedEx Express) to verified commercial roasters and import firms worldwide, accompanied by Certificate of Analysis (CoA).
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqModernH3">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faqModernC3"
                                aria-expanded="false" aria-controls="faqModernC3">
                                <span>Which Indian seaports are used for container dispatch?</span>
                            </button>
                        </h2>
                        <div id="faqModernC3" class="accordion-collapse collapse"
                            aria-labelledby="faqModernH3" data-bs-parent="#modernFaqAccordion">
                            <div class="accordion-body">
                                Shipments are dispatched via premier deep-water container ports: Mangalore Port (Southern Coffee), Cochin Port (Kerala Spices &amp; Coffee), Chennai &amp; Tuticorin Ports (Turmeric &amp; Teas), and Kolkata Port (Assam Teas).
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqModernH4">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faqModernC4"
                                aria-expanded="false" aria-controls="faqModernC4">
                                <span>What are your standard Minimum Order Quantities (MOQs)?</span>
                            </button>
                        </h2>
                        <div id="faqModernC4" class="accordion-collapse collapse"
                            aria-labelledby="faqModernH4" data-bs-parent="#modernFaqAccordion">
                            <div class="accordion-body">
                                Standard contracts are based on 20ft FCL (~18.0&ndash;19.2 MT for green coffee; ~18 MT for black pepper; ~12&ndash;14 MT for bulk teas). Consolidated multi-commodity containers are also supported on request.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqModernH5">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faqModernC5"
                                aria-expanded="false" aria-controls="faqModernC5">
                                <span>What export documentation and certifications are provided?</span>
                            </button>
                        </h2>
                        <div id="faqModernC5" class="accordion-collapse collapse"
                            aria-labelledby="faqModernH5" data-bs-parent="#modernFaqAccordion">
                            <div class="accordion-body">
                                Every shipment includes Clean Ocean Bill of Lading, Phytosanitary Certificate (Ministry of Agriculture), Certificate of Origin (Spices/Coffee/Tea Board of India), Commercial Invoice, Packing List, and Fumigation reports.
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Column: Full-Fill Aesthetics Image -->
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="faq-modern-img-wrapper w-100">
                    <img src="assets/img/commodities/indian-sourcing-landscape.jpg" alt="Antara Globale Agricultural Origin">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 7. Commodity Market Insights & Blog Section (Dynamic from Database) -->
<?php
$home_blogs = get_blogs('', '', '', 3);
if (!empty($home_blogs)):
?>
<section class="section-padding fix section-bg-3" style="background-color: var(--bg3);" data-aos="fade-up" data-aos-duration="850">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-5" data-aos="fade-up">
            <div>
                <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold"
                    style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">
                    Market Intelligence
                </span>
                <h2 style="font-size: 38px;" class="mb-1">
                    Commodity Export Insights &amp; Trade Updates
                </h2>
                <p class="text-muted mb-0" style="max-width: 680px; font-size: 16px;">
                    Stay informed on Indian harvest cycles, crop quality parameters, export specifications, and international maritime logistics.
                </p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="blog.php" class="theme-btn border-btn text-dark" style="border-color: var(--theme); color: var(--theme) !important;">
                    View All Insights <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach ($home_blogs as $b_idx => $hb): ?>
                <?php 
                $hb_img = get_blog_image_url($hb['b_image'] ?? '');
                $hb_url = 'blog-detail.php?url=' . urlencode($hb['b_url']);
                $hb_date = !empty($hb['b_date']) ? date('M d, Y', strtotime($hb['b_date'])) : 'Recent';
                $hb_cat = !empty($hb['b_category']) ? $hb['b_category'] : 'Market Insights';
                $hb_excerpt = clean_output(strip_tags(html_entity_decode($hb['b_short_desc'] ?? '')));
                ?>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= ($b_idx + 1) * 100 ?>">
                    <div class="b2b-blog-card h-100 d-flex flex-column">
                        <div class="b2b-blog-thumb">
                            <a href="<?= $hb_url ?>" class="d-block">
                                <img src="<?= htmlspecialchars($hb_img) ?>" alt="<?= clean_output($hb['b_title']) ?>">
                            </a>
                        </div>
                        <div class="b2b-blog-body d-flex flex-column flex-grow-1">
                            <div class="b2b-blog-meta">
                                <span><i class="fa-regular fa-calendar"></i> <?= htmlspecialchars($hb_date) ?></span>
                                <span><i class="fa-solid fa-tag"></i> <?= clean_output($hb_cat) ?></span>
                            </div>
                            <h4 class="mb-2">
                                <a href="<?= $hb_url ?>"><?= clean_output($hb['b_title']) ?></a>
                            </h4>
                            <p class="text-muted small mb-3 flex-grow-1">
                                <?= $hb_excerpt ?>
                            </p>
                            <div class="mt-auto pt-2 border-top">
                                <a href="<?= $hb_url ?>" class="fw-bold text-success d-inline-flex align-items-center gap-1">
                                    Read Full Report <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 8. Commercial Trade CTA Banner Section -->
<section class="container my-5 py-4" data-aos="zoom-in" data-aos-duration="850">
    <div class="b2b-cta-section text-center p-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <span class="badge bg-warning text-dark px-3 py-2 text-uppercase mb-3 fw-bold"
                    style="letter-spacing: 1px;">
                    Commercial Trade Desk
                </span>
                <h2 class="text-white mb-3" style="font-size: 40px;">
                    Looking for Reliable Indian Commodity Supply?
                </h2>
                <p class="text-white-50 mb-4" style="font-size: 18px; line-height: 1.6;">
                    Share your product requirements and our team will get back to you with availability, specifications and export details.
                </p>
                <button type="button" class="theme-btn gold-btn px-4 py-3" style="font-size: 17px;"
                    data-bs-toggle="modal" data-bs-target="#b2bEnquiryModal">
                    <i class="fa-solid fa-paper-plane me-2"></i> Send an Enquiry
                </button>
            </div>
        </div>
    </div>
</section>

<?php 
require_once 'inc/footer.php';
?>
