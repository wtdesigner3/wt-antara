<?php
require_once __DIR__ . '/db.php';
$contact = get_contact_info();
$profile = get_site_profile();
?>
    <!-- Footer Section Start -->
    <footer class="footer-section footer-1" style="background-color: #0A1C14; position: relative; overflow: hidden;">
        <div class="container">
            <div class="footer-widgets-wrapper py-5">
                <div class="row g-5">
                    <!-- Column 1: Company Profile -->
                    <div class="col-xl-4 col-lg-5 col-md-6">
                        <div class="single-footer-widget">
                            <div class="widget-head mb-4">
                                <a href="index.php">
                                    <img src="<?= clean_output(!empty($profile['pro_logo']) ? $profile['pro_logo'] : 'assets/img/logo/antara-logo-white.svg') ?>" alt="Antara Globale" style="max-height: 52px;">
                                </a>
                            </div>
                            <p class="text-white text-opacity-75 mb-4" style="line-height: 1.7; font-size: 14.5px;">
                                <?= nl2br(clean_output(!empty($profile['pro_footer_desc']) ? $profile['pro_footer_desc'] : 'Antara Globale is an Indian sourcing and trading company focused on supplying quality agricultural food products, green coffee beans, spices, and foodservice ingredients to international buyers and the hospitality industry.')) ?>
                            </p>
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $contact['con_whatsaap']) ?>" target="_blank" class="btn btn-sm btn-outline-light rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-white fs-6"></i> WhatsApp
                                </a>
                                <button type="button" class="btn btn-sm theme-btn gold-btn rounded-pill px-3 py-2" data-bs-toggle="modal" data-bs-target="#b2bEnquiryModal">
                                    Send Enquiry
                                </button>
                            </div>
                            <!-- Social Profiles -->
                            <div class="d-flex align-items-center gap-2">
                                <?php if (!empty($contact['con_linkedin'])): ?>
                                    <a href="<?= clean_output($contact['con_linkedin']) ?>" target="_blank" class="btn btn-sm btn-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border: 1px solid rgba(255,255,255,0.15);" title="LinkedIn">
                                        <i class="fa-brands fa-linkedin-in text-white fs-6"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($contact['con_instagram'])): ?>
                                    <a href="<?= clean_output($contact['con_instagram']) ?>" target="_blank" class="btn btn-sm btn-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border: 1px solid rgba(255,255,255,0.15);" title="Instagram">
                                        <i class="fa-brands fa-instagram text-white fs-6"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($contact['con_facebook'])): ?>
                                    <a href="<?= clean_output($contact['con_facebook']) ?>" target="_blank" class="btn btn-sm btn-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border: 1px solid rgba(255,255,255,0.15);" title="Facebook">
                                        <i class="fa-brands fa-facebook-f text-white fs-6"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($contact['con_twitter'])): ?>
                                    <a href="<?= clean_output($contact['con_twitter']) ?>" target="_blank" class="btn btn-sm btn-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border: 1px solid rgba(255,255,255,0.15);" title="Twitter">
                                        <i class="fa-brands fa-twitter text-white fs-6"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($contact['con_youtube'])): ?>
                                    <a href="<?= clean_output($contact['con_youtube']) ?>" target="_blank" class="btn btn-sm btn-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border: 1px solid rgba(255,255,255,0.15);" title="YouTube">
                                        <i class="fa-brands fa-youtube text-white fs-6"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Export Division -->
                    <div class="col-xl-2 col-lg-3 col-md-6 col-6">
                        <div class="single-footer-widget">
                            <div class="widget-head mb-4">
                                <h4 class="text-white fw-bold" style="font-size: 18px;">Export Division</h4>
                            </div>
                            <ul class="list-unstyled text-white text-opacity-75 d-flex flex-column gap-2" style="font-size: 14px;">
                                <li><a href="export/product-arabica" class="text-white text-opacity-75 text-decoration-none hover-gold">Arabica Coffee Beans</a></li>
                                <li><a href="export/product-robusta" class="text-white text-opacity-75 text-decoration-none hover-gold">Robusta Coffee Beans</a></li>
                                <li><a href="export/product-tea" class="text-white text-opacity-75 text-decoration-none hover-gold">Indian Bulk Tea</a></li>
                                <li><a href="export/product-black-pepper" class="text-white text-opacity-75 text-decoration-none hover-gold">Malabar Black Pepper</a></li>
                                <li><a href="export/product-turmeric" class="text-white text-opacity-75 text-decoration-none hover-gold">Alleppey Turmeric</a></li>
                                <li><a href="export/product-arabica" class="text-white text-opacity-75 text-decoration-none hover-gold">Specialty Export Lots</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Column 3: HORECA Supply Division -->
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                        <div class="single-footer-widget">
                            <div class="widget-head mb-4">
                                <h4 class="text-white fw-bold" style="font-size: 18px;">Restaurant &amp; Café</h4>
                            </div>
                            <ul class="list-unstyled text-white text-opacity-75 d-flex flex-column gap-2" style="font-size: 14px;">
                                <li><a href="restaurant/supply-coffee" class="text-white text-opacity-75 text-decoration-none hover-gold">Coffee Solutions</a></li>
                                <li><a href="restaurant/supply-matcha" class="text-white text-opacity-75 text-decoration-none hover-gold">Ceremonial Matcha</a></li>
                                <li><a href="restaurant/supply-sauces" class="text-white text-opacity-75 text-decoration-none hover-gold">Sauces &amp; Condiments (Veeba)</a></li>
                                <li><a href="restaurant/supply-syrups" class="text-white text-opacity-75 text-decoration-none hover-gold">Artisanal Barista Syrups</a></li>
                                <li><a href="restaurant/supply-sugar" class="text-white text-opacity-75 text-decoration-none hover-gold">Commercial Sugar Sachets</a></li>
                                <li><a href="restaurant/supply-green-coffee" class="text-white text-opacity-75 text-decoration-none hover-gold">Green Beans for Roasters</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Column 4: Contact & Trade Desk Details -->
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="single-footer-widget">
                            <div class="widget-head mb-4">
                                <h4 class="text-white fw-bold" style="font-size: 18px;">Trade Desk Office</h4>
                            </div>
                            <div class="text-white text-opacity-75 d-flex flex-column gap-3" style="font-size: 14px;">
                                <div class="d-flex align-items-start gap-3">
                                    <i class="fa-solid fa-location-dot text-white mt-1" style="font-size: 15px;"></i>
                                    <span><?= clean_output($contact['con_address']) ?></span>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fa-solid fa-envelope text-white" style="font-size: 15px;"></i>
                                    <a href="mailto:<?= clean_output($contact['con_email1']) ?>" class="text-white text-opacity-75 text-decoration-none"><?= clean_output($contact['con_email1']) ?></a>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fa-solid fa-phone text-white" style="font-size: 15px;"></i>
                                    <a href="tel:<?= clean_output($contact['con_phone1']) ?>" class="text-white text-opacity-75 text-decoration-none"><?= clean_output($contact['con_phone1']) ?></a>
                                </div>
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fa-brands fa-whatsapp text-white" style="font-size: 16px;"></i>
                                    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $contact['con_whatsaap']) ?>" target="_blank" class="text-white text-opacity-75 text-decoration-none"><?= clean_output($contact['con_whatsaap']) ?> (Instant Chat)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom border-top border-white border-opacity-10 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 text-white text-opacity-50" style="font-size: 13px; padding-top: 20px; padding-bottom: 20px;">
                <div>
                    <span><?= clean_output(!empty($profile['pro_copyright']) ? $profile['pro_copyright'] : ('© ' . date('Y') . ' Antara Globale. All Rights Reserved.')) ?></span>
                    <span class="mx-2 text-white text-opacity-25">|</span>
                    <span>Made by <a href="https://www.thewebtycoons.com/" target="_blank" class="text-white text-opacity-75 text-decoration-none hover-gold fw-semibold">WebTycoons</a></span>
                </div>
                <div class="d-flex align-items-center gap-4">
                    <a href="about" class="text-white text-opacity-60 text-decoration-none hover-gold">About Company</a>
                    <a href="blog" class="text-white text-opacity-60 text-decoration-none hover-gold">Blogs</a>
                    <a href="contact" class="text-white text-opacity-60 text-decoration-none hover-gold">Contact Us</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Fixed Floating Call (Left) & WhatsApp (Right) Action Widgets (Dynamic CMS Controlled) -->
    <?php
    $show_call = !empty($contact['widget_call_status']) && !empty($contact['widget_call_phone']);
    $show_wa   = !empty($contact['widget_wa_status']) && !empty($contact['widget_wa_number']);

    $call_phone_raw = $contact['widget_call_phone'] ?? $contact['con_phone1'] ?? '';
    $clean_call_phone = preg_replace('/[^0-9+]/', '', $call_phone_raw);
    $call_pos = !empty($contact['widget_call_position']) ? $contact['widget_call_position'] : 'left';
    $call_tooltip = !empty($contact['widget_call_tooltip']) ? $contact['widget_call_tooltip'] : 'Call Us';

    $wa_num_raw = $contact['widget_wa_number'] ?? $contact['con_whatsaap'] ?? '';
    $clean_wa_num = preg_replace('/[^0-9]/', '', $wa_num_raw);
    $wa_pos = !empty($contact['widget_wa_position']) ? $contact['widget_wa_position'] : 'right';
    $wa_tooltip = !empty($contact['widget_wa_tooltip']) ? $contact['widget_wa_tooltip'] : 'Chat on WhatsApp';
    $wa_prefill = !empty($contact['widget_wa_message']) ? $contact['widget_wa_message'] : 'Hello Antara Globale, I am interested in commodity sourcing & trade inquiries.';
    $wa_msg_encoded = urlencode($wa_prefill);
    ?>
    
    <?php if ($show_call && !empty($clean_call_phone)): ?>
    <!-- Floating Call Action Button -->
    <div class="fixed-floating-call-widget position-<?= htmlspecialchars($call_pos) ?>" id="floatingCallWidget">
        <a href="tel:<?= $clean_call_phone ?>" class="floating-btn floating-call-btn" title="<?= clean_output($call_tooltip) ?>: <?= clean_output($call_phone_raw) ?>" aria-label="<?= clean_output($call_tooltip) ?>">
            <span class="floating-btn-pulse"></span>
            <div class="floating-btn-icon">
                <i class="fa-solid fa-phone-volume"></i>
            </div>
        </a>
    </div>
    <?php endif; ?>

    <?php if ($show_wa && !empty($clean_wa_num)): ?>
    <!-- Floating WhatsApp Action Button -->
    <div class="fixed-floating-wa-widget position-<?= htmlspecialchars($wa_pos) ?>" id="floatingWaWidget">
        <a href="https://wa.me/<?= $clean_wa_num ?>?text=<?= $wa_msg_encoded ?>" target="_blank" class="floating-btn floating-wa-btn" title="<?= clean_output($wa_tooltip) ?>" aria-label="<?= clean_output($wa_tooltip) ?>">
            <span class="floating-btn-pulse"></span>
            <div class="floating-btn-icon">
                <i class="fa-brands fa-whatsapp"></i>
            </div>
        </a>
    </div>
    <?php endif; ?>

    <!-- Universal B2B Enquiry Modal Include -->
    <?php require_once __DIR__ . '/enquiry-modal.php'; ?>

    <!-- JavaScript Bundles -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/aos.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/b2b-export.js"></script>
    <script>
        // Failsafe: Ensure AOS initializes and triggers animations
        $(document).ready(function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-out-cubic',
                    once: true,
                    offset: 40
                });
                AOS.refresh();
            }
        });
    </script>
</body>
</html>
