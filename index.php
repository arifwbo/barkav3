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
    
    // Modern page transition effects
    document.addEventListener('DOMContentLoaded', function() {
      // Add smooth entrance animation to main content
      const mainContent = document.querySelector('main');
      if (mainContent) {
        mainContent.style.opacity = '0';
        mainContent.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
          mainContent.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
          mainContent.style.opacity = '1';
          mainContent.style.transform = 'translateY(0)';
        }, 100);
      }
      
      // Enhance navigation links with page transition hint
      document.querySelectorAll('a[href]').forEach(link => {
        if (link.hostname === window.location.hostname && !link.hash) {
          link.addEventListener('click', function(e) {
            const href = this.href;
            if (href && href !== window.location.href) {
              // Add subtle loading feedback
              this.style.opacity = '0.7';
              setTimeout(() => {
                if (this.style) this.style.opacity = '1';
              }, 300);
            }
          });
        }
      });
    });
  </script>

</body>
</html>
