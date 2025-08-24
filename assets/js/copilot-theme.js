/**
 * Copilot Theme JavaScript Initialization
 * Modern glassmorphism theme with enhanced interactivity
 */

$(document).ready(function() {
    // Initialize Copilot Theme
    initCopilotTheme();
    
    // Add Floating Action Button
    addFloatingActionButton();
    
    // Enhance existing elements
    enhanceElements();
    
    // Initialize smooth animations
    initAnimations();
});

function initCopilotTheme() {
    // Add copilot-theme class to body for automatic styling
    $('body').addClass('copilot-theme');
    
    // Add glass effect to cards
    $('.card, .bg-white, .profile-alumni, .profile-student, .profile-employees').addClass('copilot-glass');
    
    // Add copilot styling to buttons
    $('.btn, button').not('.copilot-fab').addClass('copilot-style');
    
    // Add copilot styling to inputs
    $('input, textarea, select').addClass('copilot-style');
    
    // Add copilot styling to thumbnails
    $('.thumbnail').addClass('copilot-style');
    
    console.log('Copilot Theme initialized successfully');
}

function addFloatingActionButton() {
    // Check if FAB already exists
    if ($('.copilot-fab').length > 0) return;
    
    // Create FAB HTML
    const fabHtml = `
        <button class="copilot-fab" id="copilotFAB" title="Quick Actions">
            <i class="fa fa-plus"></i>
        </button>
    `;
    
    // Add FAB to body
    $('body').append(fabHtml);
    
    // FAB click handler with rotation animation
    $('#copilotFAB').on('click', function() {
        const $this = $(this);
        const $icon = $this.find('i');
        
        // Rotate icon and change
        if ($icon.hasClass('fa-plus')) {
            $icon.removeClass('fa-plus').addClass('fa-times');
            $this.css('transform', 'scale(1.1) rotate(45deg)');
            showQuickActions();
        } else {
            $icon.removeClass('fa-times').addClass('fa-plus');
            $this.css('transform', 'scale(1.1) rotate(0deg)');
            hideQuickActions();
        }
    });
}

function showQuickActions() {
    // Remove existing quick actions
    $('.copilot-quick-actions').remove();
    
    // Create quick actions menu
    const quickActionsHtml = `
        <div class="copilot-quick-actions" style="
            position: fixed;
            bottom: 100px;
            right: 24px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            z-index: 999;
        ">
            <button class="copilot-quick-action" onclick="scrollToTop()" title="Scroll to Top">
                <i class="fa fa-arrow-up"></i>
            </button>
            <button class="copilot-quick-action" onclick="goBack()" title="Go Back">
                <i class="fa fa-arrow-left"></i>
            </button>
            <button class="copilot-quick-action" onclick="toggleDarkMode()" title="Toggle Theme">
                <i class="fa fa-moon-o"></i>
            </button>
        </div>
    `;
    
    $('body').append(quickActionsHtml);
    
    // Style quick action buttons
    $('.copilot-quick-action').css({
        'width': '48px',
        'height': '48px',
        'border-radius': '50%',
        'border': 'none',
        'background': 'linear-gradient(135deg, #1e40af 0%, #8b5cf6 100%)',
        'color': 'white',
        'display': 'flex',
        'align-items': 'center',
        'justify-content': 'center',
        'cursor': 'pointer',
        'box-shadow': '0 4px 20px rgba(30, 64, 175, 0.3)',
        'transition': 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)',
        'backdrop-filter': 'blur(10px)',
        'opacity': '0',
        'transform': 'scale(0.8) translateX(20px)'
    });
    
    // Animate in
    $('.copilot-quick-action').each(function(index) {
        const $this = $(this);
        setTimeout(() => {
            $this.css({
                'opacity': '1',
                'transform': 'scale(1) translateX(0)'
            });
        }, index * 100);
    });
    
    // Add hover effects
    $('.copilot-quick-action').hover(
        function() {
            $(this).css({
                'transform': 'scale(1.1)',
                'box-shadow': '0 8px 30px rgba(30, 64, 175, 0.5)'
            });
        },
        function() {
            $(this).css({
                'transform': 'scale(1)',
                'box-shadow': '0 4px 20px rgba(30, 64, 175, 0.3)'
            });
        }
    );
}

function hideQuickActions() {
    $('.copilot-quick-actions').fadeOut(200, function() {
        $(this).remove();
    });
}

function enhanceElements() {
    // Add hover effects to cards
    $('.card, .bg-white').on('mouseenter', function() {
        $(this).addClass('copilot-loading');
    }).on('mouseleave', function() {
        $(this).removeClass('copilot-loading');
    });
    
    // Enhance menu items
    $('.menu-link, .menu-item > a').wrap('<div class="copilot-nav"></div>');
    
    // Add gradient text to headings
    $('h1, h2, h3').addClass('copilot-gradient-text');
}

function initAnimations() {
    // Intersection Observer for animations
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });
        
        // Observe cards for animation
        $('.card, .bg-white').each(function() {
            this.style.opacity = '0';
            this.style.transform = 'translateY(20px)';
            this.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(this);
        });
    }
}

// Utility functions for FAB actions
function scrollToTop() {
    $('html, body').animate({ scrollTop: 0 }, 600);
}

function goBack() {
    if (document.referrer) {
        window.history.back();
    } else {
        window.location.href = '/';
    }
}

function toggleDarkMode() {
    $('body').toggleClass('dark-mode');
    
    if ($('body').hasClass('dark-mode')) {
        // Apply dark mode styles
        $('body').css({
            'background': 'linear-gradient(135deg, #1a1a2e 0%, #16213e 100%)',
            'color': '#e2e8f0'
        });
        
        $('.copilot-card, .card, .bg-white').css({
            'background': 'rgba(30, 41, 59, 0.8) !important',
            'color': '#e2e8f0'
        });
    } else {
        // Remove dark mode styles
        $('body').css({
            'background': '',
            'color': ''
        });
        
        $('.copilot-card, .card, .bg-white').css({
            'background': '',
            'color': ''
        });
    }
    
    // Show toast notification
    if (typeof toastr !== 'undefined') {
        const mode = $('body').hasClass('dark-mode') ? 'Dark' : 'Light';
        toastr.info(`Switched to ${mode} mode`);
    }
}

// Enhanced form interactions
$(document).on('focus', 'input.copilot-style, textarea.copilot-style, select.copilot-style', function() {
    $(this).parent().addClass('copilot-focus');
});

$(document).on('blur', 'input.copilot-style, textarea.copilot-style, select.copilot-style', function() {
    $(this).parent().removeClass('copilot-focus');
});

// Smooth scroll for internal links
$(document).on('click', 'a[href^="#"]', function(e) {
    const target = $(this.getAttribute('href'));
    if (target.length) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: target.offset().top - 80
        }, 600);
    }
});

// Preloader enhancement
$(window).on('load', function() {
    $('.preloader').addClass('copilot-loading');
    setTimeout(() => {
        $('.preloader').fadeOut(1000);
    }, 500);
});