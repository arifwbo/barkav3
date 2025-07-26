<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<div class="backdrop"></div>
<nav class="max-w-full nav-modern px-4 shadow-lg lg:border-b-4 lg:border-tertiary">
  <ul class="menu py-2 font-heading">
    <span class="block py-2 text-title mx-5 mb-3 lg:hidden tracking-wide font-medium">MENU</span>
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
        <a class="h-full block lg:inline-flex items-center py-3 px-6 lg:px-3 font-medium hover:text-tertiary transition duration-300 border-b lg:border-none menu-link lg:text-gray-700 hover:bg-opacity-20" href="<?= $url ?>" target="<?= $menu['menu_target'] ?>">
          <?= ucwords($menu['menu_title']) ?>
          <?php if($sub_nav) : ?>
            <span class="menu-icon fa fa-chevron-down ml-2 text-xs transition-transform duration-300"></span>
          <?php endif ?>
        </a>

        <?php if($sub_nav) : ?>
          <ul class="menu-dropdown ml-4 lg:ml-0">
            <?php foreach($menu['children'] as $menu) : ?>
              <li>
                <?php $url = base_url() . $menu['menu_url'] ?>
                <?php if($menu['menu_type'] == 'links') : ?>
                  <?php $url = $menu['menu_url'] ?>
                <?php endif ?>
                <a href="<?= $url ?>" class="h-full block py-2 px-5 lg:px-4 font-medium hover:text-secondary transition duration-300 border-b" target="<?= $menu['menu_target'] ?>"><?= ucwords($menu['menu_title']) ?></a>
              </li>
            <?php endforeach ?>
          </ul>
        <?php endif ?>
      </li>
    <?php endforeach ?>
  </ul>
</nav>