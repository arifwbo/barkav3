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
  <!-- Dark Mode Toggle -->
  <button class="dark-mode-toggle" onclick="toggleDarkMode()" title="Toggle Dark/Light Mode">
    <i class="fa fa-moon-o dark-icon"></i>
    <i class="fa fa-sun-o light-icon" style="display: none;"></i>
  </button>

  <div class="secondary-color preloader">
    <div class="preloader-inner">
      <div class="preloader-icon">
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <?php $this->load->view(THEME_PATH . 'components/header') ?>

  <?php $this->load->view($content) ?>

  <!-- COPYRIGHT - DO NOT MODIFY!-->
    <?php $this->load->view(THEME_PATH . 'components/footer') ?>
  <!-- END COPYRIGHT -->

  <script>
    $(window).on('load', function() {
      $('.preloader').fadeOut(1000);
    });

    // Dark mode functionality
    function toggleDarkMode() {
      const body = document.body;
      const darkIcon = document.querySelector('.dark-icon');
      const lightIcon = document.querySelector('.light-icon');
      
      body.classList.toggle('dark-mode');
      
      if (body.classList.contains('dark-mode')) {
        darkIcon.style.display = 'none';
        lightIcon.style.display = 'inline';
        localStorage.setItem('darkMode', 'enabled');
      } else {
        darkIcon.style.display = 'inline';
        lightIcon.style.display = 'none';
        localStorage.setItem('darkMode', 'disabled');
      }
    }

    // Check for saved dark mode preference or default to light mode
    document.addEventListener('DOMContentLoaded', function() {
      const darkMode = localStorage.getItem('darkMode');
      if (darkMode === 'enabled') {
        document.body.classList.add('dark-mode');
        document.querySelector('.dark-icon').style.display = 'none';
        document.querySelector('.light-icon').style.display = 'inline';
      }
    });

    // Add fade-in animation to main content
    $(document).ready(function() {
      $('main').addClass('animate-fade-in');
      $('.card, .profile-alumni, .profile-student, .profile-employees').each(function(index) {
        $(this).addClass('animate-fade-in').css('animation-delay', (index * 0.1) + 's');
      });
    });
  </script>

</body>
</html>
