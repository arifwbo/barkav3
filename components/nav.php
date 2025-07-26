<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<div class="backdrop"></div>
<!-- CUSTOMIZABLE SECTION: Main navigation menu -->
<nav class="max-w-full bg-gradient-to-r from-accent-blue to-primary-blue px-4 shadow-lg lg:border-b-4 lg:border-status-warning rounded-lg lg:rounded-none">
  <ul class="menu py-2 font-heading">
    <span class="block py-3 text-white mx-5 mb-3 lg:hidden tracking-wide font-semibold text-lg border-b border-white border-opacity-20">MENU NAVIGASI</span>
    <?php $menus = get_menus() ?>
    <?php foreach($menus as $menu) : ?>
      <?php
        $sub_nav = recursive_list($menu['children']);
        $url = base_url() . $menu['menu_url'];
      ?>
      <li class="relative flex-shrink-0 menu-item <?php (count($menu['children']) > 0) and print('has-submenu') ?>">
        <?php if($menu['menu_type'] == 'links') : ?>
          <?php $url = $menu['menu_url'] ?>
        <?php endif ?>
        <a class="h-full block lg:inline-flex items-center py-3 px-5 lg:px-4 font-semibold hover:text-status-warning transition-all duration-300 border-b lg:border-none menu-link lg:text-white rounded-lg lg:rounded-none relative overflow-hidden" 
           href="<?= $url ?>" 
           target="<?= $menu['menu_target'] ?>">
          <?= ucwords($menu['menu_title']) ?>
          <?php if($sub_nav) : ?>
            <span class="menu-icon fa fa-chevron-down ml-2 text-xs transition-transform duration-300"></span>
          <?php endif ?>
        </a>

        <?php if($sub_nav) : ?>
          <ul class="menu-dropdown ml-4 lg:ml-0 bg-primary-dark lg:bg-white lg:shadow-lg lg:rounded-lg lg:border lg:border-opacity-10">
            <?php foreach($menu['children'] as $menu) : ?>
              <li>
                <?php $url = base_url() . $menu['menu_url'] ?>
                <?php if($menu['menu_type'] == 'links') : ?>
                  <?php $url = $menu['menu_url'] ?>
                <?php endif ?>
                <a href="<?= $url ?>" 
                   class="h-full block py-2 px-4 lg:px-4 font-medium hover:text-status-warning lg:hover:text-primary-blue transition-all duration-300 border-b lg:text-gray-700 rounded lg:hover:bg-primary-light" 
                   target="<?= $menu['menu_target'] ?>">
                  <?= ucwords($menu['menu_title']) ?>
                </a>
              </li>
            <?php endforeach ?>
          </ul>
        <?php endif ?>
      </li>
    <?php endforeach ?>
  </ul>
</nav>