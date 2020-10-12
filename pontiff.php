<?php
/*
Template Name: Архиерей
*/

$biography_page_id = 356;
$photogallery_page_id = 359;

$ministration_category = get_term(31);
$latest_ministration_query = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => 5,
  'order' => 'DESC',
  'orderby' => 'date',
  'cat' => $ministration_category->term_id
]);

$preaching_category = get_term(32);
$latest_preaching_query = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => 5,
  'order' => 'DESC',
  'orderby' => 'date',
  'cat' => $preaching_category->term_id
]);

$news_category = get_term(33);
$latest_news_query = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => 5,
  'order' => 'DESC',
  'orderby' => 'date',
  'cat' => $news_category->term_id
]);

$video_category = get_term(14);
$latest_video_query = new WP_Query([
  'post_type' => 'video',
  'posts_per_page' => 5,
  'order' => 'DESC',
  'orderby' => 'date',
  'tax_query' => [
    [
			'taxonomy' => $video_category->taxonomy,
			'field' => 'id',
			'terms' => $video_category->term_id
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

      <div class="page-sheet">
        <div class="container">
          <?php get_template_part('partials/page-headline'); ?>

          <div class="grid-pontiff-root">
            <div class="grid-pontiff-root__desc">
              Управляющий Борисоглебской епархией Преосвященнейший Сергий, епископ Борисоглебский и Бутурлиновский
            </div>
            <div class="grid-pontiff-root__grid">
              <div class="grid-pontiff-sections">
                <div class="grid-pontiff-sections__biography">
                  <div class="card-oenone">
                    <?php if ($thumb = get_the_post_thumbnail($biography_page_id)): ?>
                    <div class="card-oenone__image">
                      <?php echo $thumb ?>
                    </div>
                    <?php endif; ?>
                    <a href="<?php the_permalink($biography_page_id) ?>" class="card-oenone__title"><?php echo get_the_title($biography_page_id) ?></a>
                  </div>
                </div>

                <div class="grid-pontiff-sections__ministration-and-preaching">
                  <div class="grid-pontiff-sections__ministration">
                    <?php if ($latest_ministration_query->posts): ?>
                    <div class="tiled-slider tiled-slider_orange" data-tiled-swiper>
                      <div class="swiper-container">
                        <div class="swiper-wrapper">
                          <?php foreach ($latest_ministration_query->posts as $item): ?>
                          <div class="swiper-slide tiled-slider-item" data-tiled-swiper-date="<?php echo get_the_date('d.m.', $item) . '<wbr />' . get_the_date('Y', $item) ?>">
                            <div class="tiled-slider-item__body">
                              <div class="tiled-slider-item__figure">
                                <?php echo get_the_post_thumbnail($item) ?>
                              </div>
                              <a href="<?php the_permalink($item) ?>" class="tiled-slider-item__title"><?php echo get_the_title($item) ?></a>
                            </div>
                          </div>
                          <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                      </div>
                      <a href="<?php echo get_term_link($ministration_category->term_id, $ministration_category->taxonomy) ?>" class="tiled-slider__category">
                        <span><?php echo $ministration_category->name ?></span>
                      </a>
                      <span class="tiled-slider__date"></span>
                    </div>
                    <?php endif; ?>
                  </div>
                  <div class="grid-pontiff-sections__preaching">
                    <?php if ($latest_preaching_query->posts): ?>
                    <div class="tiled-slider tiled-slider_red" data-tiled-swiper>
                      <div class="swiper-container">
                        <div class="swiper-wrapper">
                          <?php foreach ($latest_preaching_query->posts as $item): ?>
                          <div class="swiper-slide tiled-slider-item" data-tiled-swiper-date="<?php echo get_the_date('d.m.', $item) . '<wbr />' . get_the_date('Y', $item) ?>">
                            <div class="tiled-slider-item__body">
                              <div class="tiled-slider-item__figure">
                                <?php echo get_the_post_thumbnail($item) ?>
                              </div>
                              <a href="<?php the_permalink($item) ?>" class="tiled-slider-item__title"><?php echo get_the_title($item) ?></a>
                            </div>
                          </div>
                          <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                      </div>
                      <a href="<?php echo get_term_link($preaching_category->term_id, $preaching_category->taxonomy) ?>" class="tiled-slider__category">
                        <span><?php echo $preaching_category->name ?></span>
                      </a>
                      <span class="tiled-slider__date"></span>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="grid-pontiff-sections__photo">
                  <div class="card-oenone">
                    <?php if ($thumb = get_the_post_thumbnail($photogallery_page_id)): ?>
                    <div class="card-oenone__image">
                      <?php echo $thumb ?>
                    </div>
                    <?php endif; ?>
                    <a href="<?php the_permalink($photogallery_page_id) ?>" class="card-oenone__title"><?php echo get_the_title($photogallery_page_id) ?></a>
                  </div>
                </div>

                <div class="grid-pontiff-sections__news-and-video">
                  <div class="grid-pontiff-sections__news">
                    <?php if ($latest_news_query->posts): ?>
                    <div class="tiled-slider tiled-slider_blue" data-tiled-swiper>
                      <div class="swiper-container">
                        <div class="swiper-wrapper">
                          <?php foreach ($latest_news_query->posts as $item): ?>
                          <div class="swiper-slide tiled-slider-item" data-tiled-swiper-date="<?php echo get_the_date('d.m.', $item) . '<wbr />' . get_the_date('Y', $item) ?>">
                            <div class="tiled-slider-item__body">
                              <div class="tiled-slider-item__figure">
                                <?php echo get_the_post_thumbnail($item) ?>
                              </div>
                              <a href="<?php the_permalink($item) ?>" class="tiled-slider-item__title"><?php echo get_the_title($item) ?></a>
                            </div>
                          </div>
                          <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                      </div>
                      <a href="<?php echo get_term_link($news_category->term_id, $news_category->taxonomy) ?>" class="tiled-slider__category">
                        <span><?php echo $news_category->name ?></span>
                      </a>
                      <span class="tiled-slider__date"></span>
                    </div>
                    <?php endif; ?>
                  </div>
                  <div class="grid-pontiff-sections__video">
                    <?php if ($latest_video_query->posts): ?>
                    <div class="tiled-slider tiled-slider_green" data-tiled-swiper>
                      <div class="swiper-container">
                        <div class="swiper-wrapper">
                          <?php foreach ($latest_video_query->posts as $item): ?>
                          <div class="swiper-slide tiled-slider-item tiled-slider-item_has-nav" data-tiled-swiper-date="<?php echo get_the_date('d.m.', $item) . '<wbr />' . get_the_date('Y', $item) ?>">
                            <div class="tiled-slider-item__body">
                              <div class="tiled-slider-item__figure">
                                <?php print_oembed(get_field('video_source', $item)) ?>
                              </div>
                            </div>
                          </div>
                          <?php endforeach; ?>
                        </div>
                      </div>
                      <a href="<?php echo get_term_link($video_category->term_id, $video_category->taxonomy) ?>" class="tiled-slider__category">
                        <span>Видеоматериалы</span>
                      </a>
                      <span class="tiled-slider__date"></span>
                      <div class="tiled-slider__prev swiper-button-prev" data-tiled-swiper-prev></div>
                      <div class="tiled-slider__next swiper-button-next" data-tiled-swiper-next></div>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="grid-pontiff-root__content content">
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
