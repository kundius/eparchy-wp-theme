<div class="header">
  <div class="container header__container">
    <button class="haader__toggle" data-off-canvas-toggle><span></span><span></span><span></span></button>

    <a href="/" class="haader-logo">
      <img src="<?php echo get_bloginfo('template_url') ?>/dist/images/logo.svg" alt="" class="haader-logo__image" />
      <span class="haader-logo__first">Русская Православная Церковь</span>
      <span class="haader-logo__second">Борисоглебская&nbsp;&nbsp;Епархия</span>
      <span class="haader-logo__third">Московский Патриархат Воронежская Митрополия</span>
    </a>

    <?php wp_nav_menu([
      'theme_location' => 'header_menu',
      'container' => false,
      'menu_class' => 'header__menu'
    ]) ?>

    <?php get_search_form() ?>
  </div>
</div>

<div class="mainmenu">
  <div class="container mainmenu__container">
    <?php wp_nav_menu([
      'theme_location' => 'main_menu',
      'container' => false,
      'menu_class' => 'mainmenu__list'
    ]) ?>
  </div>
</div>
