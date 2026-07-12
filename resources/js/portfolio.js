// ===========================================
// Abideen.dev — Portfolio JavaScript
// ===========================================

document.addEventListener('DOMContentLoaded', function () {

    // ---- Loading Screen ----
    const loadingScreen = document.getElementById('loading-screen');
    if (loadingScreen) {
        window.addEventListener('load', function () {
            setTimeout(() => {
                loadingScreen.classList.add('loaded');
            }, 600);
        });
    }

    // ---- Navbar Scroll Effect ----
    const navbar = document.getElementById('main-navbar');
    if (navbar) {
        const handleNavScroll = () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        };
        window.addEventListener('scroll', handleNavScroll, { passive: true });
        handleNavScroll();
    }

    // ---- Dark/Light Theme Toggle ----
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const html = document.documentElement;

    const savedTheme = localStorage.getItem('theme') || 'dark';
    html.setAttribute('data-bs-theme', savedTheme);
    updateThemeIcon(savedTheme);

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });
    }

    function updateThemeIcon(theme) {
        if (themeIcon) {
            themeIcon.className = theme === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';
        }
    }

    // ---- Typing Animation ----
    const typingElement = document.getElementById('typing-text');
    if (typingElement) {
        const words = JSON.parse(typingElement.dataset.words || '["Full-Stack Developer"]');
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;

        function typeEffect() {
            const currentWord = words[wordIndex];

            if (isDeleting) {
                typingElement.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;
            } else {
                typingElement.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;
            }

            let typeSpeed = isDeleting ? 50 : 100;

            if (!isDeleting && charIndex === currentWord.length) {
                typeSpeed = 2000;
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex = (wordIndex + 1) % words.length;
                typeSpeed = 500;
            }

            setTimeout(typeEffect, typeSpeed);
        }

        typeEffect();
    }

    // ---- Scroll Reveal (IntersectionObserver) ----
    const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -50px 0px' });

    revealElements.forEach(el => revealObserver.observe(el));

    // ---- Animated Counters ----
    const counters = document.querySelectorAll('.stat-number');
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.dataset.target);
                let current = 0;
                const increment = target / 60;

                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        entry.target.textContent = Math.ceil(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        entry.target.textContent = target + (entry.target.dataset.suffix || '');
                    }
                };

                updateCounter();
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => counterObserver.observe(counter));

    // ---- Skills Progress Bars ----
    const skillBars = document.querySelectorAll('.skill-progress-bar');
    const skillObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target.dataset.progress;
                entry.target.style.width = target + '%';
                skillObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    skillBars.forEach(bar => skillObserver.observe(bar));

    // ---- Project Filtering ----
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projectItems = document.querySelectorAll('.project-item');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const filter = this.dataset.filter;

            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            projectItems.forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = '';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 50);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    // ---- Lightbox ----
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxClose = document.getElementById('lightbox-close');
    const lightboxPrev = document.getElementById('lightbox-prev');
    const lightboxNext = document.getElementById('lightbox-next');

    let currentImageIndex = 0;
    let imageList = [];

    document.querySelectorAll('[data-lightbox]').forEach((trigger, index) => {
        imageList.push(trigger.getAttribute('href'));

        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            currentImageIndex = imageList.indexOf(this.getAttribute('href'));
            showLightbox();
        });
    });

    function showLightbox() {
        if (lightbox && lightboxImage) {
            lightboxImage.src = imageList[currentImageIndex];
            lightbox.classList.add('show');
            lightbox.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }

    function hideLightbox() {
        if (lightbox) {
            lightbox.classList.remove('show');
            lightbox.style.display = 'none';
            document.body.style.overflow = '';
        }
    }

    function showNext() {
        currentImageIndex = (currentImageIndex + 1) % imageList.length;
        showLightbox();
    }

    function showPrev() {
        currentImageIndex = (currentImageIndex - 1 + imageList.length) % imageList.length;
        showLightbox();
    }

    if (lightboxClose) lightboxClose.addEventListener('click', hideLightbox);
    if (lightboxNext) lightboxNext.addEventListener('click', showNext);
    if (lightboxPrev) lightboxPrev.addEventListener('click', showPrev);

    if (lightbox) {
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) hideLightbox();
        });
    }

    document.addEventListener('keydown', function (e) {
        if (lightbox && lightbox.classList.contains('show')) {
            if (e.key === 'Escape') hideLightbox();
            if (e.key === 'ArrowRight') showNext();
            if (e.key === 'ArrowLeft') showPrev();
        }
    });

    // ---- Back to Top Button ----
    const backToTop = document.getElementById('back-to-top');
    if (backToTop) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 400) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        }, { passive: true });

        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ---- Smooth Scroll for Anchor Links ----
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#' || href === '#!') return;

            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const offset = 80;
                const targetPosition = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top: targetPosition, behavior: 'smooth' });

                // Close mobile navbar
                const navCollapse = document.querySelector('.navbar-collapse');
                if (navCollapse && navCollapse.classList.contains('show')) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navCollapse);
                    if (bsCollapse) bsCollapse.hide();
                }
            }
        });
    });

    // ---- Active Nav Link on Scroll ----
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.navbar-custom .nav-link');

    window.addEventListener('scroll', function () {
        const scrollPos = window.scrollY + 100;

        sections.forEach(section => {
            const top = section.offsetTop;
            const height = section.offsetHeight;
            const id = section.getAttribute('id');

            if (scrollPos >= top && scrollPos < top + height) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + id) {
                        link.classList.add('active');
                    }
                });
            }
        });
    }, { passive: true });

    // ---- Contact Form AJAX Submission ----
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';

            const formData = new FormData(contactForm);

            fetch(contactForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Message sent successfully! I\'ll get back to you soon.', 'success');
                    contactForm.reset();
                } else {
                    const errors = data.errors || {};
                    const firstError = Object.values(errors)[0];
                    showToast(firstError || 'Something went wrong. Please try again.', 'error');
                }
            })
            .catch(() => {
                showToast('Something went wrong. Please try again.', 'error');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }

    // ---- Toast Notifications ----
    window.showToast = function (message, type = 'success') {
        const toastContainer = document.getElementById('toast-container');
        if (!toastContainer) return;

        const toastId = 'toast-' + Date.now();
        const iconMap = {
            success: 'bi-check-circle-fill',
            error: 'bi-x-circle-fill',
            warning: 'bi-exclamation-triangle-fill',
            info: 'bi-info-circle-fill',
        };

        const colorMap = {
            success: 'text-success',
            error: 'text-danger',
            warning: 'text-warning',
            info: 'text-info',
        };

        const toastHTML = `
            <div id="${toastId}" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="bi ${iconMap[type]} ${colorMap[type]} me-2"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;

        toastContainer.insertAdjacentHTML('beforeend', toastHTML);
        const toastEl = document.getElementById(toastId);
        const bsToast = new bootstrap.Toast(toastEl, { delay: 5000 });
        bsToast.show();

        toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
    };

    // ---- Testimonials Carousel ----
    const testimonialCarousel = document.getElementById('testimonialCarousel');
    if (testimonialCarousel) {
        new bootstrap.Carousel(testimonialCarousel, {
            interval: 5000,
            ride: 'carousel',
            pause: 'hover',
        });
    }

    // ---- Project Cost Calculator ----
    const calcSection = document.getElementById('calculator');
    if (calcSection) {
        const projectTypeBtns = calcSection.querySelectorAll('.project-type-btn');
        const pageCountSlider = document.getElementById('page-count');
        const pageCountDisplay = document.getElementById('page-count-display');
        const featureCheckboxes = calcSection.querySelectorAll('.feature-checkbox');
        const totalCostEl = document.getElementById('total-cost');
        const resetBtn = document.getElementById('calc-reset-btn');
        const getQuoteBtn = document.getElementById('get-quote-btn');
        const breakdownType = document.getElementById('breakdown-type');
        const breakdownTypeCost = document.getElementById('breakdown-type-cost');
        const breakdownPagesText = document.getElementById('breakdown-pages-text');
        const breakdownPagesCost = document.getElementById('breakdown-pages-cost');
        const breakdownFeaturesRow = document.getElementById('breakdown-features-row');
        const breakdownFeaturesCost = document.getElementById('breakdown-features-cost');

        const PAGE_RATE = parseInt(pageCountSlider.dataset.perPage) || 10000;
        const INCLUDED_PAGES = parseInt(pageCountSlider.dataset.included) || 5;

        let currentType = projectTypeBtns[0].dataset.type;
        let currentBase = parseInt(projectTypeBtns[0].dataset.base) || 50000;
        let currentTypeName = projectTypeBtns[0].querySelector('span').textContent;

        function formatNaira(amount) {
            return '\u20a6' + amount.toLocaleString('en-US');
        }

        function calculateCost() {
            const pages = parseInt(pageCountSlider.value);
            const extraPages = Math.max(0, pages - INCLUDED_PAGES);
            const pagesCost = extraPages * PAGE_RATE;

            let featuresCost = 0;
            featureCheckboxes.forEach(cb => {
                if (cb.checked) featuresCost += parseInt(cb.dataset.cost);
            });

            const total = currentBase + pagesCost + featuresCost;
            totalCostEl.textContent = formatNaira(total);

            breakdownType.textContent = currentTypeName;
            breakdownTypeCost.textContent = formatNaira(currentBase);

            breakdownPagesText.textContent = extraPages > 0
                ? 'Extra Pages (' + extraPages + ')'
                : 'Extra Pages (0)';
            breakdownPagesCost.textContent = formatNaira(pagesCost);

            if (featuresCost > 0) {
                breakdownFeaturesRow.style.display = 'flex';
                breakdownFeaturesCost.textContent = formatNaira(featuresCost);
            } else {
                breakdownFeaturesRow.style.display = 'none';
            }
        }

        projectTypeBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                projectTypeBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentType = this.dataset.type;
                currentBase = parseInt(this.dataset.base);
                currentTypeName = this.querySelector('span').textContent;
                calculateCost();
            });
        });

        pageCountSlider.addEventListener('input', function () {
            pageCountDisplay.textContent = this.value;
            calculateCost();
        });

        featureCheckboxes.forEach(cb => {
            cb.addEventListener('change', calculateCost);
        });

        resetBtn.addEventListener('click', function () {
            projectTypeBtns.forEach(b => b.classList.remove('active'));
            projectTypeBtns[0].classList.add('active');
            currentType = projectTypeBtns[0].dataset.type;
            currentBase = parseInt(projectTypeBtns[0].dataset.base);
            currentTypeName = projectTypeBtns[0].querySelector('span').textContent;

            pageCountSlider.value = 1;
            pageCountDisplay.textContent = '1';

            featureCheckboxes.forEach(cb => cb.checked = false);

            calculateCost();

            if (window.showToast) {
                showToast('Calculator has been reset.', 'info');
            }
        });

        getQuoteBtn.addEventListener('click', function () {
            const pages = parseInt(pageCountSlider.value);
            const selectedFeatures = [];
            featureCheckboxes.forEach(cb => {
                if (cb.checked) {
                    selectedFeatures.push(cb.parentElement.textContent.trim());
                }
            });

            const subjectField = document.querySelector('#contact-form input[name="subject"]');
            const messageField = document.querySelector('#contact-form textarea[name="message"]');

            if (subjectField) {
                subjectField.value = 'Project Quote Request — ' + currentTypeName;
            }

            if (messageField) {
                let msg = 'Hi Abideen,\n\nI would like to get a quote for the following project:\n\n';
                msg += '• Project Type: ' + currentTypeName + '\n';
                msg += '• Number of Pages: ' + pages + '\n';
                if (selectedFeatures.length > 0) {
                    msg += '• Extra Features: ' + selectedFeatures.join(', ') + '\n';
                }
                msg += '• Estimated Budget: ' + totalCostEl.textContent + '\n\n';
                msg += 'Please get back to me with a detailed quote. Thank you!';
                messageField.value = msg;
            }

            const contactSection = document.getElementById('contact');
            if (contactSection) {
                const offset = 80;
                const targetPosition = contactSection.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top: targetPosition, behavior: 'smooth' });
            }

            if (window.showToast) {
                showToast('Quote details filled in the contact form below!', 'success');
            }
        });

        calculateCost();
    }
});
