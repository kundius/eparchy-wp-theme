<?php
/*
Template Name: Документы
*/
$query = new WP_Query([
  'post_type' => 'page',
  'post_parent' => get_the_ID(),
  'posts_per_page' => -1,
  'orderby' => ['menu_order' => 'ASC']
]);
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

      <div class="page-sheet">
        <div class="container">
          <?php if (have_posts()): while (have_posts()): the_post(); ?>
          <?php get_template_part('partials/page-headline'); ?>

          <div class="document-sections">
            <div class="document-sections-grid">
              <?php foreach ($query->posts as $key => $item): ?>
              <div class="document-sections-grid__cell">
                <div class="card-hestia card-hestia_<?php echo $key ?>">
                  <div class="card-hestia__body">
                    <div class="card-hestia__icon">
                      <?php icon('document', 2.5) ?>
                    </div>
                    <a href="<?php the_permalink($item) ?>" class="card-hestia__title">
                      <?php echo get_the_title($item) ?>
                    </a>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>

          <?php endwhile; endif; ?>
        </div>

        <?php get_template_part('partials/footer'); ?>
      </div>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
