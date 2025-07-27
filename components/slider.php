<?php $image_sliders = get_image_sliders() ?>
<?php if($image_sliders->num_rows() > 0) : ?>
  <section class="owl-carousel o-slider w-full max-h-full max-w-slider mx-auto modern-shadow-lg overflow-hidden rounded-2xl">
    <?php foreach($image_sliders->result() as $slider) : ?>
      <figure class="lg:h-slider h-48 w-full relative overflow-hidden group">
        <img src="<?= base_url('media_library/image_sliders/'.$slider->image) ?>" 
             alt="foto slider" 
             class="lg:h-slider h-48 w-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
             loading="lazy">
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
      </figure>
    <?php endforeach ?>
  </section>
<?php endif ?>

