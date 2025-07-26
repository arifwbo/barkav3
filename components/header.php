<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<?php
  $initial_name = explode(' ', __session('school_name'));
  $last_name = array_pop($initial_name);
  $initial_name = implode(' ', $initial_name);

?>
<header class="bg-primary shadow-lg py-4 lg:pt-6 lg:pb-16 sticky top-0 z-20 lg:static" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%); box-shadow: 0 8px 32px rgba(14,165,233,0.2);">
  <div class="container flex flex-col lg:flex-row justify-between items-center">
    <div class="group flex justify-between items-center w-full lg:w-auto">
      <a href="<?= site_url() ?>" class="flex lg:flex-row items-center py-2 space-x-8 animate-slide-in-left">
        <img src="<?= base_url('media_library/images/'. __session('logo')) ?>" alt="Logo <?= __session('school_name') ?>" class="w-16 lg:w-24 h-auto logo-pulse transition-all duration-300 hover:scale-105 drop-shadow-lg">
        <span class="flex flex-col font-black text-white text-justify font-heading">
          <span class="text-xl lg:text-3xl animate-fade-in tracking-wide"><?= $initial_name ?></span>
          <span class="uppercase text-2xl lg:text-4xl tracking-wider animate-fade-in font-extrabold" style="animation-delay: 0.2s;"><?= $last_name ?></span>
        </span>
      </a>
      <button class="lg:hidden px-3 py-2 text-xl active:outline-none focus:outline-none h-auto z-50 transition duration-200 menu-button hover:scale-110 rounded-lg hover:bg-white hover:bg-opacity-20">
        <span class="fa fa-bars text-white"></span>
      </button>
    </div>
    <div class="hidden lg:flex items-center space-x-8 animate-slide-in-right">
      <div class="lg:flex lg:space-x-8 flex-col lg:flex-row">
        <div class="text-gray-100 flex items-center space-x-3 hover:text-white transition-all duration-300 hover:scale-105 bg-white bg-opacity-10 rounded-lg px-4 py-2 backdrop-blur-sm">
          <span class="text-lg fa fa-phone bg-white bg-opacity-20 p-2 rounded-full"></span>
          <span class="font-medium"><?= __session('phone') ?></span>
        </div>
        <div class="text-gray-100 flex items-center space-x-3 hover:text-white transition-all duration-300 hover:scale-105 bg-white bg-opacity-10 rounded-lg px-4 py-2 backdrop-blur-sm">
          <span class="text-lg fa fa-envelope bg-white bg-opacity-20 p-2 rounded-full"></span>
          <span class="font-medium"><?= __session('email') ?></span>
        </div>
      </div>
    </div>
  </div>
</header>
<section class="container lg:-mt-10 z-30 relative lg:sticky top-0">
  <?php $this->load->view('themes/barka/components/nav') ?>
</section>