<?php
$page_title = "Contact & Trade Desk | Antara Globale";
$page_description = "Contact Antara Globale for agricultural export commodities and restaurant/café supplies. Request sample shipments, volume pricing, and technical specifications.";
require_once __DIR__ . '/inc/header.php';
$contact = get_contact_info();
?>

    <div id="smooth-wrapper">
        <div id="smooth-content">

            <!-- Dynamic Header Section Start -->
            <div class="breadcrumb-wrapper bg-cover header-bg-contact">
                <div class="container">
                    <div class="page-heading text-center">
                        <div class="breadcrumb-sub-title">
                            <h1 class="text-white wow fadeInUp" data-wow-delay=".3s" style="font-size: 46px;">Commercial Trade Desk &amp; Quick Inquiry</h1>
                        </div>
                        <ul class="breadcrumb-items wow fadeInUp d-flex justify-content-center gap-2 list-unstyled mt-3" data-wow-delay=".5s" style="color: #E0E7E1;">
                            <li><a href="index.php" class="text-white"><i class="fa-solid fa-house"></i> Home</a></li>
                            <li>/</li>
                            <li class="text-warning">Contact &amp; Trade Desk</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Contact & B2B Form Section Start -->
            <section class="section-padding fix" id="enquiry-form-section">
                <div class="container">
                    <div class="row g-4 g-lg-5 align-items-start">
                        
                        <!-- Left Info Column: Contact Details Only -->
                        <div class="col-lg-5 col-xl-4">
                            <div class="executive-contact-desk-card h-100">
                                <div>
                                    <span class="sub-title-3 mb-2 d-inline-block text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 12px;">
                                        Get In Touch
                                    </span>
                                    <h3 class="text-white mb-2" style="font-size: 26px; font-family: 'Instrument Sans', sans-serif;">Contact Information</h3>
                                    <p class="text-light opacity-75 mb-4" style="line-height: 1.6; font-size: 14px;">
                                        Reach out to us directly for trade procurement, commodity pricing, or commercial foodservice requirements.
                                    </p>

                                    <div class="d-flex flex-column gap-3">
                                        <!-- Address -->
                                        <div class="desk-channel-item">
                                            <div class="desk-icon-box"><i class="fa-solid fa-location-dot"></i></div>
                                            <div>
                                                <span class="d-block text-white opacity-75 small fw-semibold mb-1">Office Address</span>
                                                <span class="text-light small" style="line-height: 1.5;"><?= clean_output($contact['con_address']) ?></span>
                                            </div>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="desk-channel-item">
                                            <div class="desk-icon-box"><i class="fa-solid fa-phone"></i></div>
                                            <div>
                                                <span class="d-block text-white opacity-75 small fw-semibold mb-1">Phone Number</span>
                                                <a href="tel:<?= preg_replace('/[^0-9+]/', '', $contact['con_phone1']) ?>" class="fw-bold text-white text-decoration-none d-block font-sm">
                                                    <?= clean_output($contact['con_phone1']) ?>
                                                </a>
                                                <?php if (!empty($contact['con_phone2']) && $contact['con_phone2'] !== $contact['con_phone1']): ?>
                                                <a href="tel:<?= preg_replace('/[^0-9+]/', '', $contact['con_phone2']) ?>" class="small text-light opacity-50 text-decoration-none d-block">
                                                    <?= clean_output($contact['con_phone2']) ?>
                                                </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Email ID -->
                                        <div class="desk-channel-item">
                                            <div class="desk-icon-box"><i class="fa-solid fa-envelope"></i></div>
                                            <div>
                                                <span class="d-block text-white opacity-75 small fw-semibold mb-1">Email Address</span>
                                                <a href="mailto:<?= clean_output($contact['con_email1']) ?>" class="fw-bold text-warning text-decoration-none d-block font-sm">
                                                    <?= clean_output($contact['con_email1']) ?>
                                                </a>
                                                <?php if (!empty($contact['con_email2']) && $contact['con_email2'] !== $contact['con_email1']): ?>
                                                <a href="mailto:<?= clean_output($contact['con_email2']) ?>" class="small text-light opacity-50 text-decoration-none d-block">
                                                    <?= clean_output($contact['con_email2']) ?>
                                                </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Form Column: Minimal, Compact, Luxury Form -->
                        <div class="col-lg-7 col-xl-8">
                            <div class="compact-enquiry-card">
                                <div class="compact-top-gold-bar"></div>
                                <div class="compact-card-body">
                                    
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-1">
                                            <span class="text-uppercase fw-bold" style="color: var(--gold); letter-spacing: 1.5px; font-size: 12px;">
                                                <i class="fa-solid fa-paper-plane me-1"></i> Quick Procurement Inquiry
                                            </span>
                                        </div>
                                        <h2 style="font-size: 28px; font-family: 'Instrument Sans', sans-serif;" class="mb-2 text-dark">Request Commercial Specifications &amp; Quote</h2>
                                        <p class="text-muted mb-0" style="font-size: 14.5px;">
                                            Enter your requirements below. Our trade team will respond with current lot availability, grade parameters, and competitive FOB/CIF quotation.
                                        </p>
                                    </div>

                                    <div id="pageEnquiryAlert" style="display: none;"></div>

                                    <form id="pageEnquiryForm">
                                        
                                        <!-- Row 1: Name & Work Email (Compact 2-col) -->
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="compact-form-group">
                                                    <label class="compact-label">
                                                        Full Name <span class="req">*</span>
                                                    </label>
                                                    <div class="compact-input-wrapper">
                                                        <i class="fa-regular fa-user compact-input-icon"></i>
                                                        <input type="text" name="full_name" class="compact-input" placeholder="e.g. Marcus Vance" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="compact-form-group">
                                                    <label class="compact-label">
                                                        Business Email <span class="req">*</span>
                                                    </label>
                                                    <div class="compact-input-wrapper">
                                                        <i class="fa-regular fa-envelope compact-input-icon"></i>
                                                        <input type="email" name="email" class="compact-input" placeholder="procurement@company.com" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Row 2: Phone & Division (Compact 2-col) -->
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="compact-form-group">
                                                    <label class="compact-label">
                                                        Phone / WhatsApp <span class="req">*</span>
                                                    </label>
                                                    <div class="compact-input-wrapper">
                                                        <i class="fa-brands fa-whatsapp compact-input-icon"></i>
                                                        <input type="tel" name="phone" class="compact-input" placeholder="+1 (555) 000-0000" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="compact-form-group">
                                                    <label class="compact-label">
                                                        Category <span class="req">*</span>
                                                    </label>
                                                    <div class="compact-input-wrapper">
                                                        <i class="fa-solid fa-layer-group compact-input-icon"></i>
                                                        <select name="division" class="compact-input compact-select" required>
                                                            <option value="" disabled selected>Select Trade Division</option>
                                                            <option value="export">Export Commodities (Green Coffee, Teas, Spices)</option>
                                                            <option value="horeca">Restaurant &amp; Café Supplies (Matcha, Syrups, Sauces)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Row 3: Product Name & Estimated Volume (Compact 2-col) -->
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="compact-form-group">
                                                    <label class="compact-label">Specific Product</label>
                                                    <div class="compact-input-wrapper">
                                                        <i class="fa-solid fa-tag compact-input-icon"></i>
                                                        <input type="text" name="product_name" class="compact-input" placeholder="e.g. Arabica Plantation AA / Bulk Assam CTC">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="compact-form-group">
                                                    <label class="compact-label">Estimated Volume / Quantity</label>
                                                    <div class="compact-input-wrapper">
                                                        <i class="fa-solid fa-weight-hanging compact-input-icon"></i>
                                                        <input type="text" name="quantity" class="compact-input" placeholder="e.g. 1x 20ft FCL / 500 kg / Monthly">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Row 4: Commercial Specifications & Notes -->
                                        <div class="compact-form-group">
                                            <label class="compact-label">
                                                Commercial Specifications &amp; Requirements <span class="req">*</span>
                                            </label>
                                            <div class="compact-input-wrapper is-textarea">
                                                <i class="fa-regular fa-comment-dots compact-input-icon"></i>
                                                <textarea name="message" class="compact-input compact-textarea" rows="4" placeholder="Target delivery port, packaging specifications (Jute/GrainPro), required certifications, sample request details..." required></textarea>
                                            </div>
                                        </div>

                                        <!-- Row 5: Collapsible Company & Destination Fields (Clean Toggle) -->
                                        <div class="company-expand-wrapper">
                                            <button type="button" class="btn-expand-company" data-bs-toggle="collapse" data-bs-target="#companyDetailsCollapse" aria-expanded="false">
                                                <span><i class="fa-solid fa-building me-1"></i> Add Company &amp; Port Details <small class="text-muted">(Optional)</small></span>
                                                <i class="fa-solid fa-chevron-down expand-arrow"></i>
                                            </button>
                                            <div class="collapse" id="companyDetailsCollapse">
                                                <div class="row g-3 pt-2">
                                                    <div class="col-md-6">
                                                        <label class="compact-label" style="font-size: 12px;">Company / Firm Name</label>
                                                        <div class="compact-input-wrapper">
                                                            <i class="fa-regular fa-building compact-input-icon"></i>
                                                            <input type="text" name="company_name" class="compact-input" style="padding: 8px 12px 8px 36px; font-size: 13px;" placeholder="e.g. Alpine Roasters GmbH">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="compact-label" style="font-size: 12px;">Destination Country / Port</label>
                                                        <div class="compact-input-wrapper">
                                                            <i class="fa-solid fa-earth-americas compact-input-icon"></i>
                                                            <input type="text" name="country" class="compact-input" style="padding: 8px 12px 8px 36px; font-size: 13px;" placeholder="e.g. Hamburg Port, Germany">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="mt-4">
                                            <button type="submit" id="pageSubmitBtn" class="btn-compact-submit">
                                                <i class="fa-solid fa-paper-plane"></i>
                                                <span>Send Quick Inquiry to Trade Desk</span>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- Full-Width Location Map Section Start -->
            <div class="contact-map-section fix">
                <div class="container-fluid p-0">
                    <div class="trade-office-map-frame">
                        <?php 
                        $map_val = trim($contact['con_map'] ?? '');
                        if (!empty($map_val)): 
                            if (strpos($map_val, '<iframe') !== false):
                                echo $map_val;
                            else:
                        ?>
                                <iframe 
                                    src="<?= clean_output($map_val) ?>" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="Antara Globale Trade Office Location">
                                </iframe>
                        <?php 
                            endif;
                        else:
                        ?>
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.893325603598!2d77.5945627!3d12.9715987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670c9b44e6d%3A0xf8dfc3e8517e4fe0!2sBengaluru%2C%20Karnataka!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                                title="Antara Globale Corporate Headquarters &amp; Sourcing Corridors">
                            </iframe>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('pageEnquiryForm');
    const alertBox = document.getElementById('pageEnquiryAlert');
    const submitBtn = document.getElementById('pageSubmitBtn');
    const toggleBtn = document.getElementById('toggleOptionalFields');
    const optionalBox = document.getElementById('optionalFieldsBox');
    const toggleIcon = document.getElementById('toggleIcon');

    // Smooth toggle for optional details
    if (toggleBtn && optionalBox) {
        toggleBtn.addEventListener('click', function() {
            const isVisible = optionalBox.style.display === 'block';
            if (isVisible) {
                optionalBox.style.display = 'none';
                toggleIcon.className = 'fa-solid fa-circle-plus';
                toggleBtn.querySelector('span').textContent = 'Add Company Name & Destination Country (Optional)';
            } else {
                optionalBox.style.display = 'block';
                toggleIcon.className = 'fa-solid fa-circle-minus';
                toggleBtn.querySelector('span').textContent = 'Hide Additional Details';
            }
        });
    }

    // AJAX Form Submission
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Submitting to Trade Desk...';

            const formData = new FormData(form);

            fetch('ajax/submit-enquiry.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fa-solid fa-paper-plane me-1"></i> Send Quick Inquiry to Trade Desk <i class="fa-solid fa-arrow-right ms-2"></i>';
                alertBox.style.display = 'block';

                if (data.success) {
                    alertBox.className = 'alert alert-success py-3 px-4 mb-4 rounded-3 border-0 shadow-sm';
                    alertBox.innerHTML = '<i class="fa-solid fa-circle-check me-2 fs-5 align-middle"></i> ' + data.message;
                    form.reset();
                    if (optionalBox) {
                        optionalBox.style.display = 'none';
                        if (toggleIcon) toggleIcon.className = 'fa-solid fa-circle-plus';
                    }
                    // Scroll smoothly to alert
                    alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    alertBox.className = 'alert alert-danger py-3 px-4 mb-4 rounded-3 border-0 shadow-sm';
                    alertBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-2 fs-5 align-middle"></i> ' + data.message;
                }
            })
            .catch(err => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fa-solid fa-paper-plane me-1"></i> Send Quick Inquiry to Trade Desk <i class="fa-solid fa-arrow-right ms-2"></i>';
                alertBox.style.display = 'block';
                alertBox.className = 'alert alert-danger py-3 px-4 mb-4 rounded-3 border-0 shadow-sm';
                alertBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-2 fs-5 align-middle"></i> Communication network error. Please try again or connect via WhatsApp.';
            });
        });
    }
});
</script>

<?php require_once __DIR__ . '/inc/footer.php'; ?>
