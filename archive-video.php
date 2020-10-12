<?php
$latest_interview_query = new WP_Query([
  'post_type' => 'video',
  'posts_per_page' => 1,
  'order' => 'DESC',
  'orderby' => 'date',
  'tax_query' => [
    'relation' => 'OR',
    [
			'taxonomy' => 'video_category',
			'field' => 'id',
			'terms' => [17]
    ]
  ]
]);
$latest_interview = array_shift($latest_interview_query->posts);

$latest_speech_query = new WP_Query([
  'post_type' => 'video',
  'posts_per_page' => 5,
  'order' => 'DESC',
  'orderby' => 'date',
  'tax_query' => [
    'relation' => 'OR',
    [
			'taxonomy' => 'video_category',
			'field' => 'id',
			'terms' => [16]
    ]
  ]
]);

$latest_preaching_query = new WP_Query([
  'post_type' => 'video',
  'posts_per_page' => 5,
  'order' => 'DESC',
  'orderby' => 'date',
  'tax_query' => [
    'relation' => 'OR',
    [
			'taxonomy' => 'video_category',
			'field' => 'id',
			'terms' => [18]
    ]
  ]
]);

$latest_events_query = new WP_Query([
  'post_type' => 'video',
  'posts_per_page' => 4,
  'order' => 'DESC',
  'orderby' => 'date',
  'tax_query' => [
    'relation' => 'OR',
    [
			'taxonomy' => 'video_category',
			'field' => 'id',
			'terms' => [15]
    ]
  ]
]);

$categories = new WP_Term_Query([
	'taxonomy' => ['video_category'],
	'hide_empty' => false,
	'exclude_tree' => [14, 15]
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
          <div class="page-headline">
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
              <?php bcn_display() ?>
            </div>
            <h1 class="page-headline__title">Видеоматериалы</h1>
            <div class="ui-hr"></div>
          </div>

          <div class="grid-video-root">
            <div class="grid-video-root__pontiff-title">
              <div class="section-headline section-headline_blue">
                <div class="section-headline__title">Епархиальный архиерей</div>
              </div>
            </div>
            <div class="grid-video-root__pontiff-body">
              <div class="grid-video-pontiff">
                <div class="grid-video-pontiff__interview">
                  <?php if ($latest_interview): ?>
                  <div class="card-melissa">
                    <div class="card-melissa__video">
                      <?php print_oembed(get_field('video_source', $latest_interview)) ?>
                    </div>
                    <div class="card-melissa__info">
                      <div class="card-melissa__header">
                        <div class="card-melissa__title"><?php echo $latest_interview->post_title ?></div>
                        <div class="card-melissa__date"><?php echo get_the_date('d.m.Y', $latest_interview) ?></div>
                      </div>
                      <div class="card-melissa__footer">
                        <?php if ($section = get_term(17)): ?>
                        <a href="<?php echo get_term_link($section->term_id, $section->taxonomy) ?>" class="card-melissa__section"><?php echo $section->name ?></a>
                        <?php if ($parent = get_term($section->parent)): ?>
                        <a href="<?php echo get_term_link($parent->term_id, $parent->taxonomy) ?>" class="card-melissa__parent"><?php echo $parent->name ?></a>
                        <?php endif; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>
                </div>
                <div class="grid-video-pontiff__speech-and-preaching">
                  <div class="grid-video-pontiff__speech">
                    <?php if ($latest_speech_query->posts): ?>
                    <div class="tiled-slider tiled-slider_orange" data-tiled-swiper>
                      <div class="swiper-container">
                        <div class="swiper-wrapper">
                          <?php foreach ($latest_speech_query->posts as $item): ?>
                          <div class="swiper-slide tiled-slider-item" data-tiled-swiper-date="<?php echo get_the_date('d.m.', $item) . '<wbr />' . get_the_date('Y', $item) ?>">
                            <div class="tiled-slider-item__body">
                              <div class="tiled-slider-item__figure">
                                <?php print_oembed(get_field('video_source', $item)) ?>
                              </div>
                              <div class="tiled-slider-item__title"><?php echo get_the_title($item) ?></div>
                            </div>
                          </div>
                          <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                      </div>
                      <?php if ($items_category = get_term(16)): ?>
                      <a href="<?php echo get_term_link($items_category->term_id, $items_category->taxonomy) ?>" class="tiled-slider__category">
                        <span><?php echo $items_category->name ?></span>
                      </a>
                      <?php endif; ?>
                      <span class="tiled-slider__date"></span>
                    </div>
                    <?php endif; ?>
                  </div>
                  <div class="grid-video-pontiff__preaching">
                    <?php if ($latest_preaching_query->posts): ?>
                    <div class="tiled-slider tiled-slider_red" data-tiled-swiper>
                      <div class="swiper-container">
                        <div class="swiper-wrapper">
                          <?php foreach ($latest_preaching_query->posts as $item): ?>
                          <div class="swiper-slide tiled-slider-item" data-tiled-swiper-date="<?php echo get_the_date('d.m.', $item) . '<wbr />' . get_the_date('Y', $item) ?>">
                            <div class="tiled-slider-item__body">
                              <div class="tiled-slider-item__figure">
                                <?php print_oembed(get_field('video_source', $item)) ?>
                              </div>
                              <div class="tiled-slider-item__title"><?php echo get_the_title($item) ?></div>
                            </div>
                          </div>
                          <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                      </div>
                      <?php if ($items_category = get_term(18)): ?>
                      <a href="<?php echo get_term_link($items_category->term_id, $items_category->taxonomy) ?>" class="tiled-slider__category">
                        <span><?php echo $items_category->name ?></span>
                      </a>
                      <?php endif; ?>
                      <span class="tiled-slider__date"></span>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="grid-video-root__latest-title">
              <div class="section-headline section-headline_green">
                <div class="section-headline__title">Богослужения и события епархиальной жизни</div>
              </div>
            </div>
            <div class="grid-video-root__latest-body">
              <?php if ($latest_events_query->posts): ?>
              <div class="video-events">
                <?php foreach ($latest_events_query->posts as $key => $item): ?>
                <?php if ($key == 0): ?>
                <div class="video-events-first">
                  <div class="video-events-first__header">
                    <div class="video-events-first__header-item"><?php echo get_the_date('d.m.Y', $item) ?></div>
                    <div class="video-events-first__header-item"><?php print_time_ago($item) ?></div>
                  </div>
                  <div class="video-events-first__body">
                    <div class="video-events-first__figure">
                      <?php print_oembed(get_field('video_source', $item)) ?>
                    </div>
                    <?php $video_tags = get_the_terms($item->ID, 'video_tag') ?>
                    <?php if (is_array($video_tags)): ?>
                      <div class="video-events-first__tags">
                        <?php foreach($video_tags as $video_tag): ?>
                        <a href="<?php echo get_term_link($video_tag->term_id, $video_tag->taxonomy) ?>"><?php echo $video_tag->name ?></a>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>
                    <div class="video-events-first__title"><?php echo get_the_title($item) ?></div>
                  </div>
                </div>
                <?php endif; ?>
                <?php if ($key == 1): ?>
                <div class="video-events-second">
                  <div class="video-events-second__header">
                    <div class="video-events-second__header-item"><?php echo get_the_date('d.m.Y', $item) ?></div>
                    <div class="video-events-second__header-item"><?php print_time_ago($item) ?></div>
                  </div>
                  <div class="video-events-second__figure">
                    <?php print_oembed(get_field('video_source', $item)) ?>
                  </div>
                  <?php $video_categories = get_the_terms($item->ID, 'video_category') ?>
                  <?php if (is_array($video_categories)): ?>
                  <a class="video-events-second__category" href="<?php echo get_term_link($video_categories[0]->term_id, $video_categories[0]->taxonomy) ?>">смотреть все</a>
                  <?php endif; ?>
                  <div class="video-events-second__title"><?php echo get_the_title($item) ?></div>
                  <?php $video_tags = get_the_terms($item->ID, 'video_tag') ?>
                  <?php if (is_array($video_tags)): ?>
                  <div class="video-events-second__tags">
                    <?php foreach($video_tags as $video_tag): ?>
                    <a href="<?php echo get_term_link($video_tag->term_id, $video_tag->taxonomy) ?>"><?php echo $video_tag->name ?></a>
                    <?php endforeach; ?>
                  </div>
                  <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if ($key == 2): ?>
                <div class="video-events-third">
                  <div class="video-events-third__header">
                    <?php echo get_the_date('d.m.Y', $item) ?>
                  </div>
                  <div class="video-events-third__figure">
                    <?php print_oembed(get_field('video_source', $item)) ?>
                  </div>
                  <div class="video-events-third__title"><?php echo get_the_title($item) ?></div>
                  <?php $video_tags = get_the_terms($item->ID, 'video_tag') ?>
                  <?php if (is_array($video_tags)): ?>
                    <div class="video-events-third__tags">
                      <?php foreach($video_tags as $video_tag): ?>
                      <a href="<?php echo get_term_link($video_tag->term_id, $video_tag->taxonomy) ?>"><?php echo $video_tag->name ?></a>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if ($key == 3): ?>
                <div class="video-events-fourth">
                  <div class="video-events-fourth__header">
                    <?php echo get_the_date('d.m.Y', $item) ?>
                  </div>
                  <div class="video-events-fourth__figure">
                    <?php print_oembed(get_field('video_source', $item)) ?>
                    <?php $video_tags = get_the_terms($item->ID, 'video_tag') ?>
                    <?php if (is_array($video_tags)): ?>
                    <div class="video-events-fourth__tags">
                      <?php foreach($video_tags as $video_tag): ?>
                      <a href="<?php echo get_term_link($video_tag->term_id, $video_tag->taxonomy) ?>"><?php echo $video_tag->name ?></a>
                      <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                  </div>
                  <div class="video-events-fourth__title"><?php echo get_the_title($item) ?></div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="video-sections-wrapper">
          <div class="container">
            <div class="grid-video-sections">
              <?php foreach ($categories->terms as $key => $category): ?>
              <div class="grid-video-sections__cell">
                <div class="card-oedipus card-oedipus_<?php echo $key ?>">
                  <?php if ($image = get_field('thumb', $category)): ?>
                  <div class="card-oedipus__image">
                    <img src="<?php echo $image['url'] ?>" alt="" />
                  </div>
                  <?php endif; ?>
                  <div class="card-oedipus__info">
                    <a href="<?php echo get_term_link($category->term_id, $category->taxonomy) ?>" class="card-oedipus__title"><?php echo $category->name ?></a>
                    <div class="card-oedipus__footer">
                      <?php if ($tags = get_field('tags', $category)): ?>
                      <div class="card-oedipus__tags">
                        <?php foreach ($tags as $tag): ?>
                        <a href="<?php echo get_term_link($tag->term_id, $tag->taxonomy) ?>"><?php echo $tag->name ?></a>
                        <?php endforeach; ?>
                      </div>
                      <?php endif; ?>
                      <?php if ($date = get_field('date', $category)): ?>
                      <div class="card-oedipus__date">
                        <?php echo $date ?>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

        <?php get_template_part('partials/footer'); ?>
      </div>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
