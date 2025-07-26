<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<?php defined('THEME_PATH') or define('THEME_PATH', 'themes/barka/') ?>
<?php defined('THEME_VERSION') or define('THEME_VERSION', 'v1.5.1') ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <?php $this->load->view(THEME_PATH . 'components/meta') ?>
  <?php $this->load->view(THEME_PATH . 'components/source_css') ?>

  <script type="text/javascript">
  const _BASE_URL = '<?= base_url() ?>';
  const _CURRENT_URL = '<?=current_url() ?>';
  const _SCHOOL_LEVEL = '<?= __session('school_level') ?>';
  const _ACADEMIC_YEAR = '<?= __session('_academic_year') ?>';
  const _STUDENT = '<?= __session('_student') ?>';
  const _IDENTITY_NUMBER = '<?= __session('_identity_number') ?>';
  const _EMPLOYEE = '<?= __session('_employee') ?>';
  const _HEADMASTER = '<?= __session('_headmaster') ?>';
  const _MAJOR = '<?= __session('_major') ?>';
  const _SUBJECT = '<?= __session('_subject') ?>';
  const _RECAPTCHA_STATUS = '<?=(NULL !== __session('recaptcha_status') && __session('recaptcha_status') == 'enable') ? 'true': 'false' ?>'=='true';
  </script>

  <?php $this->load->view(THEME_PATH . 'components/source_js') ?>
  <noscript>You need to enable javaScript to run this app.</noscript>
</head>
<body class="flex flex-col min-h-screen">
  <div class="secondary-color preloader">
    <div class="preloader-inner">
      <div class="modern-spinner">
        <div class="spinner-ring"></div>
      </div>
    </div>
  </div>
  
  <!-- Dark Mode Toggle -->
  <button class="dark-mode-toggle tooltip" onclick="toggleDarkMode()" title="Toggle Dark Mode">
    <i class="fa fa-moon-o"></i>
    <span class="tooltip-text">Dark Mode</span>
  </button>
  
  <!-- Floating Action Button -->
  <button class="fab animate-float tooltip" onclick="scrollToTop()" title="Back to Top">
    <i class="fa fa-arrow-up"></i>
    <span class="tooltip-text">Back to Top</span>
  </button>
  
  <?php $this->load->view(THEME_PATH . 'components/header') ?>

  <?php $this->load->view($content) ?>

  <!-- COPYRIGHT - DO NOT MODIFY!-->
    <?php $this->load->view(THEME_PATH . 'components/footer') ?>
  <!-- END COPYRIGHT -->

  <script>
    $(window).on('load', function() {
      $('.preloader').fadeOut(1200);
      
      // Enhanced fade-in animation with stagger effect
      const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -30px 0px'
      };
      
      const observer = new IntersectionObserver(function(entries) {
        entries.forEach((entry, index) => {
          if (entry.isIntersecting) {
            setTimeout(() => {
              entry.target.classList.add('animate-fade-in');
            }, index * 100); // Stagger animation
          }
        });
      }, observerOptions);
      
      // Observe all cards and important elements
      document.querySelectorAll('.card, .profile-alumni, .profile-student, .profile-employees, .bg-white, .sidebar').forEach(el => {
        observer.observe(el);
      });
      
      // Add hover effects for better elegance
      $('.card, .profile-alumni, .profile-student, .profile-employees, .bg-white').hover(
        function() {
          $(this).find('img').css('transform', 'scale(1.05)');
        },
        function() {
          $(this).find('img').css('transform', 'scale(1)');
        }
      );
    });
    
    // Enhanced Dark Mode Toggle Function
    function toggleDarkMode() {
      const body = document.body;
      const isDark = body.getAttribute('data-theme') === 'dark';
      const icon = document.querySelector('.dark-mode-toggle i');
      
      // Add transition class for smooth theme change
      body.style.transition = 'background 0.5s ease, color 0.5s ease';
      
      if (isDark) {
        body.removeAttribute('data-theme');
        icon.className = 'fa fa-moon-o';
        localStorage.setItem('theme', 'light');
      } else {
        body.setAttribute('data-theme', 'dark');
        icon.className = 'fa fa-sun-o';
        localStorage.setItem('theme', 'dark');
      }
      
      // Remove transition after animation
      setTimeout(() => {
        body.style.transition = '';
      }, 500);
    }
    
    // Enhanced Scroll to Top Function
    function scrollToTop() {
      const fab = document.querySelector('.fab');
      fab.style.transform = 'scale(0.9)';
      
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
      
      setTimeout(() => {
        fab.style.transform = 'scale(1)';
      }, 200);
    }
    
    // Enhanced Document Ready Functions
    $(document).ready(function() {
      // Load saved theme preference
      const savedTheme = localStorage.getItem('theme');
      if (savedTheme === 'dark') {
        document.body.setAttribute('data-theme', 'dark');
        document.querySelector('.dark-mode-toggle i').className = 'fa fa-sun-o';
      }
      
      // Enhanced FAB behavior
      let fabTimeout;
      $(window).scroll(function() {
        const scrollTop = $(this).scrollTop();
        
        if (scrollTop > 300) {
          $('.fab').addClass('animate-float').fadeIn(300);
        } else {
          $('.fab').removeClass('animate-float').fadeOut(300);
        }
        
        // Auto-hide dark mode toggle when scrolling
        $('.dark-mode-toggle').css('opacity', scrollTop > 100 ? '0.7' : '1');
      });
      
      // Enhanced menu interactions for mobile
      $('.menu-button').click(function() {
        $(this).find('span').toggleClass('fa-bars fa-times');
        $(this).toggleClass('rotate-180');
      });
      
      // Smooth scroll for internal links
      $('a[href^="#"]').click(function(e) {
        e.preventDefault();
        const target = $(this.getAttribute('href'));
        if (target.length) {
          $('html, body').animate({
            scrollTop: target.offset().top - 100
          }, 800);
        }
      });
      
      // Enhanced form interactions
      $('input, textarea, select').focus(function() {
        $(this).parent().addClass('focused');
      }).blur(function() {
        $(this).parent().removeClass('focused');
      });
      
      // Add ripple effect to buttons
      $('.btn, button').click(function(e) {
        const button = $(this);
        const ripple = $('<span class="ripple"></span>');
        
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.css({
          position: 'absolute',
          width: size + 'px',
          height: size + 'px',
          left: x + 'px',
          top: y + 'px',
          background: 'rgba(255,255,255,0.3)',
          borderRadius: '50%',
          transform: 'scale(0)',
          animation: 'ripple 0.6s linear',
          pointerEvents: 'none'
        });
        
        button.append(ripple);
        
        setTimeout(() => {
          ripple.remove();
        }, 600);
      });
      
      // Enhanced mobile menu animation
      $('.menu-item.has-submenu > a').click(function(e) {
        if ($(window).width() < 1024) {
          e.preventDefault();
          const submenu = $(this).siblings('.menu-dropdown');
          const icon = $(this).find('.menu-icon');
          
          submenu.slideToggle(300);
          icon.toggleClass('fa-chevron-down fa-chevron-up');
        }
      });
    });
    
    // Add CSS for ripple effect
    $('<style>')
      .prop('type', 'text/css')
      .html(`
        @keyframes ripple {
          to {
            transform: scale(4);
            opacity: 0;
          }
        }
        .form-group.focused input,
        .form-group.focused textarea {
          border-color: var(--primary-color) !important;
          box-shadow: 0 0 0 3px rgba(14,165,233,0.1) !important;
        }
        .menu-button {
          transition: transform 0.3s ease;
        }
        .menu-button.rotate-180 {
          transform: rotate(180deg);
        }
      `)
      .appendTo('head');
  </script>

</body>
</html>
