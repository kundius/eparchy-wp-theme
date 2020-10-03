<div class="off-canvas-bar">
  <button class="off-canvas-bar__close" data-off-canvas-toggle></button>

  <div class="off-canvas-bar__body">
    <div class="drawer">
      <a href="/" class="drawer-logo">
        <span class="drawer-logo__first">Русская Православная Церковь</span>
        <span class="drawer-logo__second">Борисоглебская&nbsp;&nbsp;Епархия</span>
        <span class="drawer-logo__third">Московский Патриархат Воронежская Митрополия</span>
      </a>

      <?php wp_nav_menu([
        'theme_location' => 'main_menu',
        'container' => false,
        'menu_class' => 'drawer-mainmenu'
      ]) ?>

      <?php wp_nav_menu([
        'theme_location' => 'header_menu',
        'container' => false,
        'menu_class' => 'drawer-secondmenu'
      ]) ?>
    </div>
  </div>
</div>
