document.addEventListener('DOMContentLoaded', () => {
    const prefersReducedMotion = window.matchMedia ? window.matchMedia('(prefers-reduced-motion: reduce)') : null;
    const isReducedMotion = () => (prefersReducedMotion ? prefersReducedMotion.matches : false);

    const mainToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.primary-nav');

    if (mainToggle && mainNav) {
        mainToggle.addEventListener('click', () => {
            const expanded = mainToggle.getAttribute('aria-expanded') === 'true';
            mainToggle.setAttribute('aria-expanded', (!expanded).toString());
            mainNav.classList.toggle('is-open', !expanded);
        });
    }

    const externalToggle = document.querySelector('.external-links-toggle');
    const externalPanel = document.querySelector('#external-links-panel');

    if (externalToggle && externalPanel) {
        const closeButtons = externalPanel.querySelectorAll('[data-panel-close]');
        const menuLinks = externalPanel.querySelectorAll('.external-links-menu a');

        const closeExternalPanel = (options = { focusToggle: true }) => {
            externalToggle.setAttribute('aria-expanded', 'false');
            externalPanel.classList.remove('is-open');
            externalPanel.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('external-links-panel-open');

            if (options.focusToggle) {
                externalToggle.focus();
            }
        };

        const openExternalPanel = () => {
            externalToggle.setAttribute('aria-expanded', 'true');
            externalPanel.classList.add('is-open');
            externalPanel.setAttribute('aria-hidden', 'false');
            document.body.classList.add('external-links-panel-open');

            const focusTarget = externalPanel.querySelector('.external-links-panel__close');
            if (focusTarget) {
                focusTarget.focus();
            }
        };

        externalToggle.addEventListener('click', () => {
            const expanded = externalToggle.getAttribute('aria-expanded') === 'true';
            if (expanded) {
                closeExternalPanel();
            } else {
                openExternalPanel();
            }
        });

        closeButtons.forEach((button) => {
            button.addEventListener('click', () => {
                closeExternalPanel();
            });
        });

        menuLinks.forEach((link) => {
            link.addEventListener('click', () => {
                closeExternalPanel({ focusToggle: false });
            });
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && externalPanel.classList.contains('is-open')) {
                event.preventDefault();
                closeExternalPanel();
            }
        });
    }

    const heroSection = document.querySelector('[data-hero]');
    const heroSlider = heroSection ? heroSection.querySelector('[data-hero-slider]') : null;
    const heroDotsContainer = heroSection ? heroSection.querySelector('[data-hero-dots]') : null;

    if (heroSlider) {
        const slides = Array.from(heroSlider.querySelectorAll('[data-hero-slide]'));
        const dots = heroDotsContainer
            ? Array.from(heroDotsContainer.querySelectorAll('[data-hero-dot]'))
            : [];
        const totalSlides = slides.length;
        const AUTOPLAY_DELAY = 7000;
        let activeIndex = slides.findIndex((slide) => slide.classList.contains('is-active'));
        let autoplayId = null;

        if (activeIndex < 0) {
            activeIndex = 0;
        }

        const setActiveSlide = (index) => {
            slides.forEach((slide, slideIndex) => {
                slide.classList.toggle('is-active', slideIndex === index);
            });

            dots.forEach((dot, dotIndex) => {
                const isActive = dotIndex === index;
                dot.classList.toggle('is-active', isActive);
                dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
            });

            activeIndex = index;
        };

        const goToNextSlide = () => {
            const nextIndex = (activeIndex + 1) % totalSlides;
            setActiveSlide(nextIndex);
        };

        const stopAutoplay = () => {
            if (autoplayId) {
                window.clearInterval(autoplayId);
                autoplayId = null;
            }
        };

        const startAutoplay = () => {
            if (totalSlides <= 1 || isReducedMotion()) {
                return;
            }
            stopAutoplay();
            autoplayId = window.setInterval(goToNextSlide, AUTOPLAY_DELAY);
        };

        dots.forEach((dot) => {
            dot.addEventListener('click', () => {
                const targetIndex = Number(dot.getAttribute('data-hero-dot'));
                if (Number.isNaN(targetIndex) || targetIndex === activeIndex) {
                    return;
                }
                setActiveSlide(targetIndex);
                startAutoplay();
            });
        });

        const interactiveArea = heroSection || heroSlider;

        if (interactiveArea) {
            interactiveArea.addEventListener('mouseenter', stopAutoplay);
            interactiveArea.addEventListener('mouseleave', startAutoplay);
        }

        if (heroDotsContainer) {
            heroDotsContainer.addEventListener('focusin', stopAutoplay);
            heroDotsContainer.addEventListener('focusout', startAutoplay);
        }

        const handleMotionPreference = () => {
            if (isReducedMotion()) {
                stopAutoplay();
            } else {
                startAutoplay();
            }
        };

        if (prefersReducedMotion) {
            if (typeof prefersReducedMotion.addEventListener === 'function') {
                prefersReducedMotion.addEventListener('change', handleMotionPreference);
            } else if (typeof prefersReducedMotion.addListener === 'function') {
                prefersReducedMotion.addListener(handleMotionPreference);
            }
        }

        setActiveSlide(activeIndex);
        handleMotionPreference();
    }

    const tourSliders = document.querySelectorAll('[data-tour-slider]');

    tourSliders.forEach((slider) => {
        const slides = Array.from(slider.querySelectorAll('[data-tour-slide]'));
        if (!slides.length) {
            return;
        }

        const thumbs = Array.from(slider.querySelectorAll('[data-tour-thumb]'));
        const prevButton = slider.querySelector('[data-tour-nav="prev"]');
        const nextButton = slider.querySelector('[data-tour-nav="next"]');
        let activeIndex = slides.findIndex((slide) => slide.classList.contains('is-active'));

        if (activeIndex < 0) {
            activeIndex = 0;
        }

        const setActiveSlide = (index) => {
            slides.forEach((slide, slideIndex) => {
                slide.classList.toggle('is-active', slideIndex === index);
            });

            thumbs.forEach((thumb, thumbIndex) => {
                const isActive = thumbIndex === index;
                thumb.classList.toggle('is-active', isActive);
                thumb.setAttribute('aria-selected', isActive ? 'true' : 'false');
            });

            activeIndex = index;
        };

        const moveSlide = (offset) => {
            const total = slides.length;
            if (total <= 1) {
                return;
            }

            const nextIndex = (activeIndex + offset + total) % total;
            setActiveSlide(nextIndex);
        };

        if (prevButton) {
            prevButton.addEventListener('click', () => {
                moveSlide(-1);
            });
        }

        if (nextButton) {
            nextButton.addEventListener('click', () => {
                moveSlide(1);
            });
        }

        thumbs.forEach((thumb) => {
            thumb.addEventListener('click', () => {
                const targetIndex = Number(thumb.getAttribute('data-tour-thumb'));
                if (Number.isNaN(targetIndex) || targetIndex === activeIndex) {
                    return;
                }
                setActiveSlide(targetIndex);
            });
        });

        setActiveSlide(activeIndex);
    });

    const setupSectionSpy = () => {
        const nav = document.querySelector('.primary-nav');
        if (!nav) {
            return;
        }

        const normalizePath = (path) => {
            const trimmed = path.replace(/\/+$/, '');
            return trimmed === '' ? '/' : trimmed;
        };

        const currentPath = normalizePath(window.location.pathname);
        const links = Array.from(nav.querySelectorAll('a[href]'));
        const anchors = links
            .map((link) => {
                const href = link.getAttribute('href');
                if (!href) {
                    return null;
                }

                const url = new URL(href, window.location.href);
                if (!url.hash || url.hash === '#') {
                    return null;
                }

                if (normalizePath(url.pathname) !== currentPath) {
                    return null;
                }

                const targetId = decodeURIComponent(url.hash.slice(1));
                if (!targetId) {
                    return null;
                }

                const section = document.getElementById(targetId);
                if (!section) {
                    return null;
                }

                return {
                    link,
                    item: link.closest('li') || link,
                    section,
                };
            })
            .filter(Boolean);

        if (!anchors.length) {
            return;
        }

        anchors.forEach(({ item }) => {
            item.classList.remove('current-menu-item');
            item.classList.remove('current-menu-ancestor');
            item.classList.remove('current-menu-parent');
        });

        let activeEntry = null;

        const setActiveEntry = (entry) => {
            if (activeEntry === entry) {
                return;
            }

            anchors.forEach(({ item, link }) => {
                item.classList.remove('is-active');
                link.classList.remove('is-active');
            });

            if (entry) {
                entry.item.classList.add('is-active');
                entry.link.classList.add('is-active');
            }

            activeEntry = entry;
        };

        const updateActiveEntry = () => {
            const focusLine = Math.max(120, window.innerHeight * 0.35);
            let nextEntry = null;

            anchors.forEach((entry) => {
                const rect = entry.section.getBoundingClientRect();
                if (rect.top <= focusLine && rect.bottom >= focusLine) {
                    nextEntry = entry;
                }
            });

            setActiveEntry(nextEntry);
        };

        let ticking = false;
        const requestUpdate = () => {
            if (ticking) {
                return;
            }
            ticking = true;
            window.requestAnimationFrame(() => {
                updateActiveEntry();
                ticking = false;
            });
        };

        window.addEventListener('scroll', requestUpdate, { passive: true });
        window.addEventListener('resize', requestUpdate);
        window.addEventListener('hashchange', requestUpdate);
        updateActiveEntry();
    };

    setupSectionSpy();
});
