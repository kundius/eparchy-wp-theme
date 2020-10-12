<?php
/*
Template Name: Храмы - Корень
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
          <?php get_template_part('partials/page-headline'); ?>

          <div class="grid-temples-root">
            <div class="grid-temples-root__sections">
              <div class="grid-temples-sections">
                <?php foreach ($query->posts as $item): ?>
                <div class="grid-temples-sections__cell">
                  <div class="card-cynthia">
                    <?php if ($thumbnail = get_the_post_thumbnail($item, ['400', '260'])): ?>
                    <div class="card-cynthia__figure">
                      <?php echo $thumbnail ?>
                    </div>
                    <?php endif; ?>
                    <div class="card-cynthia__body">
                      <a href="<?php the_permalink($item) ?>" class="card-cynthia__title">
                        <?php echo get_the_title($item) ?>
                      </a>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>

            <?php if ('' !== get_post()->post_content): ?>
            <div class="grid-temples-root__content content">
              <?php the_content() ?>
            </div>
            <?php endif; ?>
          </div>
        </div>

        <?php get_template_part('partials/footer'); ?>
      </div>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
