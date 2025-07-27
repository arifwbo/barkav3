<style type="text/css">
.mapouter {
  position:relative;
  text-align:right;
}
.gmap_canvas {
  overflow:hidden;
  background:none!important;
}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<main class="container space-y-5 my-5 flex-1">
  <div class="flex flex-col lg:flex-row items-start gap-x-6 relative space-y-5 lg:space-y-0">
    <section class="w-full lg:w-2/3 space-y-4">
      <h1 class="font-heading text-2xl capitalize font-black text-title"><span class="fa fa-phone"></span> <?= ucwords($page_title) ?></h1>
      <div class="card modern-shadow animate-fade-in">
        <div class="gmap_canvas">
          <?= __session('map_location') ?>
        </div>
      </div>
      <form action="" method="post" class="space-y-6">
        <div class="form-group">
          <input type="text" class="form-input w-full" id="comment_author" name="comment_author" placeholder=" " required>
          <label for="comment_author">Nama Lengkap <span style="color: red">*</span></label>
        </div>
        
        <div class="form-group">
          <input type="email" class="form-input w-full" id="comment_email" name="comment_email" placeholder=" " required>
          <label for="comment_email">Email <span style="color: red">*</span></label>
        </div>
        
        <div class="form-group">
          <input type="url" class="form-input w-full" id="comment_url" name="comment_url" placeholder=" ">
          <label for="comment_url">Website (Opsional)</label>
        </div>
        
        <div class="form-group">
          <textarea class="form-textarea w-full" id="comment_content" name="comment_content" rows="4" placeholder=" " required></textarea>
          <label for="comment_content">Pesan <span style="color: red">*</span></label>
        </div>
        <?php if (NULL !== __session('recaptcha_status') && __session('recaptcha_status') == 'enable') : ?>
          <div class="flex flex-col lg:flex-row">
            <label class="lg:w-1/4 pt-1"></label>
            <div class="lg:w-3/4">
              <div class="g-recaptcha" data-sitekey="<?= $recaptcha_site_key ?>"></div>
            </div>
          </div>
        <?php endif ?>
        <div class="flex flex-col lg:flex-row pt-3">
          <span class="lg:w-1/4"></span>
          <button type="button" onclick="send_message(); return false;" class="btn animate-scale-in">
            <i class="fa fa-send"></i> 
            <span>Kirim Pesan</span>
          </button>
        </div>
      </form>
    </section>
    <div class="w-full lg:w-1/3 space-y-5 sticky top-4">
      <?php $this->load->view(THEME_PATH . 'components/sidebar') ?>
    </div>
  </div>
</main>