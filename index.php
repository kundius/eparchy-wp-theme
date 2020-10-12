<?php
the_post();

$tags = wp_get_post_tags(get_post()->ID);
$tag_ids = array_map(function ($tag) {
  return $tag->term_id;
}, $tags);
$related = new wp_query([
  'tag__in' => $tag_ids,
  'post__not_in' => [get_post()->ID],
  'posts_per_page' => 20,
  'ignore_sticky_posts' => 1,
  'paged' => get_query_var('paged') ?: 1,
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

          <div class="page-article-details">
            <div class="page-article-details__content content">
              <?php the_content() ?>
            </div>
          </div>
        </div>

        <?php get_template_part('partials/footer'); ?>
      </div>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
