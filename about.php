<?php 
require_once 'inc/db.php';

$page_title = "About Us | Indian Sourcing & Trading Company | Antara Globale";
$page_desc = "Learn about Antara Globale - Indian sourcing and trading company supplying quality agricultural food products, green coffee, teas, spices, and hospitality supplies.";

$about = get_about_content();

require_once 'inc/header.php';
?>

<!-- Breadcrumb Section Start -->
<div class="breadcrumb-wrapper bg-cover header-bg-about">
    <div class="container">
        <div class="page-heading text-center">
            <div class="breadcrumb-sub-title">
                <h1 class="text-white wow fadeInUp" data-wow-delay=".3s" style="font-size: 46px;">About Antara Globale</h1>
            </div>
            <ul class="breadcrumb-items wow fadeInUp d-flex justify-content-center gap-2 list-unstyled mt-3" data-wow-delay=".5s" style="color: #E0E7E1;">
                <li><a href="index.php" class="text-white"><i class="fa-solid fa-house"></i> Home</a></li>
                <li>/</li>
                <li class="text-warning">About Us</li>
            </ul>
        </div>
    </div>
</div>

<!-- About Intro Section Start -->
<?php 
$has_story_head = !empty(trim($about['story_heading'] ?? ''));
$has_story_body = !empty(trim(strip_tags($about['story_content'] ?? '')));
$has_story_img  = !empty(trim($about['story_image'] ?? '')) && file_exists($about['story_image']);

if ($has_story_head || $has_story_body || $has_story_img):
    $story_text_col = $has_story_img ? 'col-lg-6' : 'col-12';
?>
<section class="section-padding fix">
    <div class="container">
        <div class="row align-items-center g-5">
            <?php if ($has_story_img): ?>
                <div class="col-lg-6 wow img-custom-anim-left">
                    <div style="border-radius: 20px; overflow: hidden; box-shadow: var(--box-shadow); border: 1px solid var(--border); position: relative;">
                        <img src="<?= clean_output($about['story_image']) ?>" alt="Indian Agricultural Sourcing Landscape" style="width: 100%; height: 520px; object-fit: cover; display: block;">
                        <?php 
                        $has_badge_t = !empty(trim($about['story_badge_title'] ?? ''));
                        $has_badge_s = !empty(trim($about['story_badge_subtitle'] ?? ''));
                        if ($has_badge_t || $has_badge_s):
                        ?>
                            <div style="position: absolute; bottom: 20px; left: 20px; right: 20px; background: rgba(18, 43, 34, 0.92); backdrop-filter: blur(8px); border-radius: 12px; padding: 16px 20px; color: #FFFFFF; border: 1px solid rgba(197, 160, 89, 0.4);">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width: 44px; height: 44px; border-radius: 10px; background: rgba(197, 160, 89, 0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <img src="assets/img/icons/partnership-trust.svg" alt="Dependable Sourcing Partner" style="width: 28px; height: 28px; object-fit: contain;">
                                    </div>
                                    <div>
                                        <?php if ($has_badge_t): ?>
                                            <h6 class="mb-0 text-white fw-bold"><?= clean_output($about['story_badge_title']) ?></h6>
                                        <?php endif; ?>
                                        <?php if ($has_badge_s): ?>
                                            <small style="color: #D1DFD4;"><?= clean_output($about['story_badge_subtitle']) ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="<?= $story_text_col ?>">
                <?php if (!empty(trim($about['story_subheading'] ?? ''))): ?>
                    <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">
                        <?= clean_output($about['story_subheading']) ?>
                    </span>
                <?php endif; ?>
                <?php if ($has_story_head): ?>
                    <h2 class="mb-4" style="font-size: 38px; line-height: 1.25;">
                        <?= clean_output($about['story_heading']) ?>
                    </h2>
                <?php endif; ?>
                
                <!-- CKEditor Rich Story Narrative -->
                <?php if ($has_story_body): ?>
                    <div class="about-rich-narrative mb-4" style="font-size: 16px; line-height: 1.8; color: #3E4B3F;">
                        <?= $about['story_content'] ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex flex-wrap gap-3">
                    <a href="contact.php" class="theme-btn">
                        Contact Our Trade Desk <i class="fa-solid fa-arrow-right ms-1"></i>
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

<!-- Vision & Mission Section Start -->
<?php 
$has_mission = !empty(trim($about['mission_heading'] ?? '')) || !empty(trim(strip_tags($about['mission_content'] ?? '')));
$has_vision  = !empty(trim($about['vision_heading'] ?? '')) || !empty(trim(strip_tags($about['vision_content'] ?? '')));

if ($has_mission || $has_vision):
    $vm_col = ($has_mission && $has_vision) ? 'col-lg-6' : 'col-lg-8 mx-auto';
?>
<section class="section-padding fix section-bg-3" style="background-color: var(--bg3);">
    <div class="container">
        <div class="text-center mb-5">
            <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">
                Our Strategic Direction
            </span>
            <h2 style="font-size: 38px;">Built on Trust, Reliability &amp; Execution</h2>
            <p class="text-muted mx-auto mb-0" style="max-width: 650px; font-size: 16px;">
                Guiding every sourcing contract, quality evaluation, and client interaction with clear principles.
            </p>
        </div>

        <?php
        $mission_img = !empty($about['mission_image']) && file_exists($about['mission_image']) ? $about['mission_image'] : 'assets/img/icons/mission-target.svg';
        $vision_img = !empty($about['vision_image']) && file_exists($about['vision_image']) ? $about['vision_image'] : 'assets/img/icons/vision-compass.svg';
        ?>
        <div class="row g-4 mb-0 justify-content-center">
            <!-- Mission Card -->
            <?php if ($has_mission): ?>
                <div class="<?= $vm_col ?>" data-aos="fade-up" data-aos-delay="100">
                    <div class="b2b-vm-card h-100">
                        <div class="b2b-vm-icon">
                            <img src="<?= clean_output($mission_img) ?>" alt="<?= clean_output($about['mission_heading'] ?? 'Our Strategic Mission') ?>">
                        </div>
                        <?php if (!empty(trim($about['mission_heading'] ?? ''))): ?>
                            <h4><?= clean_output($about['mission_heading']) ?></h4>
                        <?php endif; ?>
                        <?php if (!empty(trim(strip_tags($about['mission_content'] ?? '')))): ?>
                            <div class="text-muted" style="font-size: 15px; line-height: 1.75;">
                                <?= $about['mission_content'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Vision Card -->
            <?php if ($has_vision): ?>
                <div class="<?= $vm_col ?>" data-aos="fade-up" data-aos-delay="200">
                    <div class="b2b-vm-card h-100">
                        <div class="b2b-vm-icon">
                            <img src="<?= clean_output($vision_img) ?>" alt="<?= clean_output($about['vision_heading'] ?? 'Our Global Vision') ?>">
                        </div>
                        <?php if (!empty(trim($about['vision_heading'] ?? ''))): ?>
                            <h4><?= clean_output($about['vision_heading']) ?></h4>
                        <?php endif; ?>
                        <?php if (!empty(trim(strip_tags($about['vision_content'] ?? '')))): ?>
                            <div class="text-muted" style="font-size: 15px; line-height: 1.75;">
                                <?= $about['vision_content'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Industries We Serve Section Start -->
<?php 
$has_ind1 = !empty(trim($about['ind1_title'] ?? '')) || !empty(trim($about['ind1_desc'] ?? ''));
$has_ind2 = !empty(trim($about['ind2_title'] ?? '')) || !empty(trim($about['ind2_desc'] ?? ''));

if ($has_ind1 || $has_ind2):
    $ind_col = ($has_ind1 && $has_ind2) ? 'col-lg-6' : 'col-lg-8 mx-auto';
?>
<section class="section-padding fix bg-white">
    <div class="container">
        <?php if (!empty(trim($about['ind_heading'] ?? '')) || !empty(trim($about['ind_desc'] ?? ''))): ?>
            <div class="text-center mb-5">
                <?php if (!empty(trim($about['ind_subheading'] ?? ''))): ?>
                    <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">
                        <?= clean_output($about['ind_subheading']) ?>
                    </span>
                <?php endif; ?>
                <?php if (!empty(trim($about['ind_heading'] ?? ''))): ?>
                    <h2 style="font-size: 38px;"><?= clean_output($about['ind_heading']) ?></h2>
                <?php endif; ?>
                <?php if (!empty(trim($about['ind_desc'] ?? ''))): ?>
                    <p class="text-muted mx-auto mb-0" style="max-width: 680px; font-size: 16px;">
                        <?= clean_output($about['ind_desc']) ?>
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="row g-4 justify-content-center">
            <!-- Industry 1: Export -->
            <?php if ($has_ind1): ?>
                <div class="<?= $ind_col ?>" data-aos="fade-up" data-aos-delay="100">
                    <div class="b2b-industry-card">
                        <div class="b2b-industry-header">
                            <?php if (!empty(trim($about['ind1_icon'] ?? ''))): ?>
                                <div class="b2b-industry-icon">
                                    <img src="<?= clean_output($about['ind1_icon']) ?>" alt="<?= clean_output($about['ind1_title'] ?? 'Export Sector') ?>">
                                </div>
                            <?php endif; ?>
                            <div>
                                <?php if (!empty(trim($about['ind1_badge'] ?? ''))): ?>
                                    <span class="b2b-industry-badge"><?= clean_output($about['ind1_badge']) ?></span>
                                <?php endif; ?>
                                <?php if (!empty(trim($about['ind1_title'] ?? ''))): ?>
                                    <h3><?= clean_output($about['ind1_title']) ?></h3>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if (!empty(trim($about['ind1_desc'] ?? ''))): ?>
                            <p class="text-muted mb-4" style="font-size: 15px; line-height: 1.7;">
                                <?= clean_output($about['ind1_desc']) ?>
                            </p>
                        <?php endif; ?>
                        <?php if (!empty(trim($about['ind1_clients'] ?? ''))): ?>
                            <h6 class="fw-bold mb-3" style="color: var(--header); font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Who We Supply:</h6>
                            <div class="industry-client-list">
                                <?php 
                                $sec1_clients = array_filter(array_map('trim', explode(',', $about['ind1_clients'])));
                                foreach ($sec1_clients as $chip): ?>
                                    <span class="industry-client-chip"><i class="fa-solid fa-check"></i> <?= clean_output($chip) ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty(trim($about['ind1_btn_text'] ?? ''))): ?>
                            <div class="mt-auto pt-3">
                                <a href="<?= clean_output(!empty($about['ind1_btn_link']) ? $about['ind1_btn_link'] : 'export/product-arabica') ?>" class="theme-btn btn-sm">
                                    <?= clean_output($about['ind1_btn_text']) ?> <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Industry 2: HORECA -->
            <?php if ($has_ind2): ?>
                <div class="<?= $ind_col ?>" data-aos="fade-up" data-aos-delay="200">
                    <div class="b2b-industry-card">
                        <div class="b2b-industry-header">
                            <?php if (!empty(trim($about['ind2_icon'] ?? ''))): ?>
                                <div class="b2b-industry-icon">
                                    <img src="<?= clean_output($about['ind2_icon']) ?>" alt="<?= clean_output($about['ind2_title'] ?? 'HORECA Sector') ?>">
                                </div>
                            <?php endif; ?>
                            <div>
                                <?php if (!empty(trim($about['ind2_badge'] ?? ''))): ?>
                                    <span class="b2b-industry-badge"><?= clean_output($about['ind2_badge']) ?></span>
                                <?php endif; ?>
                                <?php if (!empty(trim($about['ind2_title'] ?? ''))): ?>
                                    <h3><?= clean_output($about['ind2_title']) ?></h3>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if (!empty(trim($about['ind2_desc'] ?? ''))): ?>
                            <p class="text-muted mb-4" style="font-size: 15px; line-height: 1.7;">
                                <?= clean_output($about['ind2_desc']) ?>
                            </p>
                        <?php endif; ?>
                        <?php if (!empty(trim($about['ind2_clients'] ?? ''))): ?>
                            <h6 class="fw-bold mb-3" style="color: var(--header); font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Who We Supply:</h6>
                            <div class="industry-client-list">
                                <?php 
                                $sec2_clients = array_filter(array_map('trim', explode(',', $about['ind2_clients'])));
                                foreach ($sec2_clients as $chip): ?>
                                    <span class="industry-client-chip"><i class="fa-solid fa-check"></i> <?= clean_output($chip) ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty(trim($about['ind2_btn_text'] ?? ''))): ?>
                            <div class="mt-auto pt-3">
                                <a href="<?= clean_output(!empty($about['ind2_btn_link']) ? $about['ind2_btn_link'] : 'restaurant/supply-coffee') ?>" class="theme-btn gold-btn btn-sm">
                                    <?= clean_output($about['ind2_btn_text']) ?> <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Supply Capabilities Section Start -->
<?php 
$has_cap_head = !empty(trim($about['capabilities_heading'] ?? ''));
$has_cap_body = !empty(trim(strip_tags($about['capabilities_content'] ?? '')));
$has_cap_img  = !empty(trim($about['capabilities_image'] ?? '')) && file_exists($about['capabilities_image']);
$has_cap_btn1 = !empty(trim($about['capabilities_btn1_text'] ?? ''));
$has_cap_btn2 = !empty(trim($about['capabilities_btn2_text'] ?? ''));

if ($has_cap_head || $has_cap_body || $has_cap_img || $has_cap_btn1):
    $cap_text_col = $has_cap_img ? 'col-lg-6' : 'col-12';
?>
<section class="section-padding fix section-bg-3" style="background-color: var(--bg3);">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="<?= $cap_text_col ?>">
                <?php if (!empty(trim($about['capabilities_subheading'] ?? ''))): ?>
                    <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">
                        <?= clean_output($about['capabilities_subheading']) ?>
                    </span>
                <?php endif; ?>
                <?php if ($has_cap_head): ?>
                    <h2 class="mb-3" style="font-size: 36px;">
                        <?= clean_output($about['capabilities_heading']) ?>
                    </h2>
                <?php endif; ?>

                <!-- CKEditor Rich Narrative & Feature Points -->
                <?php if ($has_cap_body): ?>
                    <div class="capabilities-rich-content mb-4" style="font-size: 16px; line-height: 1.75; color: #3E4B3F;">
                        <?= $about['capabilities_content'] ?>
                    </div>
                <?php endif; ?>

                <?php if ($has_cap_btn1 || $has_cap_btn2): ?>
                    <div class="d-flex flex-wrap gap-3">
                        <?php if ($has_cap_btn1): ?>
                            <a href="<?= clean_output(!empty($about['capabilities_btn1_link']) ? $about['capabilities_btn1_link'] : 'export/product-arabica') ?>" class="theme-btn">
                                <?= clean_output($about['capabilities_btn1_text']) ?> <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($has_cap_btn2): ?>
                            <a href="<?= clean_output(!empty($about['capabilities_btn2_link']) ? $about['capabilities_btn2_link'] : 'restaurant/supply-coffee') ?>" class="theme-btn border-btn text-dark" style="border-color: var(--theme); color: var(--theme) !important;">
                                <?= clean_output($about['capabilities_btn2_text']) ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($has_cap_img): ?>
                <div class="col-lg-6">
                    <div style="border-radius: 20px; overflow: hidden; box-shadow: var(--box-shadow); border: 1px solid var(--border);">
                        <img src="<?= clean_output($about['capabilities_image']) ?>" alt="<?= clean_output($about['capabilities_heading'] ?? 'Antara Globale Supply Capabilities') ?>" style="width: 100%; height: 460px; object-fit: cover; display: block;">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Verified Trade Statistics Strip -->
<?php 
$stats_items = [];
if (!empty(trim($about['stat_volume'] ?? ''))) {
    $stats_items[] = ['val' => $about['stat_volume'], 'label' => $about['stat_volume_label'] ?? 'Monthly Commodity Flow'];
}
if (!empty(trim($about['stat_ports'] ?? ''))) {
    $stats_items[] = ['val' => $about['stat_ports'], 'label' => $about['stat_ports_label'] ?? 'Global Discharge Ports'];
}
if (!empty(trim($about['stat_lots'] ?? ''))) {
    $stats_items[] = ['val' => $about['stat_lots'], 'label' => $about['stat_lots_label'] ?? 'Batch Traceable Lots'];
}
if (!empty(trim($about['stat_clients'] ?? ''))) {
    $stats_items[] = ['val' => $about['stat_clients'], 'label' => $about['stat_clients_label'] ?? 'Commercial Buyers'];
}
if (!empty($stats_items)):
    $stat_col = count($stats_items) >= 4 ? 'col-lg-3 col-6' : (count($stats_items) == 3 ? 'col-lg-4 col-6' : (count($stats_items) == 2 ? 'col-lg-6 col-6' : 'col-lg-8 mx-auto'));
?>
<section class="section-padding fix bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 14px;">Verified Metrics</span>
            <h2 style="font-size: 36px;">Antara Globale in Numbers</h2>
        </div>
        <div class="row g-4 text-center justify-content-center">
            <?php foreach ($stats_items as $st): ?>
                <div class="<?= $stat_col ?>">
                    <div class="p-4 rounded-3 border bg-light h-100">
                        <h3 class="fw-bold mb-1" style="font-size: 38px; color: var(--header);"><?= clean_output($st['val']) ?></h3>
                        <?php if (!empty(trim($st['label']))): ?>
                            <span class="text-muted" style="font-size: 14px;"><?= clean_output($st['label']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<?php 
$has_cta_heading = !empty(trim($about['cta_heading'] ?? ''));
$has_cta_desc = !empty(trim($about['cta_desc'] ?? ''));
$has_cta_btn = !empty(trim($about['cta_btn_text'] ?? ''));
if ($has_cta_heading || $has_cta_desc || $has_cta_btn):
    $cta_bg = !empty($about['cta_bg_image']) && file_exists($about['cta_bg_image']) ? $about['cta_bg_image'] : 'assets/img/commodities/shipping-logistics-port.jpg';
    $cta_action = $about['cta_btn_action'] ?? 'link';
?>
<section class="container my-5 py-4">
    <div class="b2b-cta-section text-center p-5" style="background: linear-gradient(135deg, rgba(18, 43, 34, 0.92) 0%, rgba(22, 58, 44, 0.86) 50%, rgba(45, 30, 23, 0.92) 100%), url('<?= clean_output($cta_bg) ?>') center/cover no-repeat;">
        <?php if (!empty(trim($about['cta_subheading'] ?? ''))): ?>
            <span class="badge bg-warning text-dark px-3 py-1.5 text-uppercase fw-bold mb-3 d-inline-block" style="letter-spacing: 1px; font-size: 12px;">
                <?= clean_output($about['cta_subheading']) ?>
            </span>
        <?php endif; ?>
        <?php if ($has_cta_heading): ?>
            <h2 class="text-white mb-3" style="font-size: 38px;">
                <?= clean_output($about['cta_heading']) ?>
            </h2>
        <?php endif; ?>
        <?php if ($has_cta_desc): ?>
            <p class="text-white-50 mb-4" style="max-width: 680px; margin: 0 auto 24px; font-size: 16px;">
                <?= clean_output($about['cta_desc']) ?>
            </p>
        <?php endif; ?>
        <?php if ($has_cta_btn): ?>
            <?php if ($cta_action === 'modal'): ?>
                <button type="button" class="theme-btn gold-btn" data-bs-toggle="modal" data-bs-target="#b2bEnquiryModal">
                    <?= clean_output($about['cta_btn_text']) ?>
                </button>
            <?php else: ?>
                <a href="<?= clean_output(!empty($about['cta_btn_link']) ? $about['cta_btn_link'] : 'contact.php') ?>" class="theme-btn gold-btn">
                    <?= clean_output($about['cta_btn_text']) ?>
                </a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<?php 
require_once 'inc/footer.php';
?>
