// Enhanced Mobile Navigation with Accessibility and Smooth Interactions
document.addEventListener('DOMContentLoaded', function() {
    
    // Mobile Menu Enhancement
    const menuButton = document.querySelector('.menu-button');
    const menu = document.querySelector('.menu');
    const body = document.querySelector('body');
    const backdrop = document.querySelector('.backdrop');
    const hasDropdownMenuItems = document.querySelectorAll('.has-submenu > .menu-link');
    
    if (menuButton && menu) {
        
        // Enhanced menu toggle with accessibility
        function toggleMenu(open = null) {
            const isOpen = open !== null ? open : !menu.classList.contains('is-open');
            const menuButtonIcon = menuButton.querySelector('.fa');
            
            // Update button state
            menuButton.setAttribute('aria-expanded', isOpen);
            menuButton.classList.toggle('text-white', !isOpen);
            
            // Update icon with smooth animation
            if (isOpen) {
                menuButtonIcon.classList.remove('fa-bars');
                menuButtonIcon.classList.add('fa-times');
            } else {
                menuButtonIcon.classList.remove('fa-times');
                menuButtonIcon.classList.add('fa-bars');
            }
            
            // Update menu and body state
            menu.classList.toggle('is-open', isOpen);
            body.classList.toggle('is-disabled', isOpen);
            
            // Focus management for accessibility
            if (isOpen) {
                menu.querySelector('.menu-link')?.focus();
            } else {
                menuButton.focus();
            }
        }
        
        // Menu button click handler
        menuButton.addEventListener('click', () => toggleMenu());
        
        // Backdrop click handler
        backdrop?.addEventListener('click', () => toggleMenu(false));
        
        // Keyboard support for menu button
        menuButton.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleMenu();
            } else if (e.key === 'Escape') {
                toggleMenu(false);
            }
        });
        
        // Backdrop keyboard support
        backdrop?.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleMenu(false);
            }
        });
        
        // Enhanced dropdown menu handling
        hasDropdownMenuItems.forEach(function(menuItem) {
            const parentLi = menuItem.parentNode;
            const dropdown = parentLi.querySelector('.menu-dropdown');
            
            // Click handler
            menuItem.addEventListener('click', function(event) {
                event.preventDefault();
                const isOpen = dropdown.classList.contains('is-open');
                
                // Close all other dropdowns
                hasDropdownMenuItems.forEach(function(otherItem) {
                    const otherParent = otherItem.parentNode;
                    const otherDropdown = otherParent.querySelector('.menu-dropdown');
                    if (otherDropdown !== dropdown) {
                        otherDropdown.classList.remove('is-open');
                        otherItem.setAttribute('aria-expanded', 'false');
                    }
                });
                
                // Toggle current dropdown
                dropdown.classList.toggle('is-open', !isOpen);
                menuItem.setAttribute('aria-expanded', !isOpen);
                
                // Focus first dropdown item when opened
                if (!isOpen) {
                    dropdown.querySelector('a')?.focus();
                }
            });
            
            // Keyboard navigation for dropdowns
            menuItem.addEventListener('keydown', function(e) {
                const isOpen = dropdown.classList.contains('is-open');
                
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    menuItem.click();
                } else if (e.key === 'ArrowDown' && isOpen) {
                    e.preventDefault();
                    dropdown.querySelector('a')?.focus();
                } else if (e.key === 'Escape') {
                    dropdown.classList.remove('is-open');
                    menuItem.setAttribute('aria-expanded', 'false');
                    menuItem.focus();
                }
            });
            
            // Keyboard navigation within dropdown
            const dropdownLinks = dropdown.querySelectorAll('a');
            dropdownLinks.forEach(function(link, index) {
                link.addEventListener('keydown', function(e) {
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        const nextLink = dropdownLinks[index + 1];
                        if (nextLink) {
                            nextLink.focus();
                        }
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        if (index === 0) {
                            menuItem.focus();
                        } else {
                            dropdownLinks[index - 1].focus();
                        }
                    } else if (e.key === 'Escape') {
                        dropdown.classList.remove('is-open');
                        menuItem.setAttribute('aria-expanded', 'false');
                        menuItem.focus();
                    }
                });
            });
        });
        
        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && menu.classList.contains('is-open')) {
                toggleMenu(false);
            }
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menu.contains(e.target) && !menuButton.contains(e.target) && menu.classList.contains('is-open')) {
                toggleMenu(false);
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024 && menu.classList.contains('is-open')) {
                toggleMenu(false);
            }
        });
    }
    
    // Smooth scrolling for internal links
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    // Close mobile menu if open
                    if (menu && menu.classList.contains('is-open')) {
                        toggleMenu(false);
                    }
                }
            }
        });
    });
    
    // Enhanced form accessibility
    document.querySelectorAll('.form-group').forEach(function(group) {
        const input = group.querySelector('input, textarea, select');
        const label = group.querySelector('label');
        
        if (input && label) {
            // Generate unique ID if not present
            if (!input.id) {
                input.id = 'field-' + Math.random().toString(36).substr(2, 9);
            }
            label.setAttribute('for', input.id);
        }
    });
    
    // Intersection Observer for animations
    if ('IntersectionObserver' in window) {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        // Observe cards and content sections
        document.querySelectorAll('.card, .profile-alumni, .profile-student, .profile-employees, .bg-white').forEach(function(el) {
            observer.observe(el);
        });
    }
    
    // Performance optimization: Lazy load images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(function(img) {
            imageObserver.observe(img);
        });
    }
    
});