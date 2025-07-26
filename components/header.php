<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<?php
  $initial_name = explode(' ', __session('school_name'));
  $last_name = array_pop($initial_name);
  $initial_name = implode(' ', $initial_name);

?>
<header class="bg-primary shadow-md py-3 lg:py-5 sticky top-0 z-20 lg:static" style="background: linear-gradient(135deg, rgba(59,130,246,0.95) 0%, rgba(30,64,175,0.95) 100%); backdrop-filter: blur(10px);">
  <div class="container flex flex-col lg:flex-row justify-between">
    <div class="group flex justify-between">
      <a href="<?= site_url() ?>" class="flex lg:flex-row items-center py-2 space-x-5">
        <img src="<?= base_url('media_library/images/'. __session('logo')) ?>" alt="Logo <?= __session('school_name') ?>" class="w-12 lg:w-16 h-auto logo-pulse">
        <span class="flex flex-col font-black text-white text-justify font-heading">
          <span class="text-lg lg:text-xl"><?= $initial_name ?></span>
          <span class="uppercase text-xl lg:text-2xl tracking-wide"><?= $last_name ?></span>
        </span>
      </a>
      <button class="lg:hidden px-2 text-xl active:outline-none focus:outline-none h-auto z-50 transition duration-200 menu-button">
        <span class="fa fa-bars text-white"></span>
      </button>
    </div>
    <div class="hidden lg:flex items-center space-x-5">
      <div class="lg:flex lg:space-x-5 flex-col lg:flex-row">
        <div class="text-gray-100 flex items-center space-x-2 bg-white bg-opacity-20 px-3 py-2 rounded-lg backdrop-blur-sm">
          <span class="text-lg fa fa-phone text-yellow-300"></span>
          <span><?= __session('phone') ?></span>
        </div>
        <div class="text-gray-100 flex items-center space-x-2 bg-white bg-opacity-20 px-3 py-2 rounded-lg backdrop-blur-sm">
          <span class="text-lg fa fa-envelope text-yellow-300"></span>
          <span><?= __session('email') ?></span>
        </div>
      </div>
    </div>
  </div>
</header>
<section class="container lg:-mt-7 z-30 relative lg:sticky top-0">
  <?php $this->load->view('themes/barka/components/nav') ?>
</section>