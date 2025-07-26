<?php defined('BASEPATH') or exit('No direct script access allowed') ?>

<section class="lg:-mt-6">
  <?php $this->load->view(THEME_PATH . 'components/slider') ?>
</section>

<main class="container space-y-6 my-6 flex-1">
  <?php $this->load->view(THEME_PATH . 'components/newsticker') ?>

  <!-- CUSTOMIZABLE SECTION: School info hero section -->
  <div class="bg-gradient-to-r from-primary-blue to-accent-blue text-white lg:py-6 rounded-2xl shadow-lg overflow-hidden">
    <div class="flex flex-col lg:flex-row divide-y-2 lg:divide-x-2 lg:divide-y-0 divide-white divide-opacity-20">
      <div class="lg:w-1/2 py-4 px-6 lg:py-4 flex items-center space-x-6 fade-in-on-scroll">
        <div class="bg-white bg-opacity-10 rounded-full p-4 flex-shrink-0">
          <span class="fa fa-map-marker text-4xl font-bold text-status-warning"></span>
        </div>
        <div class="flex flex-col space-y-3">
          <div class="group">
            <span class="block text-2xl font-heading font-bold tracking-wide"><?= __session('school_name') ?></span>
            <span class="block text-sm italic opacity-90 bg-white bg-opacity-10 inline-block px-3 py-1 rounded-full mt-2">
              <?= __session('tagline') ?>
            </span>
          </div>
          <span class="text-sm leading-relaxed">
            <?= __session('street_address') ?>, <?= __session('village') ?>, <?= __session('sub_district') ?>, <?= __session('district') ?>
          </span>
        </div>
      </div>
      
      <div class="lg:w-1/2 py-4 px-6 lg:py-4 flex items-center space-x-6 fade-in-on-scroll">
        <div class="bg-white bg-opacity-10 rounded-full p-4 flex-shrink-0">
          <span class="fa fa-share-alt text-4xl font-bold text-status-warning"></span>
        </div>
        <div class="flex flex-col space-y-3">
          <span class="block text-2xl font-heading font-bold">Media Sosial</span>
          <div class="flex gap-3">
            <?php if (NULL !== __session('facebook') && __session('facebook')) : ?>
              <a target="_blank" rel="noopener" href="<?= __session('facebook') ?>" 
                 class="social-icon bg-white bg-opacity-10 hover:bg-white hover:text-primary-blue">
                <i class="fa fa-facebook" aria-label="facebook"></i>
              </a>
            <?php endif ?>
            <?php if (NULL !== __session('twitter') && __session('twitter')) : ?>
              <a target="_blank" rel="noopener" href="<?= __session('twitter') ?>" 
                 class="social-icon bg-white bg-opacity-10 hover:bg-white hover:text-primary-blue">
                <i class="fa fa-twitter" aria-label="twitter"></i>
              </a>
            <?php endif ?>
            <?php if (NULL !== __session('instagram') && __session('instagram')) : ?>
              <a target="_blank" rel="noopener" href="<?= __session('instagram') ?>" 
                 class="social-icon bg-white bg-opacity-10 hover:bg-white hover:text-primary-blue">
                <i class="fa fa-instagram" aria-label="instagram"></i>
              </a>
            <?php endif ?>
            <?php if (NULL !== __session('youtube') && __session('youtube')) : ?>
              <a target="_blank" rel="noopener" href="<?= __session('youtube') ?>" 
                 class="social-icon bg-white bg-opacity-10 hover:bg-white hover:text-primary-blue">
                <i class="fa fa-youtube-play" aria-label="youtube"></i>
              </a>
            <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="flex flex-col lg:flex-row items-start gap-x-8 relative space-y-6 lg:space-y-0">
    <div class="w-full lg:w-2/3 space-y-6">
      <!-- CUSTOMIZABLE SECTION: Latest articles section -->
      <div class="fade-in-on-scroll">
        <h3 class="font-heading text-3xl capitalize font-bold text-primary-blue flex items-center gap-3 mb-6">
          <span class="fa fa-newspaper-o bg-accent-blue text-white p-3 rounded-full"></span> 
          Artikel Terkini
        </h3>
        <div class="grid grid-cols-1 gap-6">
          <?php $posts = get_latest_posts(5) ?>
          <?php if ($posts->num_rows() > 0) : ?>
          <?php foreach ($posts->result() as $post) : ?>
            <?php
            $content = substr(strip_tags($post->post_content), 0, 200);
            $write_post = substr($content, 0, strrpos(trim($content, " "), " "))
            ?>
            <div class="bg-white overflow-hidden relative flex flex-col lg:flex-row justify-between" data-aos="fade-up">

              <div class="w-full h-48 lg:h-full lg:w-5/12 flex-shrink-0 bg-gray-300 flex items-center justify-center">

                <?php $post_image = 'media_library/posts/medium/' . $post->post_image; ?>
                <?php $poster = is_file('./' . $post_image) ? base_url($post_image) : base_url('media_library/images/' . __session('logo')) ?>
                <?php $poster_class = is_file('./' . $post_image) ? 'w-full object-cover object-center h-inherit' : 'w-16' ?>
                <?php $link = site_url('read/' . $post->id . '/' . $post->post_slug) ?>

                <img src="<?= $poster ?>" alt="<?= $post->post_title ?>" class="<?= $poster_class ?>">
              </div>

              <div class="flex flex-col absolute top-0 left-0 px-3 py-2 bg-secondary text-white text-center">
                <?php $date = explode('-', date('Y-m-d', strtotime($post->created_at))) ?>
                <span class="text-3xl font-black"><?= $date[2] ?></span>
                <span class="tracking-wide uppercase"><?= substr(bulan($date[1]), 0, 3) ?></span>
              </div>
              <div class="w-full lg:w-7/12 space-y-2 py-2 lg:px-4 flex flex-col justify-between">
                <div class="space-y-2">
                  <a href="<?= $link ?>" class="transition duration-200 hover:text-secondary">
                    <h2 class="font-black text-lg lg:text-xl font-heading"><?= $post->post_title ?></h2>
                  </a>
                  <p class="break-normal whitespace-normal">
                    <?= $write_post . " [....] " ?>
                  </p>
                </div>
                <a href="<?= $link ?>" class="block text-secondary">Baca selengkapnya <span class="fa fa-chevron-right text-xs ml-1"></span></a>
              </div>
            </div>
          <?php endforeach ?>
        <?php endif ?>
      </div>

      <?php $albums = get_albums(2) ?>
      <?php if ($albums->num_rows() > 0) : ?>
        <h3 class="font-heading text-2xl capitalize font-black text-title py-2"><i class="fa fa-camera"></i> Album Galeri</h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
          <?php foreach ($albums->result() as $album) : ?>
            <figure class="shadow-md bg-white overflow-hidden">
              <img src="<?= base_url('media_library/albums/' . $album->album_cover) ?>" alt="<?= $album->album_title ?>" class="h-48 w-full object-fit object-cover flex items-center justify-center bg-gray-300">
              <figcaption class="py-2 text-center">
                <?= $album->album_title ?>
              </figcaption>
              <div class="px-3 py-2">
                <button type="button" onclick="photo_preview(<?= $album->id ?>)" class="bg-secondary text-white block w-full py-2 text-center mx-2"><i class="fa fa-search mr-2"></i> Lihat</button>
              </div>
            </figure>
          <?php endforeach ?>
        </div>
      <?php endif ?>

      <?php $videos = get_videos(2) ?>
      <?php if ($videos->num_rows() > 0) : ?>
        <h3 class="font-heading text-2xl capitalize font-black text-title py-2"><i class="fa fa-film"></i> Video</h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
          <?php foreach ($videos->result() as $video) : ?>
            <iframe width="100%" height="280" src="https://www.youtube.com/embed/<?= $video->post_content ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full"></iframe>
          <?php endforeach ?>
        </div>
      <?php endif ?>
    </div>

    <div class="w-full lg:w-1/3 space-y-5 ">
      <?php $this->load->view(THEME_PATH . 'components/sidebar') ?>
    </div>
  </div>
</main>
