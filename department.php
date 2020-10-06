<?php
/*
Template Name: Епархиальные отделы
*/
$query = new WP_Query([
  'post_type' => 'page',
  'post_parent' => get_the_ID(),
  'posts_per_page' => -1,
  'orderby' => ['menu_order' => 'ASC']
]);
$groups = array_chunk($query->posts, round(count($query->posts) / 2));
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

          <div class="departaments-dialog">
            <?php if ($introtext = get_field('introtext')): ?>
            <div class="departaments-dialog__introtext">
              <?php echo $introtext ?>
            </div>
            <?php endif; ?>
            <?php $administrator = get_field('administrator') ?>
            <?php if ($administrator['image'] || $administrator['description']): ?>
            <div class="departaments-dialog__administrator">
              <?php if (!empty($administrator['image'])): ?>
              <div class="departaments-dialog__administrator-figure">
                <img src="<?php echo $administrator['image']['url'] ?>" alt="" />
              </div>
              <?php endif; ?>
              <div class="departaments-dialog__administrator-info">
                <div class="departaments-dialog__administrator-title">
                  Руководитель отдела
                </div>
                <div class="departaments-dialog__administrator-description">
                  <?php echo $administrator['description'] ?>
                </div>
              </div>
            </div>
            <?php endif; ?>
          </div>

          <?php the_content() ?>

          <?php endwhile; endif; ?>
        </div>

        <?php get_template_part('partials/footer'); ?>
      </div>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
