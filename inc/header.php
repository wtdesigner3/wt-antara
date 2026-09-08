<?php
require_once __DIR__ . '/db.php';

$profile = get_site_profile();
$contact = get_contact_info();

// Current Active Page Detection
$current_page = basename($_SERVER['PHP_SELF']);
if ($current_page == '' || $current_page == 'index.php') {
    $active_nav = 'home';
} elseif ($current_page == 'about.php') {
    $active_nav = 'about';
} elseif ($current_page == 'export-supply.php' || strpos($current_page, 'product-') === 0) {
    $active_nav = 'export';
} elseif ($current_page == 'restaurant-cafe-supply.php' || strpos($current_page, 'supply-') === 0) {
    $active_nav = 'horeca';
} elseif ($current_page == 'contact.php') {
    $active_nav = 'contact';
} else {
    $active_nav = '';
}

// Fetch HORECA and Export Products for Dropdowns
$horeca_nav_products = get_products_by_division('horeca');
$export_nav_products = get_products_by_division('export');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <base href="/">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Antara Globale">
    <meta name="description" content="<?= clean_output($page_description ?? $profile['pro_detail']) ?>">
    <meta name="keywords" content="<?= clean_output($profile['pro_keyword']) ?>">

    <!-- ======== Page Title ======== -->
    <title><?= clean_output($page_title ?? $profile['pro_title']) ?></title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="<?= clean_output(!empty($profile['pro_favicon']) ? $profile['pro_favicon'] : 'assets/img/logo/favicon.svg') ?>" type="image/svg+xml">

    <!-- ========== Google Fonts (Modern Executive Typography) ========== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!-- ========== CSS Stylesheets ========== -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/aos.css">
    <link rel="stylesheet" href="assets/css/b2b-custom.css?v=<?= file_exists(__DIR__ . '/../assets/css/b2b-custom.css') ? filemtime(__DIR__ . '/../assets/css/b2b-custom.css') : time() ?>">
</head>

<body>
    <!-- Back To Top Start -->
    <button id="back-top" class="back-to-top theme-bg-2">
        <i class="fa-regular fa-arrow-up"></i>
    </button>

    <!-- Offcanvas Area Start -->
    <div class="fix-area">
        <div class="offcanvas__info">
            <div class="offcanvas__wrapper">
                <div class="offcanvas__content">
                    <div class="offcanvas__top mb-4 d-flex justify-content-between align-items-center">
                        <div class="offcanvas__logo">
                            <a href="index.php">
                                <img src="<?= clean_output(!empty($profile['pro_dark_logo']) ? $profile['pro_dark_logo'] : 'assets/img/logo/antara-logo-dark.svg') ?>" alt="Antara Globale Logo" style="max-height: 48px;">
                            </a>
                        </div>
                        <div class="offcanvas__close">
                            <button><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <p class="text mb-4">
                        Premium Indian agricultural commodities exporter supplying Green Arabica &amp; Robusta Coffee Beans, Tea, Black Pepper, and Turmeric to international markets.
                    </p>
                    <div class="mobile-menu fix mb-4"></div>
                    <div class="offcanvas__contact">
                        <h4>Export Trade Desk</h4>
                        <ul>
                            <li class="d-flex align-items-center mb-3">
                                <div class="offcanvas__contact-icon me-3"><i class="fal fa-map-marker-alt"></i></div>
                                <div class="offcanvas__contact-text">
                                    <span>Origin: India</span>
                                </div>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <div class="offcanvas__contact-icon me-3"><i class="fal fa-envelope"></i></div>
                                <div class="offcanvas__contact-text">
                                    <a href="mailto:<?= clean_output($contact['con_email1']) ?>"><?= clean_output($contact['con_email1']) ?></a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <div class="offcanvas__contact-icon me-3"><i class="fal fa-phone-alt"></i></div>
                                <div class="offcanvas__contact-text">
                                    <a href="tel:<?= clean_output($contact['con_phone1']) ?>"><?= clean_output($contact['con_phone1']) ?></a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center mb-4">
                                <div class="offcanvas__contact-icon me-3"><i class="fal fa-ship"></i></div>
                                <div class="offcanvas__contact-text"><span>Global Seaport Shipments</span></div>
                            </li>
                        </ul>
                        <div class="mt-4">
                            <button type="button" class="theme-btn w-100 text-center" data-bs-toggle="modal" data-bs-target="#b2bEnquiryModal">
                                Send Enquiry
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas__overlay"></div>

    <!-- Header Section Start -->
    <header id="header-sticky" class="header-1 <?= ($active_nav != 'home') ? 'header-2' : '' ?>">
        <div class="container-fluid px-lg-5">
            <div class="mega-menu-wrapper">
                <div class="header-main <?= ($active_nav != 'home') ? 'header-inner' : '' ?> py-2">
                    <div class="header-left">
                        <div class="logo">
                            <a href="index.php" class="header-logo">
                                <img src="<?= clean_output(!empty($profile['pro_logo']) ? $profile['pro_logo'] : 'assets/img/logo/antara-logo-white.svg') ?>" alt="Antara Globale Logo">
                            </a>
                            <a href="index.php" class="header-logo-2">
                                <img src="<?= clean_output(!empty($profile['pro_dark_logo']) ? $profile['pro_dark_logo'] : 'assets/img/logo/antara-logo-dark.svg') ?>" alt="Antara Globale Logo">
                            </a>
                        </div>
                    </div>
                    <div class="mean__menu-wrapper">
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li class="<?= ($active_nav == 'home') ? 'active' : '' ?>">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="<?= ($active_nav == 'about') ? 'active' : '' ?>">
                                        <a href="about">About Us</a>
                                    </li>
                                    
                                    <!-- Export & Supply with Dropdown -->
                                    <li class="has-dropdown <?= ($active_nav == 'export') ? 'active' : '' ?>">
                                        <a href="javascript:void(0);" style="cursor: pointer;">
                                            Export &amp; Supply <i class="fas fa-angle-down ms-1"></i>
                                        </a>
                                        <ul class="submenu">
                                            <li class="has-preview">
                                                <a href="product/product-arabica">
                                                    <span class="menu-item-icon"><i class="fa-solid fa-chevron-right"></i></span>
                                                    <span class="menu-item-text">Arabica Coffee Beans</span>
                                                </a>
                                                <div class="menu-preview-popup">
                                                    <div class="popup-img-wrap">
                                                        <img src="assets/img/commodities/arabica-coffee-beans.jpg" alt="Arabica Coffee Beans">
                                                    </div>
                                                    <div class="popup-content">
                                                        <span class="popup-title">Arabica Coffee Beans</span>
                                                        <span class="popup-tag">Plantation AA &amp; Peaberry</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="has-preview">
                                                <a href="product/product-robusta">
                                                    <span class="menu-item-icon"><i class="fa-solid fa-chevron-right"></i></span>
                                                    <span class="menu-item-text">Robusta Coffee Beans</span>
                                                </a>
                                                <div class="menu-preview-popup">
                                                    <div class="popup-img-wrap">
                                                        <img src="assets/img/commodities/robusta-coffee-beans.jpg" alt="Robusta Coffee Beans">
                                                    </div>
                                                    <div class="popup-content">
                                                        <span class="popup-title">Robusta Coffee Beans</span>
                                                        <span class="popup-tag">Cherry &amp; Parchment AB</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="has-preview">
                                                <a href="product/product-tea">
                                                    <span class="menu-item-icon"><i class="fa-solid fa-chevron-right"></i></span>
                                                    <span class="menu-item-text">Bulk Indian Tea</span>
                                                </a>
                                                <div class="menu-preview-popup">
                                                    <div class="popup-img-wrap">
                                                        <img src="assets/img/commodities/indian-tea.jpg" alt="Bulk Indian Tea">
                                                    </div>
                                                    <div class="popup-content">
                                                        <span class="popup-title">Bulk Indian Tea</span>
                                                        <span class="popup-tag">Assam CTC &amp; Orthodox</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="has-preview">
                                                <a href="product/product-black-pepper">
                                                    <span class="menu-item-icon"><i class="fa-solid fa-chevron-right"></i></span>
                                                    <span class="menu-item-text">Malabar Black Pepper</span>
                                                </a>
                                                <div class="menu-preview-popup">
                                                    <div class="popup-img-wrap">
                                                        <img src="assets/img/commodities/black-pepper.jpg" alt="Malabar Black Pepper">
                                                    </div>
                                                    <div class="popup-content">
                                                        <span class="popup-title">Malabar Black Pepper</span>
                                                        <span class="popup-tag">Garbled MG-1 / TGSEB</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="has-preview">
                                                <a href="product/product-turmeric">
                                                    <span class="menu-item-icon"><i class="fa-solid fa-chevron-right"></i></span>
                                                    <span class="menu-item-text">Alleppey Turmeric</span>
                                                </a>
                                                <div class="menu-preview-popup">
                                                    <div class="popup-img-wrap">
                                                        <img src="assets/img/commodities/turmeric.jpg" alt="Alleppey Turmeric">
                                                    </div>
                                                    <div class="popup-content">
                                                        <span class="popup-title">Alleppey Turmeric</span>
                                                        <span class="popup-tag">High Curcumin 5%+ Export</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                    <!-- Restaurant & Cafe Supply with All 8 Products Dropdown -->
                                    <li class="has-dropdown <?= ($active_nav == 'horeca') ? 'active' : '' ?>">
                                        <a href="javascript:void(0);" style="cursor: pointer;">
                                             Restaurant &amp; Cafe Supply <i class="fas fa-angle-down ms-1"></i>
                                        </a>
                                        <ul class="submenu">
                                            <li class="has-preview">
                                                <a href="product/supply-coffee">
                                                    <span class="menu-item-icon"><i class="fa-solid fa-chevron-right"></i></span>
                                                    <span class="menu-item-text">Coffee Solutions</span>
                                                </a>
                                                <div class="menu-preview-popup">
                                                    <div class="popup-img-wrap">
                                                        <img src="assets/img/commodities/hero-coffee-beans-banner.jpg" alt="Coffee Solutions">
                                                    </div>
                                                    <div class="popup-content">
                                                        <span class="popup-title">Coffee Solutions</span>
                                                        <span class="popup-tag">Espresso &amp; Roast Blends</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="has-preview">
                                                <a href="product/supply-matcha">
                                                    <span class="menu-item-icon"><i class="fa-solid fa-chevron-right"></i></span>
                                                    <span class="menu-item-text">Matcha Powder</span>
                                                </a>
                                                <div class="menu-preview-popup">
                                                    <div class="popup-img-wrap">
                                                        <img src="assets/img/commodities/hero-tea-gardens.jpg" alt="Matcha Powder">
                                                    </div>
                                                    <div class="popup-content">
                                                        <span class="popup-title">Matcha Powder</span>
                                                        <span class="popup-tag">Ceremonial &amp; Culinary Grade</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="has-preview">
                                                <a href="product/supply-tea">
                                                    <span class="menu-item-icon"><i class="fa-solid fa-chevron-right"></i></span>
                                                    <span class="menu-item-text">Foodservice Tea</span>
                                                </a>
                                                <div class="menu-preview-popup">
                                                    <div class="popup-img-wrap">
                                                        <img src="assets/img/commodities/indian-tea.jpg" alt="Foodservice Tea">
                                                    </div>
                                                    <div class="popup-content">
                                                        <span class="popup-title">Foodservice Tea</span>
                                                        <span class="popup-tag">Hospitality &amp; Café Blends</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="has-preview">
                                                <a href="product/supply-sauces">
                                                    <span class="menu-item-icon"><i class="fa-solid fa-chevron-right"></i></span>
                                                    <span class="menu-item-text">Sauces &amp; Condiments</span>
                                                </a>
                                                <div class="menu-preview-popup">
                                                    <div class="popup-img-wrap">
                                                        <img src="assets/img/commodities/hero-spices-export.jpg" alt="Sauces &amp; Condiments">
                                                    </div>
                                                    <div class="popup-content">
                                                        <span class="popup-title">Sauces &amp; Condiments</span>
                                                        <span class="popup-tag">High-Yield Kitchen Grade</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="has-preview">
                                                <a href="product/supply-syrups">
                                                    <span class="menu-item-icon"><i class="fa-solid fa-chevron-right"></i></span>
                                                    <span class="menu-item-text">Flavoured Syrups</span>
                                                </a>
                                                <div class="menu-preview-popup">
                                                    <div class="popup-img-wrap">
                                                        <img src="assets/img/commodities/hero-coffee-beans-banner.jpg" alt="Flavoured Syrups">
                                                    </div>
                                                    <div class="popup-content">
                                                        <span class="popup-title">Flavoured Syrups</span>
                                                        <span class="popup-tag">Barista &amp; Mixology Flavours</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="has-preview">
                                                <a href="product/supply-sugar">
                                                    <span class="menu-item-icon"><i class="fa-solid fa-chevron-right"></i></span>
                                                    <span class="menu-item-text">Commercial Sugar</span>
                                                </a>
                                                <div class="menu-preview-popup">
                                                    <div class="popup-img-wrap">
                                                        <img src="assets/img/commodities/hero-export-banner.jpg" alt="Commercial Sugar">
                                                    </div>
                                                    <div class="popup-content">
                                                        <span class="popup-title">Commercial Sugar</span>
                                                        <span class="popup-tag">Portion Sachets &amp; Cubes</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="has-preview">
                                                <a href="product/supply-green-coffee">
                                                    <span class="menu-item-icon"><i class="fa-solid fa-chevron-right"></i></span>
                                                    <span class="menu-item-text">Green Coffee Beans</span>
                                                </a>
                                                <div class="menu-preview-popup">
                                                    <div class="popup-img-wrap">
                                                        <img src="assets/img/commodities/arabica-coffee-beans.jpg" alt="Green Coffee Beans">
                                                    </div>
                                                    <div class="popup-content">
                                                        <span class="popup-title">Green Coffee Beans</span>
                                                        <span class="popup-tag">Direct Indian Roaster Lots</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="has-preview">
                                                <a href="product/supply-custom-procurement">
                                                    <span class="menu-item-icon"><i class="fa-solid fa-chevron-right"></i></span>
                                                    <span class="menu-item-text">Custom Procurement</span>
                                                </a>
                                                <div class="menu-preview-popup">
                                                    <div class="popup-img-wrap">
                                                        <img src="assets/img/commodities/indian-sourcing-landscape.jpg" alt="Custom Procurement">
                                                    </div>
                                                    <div class="popup-content">
                                                        <span class="popup-title">Custom Procurement</span>
                                                        <span class="popup-tag">Bespoke Hospitality Sourcing</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="<?= ($active_nav == 'contact') ? 'active' : '' ?>">
                                        <a href="contact">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div> 
                    <div class="header-right d-flex justify-content-end align-items-center gap-3">
                        <div class="header-button d-none d-sm-block">
                            <button type="button" class="theme-btn gold-btn" data-bs-toggle="modal" data-bs-target="#b2bEnquiryModal">
                                <i class="fa-regular fa-paper-plane me-1"></i> Send Enquiry
                            </button>
                        </div>
                        <div class="header__hamburger d-xl-none my-auto">
                            <div class="sidebar__toggle" style="cursor: pointer;">
                                <i class="fas fa-bars fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var previewItems = document.querySelectorAll('.header-main .main-menu ul li .submenu li.has-preview');
            previewItems.forEach(function(item) {
                item.addEventListener('mouseenter', function() {
                    var popup = this.querySelector('.menu-preview-popup');
                    if (!popup) return;
                    var rect = this.getBoundingClientRect();
                    if (window.innerWidth - rect.right < 225) {
                        popup.classList.add('flip-left');
                    } else {
                        popup.classList.remove('flip-left');
                    }
                });
            });
        });
        </script>
    </header>
