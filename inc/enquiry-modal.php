<!-- Universal B2B Enquiry Modal -->
<div class="modal fade" id="b2bEnquiryModal" tabindex="-1" aria-labelledby="b2bEnquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 520px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 18px; overflow: hidden;">
            <div class="modal-header border-0 p-3 px-4" style="background: linear-gradient(135deg, #091C14 0%, #123023 100%); color: #FFFFFF;">
                <div>
                    <span class="badge mb-1 px-2 py-1 text-uppercase" style="background: rgba(197, 160, 89, 0.2); color: #C5A059; border: 1px solid rgba(197, 160, 89, 0.4); font-size: 10.5px; letter-spacing: 1px;">
                        Quick Inquiry
                    </span>
                    <h4 class="modal-title fw-bold text-white mb-0" id="b2bEnquiryModalLabel" style="font-family: 'Instrument Sans', sans-serif; font-size: 20px;">
                        Request Commercial Quote
                    </h4>
                    <p class="small mb-0 text-white text-opacity-75" style="font-size: 12.5px;">Get lot availability, grade specs, and pricing from our trade desk.</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4" style="background-color: #FAFCFA;">
                <div id="enquiryAlertBox" style="display: none;"></div>

                <form id="b2bEnquiryForm" method="POST" action="ajax/submit-enquiry.php">
                    <input type="hidden" name="division" id="modalDivisionSelect" value="export">
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="compact-label" style="font-size: 12.5px;">Your Name <span class="req">*</span></label>
                            <div class="compact-input-wrapper">
                                <i class="fa-regular fa-user compact-input-icon"></i>
                                <input type="text" name="full_name" class="compact-input" placeholder="e.g. Marcus Vance" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="compact-label" style="font-size: 12.5px;">Email Address <span class="req">*</span></label>
                            <div class="compact-input-wrapper">
                                <i class="fa-regular fa-envelope compact-input-icon"></i>
                                <input type="email" name="email" class="compact-input" placeholder="procurement@company.com" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="compact-label" style="font-size: 12.5px;">Phone / WhatsApp <span class="req">*</span></label>
                            <div class="compact-input-wrapper">
                                <i class="fa-brands fa-whatsapp compact-input-icon"></i>
                                <input type="tel" name="phone" class="compact-input" placeholder="+1 (555) 000-0000" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="compact-label" style="font-size: 12.5px;">Product of Interest</label>
                            <div class="compact-input-wrapper">
                                <i class="fa-solid fa-tag compact-input-icon"></i>
                                <input type="text" name="product_interest" id="modalProductInput" class="compact-input" placeholder="e.g. Arabica Green Coffee, Matcha, Spices">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="compact-label" style="font-size: 12.5px;">Message / Requirement</label>
                            <div class="compact-input-wrapper is-textarea">
                                <i class="fa-regular fa-comment-dots compact-input-icon"></i>
                                <textarea name="message" class="compact-input compact-textarea" rows="3" style="min-height: 85px;" placeholder="Outline your grade, volume, target delivery port, or sample requests..."></textarea>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <button type="submit" id="enquirySubmitBtn" class="theme-btn gold-btn w-100 py-3 text-center justify-content-center fw-bold" style="font-size: 15px; border-radius: 10px;">
                                <i class="fa-regular fa-paper-plane me-2"></i> Submit Inquiry
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Autofill product when enquiry button clicked
    const enquiryButtons = document.querySelectorAll('[data-bs-target="#b2bEnquiryModal"]');
    enquiryButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const product = this.getAttribute('data-product');
            const division = this.getAttribute('data-division');
            if (product) {
                const prodInput = document.getElementById('modalProductInput');
                if (prodInput) prodInput.value = product;
            }
            if (division) {
                const divSelect = document.getElementById('modalDivisionSelect');
                if (divSelect) divSelect.value = division;
            }
        });
    });

    // AJAX Form submission
    const form = document.getElementById('b2bEnquiryForm');
    const alertBox = document.getElementById('enquiryAlertBox');
    const submitBtn = document.getElementById('enquirySubmitBtn');

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
                submitBtn.innerHTML = '<i class="fa-regular fa-paper-plane me-2"></i> Submit Procurement Inquiry';
                alertBox.style.display = 'block';

                if (data.success) {
                    alertBox.className = 'alert alert-success py-3 px-4 mb-4 rounded-3 border-0';
                    alertBox.innerHTML = '<i class="fa-solid fa-circle-check me-2 fs-5 align-middle"></i> ' + data.message;
                    form.reset();
                    setTimeout(() => {
                        const modalEl = document.getElementById('b2bEnquiryModal');
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        if (modal) modal.hide();
                        alertBox.style.display = 'none';
                    }, 3500);
                } else {
                    alertBox.className = 'alert alert-danger py-3 px-4 mb-4 rounded-3 border-0';
                    alertBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-2 fs-5 align-middle"></i> ' + data.message;
                }
            })
            .catch(err => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fa-regular fa-paper-plane me-2"></i> Submit Procurement Inquiry';
                alertBox.style.display = 'block';
                alertBox.className = 'alert alert-danger py-3 px-4 mb-4 rounded-3 border-0';
                alertBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation me-2 fs-5 align-middle"></i> Network error. Please try again or email trade@antaraglobale.com directly.';
            });
        });
    }
});
</script>
