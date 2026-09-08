<?php
/**
 * Antara Globale - Core Database & Dynamic Site Engine
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ==============================================================================
// 1. DATABASE CONFIGURATION (Direct & Simple)
// ==============================================================================
$is_localhost = in_array($_SERVER['SERVER_NAME'] ?? 'localhost', ['localhost', '127.0.0.1', '::1']) 
                || php_sapi_name() === 'cli';

if ($is_localhost) {
    // Localhost / XAMPP
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'anahat_db';
} else {
    // Live Server (Hostinger)
    $db_host = 'localhost';
    $db_user = 'u345262298_antara_user';
    $db_pass = 'hJ^5e9JJq'; 
    $db_name = 'u345262298_antara';
}

// Establish Connection
if (!isset($conn) || !$conn) {
    if (function_exists('mysqli_report')) {
        mysqli_report(MYSQLI_REPORT_OFF);
    }
    $conn = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        $err = mysqli_connect_error();
        die("<div style='font-family:sans-serif;background:#0A1C14;color:#FFF;padding:40px;text-align:center;'>
            <div style='background:#112A1E;border:1px solid #C5A059;padding:30px;border-radius:12px;max-width:600px;margin:30px auto;text-align:left;'>
                <h2 style='color:#C5A059;margin-top:0;'>Antara Globale &bull; Database Connection Error</h2>
                <p>Could not connect to database <code>$db_name</code> with user <code>$db_user</code>.</p>
                <p><strong>MySQL Error:</strong> $err</p>
                <p>Please edit <code>inc/db.php</code> around line 23 and set your Hostinger database password.</p>
            </div>
        </div>");
    }
    mysqli_set_charset($conn, "utf8mb4");
}

// Site Configuration
define('SITE_NAME', 'Antara Globale');
define('SITE_URL', '/');

/**
 * Fetch Site Profile & Branding
 */
function get_site_profile() {
    global $conn;
    $res = mysqli_query($conn, "SELECT * FROM `tbl_profile` LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        return mysqli_fetch_assoc($res);
    }
    return [
        'pro_title' => 'Antara Globale | Indian Agricultural Commodity Exporter & HORECA Supplier',
        'pro_logo' => 'assets/img/logo/antara-logo-white.svg',
        'pro_dark_logo' => 'assets/img/logo/antara-logo-dark.svg',
        'pro_favicon' => 'assets/img/logo/favicon.svg',
        'pro_detail' => 'Indian sourcing and trading company supplying quality food products and ingredients to global buyers and hospitality.'
    ];
}

/**
 * Fetch Contact & Trade Desk Details
 */
function get_contact_info() {
    global $conn;
    $res = mysqli_query($conn, "SELECT * FROM `tbl_contact` LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        return mysqli_fetch_assoc($res);
    }
    return [
        'con_email1' => 'trade@antaraglobale.com',
        'con_email2' => 'exports@antaraglobale.com',
        'con_phone1' => '+91 98765 43210',
        'con_phone2' => '+91 91234 56789',
        'con_address' => 'Antara Globale Trade Office, Bangalore & Mumbai Ports, India',
        'con_whatsaap' => '+919876543210',
        'con_linkedin' => 'https://linkedin.com'
    ];
}

/**
 * Fetch Products by Division ('export' or 'horeca')
 */
function get_products_by_division($division = 'horeca') {
    global $conn;
    $division = mysqli_real_escape_string($conn, $division);
    $res = mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE `division`='$division' AND `status`=1 ORDER BY `sort` ASC, `id` ASC");
    $products = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $products[] = $row;
    }
    return $products;
}

/**
 * Fetch All Products
 */
function get_all_products() {
    global $conn;
    $res = mysqli_query($conn, "SELECT * FROM `tbl_product` WHERE `status`=1 ORDER BY `division` DESC, `sort` ASC");
    $products = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $products[] = $row;
    }
    return $products;
}

/**
 * Fetch Single Product by Slug or ID
 */
function get_product($identifier) {
    global $conn;
    $clean = mysqli_real_escape_string($conn, $identifier);
    if (is_numeric($identifier)) {
        $query = "SELECT * FROM `tbl_product` WHERE `id`='$clean' AND `status`=1 LIMIT 1";
    } else {
        $query = "SELECT * FROM `tbl_product` WHERE `slug`='$clean' AND `status`=1 LIMIT 1";
    }
    $res = mysqli_query($conn, $query);
    if ($res && mysqli_num_rows($res) > 0) {
        return mysqli_fetch_assoc($res);
    }
    return null;
}

/**
 * Generate Clean Category/Division-Based Product URL (e.g. export/product-tea or restaurant/supply-sugar)
 */
function get_product_url($product_or_slug) {
    if (is_array($product_or_slug)) {
        $division = strtolower($product_or_slug['division'] ?? 'export');
        $slug = $product_or_slug['slug'] ?? '';
    } else {
        $slug = (string)$product_or_slug;
        $division = (strpos($slug, 'supply-') === 0) ? 'horeca' : 'export';
    }
    $folder = ($division === 'horeca' || $division === 'restaurant') ? 'restaurant' : 'export';
    return $folder . '/' . urlencode($slug);
}

/**
 * Fetch Dynamic Hero Carousel Slides
 */
function get_hero_slides() {
    global $conn;
    $slides = [];
    $res = mysqli_query($conn, "SELECT * FROM `tbl_hero_slides` WHERE `status`=1 ORDER BY `sort_order` ASC, `id` ASC");
    if ($res && mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $slides[] = $row;
        }
    }
    
    // Fallback if no slides exist in tbl_hero_slides
    if (empty($slides)) {
        $home = get_home_content();
        $slides = [
            [
                'id' => 1,
                'badge_text' => $home['hero_badge_1'] ?? 'Direct Indian Origin Exports & Trade',
                'title' => $home['hero_title_1'] ?? 'Global Agricultural Commodities & Foodservice Supplies',
                'description' => $home['hero_desc_1'] ?? 'Connecting international commodity buyers with export-grade Coffee Beans, Bulk Teas, and Malabar Spices.',
                'btn1_text' => $home['hero_btn1_text_1'] ?? 'Explore Export Catalogue',
                'btn1_link' => $home['hero_btn1_link_1'] ?? 'products.php?division=export',
                'btn2_text' => $home['hero_btn2_text_1'] ?? 'B2B Trade Desk',
                'btn2_link' => $home['hero_btn2_link_1'] ?? 'contact.php',
                'image' => !empty($home['hero_image_1']) ? $home['hero_image_1'] : 'assets/img/commodities/hero-export-banner.jpg',
                'sort_order' => 1,
                'status' => 1
            ],
            [
                'id' => 2,
                'badge_text' => $home['hero_badge_2'] ?? 'Direct Plantation Procurement',
                'title' => $home['hero_title_2'] ?? 'Single-Origin Teas, Malabar Pepper & High-Curcumin Turmeric',
                'description' => $home['hero_desc_2'] ?? 'Export-grade orthodox teas, high-piperine black pepper, and golden turmeric sourced from celebrated Indian agro-climatic belts.',
                'btn1_text' => $home['hero_btn1_text_2'] ?? 'Request Bulk Quotation',
                'btn1_link' => $home['hero_btn1_link_2'] ?? 'contact.php',
                'btn2_text' => $home['hero_btn2_text_2'] ?? 'Origin Heritage',
                'btn2_link' => $home['hero_btn2_link_2'] ?? 'about.php',
                'image' => !empty($home['hero_image_2']) ? $home['hero_image_2'] : 'assets/img/commodities/hero-tea-gardens.jpg',
                'sort_order' => 2,
                'status' => 1
            ]
        ];
    }
    return $slides;
}

/**
 * Fetch Home Page CMS Content
 */
function get_home_content() {
    global $conn;
    $res = mysqli_query($conn, "SELECT * FROM `tbl_home_content` WHERE `id`=1 LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        return mysqli_fetch_assoc($res);
    }
    return [
        'hero_badge_1' => 'Direct Indian Origin Exports & Trade',
        'hero_title_1' => 'Global Agricultural Commodities & Commercial Foodservice Supply Desk',
        'hero_desc_1' => 'Connecting international commodity buyers with export-grade Coffee Beans, Bulk Teas, and Malabar Spices, and serving restaurant & café chains across India with dependable commercial food supplies.',
        'hero_btn1_text_1' => 'Explore Export Catalogue',
        'hero_btn1_link_1' => 'products.php?division=export',
        'hero_btn2_text_1' => 'B2B Trade Desk',
        'hero_btn2_link_1' => 'contact.php',
        'hero_badge_2' => 'Direct Plantation Procurement',
        'hero_title_2' => 'Certified Single-Origin Teas, Green Coffees & High-Grade Malabar Spices',
        'hero_desc_2' => 'Export-grade orthodox teas, high-piperine black pepper, and golden turmeric sourced from celebrated Indian agro-climatic belts for global blenders and packers.',
        'hero_btn1_text_2' => 'Request Bulk Quotation',
        'hero_btn1_link_2' => 'contact.php',
        'hero_btn2_text_2' => 'Origin Heritage',
        'hero_btn2_link_2' => 'about.php',
        'about_subheading' => 'Origin Procurement & Institutional Supply Desk',
        'about_heading' => 'Supplying Global Commodity Importers & Powering Commercial Kitchens Across India',
        'about_content' => '<p>Antara Globale operates as a specialized Indian agricultural commodity exporter and commercial foodservice procurement partner. Headquartered in India with sourcing corridors across Karnataka, Kerala, Assam, and Deccan cultivation belts, we bridge the gap between regional agricultural producers and demanding commercial enterprises.</p><p>Our business is organized into two dedicated operating divisions: <strong>Export Commodities Division</strong> supplying global importers, roasters, and spice blenders with bulk FCL shipments, and <strong>Restaurant & Café Supply Division</strong> delivering tailored wholesale beverage solutions, artisanal syrups, portion sugars, and high-yield kitchen condiments to hospitality operators.</p>',
        'about_point_1' => 'Direct Origin Procurement & Cooperative Ties',
        'about_point_2' => 'Laboratory Batch Certification & Strict Compliance',
        'about_point_3' => 'Strategic Maritime Logistics & Cold/Hermetic Care',
        'about_badge_title' => 'Sourcing & Trading Desk',
        'about_badge_exp' => '15+ Years Origin Experience',
        'about_stat_vol' => '500+ MT',
        'about_stat_ports' => '18+',
        'pillar1_title' => 'Direct Origin Sourcing',
        'pillar1_desc' => 'We procure directly from farm-gate cooperatives and shade-grown plantations, ensuring lot traceability, competitive baseline pricing, and genuine regional authenticity.',
        'pillar1_icon' => 'fa-solid fa-seedling',
        'pillar1_image' => 'assets/img/icons/pillar-1-origin.svg',
        'pillar2_title' => 'Rigorous Quality Assurance',
        'pillar2_desc' => 'Every export consignment undergoes strict batch analysis for moisture content, screen calibration, piperine or curcumin density, and sensory cupping.',
        'pillar2_icon' => 'fa-solid fa-microscope',
        'pillar2_image' => 'assets/img/icons/pillar-2-quality.svg',
        'pillar3_title' => 'Maritime Logistics Excellence',
        'pillar3_desc' => 'GrainPro hermetic lining, nitrogen-flushed bulk containers, and swift dispatch through major maritime gateways including Mangalore, Cochin, and Nhava Sheva.',
        'pillar3_icon' => 'fa-solid fa-box-archive',
        'pillar3_image' => 'assets/img/icons/pillar-3-logistics.svg',
        'pillar4_title' => 'Commercial Trade Desk Support',
        'pillar4_desc' => 'Dedicated commercial trade desk offering 24-hour turnaround on FOB/CIF quotations, sample evaluation dispatch, and real-time shipping documentation.',
        'pillar4_icon' => 'fa-solid fa-headset',
        'pillar4_image' => 'assets/img/icons/pillar-4-support.svg',
        'terroir_heading' => 'Celebrated Cultivation Belts & Origin Agro-Climates',
        'terroir_desc' => 'Explore celebrated agricultural zones producing our export-grade coffee, teas, and spices with authentic geographic provenance.'
    ];
}

/**
 * Fetch Terroir / Growing Belts
 */
function get_terroir_belts() {
    global $conn;
    $res = mysqli_query($conn, "SELECT * FROM `tbl_terroir_belts` WHERE `status`=1 ORDER BY `sort_order` ASC, `id` ASC");
    $belts = [];
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $belts[] = $row;
        }
    }
    return $belts;
}

/**
 * Fetch About Us Page CMS Content
 */
function get_about_content() {
    global $conn;
    $res = mysqli_query($conn, "SELECT * FROM `tbl_about` WHERE `id`=1 LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        return mysqli_fetch_assoc($res);
    }
    return [
        'story_subheading' => 'Origin Heritage & Sourcing Network',
        'story_heading' => 'Bridging Indian Cultivation Belts With Global Markets & Commercial Kitchens',
        'story_content' => '<p>Antara Globale was established to solve a fundamental trade challenge: international buyers seeking genuine Indian origin agricultural commodities frequently face multi-tier brokerage layers, inconsistent batch quality, and delayed shipping documentation. Simultaneously, domestic café chains, roasters, and restaurant operators require dependable, consolidated wholesale food supplies delivered with rigorous consistency.</p><p>We operate directly at the agricultural source. By establishing direct procurement relationships with planters, cooperatives, and spice processing units across Southern and Eastern India, Antara Globale delivers certified commodity shipments and kitchen ingredients backed by strict laboratory grade analysis and hermetic packaging.</p>',
        'story_image' => 'assets/img/commodities/hero-coffee-plantation-banner.jpg',
        'story_badge_exp' => '15+',
        'story_badge_title' => 'Dependable Sourcing Partner',
        'story_badge_subtitle' => '15+ Years Origin Experience • Direct Cooperative Ties',
        'mission_heading' => 'Our Strategic Mission',
        'mission_content' => '<p>To provide international commodity buyers and domestic foodservice operators with direct, transparent, and certified access to India\'s agricultural wealth, executing every transaction with precision grading, competitive commercial terms, and dependable maritime delivery.</p>',
        'mission_image' => 'assets/img/icons/mission-target.svg',
        'vision_heading' => 'Our Global Vision',
        'vision_content' => '<p>To stand as India\'s most trusted export and foodservice procurement desk, recognized across global ports and commercial kitchens for unyielding quality assurance, supply predictability, and customer-first trade execution.</p>',
        'vision_image' => 'assets/img/icons/vision-compass.svg',
        'value1_title' => 'Origin Authenticity & Traceability',
        'value1_desc' => 'Eliminating speculative trading layers by sourcing directly from plantation gates and verified producer clusters.',
        'value1_icon' => 'fa-solid fa-seedling',
        'value1_image' => 'assets/img/icons/value-1-traceability.svg',
        'value2_title' => 'Laboratory-Grade Batch Quality',
        'value2_desc' => 'Zero compromise on screen calibration, moisture ceilings, essential oil density, and export certifications.',
        'value2_icon' => 'fa-solid fa-microscope',
        'value2_image' => 'assets/img/icons/value-2-quality.svg',
        'value3_title' => 'Predictable Maritime Logistics',
        'value3_desc' => 'Strategic warehouse buffering and freight partnerships ensuring scheduled container dispatches without disruption.',
        'value3_icon' => 'fa-solid fa-ship',
        'value3_image' => 'assets/img/icons/value-3-logistics.svg',
        'value4_title' => 'Transparent Commercial Integrity',
        'value4_desc' => '24-hour response turnaround on FOB/CIF quotations, sample evaluation kits, and real-time shipping tracking.',
        'value4_icon' => 'fa-solid fa-headset',
        'value4_image' => 'assets/img/icons/value-4-integrity.svg',
        'capabilities_subheading' => 'Comprehensive Supply Capability',
        'capabilities_heading' => 'From Indian Cultivation Belts to Commercial Kitchens',
        'capabilities_badge_title' => 'Direct Agro-Commodity & HORECA Logistics',
        'capabilities_content' => '<p>Our dual operational capability ensures that whether you require container shipments of export-grade commodities or consolidated pantry and beverage supplies for multi-location hospitality chains, procurement is always dependable:</p><ul class="feature-check-list mb-4 list-unstyled"><li class="mb-3 d-flex align-items-start gap-3"><i class="fa-solid fa-circle-check text-success fs-5 mt-1"></i><div><strong>Agro-Commodity Export Line:</strong> Arabica &amp; Robusta green coffee beans, estate single-origin orthodox &amp; CTC teas, whole black pepper, and high-curcumin turmeric fingers.</div></li><li class="mb-3 d-flex align-items-start gap-3"><i class="fa-solid fa-circle-check text-success fs-5 mt-1"></i><div><strong>Restaurant &amp; Café Supplies:</strong> Roasted beans, ceremonial &amp; culinary matcha, flavored syrups, commercial sugar sachets &amp; cubes, sauces &amp; condiments (Veeba &amp; on request), and custom procurement.</div></li><li class="d-flex align-items-start gap-3"><i class="fa-solid fa-circle-check text-success fs-5 mt-1"></i><div><strong>Consistent Commercial Execution:</strong> Strict quality checking, responsive communication desk, sample evaluation kits, and transparent commercial pricing.</div></li></ul>',
        'capabilities_image' => 'assets/img/commodities/shipping-logistics-port.jpg',
        'capabilities_btn1_text' => 'Browse Export Products',
        'capabilities_btn1_link' => 'product-arabica.php',
        'capabilities_btn2_text' => 'View HORECA Products',
        'capabilities_btn2_link' => 'supply-coffee.php',
        'ind_subheading' => 'Industries We Serve',
        'ind_heading' => 'Tailored Procurement Across Two Core Sectors',
        'ind_desc' => 'Providing customized sourcing frameworks tailored to international bulk commodity trade and domestic commercial hospitality operations.',
        'ind1_badge' => 'International Trade Division',
        'ind1_title' => 'Export Sector',
        'ind1_desc' => 'Supporting international trade desks with origin-graded agricultural commodities, customized export packaging, containerized sea freight logistics, and strict quality verification.',
        'ind1_clients' => 'Importers, Distributors, Wholesalers, Retail Brands, Food Manufacturers',
        'ind1_btn_text' => 'Explore Export Commodities',
        'ind1_btn_link' => 'product-arabica.php',
        'ind1_icon' => 'assets/img/icons/industry-export.svg',
        'ind2_badge' => 'Hospitality & Food Service',
        'ind2_title' => 'HORECA Sector',
        'ind2_desc' => 'Dedicated procurement service delivering essential beverage solutions, cooking condiments, sugars, specialty coffees, matcha, and custom food ingredients to professional kitchens.',
        'ind2_clients' => 'Hotels, Restaurants, Cafés, Caterers, Cloud Kitchens',
        'ind2_btn_text' => 'Explore Foodservice Products',
        'ind2_btn_link' => 'supply-coffee.php',
        'ind2_icon' => 'assets/img/icons/industry-horeca.svg',
        'export_line_title' => 'Bulk Agricultural Commodity Export Desk',
        'export_line_desc' => 'Arabica & Robusta green coffee beans, estate single-origin orthodox & CTC teas, whole black pepper, and high-curcumin turmeric fingers.',
        'horeca_line_title' => 'Hospitality & Café Supply Network',
        'horeca_line_desc' => 'Roasted beans, ceremonial & culinary matcha, flavored syrups, commercial sugar sachets & cubes, sauces & condiments (Veeba & on request), and custom procurement.',
        'stat_volume' => '500+ MT',
        'stat_volume_label' => 'Monthly Commodity Flow',
        'stat_ports' => '18+',
        'stat_ports_label' => 'Global Discharge Ports',
        'stat_lots' => '100%',
        'stat_lots_label' => 'Batch Traceable Lots',
        'stat_clients' => '120+',
        'stat_clients_label' => 'Commercial Buyers',
        'cta_subheading' => 'Commercial Trade Desk',
        'cta_heading' => 'Looking to Partner with a Dependable Indian Sourcing Company?',
        'cta_desc' => 'Contact our commercial trade desk today with your specifications, volume requirements, and delivery destination.',
        'cta_btn_text' => 'Connect with Trade Desk',
        'cta_btn_link' => 'contact.php',
        'cta_btn_action' => 'link',
        'cta_bg_image' => 'assets/img/commodities/shipping-logistics-port.jpg'
    ];
}

/**
 * Fetch Active Client Testimonials
 */
function get_testimonials($limit = 6) {
    global $conn;
    $limit = (int)$limit;
    $res = mysqli_query($conn, "SELECT * FROM `tbl_testimonial` WHERE `tt_status`=1 ORDER BY `tt_sort` ASC, `tt_id` DESC LIMIT $limit");
    $items = [];
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $items[] = $row;
        }
    }
    return $items;
}

/**
 * Fetch Published Blog Articles
 */
function get_blogs($category = '', $search = '', $tag = '', $limit = 20, $offset = 0) {
    global $conn;
    $limit = (int)$limit;
    $offset = (int)$offset;
    $where = ["`b_status` = 1"];

    if (!empty($category)) {
        $cat_safe = mysqli_real_escape_string($conn, $category);
        $where[] = "`b_category` = '$cat_safe'";
    }

    if (!empty($search)) {
        $search_safe = mysqli_real_escape_string($conn, $search);
        $where[] = "(`b_title` LIKE '%$search_safe%' OR `b_short_desc` LIKE '%$search_safe%' OR `b_description` LIKE '%$search_safe%' OR `b_tags` LIKE '%$search_safe%')";
    }

    if (!empty($tag)) {
        $tag_safe = mysqli_real_escape_string($conn, $tag);
        $where[] = "`b_tags` LIKE '%$tag_safe%'";
    }

    $where_sql = implode(' AND ', $where);
    $sql = "SELECT * FROM `tbl_blogs` WHERE $where_sql ORDER BY `b_sort` ASC, `b_date` DESC, `b_id` DESC LIMIT $limit OFFSET $offset";
    $res = mysqli_query($conn, $sql);
    $items = [];
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $items[] = $row;
        }
    }
    return $items;
}

/**
 * Get Total Blog Count for Pagination / Stats
 */
function get_blogs_count($category = '', $search = '', $tag = '') {
    global $conn;
    $where = ["`b_status` = 1"];

    if (!empty($category)) {
        $cat_safe = mysqli_real_escape_string($conn, $category);
        $where[] = "`b_category` = '$cat_safe'";
    }

    if (!empty($search)) {
        $search_safe = mysqli_real_escape_string($conn, $search);
        $where[] = "(`b_title` LIKE '%$search_safe%' OR `b_short_desc` LIKE '%$search_safe%' OR `b_description` LIKE '%$search_safe%' OR `b_tags` LIKE '%$search_safe%')";
    }

    if (!empty($tag)) {
        $tag_safe = mysqli_real_escape_string($conn, $tag);
        $where[] = "`b_tags` LIKE '%$tag_safe%'";
    }

    $where_sql = implode(' AND ', $where);
    $res = mysqli_query($conn, "SELECT COUNT(*) as total FROM `tbl_blogs` WHERE $where_sql");
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        return (int)$row['total'];
    }
    return 0;
}

/**
 * Fetch Single Blog Article by Slug URL
 */
function get_blog_by_url($url) {
    global $conn;
    $url_safe = mysqli_real_escape_string($conn, $url);
    $res = mysqli_query($conn, "SELECT * FROM `tbl_blogs` WHERE `b_url` = '$url_safe' AND `b_status` = 1 LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        return mysqli_fetch_assoc($res);
    }
    return null;
}

/**
 * Fetch Single Blog Article by ID
 */
function get_blog_by_id($id) {
    global $conn;
    $id = (int)$id;
    $res = mysqli_query($conn, "SELECT * FROM `tbl_blogs` WHERE `b_id` = $id LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        return mysqli_fetch_assoc($res);
    }
    return null;
}

/**
 * Helper to get clean, accessible blog image URL
 */
function get_blog_image_url($img_path) {
    if (empty($img_path)) {
        return 'assets/img/inner-page/news/01.jpg';
    }
    $img_path = trim($img_path);
    if (strpos($img_path, 'uploads/') === 0 || strpos($img_path, 'assets/') === 0 || strpos($img_path, 'http://') === 0 || strpos($img_path, 'https://') === 0) {
        return $img_path;
    }
    return 'uploads/blogs/' . ltrim($img_path, '/');
}

/**
 * Fetch Recent Blog Articles
 */
function get_recent_blogs($limit = 4, $exclude_id = 0) {
    global $conn;
    $limit = (int)$limit;
    $exclude_id = (int)$exclude_id;
    $where = "`b_status` = 1";
    if ($exclude_id > 0) {
        $where .= " AND `b_id` != $exclude_id";
    }
    $res = mysqli_query($conn, "SELECT * FROM `tbl_blogs` WHERE $where ORDER BY `b_date` DESC, `b_id` DESC LIMIT $limit");
    $items = [];
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $items[] = $row;
        }
    }
    return $items;
}

/**
 * Fetch Blog Categories with Article Count
 */
function get_blog_categories_with_count() {
    global $conn;
    $res = mysqli_query($conn, "SELECT `b_category`, COUNT(*) as count FROM `tbl_blogs` WHERE `b_status` = 1 AND `b_category` IS NOT NULL AND `b_category` != '' GROUP BY `b_category` ORDER BY count DESC");
    $cats = [];
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $cats[] = $row;
        }
    }
    return $cats;
}

/**
 * Sanitize Output
 */
function clean_output($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
?>
