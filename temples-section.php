<?php
/*
Template Name: Храмы - Раздел
*/
$query = new WP_Query([
  'post_type' => 'page',
  'post_parent' => get_the_ID(),
  'posts_per_page' => -1,
  'orderby' => ['menu_order' => 'ASC']
]);
$background = get_field('background');
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

      <div class="portray-section">
        <div class="portray-section__bg"<?php if (!empty($background)):?> style="background-image: url('<?php echo $background['url'] ?>')"<?php endif; ?>></div>
        
        <div class="container">
          <div class="portray-section-headline">
            <div class="breadcrumbs breadcrumbs_darken" typeof="BreadcrumbList" vocab="https://schema.org/">
              <?php bcn_display() ?>
            </div>
            <h1 class="portray-section-headline__title"><?php the_title() ?></h1>
          </div>
        </div>

        <div class="page-sheet">
          <div class="container">
            <div class="grid-temples-section">
              <?php if ($query->have_posts()): ?>
              <div class="grid-temples-section__entries">
                <div class="grid-temples-entries">
                  <?php foreach ($query->posts as $item): ?>
                  <div class="grid-temples-entries__cell">
                    <div class="card-kore">
                      <?php if ($thumbnail = get_the_post_thumbnail($item, ['600', '340'])): ?>
                      <div class="card-kore__figure">
                        <?php echo $thumbnail ?>
                      </div>
                      <?php endif; ?>
                      <a href="<?php the_permalink($item) ?>" class="card-kore__title">
                        <?php echo get_the_title($item) ?>
                      </a>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="grid-temples-section__pagination">
                <?php wp_pagenavi(['query' => $query]) ?>
              </div>
              <?php endif; ?>

              <?php if ('' !== get_post()->post_content): ?>
              <div class="grid-temples-section__content content">
                <?php the_content() ?>
              </div>
              <?php endif; ?>

              <div class="grid-temples-section__share">
                <script src="https://yastatic.net/share2/share.js"></script>
                <div class="ya-share2" data-curtain data-size="s" data-services="collections,vkontakte,facebook,odnoklassniki,messenger,twitter,viber,pinterest" data-image:pinterest="<?php the_post_thumbnail_url('full') ?>"></div>
              </div>
            </div>
          </div>

          <?php get_template_part('partials/footer'); ?>
        </div>
      </div>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
