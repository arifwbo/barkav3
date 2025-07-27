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
  <?php 
    $page_title = ucwords($page_title);
    $this->load->view(THEME_PATH . 'components/breadcrumb'); 
  ?>
  <div class="flex flex-col lg:flex-row items-start gap-x-6 relative space-y-5 lg:space-y-0">
    <section class="w-full lg:w-2/3 space-y-4">
      <h1 class="font-heading text-2xl lg:text-3xl capitalize font-black text-title">
        <span class="fa fa-phone text-primary mr-3"></span><?= ucwords($page_title) ?>
      </h1>
      <div class="mapouter border border-secondary mb-3 rounded-lg overflow-hidden shadow-lg">
        <div class="gmap_canvas">
          <?= __session('map_location') ?>
        </div>
      </div>
      <div class="card">
        <h2 class="text-xl font-bold mb-4 text-primary">Kirim Pesan</h2>
        <form action="" method="post" class="space-y-4">
          <div class="form-group">
            <input type="text" class="form-input w-full" id="comment_author" name="comment_author" placeholder=" " required>
            <label for="comment_author">Nama Lengkap *</label>
          </div>
          
          <div class="form-group">
            <input type="email" class="form-input w-full" id="comment_email" name="comment_email" placeholder=" " required>
            <label for="comment_email">Email *</label>
          </div>
          
          <div class="form-group">
            <input type="url" class="form-input w-full" id="comment_url" name="comment_url" placeholder=" ">
            <label for="comment_url">Website (Opsional)</label>
          </div>
          
          <div class="form-group">
            <textarea class="form-input w-full" id="comment_content" name="comment_content" rows="4" placeholder=" " required></textarea>
            <label for="comment_content">Pesan *</label>
          </div>
          
          <?php if (NULL !== __session('recaptcha_status') && __session('recaptcha_status') == 'enable') : ?>
            <div class="flex justify-center">
              <div class="g-recaptcha" data-sitekey="<?= $recaptcha_site_key ?>"></div>
            </div>
          <?php endif ?>
          
          <div class="flex justify-end pt-3">
            <button type="button" onclick="send_message(); return false;" class="btn bg-secondary hover:bg-secondary-dark transition duration-200 text-white rounded py-3 px-6 font-semibold">
              <i class="fa fa-send mr-2"></i>Kirim Pesan
            </button>
          </div>
        </form>
      </div>
    </section>
    <div class="w-full lg:w-1/3 space-y-5 sticky top-4">
      <?php $this->load->view(THEME_PATH . 'components/sidebar') ?>
    </div>
  </div>
</main>