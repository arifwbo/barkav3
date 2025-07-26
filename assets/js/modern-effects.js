/**
 * SMPN 4 Samarinda - Modern Dark Blue Theme
 * JavaScript Effects and Interactions
 * 
 * Features:
 * - Ripple effect on button clicks
 * - Fade-in animations on scroll
 * - Floating action button with pulse effect
 * - Card hover effects
 * - Smooth scrolling
 */

(function() {
    'use strict';

    // === RIPPLE EFFECT FOR BUTTONS ===
    function createRippleEffect() {
        const buttons = document.querySelectorAll('.btn, button, .bg-secondary');
        
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Add ripple class
                this.classList.add('ripple');
                
                // Remove class after animation
                setTimeout(() => {
                    this.classList.remove('ripple');
                }, 600);
            });
        });
    }

    // === FADE-IN ON SCROLL ANIMATION ===
    function initScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    // Add staggered animation delay for multiple cards
                    const delay = Array.from(entry.target.parentElement.children)
                        .indexOf(entry.target) * 100;
                    entry.target.style.transitionDelay = `${delay}ms`;
                }
            });
        }, observerOptions);

        // Target cards and other elements for animation
        const animatedElements = document.querySelectorAll(
            '.card, .profile-alumni, .profile-student, .profile-employees, .bg-white'
        );
        
        animatedElements.forEach(el => {
            el.classList.add('fade-in-on-scroll');
            observer.observe(el);
        });
    }

    // === FLOATING ACTION BUTTON ===
    function createFloatingActionButton() {
        // Check if FAB already exists
        if (document.querySelector('.fab')) return;

        const fab = document.createElement('button');
        fab.className = 'fab';
        fab.innerHTML = '<i class="fa fa-arrow-up" aria-label="Kembali ke atas"></i>';
        fab.title = 'Kembali ke atas';
        
        // Initially hide FAB
        fab.style.transform = 'translateY(100px)';
        fab.style.opacity = '0';
        
        document.body.appendChild(fab);

        // Show/hide FAB based on scroll position
        let isVisible = false;
        window.addEventListener('scroll', () => {
            const shouldShow = window.scrollY > 300;
            
            if (shouldShow && !isVisible) {
                fab.style.transform = 'translateY(0)';
                fab.style.opacity = '1';
                isVisible = true;
            } else if (!shouldShow && isVisible) {
                fab.style.transform = 'translateY(100px)';
                fab.style.opacity = '0';
                isVisible = false;
            }
        });

        // Smooth scroll to top
        fab.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // === SMOOTH SCROLLING FOR ANCHOR LINKS ===
    function initSmoothScrolling() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // === ENHANCED CARD INTERACTIONS ===
    function enhanceCardInteractions() {
        const cards = document.querySelectorAll('.card, .profile-alumni, .profile-student, .profile-employees');
        
        cards.forEach(card => {
            // Add subtle tilt effect on mouse move
            card.addEventListener('mousemove', function(e) {
                if (window.innerWidth > 768) { // Only on desktop
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = (y - centerY) / 20;
                    const rotateY = (centerX - x) / 20;
                    
                    this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-2px)`;
                }
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });
    }

    // === NAVIGATION ENHANCEMENTS ===
    function enhanceNavigation() {
        const navLinks = document.querySelectorAll('.menu-link, .menu-item > a');
        
        navLinks.forEach(link => {
            // Add active state based on current page
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });
    }

    // === LOADING ANIMATIONS ===
    function initLoadingAnimations() {
        // Add staggered animation to initially visible cards
        const initialCards = document.querySelectorAll('.card, .bg-white');
        initialCards.forEach((card, index) => {
            if (isElementInViewport(card)) {
                setTimeout(() => {
                    card.classList.add('animate-fade-in');
                }, index * 100);
            }
        });

        // Animate hero content
        const heroContent = document.querySelector('.hero-content');
        if (heroContent) {
            heroContent.classList.add('hero-content');
        }
    }

    // === UTILITY FUNCTIONS ===
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // === ACCESSIBILITY ENHANCEMENTS ===
    function enhanceAccessibility() {
        // Add keyboard navigation for custom elements
        const interactiveElements = document.querySelectorAll('.fab, .card');
        
        interactiveElements.forEach(element => {
            if (!element.getAttribute('tabindex') && element.tagName !== 'BUTTON' && element.tagName !== 'A') {
                element.setAttribute('tabindex', '0');
            }
            
            // Add keyboard event listeners
            element.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });
    }

    // === PERFORMANCE OPTIMIZATIONS ===
    function optimizePerformance() {
        // Debounce scroll events
        let scrollTimeout;
        const originalScrollHandler = window.onscroll;
        
        window.addEventListener('scroll', () => {
            if (scrollTimeout) {
                clearTimeout(scrollTimeout);
            }
            scrollTimeout = setTimeout(() => {
                if (originalScrollHandler) originalScrollHandler();
            }, 16); // ~60fps
        });
    }

    // === THEME INITIALIZATION ===
    function initModernTheme() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initModernTheme);
            return;
        }

        try {
            createRippleEffect();
            initScrollAnimations();
            createFloatingActionButton();
            initSmoothScrolling();
            enhanceCardInteractions();
            enhanceNavigation();
            initLoadingAnimations();
            enhanceAccessibility();
            optimizePerformance();
            
            console.log('🎨 SMPN 4 Samarinda Modern Theme Initialized');
        } catch (error) {
            console.warn('Theme initialization warning:', error);
        }
    }

    // === AUTO-INITIALIZE ===
    initModernTheme();

    // === EXPOSE PUBLIC API ===
    window.SMPN4Theme = {
        init: initModernTheme,
        createRipple: createRippleEffect,
        initAnimations: initScrollAnimations
    };

})();