<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<main class="container space-y-5 my-5 flex-1">
  <div class="flex flex-col lg:flex-row items-start gap-x-6 relative space-y-5 lg:space-y-0">
    <section class="w-full lg:w-2/3 space-y-6">
      <h1 class="font-heading text-3xl font-bold text-title mb-2">
        <i class="fa fa-search mr-2 text-primary-color"></i> 
        <?= ucwords($page_title) ?>
      </h1>
      <p class="text-muted">Menampilkan hasil pencarian untuk kata kunci yang Anda cari</p>
      
      <div class="space-y-6">
        <?php if($query->num_rows() > 0) : ?>
          <?php foreach($query->result() as $post) : ?>
            <article class="card post group animate-fade-in" data-aos="fade-up">
              <div class="flex flex-col lg:flex-row gap-6">
                <div class="w-full lg:w-5/12 flex-shrink-0 relative overflow-hidden rounded-lg">
                  <?php $post_image = 'media_library/posts/medium/'.$post->post_image; ?>
                  <?php $poster = is_file('./'.$post_image) ? base_url($post_image) : base_url('media_library/images/'. __session('logo')) ?>
                  <?php $poster_class = is_file('./'.$post_image) ? 'w-full h-48 object-cover object-center transition-transform duration-300 group-hover:scale-105' : 'w-16 h-16 mx-auto my-16' ?>
                  <?php $link = site_url('read/'.$post->id.'/'.$post->post_slug) ?>
                  <img src="<?= $poster ?>" alt="<?= $post->post_title ?>" class="<?= $poster_class ?>" loading="lazy">
                  
                  <div class="absolute top-4 left-4 bg-gradient-to-r from-primary-color to-accent-color text-white text-center rounded-lg p-3 shadow-lg">
                    <?php $date = explode('-', date('Y-m-d', strtotime($post->created_at))) ?>
                    <span class="block text-2xl font-bold"><?= $date[2] ?></span>
                    <span class="block text-xs uppercase tracking-wide"><?= substr(bulan($date[1]), 0, 3) ?></span>
                  </div>
                </div>
                
                <div class="w-full lg:w-7/12 flex flex-col justify-between space-y-4">
                  <div class="space-y-3">
                    <a href="<?= $link ?>" class="group-hover:text-primary-color transition-colors duration-300">
                      <h2 class="font-bold text-xl lg:text-2xl font-heading leading-tight"><?= $post->post_title ?></h2>
                    </a>
                    <p class="text-muted leading-relaxed">
                      <?= substr(strip_tags($post->post_content), 0, 165) ?>...
                    </p>
                  </div>
                  <a href="<?= $link ?>" class="inline-flex items-center text-primary-color font-semibold hover:text-accent-color transition-colors duration-300">
                    Baca selengkapnya 
                    <i class="fa fa-chevron-right text-xs ml-2"></i>
                  </a>
                </div>
              </div>
            </article>
                  <p class="break-normal whitespace-normal">
                    <?= substr(strip_tags($post->post_content), 0, 165) ?>
                  </p>
                </div>
                <a href="<?= $link ?>" class="block text-secondary">Baca selengkapnya <span class="fa fa-chevron-right text-xs ml-1"></span></a>
              </div>
            </div>
          <?php endforeach ?>
          <?php else : ?>
            <div class="text-center">
              Tidak ditemukan hasil yang sesuai...
            </div>
        <?php endif ?>
      </div>
    </section>
    <div class="w-full lg:w-1/3 space-y-5 sticky top-4">
      <?php $this->load->view(THEME_PATH . 'components/sidebar') ?>
    </div>
  </div>
</main>
