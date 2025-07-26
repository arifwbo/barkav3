<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<?php
  $initial_name = explode(' ', __session('school_name'));
  $last_name = array_pop($initial_name);
  $initial_name = implode(' ', $initial_name);

?>
<header class="bg-primary shadow-md py-3 lg:pt-4 lg:pb-12 sticky top-0 z-20 lg:static" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);">
  <div class="container flex flex-col lg:flex-row justify-between">
    <div class="group flex justify-between">
      <a href="<?= site_url() ?>" class="flex lg:flex-row items-center py-2 space-x-6 animate-slide-in-left">
        <img src="<?= base_url('media_library/images/'. __session('logo')) ?>" alt="Logo <?= __session('school_name') ?>" class="w-14 lg:w-20 h-auto logo-pulse transition-all duration-300 hover:scale-110">
        <span class="flex flex-col font-black text-white text-justify font-heading">
          <span class="text-xl lg:text-2xl animate-fade-in"><?= $initial_name ?></span>
          <span class="uppercase text-2xl lg:text-3xl tracking-wide animate-fade-in" style="animation-delay: 0.2s;"><?= $last_name ?></span>
        </span>
      </a>
      <button class="lg:hidden px-2 text-xl active:outline-none focus:outline-none h-auto z-50 transition duration-200 menu-button hover:scale-110">
        <span class="fa fa-bars text-white"></span>
      </button>
    </div>
    <div class="hidden lg:flex items-center space-x-6 animate-slide-in-right">
      <div class="lg:flex lg:space-x-6 flex-col lg:flex-row">
        <div class="text-gray-100 flex items-center space-x-2 hover:text-white transition-all duration-300 hover:scale-105">
          <span class="text-lg fa fa-phone"></span>
          <span><?= __session('phone') ?></span>
        </div>
        <div class="text-gray-100 flex items-center space-x-2 hover:text-white transition-all duration-300 hover:scale-105">
          <span class="text-lg fa fa-envelope"></span>
          <span><?= __session('email') ?></span>
        </div>
      </div>
    </div>
  </div>
</header>
<section class="container lg:-mt-7 z-30 relative lg:sticky top-0">
  <?php $this->load->view('themes/barka/components/nav') ?>
</section>