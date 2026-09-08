/* ==========================================================================
   ANTARA GLOBALE - B2B Agricultural Commodity Export JavaScript
   ========================================================================== */

(function ($) {
    "use strict";

    $(document).ready(function () {

        // ==========================================================================
        // 0. Initialize AOS (Animate On Scroll) Library
        // ==========================================================================
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 850,
                easing: 'ease-out-cubic',
                once: true,
                offset: 60,
                delay: 50
            });

            // Refresh AOS on window load & dynamic triggers
            $(window).on('load', function () {
                AOS.refresh();
            });
        }
        // ==========================================================================
        // 1. Initialize Hero Swiper Slider with Text Animations & Continuous Autoplay
        // ==========================================================================
        if (($('.hero-slider-main').length || $('.hero-b2b-slider').length) && typeof Swiper !== 'undefined') {
            const heroSwiper = new Swiper('.hero-slider-main, .hero-b2b-slider', {
                slidesPerView: 1,
                loop: true,
                speed: 1200,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 4500,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: false
                },
                navigation: {
                    nextEl: '.hero-slider-next',
                    prevEl: '.hero-slider-prev',
                },
                pagination: {
                    el: '.hero-slider-pagination',
                    clickable: true,
                }
            });

            // Trigger autoplay start explicitly
            if (heroSwiper.autoplay && typeof heroSwiper.autoplay.start === 'function') {
                heroSwiper.autoplay.start();
            }
        }

        // ==========================================================================
        // 2. Initialize Product Commodity Swiper Carousel (Symmetric 3-Card Display)
        // ==========================================================================
        if ($('.product-swiper-active').length && typeof Swiper !== 'undefined') {
            const productSwiper = new Swiper('.product-swiper-active', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true
                },
                navigation: {
                    nextEl: '.product-slider-next',
                    prevEl: '.product-slider-prev',
                },
                pagination: {
                    el: '.product-slider-pagination',
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
                        slidesPerView: 4,
                        spaceBetween: 24
                    }
                }
            });
        }

        // ==========================================================================
        // 2b. Initialize Related Products Swiper Carousel (Product Detail Page)
        // ==========================================================================
        if ($('.related-product-swiper-active').length && typeof Swiper !== 'undefined') {
            const relatedSwiper = new Swiper('.related-product-swiper-active', {
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

        // ==========================================================================
        // 3. Initialize Sourcing Regions Swiper Carousel
        // ==========================================================================
        if ($('.sourcing-swiper-active').length && typeof Swiper !== 'undefined') {
            const sourcingSwiper = new Swiper('.sourcing-swiper-active', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                speed: 700,
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true
                },
                navigation: {
                    nextEl: '.sourcing-slider-next',
                    prevEl: '.sourcing-slider-prev',
                },
                pagination: {
                    el: '.sourcing-slider-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    992: {
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

        // ==========================================================================
        // 4. Initialize Testimonials Swiper Carousel (Center-Stage 3D Carousel)
        // ==========================================================================
        if ($('.testimonial-swiper-active').length && typeof Swiper !== 'undefined') {
            const testimonialSwiper = new Swiper('.testimonial-swiper-active', {
                slidesPerView: 1.15,
                centeredSlides: true,
                spaceBetween: 20,
                loop: true,
                speed: 650,
                slideToClickedSlide: true,
                autoplay: {
                    delay: 5500,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true
                },
                navigation: {
                    nextEl: '.testimonial-slider-next',
                    prevEl: '.testimonial-slider-prev',
                },
                pagination: {
                    el: '.testimonial-slider-pagination',
                    clickable: true,
                },
                breakpoints: {
                    576: {
                        slidesPerView: 1.35,
                        centeredSlides: true,
                        spaceBetween: 24
                    },
                    768: {
                        slidesPerView: 2.1,
                        centeredSlides: true,
                        spaceBetween: 28
                    },
                    1200: {
                        slidesPerView: 2.7,
                        centeredSlides: true,
                        spaceBetween: 32
                    }
                }
            });
        }

        // ==========================================================================
        // 5. Quick Enquiry Modal Setup & Product Pre-population
        // ==========================================================================
        const enquiryModal = document.getElementById('b2bEnquiryModal');
        if (enquiryModal) {
            enquiryModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                if (button) {
                    const product = button.getAttribute('data-product');
                    if (product) {
                        const modalProductSelect = $('#modal-product');
                        if (modalProductSelect.length) {
                            modalProductSelect.val(product).trigger('change');
                            if ($.fn.niceSelect) {
                                modalProductSelect.niceSelect('update');
                            }
                        }
                    }
                }
            });
        }

        // Modal Form Submission
        $('#b2b-modal-form').on('submit', function (e) {
            e.preventDefault();
            const form = $(this);
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.html();

            submitBtn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Submitting Enquiry...');

            setTimeout(function () {
                submitBtn.html('<i class="fa-solid fa-check"></i> Enquiry Received');

                const successMsg = $(`
                    <div class="alert alert-success mt-3 p-3 rounded" style="background-color: #e8f5e9; border: 1px solid #c8e6c9; color: #1b5e20;">
                        <h6 class="mb-1 fw-bold"><i class="fa-solid fa-circle-check me-2"></i> Enquiry Received!</h6>
                        <small class="text-dark">Our trade desk has received your request and will contact you promptly with commodity specifications, availability, and CIF/FOB terms.</small>
                    </div>
                `);

                form.find('.alert-success').remove();
                form.append(successMsg);
                form[0].reset();

                setTimeout(function () {
                    submitBtn.prop('disabled', false).html(originalText);
                }, 4000);
            }, 1000);
        });

        // ==========================================================================
        // 6. Handle URL Query Param for Product Pre-selection on Contact/Enquiry Form
        // ==========================================================================
        function initProductPreselection() {
            const urlParams = new URLSearchParams(window.location.search);
            const productParam = urlParams.get('product');

            if (productParam) {
                const productSelect = $('#enquiry-product, #product');
                if (productSelect.length) {
                    const normalizedParam = productParam.toLowerCase().trim();

                    let targetValue = '';
                    if (normalizedParam.includes('arabica')) {
                        targetValue = 'Arabica Green Coffee Beans';
                    } else if (normalizedParam.includes('robusta')) {
                        targetValue = 'Robusta Green Coffee Beans';
                    } else if (normalizedParam.includes('tea')) {
                        targetValue = 'Tea';
                    } else if (normalizedParam.includes('pepper')) {
                        targetValue = 'Black Pepper';
                    } else if (normalizedParam.includes('turmeric')) {
                        targetValue = 'Turmeric';
                    } else {
                        targetValue = productParam;
                    }

                    // Set select value
                    productSelect.val(targetValue);

                    // If Nice Select is initialized, update it
                    if ($.fn.niceSelect) {
                        productSelect.niceSelect('update');
                    }

                    // Smooth scroll to form if on contact page
                    if ($('#enquiry-form-section').length) {
                        $('html, body').animate({
                            scrollTop: $('#enquiry-form-section').offset().top - 100
                        }, 600);
                    }
                }
            }
        }

        initProductPreselection();

        // ==========================================================================
        // 6. Enquiry Form Submission Handling with Feedback
        // ==========================================================================
        $('#b2b-enquiry-form, #contact-form').on('submit', function (e) {
            e.preventDefault();

            const form = $(this);
            const submitBtn = form.find('button[type="submit"]');
            const originalText = submitBtn.html();

            // Simple client-side validation
            let isValid = true;
            form.find('input[required], select[required], textarea[required]').each(function () {
                if (!$(this).val()) {
                    $(this).css('border-color', '#dc3545');
                    isValid = false;
                } else {
                    $(this).css('border-color', 'var(--border)');
                }
            });

            if (!isValid) {
                return false;
            }

            // Simulate sending with clear feedback
            submitBtn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i> Submitting Enquiry...');

            setTimeout(function () {
                submitBtn.html('<i class="fa-solid fa-check"></i> Enquiry Submitted');

                // Show success banner
                const successMsg = $(`
                    <div class="alert alert-success mt-4 p-3 rounded" style="background-color: #e8f5e9; border: 1px solid #c8e6c9; color: #1b5e20;">
                        <h5 class="mb-1"><i class="fa-solid fa-circle-check me-2"></i> Thank you for your enquiry!</h5>
                        <p class="mb-0 text-dark">Our export trade desk will review your requirements and provide product availability, specifications, and shipment schedules shortly.</p>
                    </div>
                `);

                form.find('.alert-success').remove();
                form.append(successMsg);
                form[0].reset();

                if ($.fn.niceSelect) {
                    form.find('select').niceSelect('update');
                }

                setTimeout(function () {
                    submitBtn.prop('disabled', false).html(originalText);
                }, 4000);
            }, 1000);
        });

        // 7. Reset input border on focus
        $('input, select, textarea').on('focus input change', function () {
            $(this).css('border-color', 'var(--gold)');
        }).on('blur', function () {
            $(this).css('border-color', 'var(--border)');
        });

    });

})(jQuery);
