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
      $('.preloader').fadeOut(1000);
      
      // Add fade-in animation to elements as they come into view
      const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      };
      
      const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('animate-fade-in');
          }
        });
      }, observerOptions);
      
      // Observe all cards and important elements
      document.querySelectorAll('.card, .profile-alumni, .profile-student, .profile-employees, .bg-white').forEach(el => {
        observer.observe(el);
      });
    });
    
    // Dark Mode Toggle Function
    function toggleDarkMode() {
      const body = document.body;
      const isDark = body.getAttribute('data-theme') === 'dark';
      const icon = document.querySelector('.dark-mode-toggle i');
      
      if (isDark) {
        body.removeAttribute('data-theme');
        icon.className = 'fa fa-moon-o';
        localStorage.setItem('theme', 'light');
      } else {
        body.setAttribute('data-theme', 'dark');
        icon.className = 'fa fa-sun-o';
        localStorage.setItem('theme', 'dark');
      }
    }
    
    // Scroll to Top Function
    function scrollToTop() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    }
    
    // Load saved theme preference
    $(document).ready(function() {
      const savedTheme = localStorage.getItem('theme');
      if (savedTheme === 'dark') {
        document.body.setAttribute('data-theme', 'dark');
        document.querySelector('.dark-mode-toggle i').className = 'fa fa-sun-o';
      }
      
      // Show/hide FAB based on scroll position
      $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
          $('.fab').fadeIn();
        } else {
          $('.fab').fadeOut();
        }
      });
    });
  </script>

</body>
</html>
