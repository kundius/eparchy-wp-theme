<?php
/*
Template Name: Контакты
*/
?>
<!DOCTYPE html>
<html lang="ru" itemscope itemtype="http://schema.org/WebSite">
  <head>
    <?php get_template_part('partials/head'); ?>
  </head>
<body>
  <?php get_template_part('partials/off-canvas'); ?>

  <div class="off-canvas-page">
    <div class="off-canvas-page__overlay" data-off-canvas-toggle></div>

    <?php get_template_part('partials/header'); ?>

    <div class="page-sheet home-page-sheet">
      <div class="container">
      <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
        <?php bcn_display() ?>
      </div>

      </div>

      <?php get_template_part('partials/footer'); ?>
    </div>
  </div>
</body>
</html>
