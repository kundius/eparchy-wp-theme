<?php
$latest_news_count = get_field('latest_news_count', 'options');
$primary_news = get_field('primary_news', 'options');
$primary_news_groups = array_chunk($primary_news, 4);
$eparchy_news_term_id = 40;
$deaneries_news_term_id = 41;
$publications_term_id = 26;
$talks_term_id = 42;
$news_term_id = 23;
$analytics_term_id = 35;
$temples_page_id = 228;
$calendar_params = [
  'url' =>  get_term_link($publications_term_id, 'category') . '?date=%year%-%month%-%day%'
];

$latest_news = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => $latest_news_count,
  'order' => 'DESC',
  'orderby' => 'date',
  'cat' => $news_term_id
]);
$latest_news_groups = array_chunk($latest_news->posts, 4);

$eparchy_news = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => 5,
  'order' => 'DESC',
  'orderby' => 'date',
  'cat' => $eparchy_news_term_id
]);

$latest_analytics = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => 11,
  'order' => 'DESC',
  'orderby' => 'date',
  'cat' => $analytics_term_id
]);

$deaneries_news = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => 8,
  'order' => 'DESC',
  'orderby' => 'date',
  'cat' => $deaneries_news_term_id
]);
$deaneries_news_primary = array_shift($deaneries_news->posts);

$temples_sections = new WP_Query([
  'post_type' => 'page',
  'post_parent' => $temples_page_id,
  'posts_per_page' => -1,
  'orderby' => ['menu_order' => 'ASC']
]);

$latest_talks = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => 5,
  'order' => 'DESC',
  'orderby' => 'date',
  'cat' => $talks_term_id
]);

$latest_publications_not_in = array_map(function ($item) {
  return $item->ID;
}, $latest_talks->posts);
$latest_publications = new WP_Query([
  'post_type' => 'post',
  'posts_per_page' => 6,
  'order' => 'DESC',
  'orderby' => 'date',
  'post__not_in' => $latest_publications_not_in,
  'cat' => $publications_term_id
]);
$latest_publications_primary = array_shift($latest_publications->posts);

$video_category = get_term(17);
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

      <div class="home-intro">
        <div class="container">
          <div class="home-intro__body">
            <div class="intro-news">
              <div class="intro-news__title">Новости</div>
              <div class="intro-news-swiper swiper-container js-intro-news-swiper">
                <div class="swiper-wrapper">
                  <?php foreach ($primary_news_groups as $group): ?>
                  <div class="swiper-slide">
                    <div class="intro-news-grid">
                      <div class="intro-news-grid__secondary">
                        <div class="intro-news-grid-secondary">
                          <?php if (!empty($group[0])): ?>
                          <div class="intro-news-item-s">
                            <?php if ($thumbnail = get_the_post_thumbnail($group[0], 'w80h80')): ?>
                            <div class="intro-news-item-s__figure">
                              <?php echo $thumbnail ?>
                            </div>
                            <?php endif; ?>
                            <div class="intro-news-item-s__date"><?php echo get_the_date('d.m.Y', $group[0]) ?></div>
                            <a class="intro-news-item-s__title" href="<?php the_permalink($group[0]) ?>"><?php echo get_the_title($group[0]) ?></a>
                          </div>
                          <?php endif; ?>
                          <?php if (!empty($group[1])): ?>
                          <div class="intro-news-item-s">
                            <?php if ($thumbnail = get_the_post_thumbnail($group[1], 'w80h80')): ?>
                            <div class="intro-news-item-s__figure">
                              <?php echo $thumbnail ?>
                            </div>
                            <?php endif; ?>
                            <div class="intro-news-item-s__date"><?php echo get_the_date('d.m.Y', $group[1]) ?></div>
                            <a class="intro-news-item-s__title" href="<?php the_permalink($group[1]) ?>"><?php echo get_the_title($group[1]) ?></a>
                          </div>
                          <?php endif; ?>
                          <?php if (!empty($group[2])): ?>
                          <div class="intro-news-item-s">
                            <?php if ($thumbnail = get_the_post_thumbnail($group[2], 'w80h80')): ?>
                            <div class="intro-news-item-s__figure">
                              <?php echo $thumbnail ?>
                            </div>
                            <?php endif; ?>
                            <div class="intro-news-item-s__date"><?php echo get_the_date('d.m.Y', $group[2]) ?></div>
                            <a class="intro-news-item-s__title" href="<?php the_permalink($group[2]) ?>"><?php echo get_the_title($group[2]) ?></a>
                          </div>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div class="intro-news-grid__primary">
                        <?php if (!empty($group[3])): ?>
                        <div class="intro-news-item-m">
                          <?php if ($thumbnail = get_the_post_thumbnail($group[3], 'w360h360')): ?>
                          <div class="intro-news-item-m__figure">
                            <?php echo $thumbnail ?>
                          </div>
                          <?php endif; ?>
                          <a class="intro-news-item-m__title" href="<?php the_permalink($group[3]) ?>"><?php echo get_the_title($group[3]) ?></a>
                          <div class="intro-news-item-m__footer">
                            <div class="intro-news-item-m__date"><?php echo get_the_date('d.m.Y', $group[3]) ?></div>
                            <div class="intro-news-item-m__ago"><?php print_time_ago($group[3]) ?></div>
                          </div>
                        </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="intro-news-swiper__pagination">
                  <div class="swiper-pagination"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="page-sheet home-page-sheet">
        <div class="container">
          <div class="home-news">
            <div class="home-news__relevant-title">
                <div class="section-headline section-headline_gray">
                  <div class="section-headline__title">Актуальные новости</div>
                  <a href="<?php echo get_term_link($news_term_id) ?>" class="section-headline__link">смотреть все</a>
                  <div class="ui-visible@s"></div>
                </div>
            </div>

            <div class="home-news__relevant-body">
              <div class="latest-news">
                <div class="swiper-container js-latest-news-swiper">
                  <div class="swiper-wrapper">
                    <?php foreach ($latest_news_groups as $group): ?>
                    <div class="swiper-slide">
                      <div class="ui-grid ui-grid-small ui-grid-medium@s ui-grid-large@m">
                        <div class="ui-width-1-1 ui-width-1-3@s">
                          <?php if (!empty($group[0])): ?>
                          <div class="latest-news-m">
                            <div class="latest-news-m__head">
                              <div class="latest-news-m__head-date"><?php echo get_the_date('d.m.Y', $group[0]) ?></div>
                              <div class="latest-news-m__head-ago"><?php print_time_ago($group[0]) ?></div>
                            </div>
                            <?php if ($thumbnail = get_the_post_thumbnail($group[0], 'w360h240')): ?>
                            <div class="latest-news-m__figure">
                              <?php echo $thumbnail ?>
                            </div>
                            <?php endif; ?>
                            <a class="latest-news-m__title" href="<?php the_permalink($group[0]) ?>"><?php echo get_the_title($group[0]) ?></a>
                          </div>
                          <?php endif; ?>
                        </div>
                        <div class="ui-width-1-1 ui-width-1-3@s">
                          <?php if (!empty($group[1])): ?>
                          <div class="latest-news-l">
                            <div class="latest-news-l__head">
                              <div class="latest-news-l__head-date"><?php echo get_the_date('d.m.Y', $group[1]) ?></div>
                              <div class="latest-news-l__head-ago"><?php print_time_ago($group[1]) ?></div>
                            </div>
                            <?php if ($thumbnail = get_the_post_thumbnail($group[1], 'w360h360')): ?>
                            <div class="latest-news-l__figure">
                              <?php echo $thumbnail ?>
                            </div>
                            <?php endif; ?>
                            <div class="latest-news-l__info">
                              <div class="latest-news-l__info-day"><?php echo get_the_date('d', $group[1]) ?></div>
                              <div>
                                <div class="latest-news-l__info-date"><?php echo get_the_date('F ‘y', $group[1]) ?></div>
                                <a class="latest-news-l__info-title" href="<?php the_permalink($group[1]) ?>"><?php echo get_the_title($group[1]) ?></a>
                              </div>
                            </div>
                          </div>
                          <?php endif; ?>
                        </div>
                        <div class="ui-width-1-2 ui-width-1-6@s">
                          <?php if (!empty($group[2])): ?>
                          <div class="latest-news-s">
                            <div class="latest-news-s__date"><?php echo get_the_date('d.m.Y', $group[2]) ?></div>
                            <?php if ($thumbnail = get_the_post_thumbnail($group[2], 'w360h360')): ?>
                            <div class="latest-news-s__figure">
                              <?php echo $thumbnail ?>
                            </div>
                            <?php endif; ?>
                            <a class="latest-news-s__title" href="<?php the_permalink($group[2]) ?>"><?php echo get_the_title($group[2]) ?></a>
                          </div>
                          <?php endif; ?>
                        </div>
                        <div class="ui-width-1-2 ui-width-1-6@s">
                          <?php if (!empty($group[3])): ?>
                          <div class="latest-news-s">
                            <div class="latest-news-s__date"><?php echo get_the_date('d.m.Y', $group[3]) ?></div>
                            <?php if ($thumbnail = get_the_post_thumbnail($group[3], 'w360h360')): ?>
                            <div class="latest-news-s__figure">
                              <?php echo $thumbnail ?>
                            </div>
                            <?php endif; ?>
                            <a class="latest-news-s__title" href="<?php the_permalink($group[3]) ?>"><?php echo get_the_title($group[3]) ?></a>
                          </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
                  <div class="latest-news__nav">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="home-news__eparchy-title">
              <div class="section-headline section-headline_blue">
                <div class="section-headline__title">Новости епархии</div>
                <a href="<?php echo get_term_link($eparchy_news_term_id) ?>" class="section-headline__link">смотреть все</a>
              </div>
            </div>

            <div class="home-news__eparchy-body">
              <div class="eparchy-news">
                <?php foreach ($eparchy_news->posts as $key => $item): ?>
                <?php if ($key == 0): ?>
                <div class="eparchy-news-item-l">
                  <?php if ($thumbnail = get_the_post_thumbnail($item, 'w800h800')): ?>
                  <div class="eparchy-news-item-l__figure">
                    <?php echo $thumbnail ?>
                  </div>
                  <?php endif; ?>
                  <a href="<?php the_permalink($item) ?>" class="eparchy-news-item-l__title"><?php echo get_the_title($item) ?></a>
                </div>
                <?php else: ?>
                <div class="eparchy-news-item-m">
                  <?php if ($thumbnail = get_the_post_thumbnail($item, 'w300h300')): ?>
                  <div class="eparchy-news-item-m__figure">
                    <?php echo $thumbnail ?>
                  </div>
                  <?php endif; ?>
                  <div class="eparchy-news-item-m__info">
                    <?php $tags = get_the_terms($item, 'post_tag') ?>
                    <?php if (is_array($tags)): ?>
                    <div class="eparchy-news-item-m__rubrics">
                      <?php foreach($tags as $ag): ?>
                      <a href="<?php echo get_term_link($ag->term_id, $ag->taxonomy) ?>"><?php echo $ag->name ?></a>
                      <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <a href="<?php the_permalink($item) ?>" class="eparchy-news-item-m__title"><?php echo get_the_title($item) ?></a>
                    <div class="eparchy-news-item-m__date"><?php echo get_the_date('d F Y', $item) ?></div>
                  </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="home-news__deans-title">
              <div class="section-headline section-headline_green">
                <div class="section-headline__title">Новости благочиний</div>
                <a href="<?php echo get_term_link($deaneries_news_term_id) ?>" class="section-headline__link">смотреть все</a>
              </div>
            </div>

            <div class="home-news__deans-body">
              <?php if ($deaneries_news_primary): ?>
              <div class="card-aegle">
                <div class="card-aegle__date">
                  <div><?php echo get_the_date('d.m.Y', $deaneries_news_primary) ?></div>
                  <div><?php print_time_ago($deaneries_news_primary) ?></div>
                </div>
                <?php if ($thumbnail = get_the_post_thumbnail($deaneries_news_primary, ['600', '340'])): ?>
                <div class="card-aegle__figure">
                  <?php echo $thumbnail ?>
                </div>
                <?php endif; ?>
                <a href="<?php the_permalink($deaneries_news_primary) ?>" class="card-aegle__title">
                  <?php echo get_the_title($deaneries_news_primary) ?>
                </a>
                <?php if ($excerpt = get_the_excerpt($deaneries_news_primary)): ?>
                <div class="card-aegle__desc"><?php echo $excerpt ?></div>
                <?php endif; ?>
              </div>

              <div class="home-news__deans-hr">
                <div class="ui-hr"></div>
              </div>
              <?php endif; ?>

              <div class="home-news__deans-news-and-banners">
                <div class="home-news__deans-news">
                  <div class="deans-news-list">
                    <?php foreach ($deaneries_news->posts as $item): ?>
                    <div class="deans-news-item">
                      <?php if ($thumbnail = get_the_post_thumbnail($item, 'w80h80')): ?>
                      <div class="deans-news-item__figure">
                        <?php echo $thumbnail ?>
                      </div>
                      <?php endif; ?>
                      <div class="deans-news-item__info">
                        <div class="deans-news-item__headline">
                          <div class="deans-news-item__date"><?php echo get_the_date('d.m.Y', $item) ?></div>
                          <?php if (is_array($tags)): ?>
                          <div class="deans-news-item__rubrics">
                            <?php foreach($tags as $ag): ?>
                            <a href="<?php echo get_term_link($ag->term_id, $ag->taxonomy) ?>"><?php echo $ag->name ?></a>
                            <?php endforeach; ?>
                          </div>
                          <?php endif; ?>
                        </div>
                        <a href="<?php the_permalink($item) ?>" class="deans-news-item__title"><?php echo get_the_title($item) ?></a>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
                </div>
                <div class="home-news__deans-banners">
                  <div class="deans-banners">
                    <div class="deans-banners-swiper">
                      <div class="swiper-container js-deans-banners-swiper">
                        <div class="swiper-wrapper">
                          <?php foreach ($temples_sections->posts as $item): ?>
                          <div class="swiper-slide">
                            <a href="<?php the_permalink($item) ?>" class="deans-banners-swiper-item">
                              <?php if ($thumbnail = get_the_post_thumbnail($item, 'w200h500')): ?>
                              <span class="deans-banners-swiper-item__image">
                                <?php echo $thumbnail ?>
                              </span>
                              <?php endif; ?>
                              <span class="deans-banners-swiper-item__title">
                                <?php echo get_the_title($item) ?>
                              </span>
                            </a>
                          </div>
                          <?php endforeach; ?>
                        </div>
                      </div>
                      <div class="deans-banners-swiper__nav">
                        <div class="swiper-button-prev js-deans-banners-swiper-prev"></div>
                        <div class="swiper-button-next js-deans-banners-swiper-next"></div>
                      </div>
                    </div>
                    <div class="deans-banners-group">
                      <a href="http://tv-soyuz.ru/" class="deans-banners-union">Православный телеканал «Союз»</a>
                      <a href="<?php the_permalink(542) ?>" class="deans-banners-ways">Маршруты<br />паломничества</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="home-publications">
            <div class="home-publications__articles-title">
              <div class="section-headline section-headline_gray">
                <div class="section-headline__title">Беседы, публикации</div>
                <a href="<?php echo get_term_link($publications_term_id) ?>" class="section-headline__link">смотреть все</a>
              </div>
            </div>

            <div class="home-publications__articles-latest">
              <div class="latest-publication">
                <?php if ($thumbnail = get_the_post_thumbnail($latest_publications_primary, 'w360h240')): ?>
                <div class="latest-publication__figure">
                  <?php echo $thumbnail ?>
                </div>
                <?php endif; ?>
                <div class="latest-publication__date"><?php echo get_the_date('d.m.Y', $latest_publications_primary) ?></div>
                <a class="latest-publication__title" href="<?php the_permalink($latest_publications_primary) ?>"><?php echo get_the_title($latest_publications_primary) ?></a>
                <?php if ($excerpt = get_the_excerpt($latest_publications_primary)): ?>
                <div class="latest-publication__desc"><?php echo $excerpt ?></div>
                <?php endif; ?>
              </div>

              <div class="home-publications__articles-more">
                <a href="<?php echo get_term_link($publications_term_id) ?>" class="more-button"><span></span>Больше</a>
              </div>
            </div>

            <div class="home-publications__sliders">
              <div class="home-publications__talks">
                <div class="tiled-slider tiled-slider_orange" data-tiled-swiper>
                  <div class="swiper-container">
                    <div class="swiper-wrapper">
                      <?php foreach ($latest_talks->posts as $item): ?>
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
                  <a href="<?php echo get_term_link($talks_term_id, 'category') ?>" class="tiled-slider__category">
                    <span><?php echo get_term($talks_term_id)->name ?></span>
                  </a>
                  <span class="tiled-slider__date"></span>
                </div>
              </div>

              <div class="home-publications__articles">
                <div class="tiled-slider tiled-slider_red" data-tiled-swiper>
                  <div class="swiper-container">
                    <div class="swiper-wrapper">
                      <?php foreach ($latest_publications->posts as $item): ?>
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
                  <a href="<?php echo get_term_link($publications_term_id, 'category') ?>" class="tiled-slider__category">
                    <span><?php echo get_term($publications_term_id)->name ?></span>
                  </a>
                  <span class="tiled-slider__date"></span>
                </div>
              </div>

              <div class="home-publications__interviews">
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
                    <span><?php echo $video_category->name ?></span>
                  </a>
                  <span class="tiled-slider__date"></span>
                  <div class="tiled-slider__prev swiper-button-prev" data-tiled-swiper-prev></div>
                  <div class="tiled-slider__next swiper-button-next" data-tiled-swiper-next></div>
                </div>
              </div>
            </div>

            <div class="home-publications__calendar-title">
              <div class="section-headline section-headline_gray">
                <div class="section-headline__title">Архив статей</div>
              </div>
            </div>

            <div class="home-publications__calendar-body">
              <div class="archive-calendar" data-archive-calendar='<?php echo json_encode($calendar_params) ?>'>
                <div class="archive-calendar__headline">
                  <button class="archive-calendar__headline-prev" data-archive-calendar-prev-year></button>
                  <div class="archive-calendar__headline-year" data-archive-calendar-year></div>
                  <button class="archive-calendar__headline-next" data-archive-calendar-next-year></button>
                </div>
                <div class="archive-calendar__body">
                  <div class="archive-calendar__months" data-archive-calendar-months>
                    <button>Янв</button>
                    <button>февр</button>
                    <button>март</button>
                    <button>Апр</button>
                    <button>май</button>
                    <button>Июн</button>
                    <button>Июл</button>
                    <button>Авг</button>
                    <button>Сент</button>
                    <button>Окт</button>
                    <button>Нояб</button>
                    <button>дек</button>
                  </div>
                  <div class="archive-calendar__days" data-archive-calendar-days></div>
                </div>
              </div>

              <div class="home-publications__calendar-desc">
                <div class="ui-text-small">Выберите <em>год, месяц и число</em>, чтобы посмотреть публикации</div>
              </div>
            </div>
          </div>

          <div class="home-ecalendar">
            <div class="home-ecalendar__title">
              <div class="section-headline section-headline_gray">
                <div class="section-headline__title">Епархиальный календарь</div>
              </div>
            </div>

            <div class="home-ecalendar__body">
              <div class="tabs-panel" data-tabs>
                <div class="tabs-panel__head">
                  <div class="tabs-panel__head-item active" data-tabs-switch="first">
                    Месяцеслов
                    <span></span>
                  </div>
                  <div class="tabs-panel__head-item" data-tabs-switch="second">
                    Церковные праздники, епархиальные памятные даты, торжества
                  </div>
                </div>
                <div class="tabs-panel__body">
                  <div class="tabs-panel__body-item active" data-tabs-body="first">
                    <div class="ecalendar" data-ecalendar>
                      <div class="ecalendar__legend-and-control">
                        <div class="ecalendar-legend">
                          <div class="ecalendar-legend__row ecalendar-legend__row_current">Текущая дата</div>
                          <div class="ecalendar-legend__row ecalendar-legend__row_primary">Главные праздники</div>
                          <div class="ecalendar-legend__row ecalendar-legend__row_weeks">Сплошные седмицы</div>
                          <div class="ecalendar-legend__row ecalendar-legend__row_post">Дни поста</div>
                          <div class="ecalendar-legend__row ecalendar-legend__row_memorial">Дни особого<br />поминовения<br />усопших</div>
                        </div>

                        <div class="ecalendar-control">
                          <div class="ecalendar-control__headline">
                            <button class="ecalendar-control__headline-prev" data-ecalendar-backward></button>
                            <div class="ecalendar-control__headline-year" data-ecalendar-date></div>
                            <button class="ecalendar-control__headline-next" data-ecalendar-forward></button>
                          </div>
                          <div class="ecalendar-control__body" data-ecalendar-body>

                          </div>
                        </div>
                      </div>

                      <div class="ecalendar-content" data-ecalendar-content></div>
                    </div>
                  </div>
                  <div class="tabs-panel__body-item" data-tabs-body="second">
                    <div class="ecalendar" data-ecalendar>
                      <div class="ecalendar__legend-and-control">
                        <div class="ecalendar-legend">
                          <div class="ecalendar-legend__row ecalendar-legend__row_current">Текущая дата</div>
                          <div class="ecalendar-legend__row ecalendar-legend__row_primary">Главные праздники</div>
                          <div class="ecalendar-legend__row ecalendar-legend__row_weeks">Сплошные седмицы</div>
                          <div class="ecalendar-legend__row ecalendar-legend__row_post">Дни поста</div>
                          <div class="ecalendar-legend__row ecalendar-legend__row_memorial">Дни особого<br />поминовения<br />усопших</div>
                        </div>

                        <div class="ecalendar-control">
                          <div class="ecalendar-control__headline">
                            <button class="ecalendar-control__headline-prev" data-ecalendar-backward></button>
                            <div class="ecalendar-control__headline-year" data-ecalendar-date></div>
                            <button class="ecalendar-control__headline-next" data-ecalendar-forward></button>
                          </div>
                          <div class="ecalendar-control__body" data-ecalendar-body>

                          </div>
                        </div>
                      </div>

                      <div class="ecalendar-content" data-ecalendar-content></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php if ($latest_analytics->have_posts()): ?>
          <div class="home-analytics">
            <div class="home-analytics__title">
              <div class="section-headline section-headline_yellow">
                <div class="section-headline__title">Актуальная аналитика</div>
                <a href="<?php echo get_term_link($analytics_term_id) ?>" class="section-headline__link">смотреть все</a>
                <div class="ui-visible@s"></div>
              </div>
            </div>

            <div class="home-analytics__body">
              <div class="grid-articles">
                <?php foreach ($latest_analytics->posts as $key => $item): ?>
                <div class="grid-articles__cell">
                  <div class="card-demeter card-demeter_<?php echo $key + 1 ?>">
                    <?php if ($thumbnail = get_the_post_thumbnail($item, ['600', '340'])): ?>
                    <div class="card-demeter__figure">
                      <?php echo $thumbnail ?>
                    </div>
                    <?php endif; ?>
                    <div class="card-demeter__info">
                      <a href="<?php the_permalink($item) ?>" class="card-demeter__title">
                        <?php echo get_the_title($item) ?>
                      </a>
                    </div>
                    <div class="card-demeter__date">
                      <?php echo get_the_date('d.m.Y', $item) ?>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>

        <?php get_template_part('partials/footer'); ?>
      </div>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
