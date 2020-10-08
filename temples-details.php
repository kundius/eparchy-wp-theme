<?php
/*
Template Name: Храмы - Подробно
*/
$background = get_field('background');
$introtext = get_field('introtext');
$gallery = get_field('gallery');
$latest_query = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => 1,
  'order' => 'DESC',
  'orderby' => 'date',
	'meta_query' => [
		[
      'key' => 'temples',
      'compare' => 'LIKE',
			'value' => '"' . get_the_ID() . '"'
		]
  ]
]);
$news_per_page = 11;
$news = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => $news_per_page,
  'post__not_in' => $latest_query->posts ? [$latest_query->posts[0]->ID] : null,
  'order' => 'DESC',
  'orderby' => 'date',
  'paged' => get_query_var('paged') ?: 1,
	'meta_query' => [
		[
      'key' => 'temples',
      'compare' => 'LIKE',
			'value' => '"' . get_the_ID() . '"'
		]
  ]
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

      <div class="portray-section">
        <div class="portray-section__bg"<?php if (!empty($background)):?> style="background-image: url('<?php echo $background['url'] ?>')"<?php endif; ?>></div>
        
        <div class="container">
          <div class="portray-section-headline">
            <div class="breadcrumbs breadcrumbs_darken" typeof="BreadcrumbList" vocab="https://schema.org/">
              <?php bcn_display() ?>
            </div>
            <h1 class="portray-section-headline__title">
              <?php the_title() ?>
            </h1>
          </div>
        </div>

        <div class="page-sheet">
          <div class="container">
            <div class="page-temples-details">
              <div class="page-temples-details__title">
                <?php the_title() ?>
              </div>

              <div class="page-temples-details__parent">
                <a class="ui-all-button" href="<?php the_permalink(get_post()->post_parent) ?>">к списку храмов</a>
              </div>

              <div class="page-temples-details__hr">
                <div class="ui-hr"></div>
              </div>

              <div class="page-temples-details__share">
                <script src="https://yastatic.net/share2/share.js"></script>
                <div class="ya-share2" data-curtain data-size="s" data-services="collections,vkontakte,facebook,odnoklassniki,messenger,twitter,viber,pinterest" data-image:pinterest="<?php the_post_thumbnail_url('full') ?>"></div>
              </div>

              <?php if ($introtext): ?>
              <div class="page-temples-details__introtext content">
                <?php echo $introtext ?>
              </div>
              <?php endif; ?>

              <?php if ($latest_query->have_posts()): ?>
              <div class="page-temples-details__latest-title">
                <div class="section-headline section-headline_yellow">
                  <div class="section-headline__title">все новости храма</div>
                </div>
              </div>

              <div class="page-temples-details__latest-body">
                <?php foreach ($latest_query->posts as $item): ?>
                <div class="article-textual-card">
                  <div class="article-textual-card__date">
                    <div><?php echo get_the_date('d.m.Y', $item) ?></div>
                    <div><?php print_time_ago($item) ?></div>
                  </div>
                  <?php if ($thumbnail = get_the_post_thumbnail($item, ['600', '340'])): ?>
                  <div class="article-textual-card__figure">
                    <?php echo $thumbnail ?>
                  </div>
                  <?php endif; ?>
                  <a href="<?php the_permalink($item) ?>" class="article-textual-card__title">
                    <?php echo get_the_title($item) ?>
                  </a>
                  <?php if ($excerpt = get_the_excerpt($item)): ?>
                  <div class="article-textual-card__desc"><?php echo $excerpt ?></div>
                  <?php endif; ?>
                </div>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>

              <?php if ($gallery): ?>
              <div class="page-temples-details__gallery-title">
                <div class="section-headline section-headline_green">
                  <div class="section-headline__title">фотоматериалы храма</div>
                </div>
              </div>

              <div class="page-temples-details__gallery-body">
                <div class="slider-gallery" data-swiper-gallery>
                  <button class="slider-gallery__close" data-swiper-gallery-close></button>
                  <div class="slider-gallery-main">
                    <div class="swiper-container" data-swiper-gallery-main>
                      <div class="swiper-wrapper">
                        <?php foreach ($gallery as $item): ?>
                        <div class="swiper-slide">
                          <img src="<?php echo $item['url'] ?>" alt="" />
                        </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                  <div class="slider-gallery-thumbs">
                    <button class="slider-gallery-thumbs__prev"></button>
                    <div class="swiper-container" data-swiper-gallery-thumbs>
                      <div class="swiper-wrapper">
                        <?php foreach ($gallery as $item): ?>
                        <div class="swiper-slide">
                          <img src="<?php echo $item['sizes']['thumbnail'] ?>" alt="" />
                        </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                    <button class="slider-gallery-thumbs__next"></button>
                    <div class="slider-gallery-thumbs__hr">
                      <div class="ui-hr ui-hr_small"></div>
                    </div>
                  </div>
                </div>
              </div>
              <?php endif; ?>

              <?php if ($news->have_posts()): ?>
              <div class="page-temples-details__news">
                <div class="articles-grid">
                  <?php foreach ($news->posts as $key => $item): ?>
                  <div class="articles-grid__cell">
                    <div class="articles-item articles-item_<?php echo $key + 1 ?>">
                      <?php if ($thumbnail = get_the_post_thumbnail($item, ['600', '340'])): ?>
                      <div class="articles-item__figure">
                        <?php echo $thumbnail ?>
                      </div>
                      <?php endif; ?>
                      <div class="articles-item__info">
                        <a href="<?php the_permalink($item) ?>" class="articles-item__title">
                          <?php echo get_the_title($item) ?>
                        </a>
                      </div>
                      <div class="articles-item__date">
                        <?php echo get_the_date('d.m.Y', $item) ?>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
              <?php endif; ?>

              <?php if (count($news->posts) > $news_per_page): ?>
              <div class="page-temples-details__pagination">
                <?php wp_pagenavi(['query' => $news]) ?>
              </div>
              <?php endif; ?>

              <?php if ('' !== get_post()->post_content): ?>
              <div class="page-temples-details__content content">
                <?php the_content() ?>
              </div>
              <?php endif; ?>
            </div>
          </div>

          <?php get_template_part('partials/footer'); ?>
        </div>
      </div>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
