<?php 
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($ro) || empty($ro['pro_logo'])) {
    $sb_prof_q = mysqli_query($conn, "SELECT `pro_logo`, `pro_dark_logo`, `pro_title` FROM `tbl_profile` LIMIT 1");
    if ($sb_prof_q && mysqli_num_rows($sb_prof_q) > 0) {
        $sb_prof = mysqli_fetch_assoc($sb_prof_q);
        $sidebar_logo = '../../' . $sb_prof['pro_logo'];
    } else {
        $sidebar_logo = '../../assets/img/logo/antara-logo-white.svg';
    }
} else {
    $sidebar_logo = '../../' . $ro['pro_logo'];
}
?>
<div id="sidebar" class="sidebar">
	<div class="sidebar-scroll-wrapper">
		<!-- Sidebar Navigation -->
		<ul class="nav">
			<li class="nav-header" style="color: #6C8176; letter-spacing: 1px; font-size: 11px; padding: 16px 20px 6px;">CORE DESK</li>
			
			<li class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
				<a href="index.php">
					<i class="fa-solid fa-chart-pie"></i>
					<span>CMS Dashboard</span>
				</a>
			</li>

			<li class="nav-header" style="color: #6C8176; letter-spacing: 1px; font-size: 11px; padding: 16px 20px 6px;">WEBSITE PAGES CMS</li>

			<!-- Home Page CMS Submenu -->
			<?php 
			$home_pages = ['manage-home-hero.php', 'manage-home-intro.php', 'manage-home-pillars.php', 'manage-home-terroir.php', 'manage-home-choose.php', 'manage-home.php'];
			$is_home_active = in_array($current_page, $home_pages);
			?>
			<li class="has-sub <?= $is_home_active ? 'active expand' : '' ?>">
				<a href="javascript:void(0);" class="sidebar-parent-toggle d-flex align-items-center justify-content-between">
					<div>
						<i class="fa-solid fa-house"></i>
						<span>Home Page CMS</span>
					</div>
					<b class="caret"></b>
				</a>
				<ul class="sub-menu" style="<?= $is_home_active ? 'display: block;' : '' ?>">
					<li class="<?= ($current_page == 'manage-home-hero.php' || $current_page == 'manage-home.php') ? 'active' : '' ?>">
						<a href="manage-home-hero.php">Hero Carousel Banners</a>
					</li>
					<li class="<?= $current_page == 'manage-home-pillars.php' ? 'active' : '' ?>">
						<a href="manage-home-pillars.php">Export Pillars (3 Blocks)</a>
					</li>
					<li class="<?= $current_page == 'manage-home-intro.php' ? 'active' : '' ?>">
						<a href="manage-home-intro.php">Corporate Story Intro</a>
					</li>
					<li class="<?= $current_page == 'manage-home-terroir.php' ? 'active' : '' ?>">
						<a href="manage-home-terroir.php">Origin Terroir Belts</a>
					</li>
					<li class="<?= $current_page == 'manage-home-choose.php' ? 'active' : '' ?>">
						<a href="manage-home-choose.php">Why Choose Us (Advantages)</a>
					</li>
				</ul>
			</li>

			<!-- About Us CMS Submenu -->
			<?php 
			$about_pages = ['manage-about-story.php', 'manage-about-mission.php', 'manage-about-industries.php', 'manage-about-capabilities.php', 'manage-about-stats.php', 'manage-about-cta.php', 'manage-about.php'];
			$is_about_active = in_array($current_page, $about_pages);
			?>
			<li class="has-sub <?= $is_about_active ? 'active expand' : '' ?>">
				<a href="javascript:void(0);" class="sidebar-parent-toggle d-flex align-items-center justify-content-between">
					<div>
						<i class="fa-solid fa-building-wheat"></i>
						<span>About Us CMS</span>
					</div>
					<b class="caret"></b>
				</a>
				<ul class="sub-menu" style="<?= $is_about_active ? 'display: block;' : '' ?>">
					<li class="<?= ($current_page == 'manage-about-story.php' || $current_page == 'manage-about.php') ? 'active' : '' ?>">
						<a href="manage-about-story.php">Heritage & Story</a>
					</li>
					<li class="<?= $current_page == 'manage-about-mission.php' ? 'active' : '' ?>">
						<a href="manage-about-mission.php">Mission & Vision</a>
					</li>
					<li class="<?= $current_page == 'manage-about-industries.php' ? 'active' : '' ?>">
						<a href="manage-about-industries.php">Industries We Serve</a>
					</li>
					<li class="<?= $current_page == 'manage-about-capabilities.php' ? 'active' : '' ?>">
						<a href="manage-about-capabilities.php">Supply Capabilities</a>
					</li>
					<li class="<?= $current_page == 'manage-about-stats.php' ? 'active' : '' ?>">
						<a href="manage-about-stats.php">Verified Statistics</a>
					</li>
					<li class="<?= $current_page == 'manage-about-cta.php' ? 'active' : '' ?>">
						<a href="manage-about-cta.php">CTA Banner</a>
					</li>
				</ul>
			</li>

			<!-- Contact Page CMS -->
			<li class="<?= ($current_page == 'manage-contact.php' || $current_page == 'manage-contact-map.php') ? 'active' : '' ?>">
				<a href="manage-contact.php">
					<i class="fa-solid fa-headset"></i>
					<span>Contact Page CMS</span>
				</a>
			</li>

			<!-- Client Testimonials -->
			<li class="<?php echo ($current_page == 'manage-testimonial.php') ? 'active' : ''; ?>">
				<a href="manage-testimonial.php">
					<i class="fa-solid fa-star"></i>
					<span>Client Testimonials</span>
				</a>
			</li>

			<!-- Blog & Market Insights CMS Submenu -->
			<?php 
			$blog_pages = ['manage-blogs.php', 'add-blogs.php', 'edit-blogs.php'];
			$is_blog_active = in_array($current_page, $blog_pages);
			?>
			<li class="has-sub <?= $is_blog_active ? 'active expand' : '' ?>">
				<a href="javascript:void(0);" class="sidebar-parent-toggle d-flex align-items-center justify-content-between">
					<div>
						<i class="fa-solid fa-newspaper"></i>
						<span>Blog & Insights CMS</span>
					</div>
					<b class="caret"></b>
				</a>
				<ul class="sub-menu" style="<?= $is_blog_active ? 'display: block;' : '' ?>">
					<li class="<?= ($current_page == 'manage-blogs.php') ? 'active' : '' ?>">
						<a href="manage-blogs.php">All Articles (3)</a>
					</li>
					<li class="<?= ($current_page == 'add-blogs.php') ? 'active' : '' ?>">
						<a href="add-blogs.php">Add New Article</a>
					</li>
				</ul>
			</li>

			<li class="nav-header" style="color: #6C8176; letter-spacing: 1px; font-size: 11px; padding: 16px 20px 6px;">CATALOG & COMMODITIES</li>

			<!-- Product Catalog Submenu -->
			<?php 
			$product_pages = ['manage-products.php', 'manage-categories.php', 'add-product.php'];
			$is_product_active = in_array($current_page, $product_pages);
			?>
			<li class="has-sub <?= $is_product_active ? 'active expand' : '' ?>">
				<a href="javascript:void(0);" class="sidebar-parent-toggle d-flex align-items-center justify-content-between">
					<div>
						<i class="fa-solid fa-boxes-stacked"></i>
						<span>Product Catalog</span>
					</div>
					<b class="caret"></b>
				</a>
				<ul class="sub-menu" style="<?= $is_product_active ? 'display: block;' : '' ?>">
					<li class="<?= ($current_page == 'manage-categories.php') ? 'active' : '' ?>">
						<a href="manage-categories.php">Categories (2)</a>
					</li>
					<li class="<?= ($current_page == 'manage-products.php' && !isset($_GET['division'])) ? 'active' : '' ?>">
						<a href="manage-products.php">All Products (13)</a>
					</li>
					<li class="<?= ($current_page == 'manage-products.php' && isset($_GET['division']) && $_GET['division'] == 'horeca') ? 'active' : '' ?>">
						<a href="manage-products.php?division=horeca">HORECA Supplies (8)</a>
					</li>
					<li class="<?= ($current_page == 'manage-products.php' && isset($_GET['division']) && $_GET['division'] == 'export') ? 'active' : '' ?>">
						<a href="manage-products.php?division=export">Export Commodities (5)</a>
					</li>
					<li class="<?= ($current_page == 'add-product.php') ? 'active' : '' ?>">
						<a href="add-product.php">Add New Product</a>
					</li>
				</ul>
			</li>

			<li class="nav-header" style="color: #6C8176; letter-spacing: 1px; font-size: 11px; padding: 16px 20px 6px;">CONFIGURATION & SETTINGS</li>

			<!-- Branding & Settings Submenu -->
			<?php 
			$settings_pages = ['manage-settings-branding.php', 'manage-settings-seo.php', 'manage-settings-social.php', 'manage-settings-widgets.php', 'manage-settings.php'];
			$is_settings_active = in_array($current_page, $settings_pages);
			?>
			<li class="has-sub <?= $is_settings_active ? 'active expand' : '' ?>">
				<a href="javascript:void(0);" class="sidebar-parent-toggle d-flex align-items-center justify-content-between">
					<div>
						<i class="fa-solid fa-sliders"></i>
						<span>Branding & Settings</span>
					</div>
					<b class="caret"></b>
				</a>
				<ul class="sub-menu" style="<?= $is_settings_active ? 'display: block;' : '' ?>">
					<li class="<?= ($current_page == 'manage-settings-branding.php' || $current_page == 'manage-settings.php') ? 'active' : '' ?>">
						<a href="manage-settings-branding.php">Brand Logos & Favicon</a>
					</li>
					<li class="<?= ($current_page == 'manage-settings-seo.php') ? 'active' : '' ?>">
						<a href="manage-settings-seo.php">Global SEO & Footer</a>
					</li>
					<li class="<?= ($current_page == 'manage-settings-social.php') ? 'active' : '' ?>">
						<a href="manage-settings-social.php">Social Media Handles</a>
					</li>
					<li class="<?= ($current_page == 'manage-settings-widgets.php') ? 'active' : '' ?>">
						<a href="manage-settings-widgets.php">Floating Action Widgets</a>
					</li>
				</ul>
			</li>

			<li class="<?php echo ($current_page == 'manage-profile.php') ? 'active' : ''; ?>">
				<a href="manage-profile.php">
					<i class="fa-solid fa-shield-halved"></i>
					<span>Admin Security</span>
				</a>
			</li>

			<li class="nav-header" style="color: #6C8176; letter-spacing: 1px; font-size: 11px; padding: 16px 20px 6px;">ACTIONS</li>

			<li>
				<a href="../../index.php" target="_blank">
					<i class="fa-solid fa-arrow-up-right-from-square"></i>
					<span>View Live Website</span>
				</a>
			</li>

			<li>
				<a href="includes/logout.php" onClick="return confirm('Are you sure you want to log out?');">
					<i class="fa-solid fa-right-from-bracket text-danger"></i>
					<span class="text-danger">Sign Out</span>
				</a>
			</li>
		</ul>
	</div>
</div>
