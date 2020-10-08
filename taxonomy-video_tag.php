<?php
$current_tag = get_queried_object();
$calendar_params = [
  'url' => get_term_link($current_tag->term_id, $current_tag->taxonomy) . '?date=%year%-%month%-%day%'
];
$query_params = [
  'post_type' => 'video',
  'posts_per_page' => 10,
  'order' => 'DESC',
  'orderby' => 'date',
  'paged' => get_query_var('paged') ?: 1,
  'tax_query' => [
    'relation' => 'OR',
    [
			'taxonomy' => $current_tag->taxonomy,
			'field' => 'id',
			'terms' => [$current_tag->term_id]
    ]
  ]
];
if ($_GET['date']) {
  $filter_date = date_parse($_GET['date']);
  if ($filter_date['error_count'] == 0) {
    $calendar_params['year'] = $query_params['year'] = $filter_date['year'];
    $calendar_params['month'] = $query_params['monthnum'] = $filter_date['month'];
    $calendar_params['day'] = $query_params['day'] = $filter_date['day'];
  }
}
$query = new WP_Query($query_params);
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
        <div class="portray-section__bg"></div>

        <div class="container">
          <div class="portray-section-headline">
            <div class="breadcrumbs breadcrumbs_darken" typeof="BreadcrumbList" vocab="https://schema.org/">
              <?php bcn_display() ?>
            </div>
            <h1 class="portray-section-headline__title"><?php echo $current_tag->name ?></h1>
          </div>
        </div>

        <div class="page-sheet">
          <div class="container">
            <div class="video-section-main">
              <?php if ($current_tag->description): ?>
              <div class="video-section-main__excerpt">
                <?php echo $current_tag->description ?>
              </div>
              <?php endif; ?>
              <div class="video-section-main__content">
                <?php if ($current_tag->description): ?>
                  <div class="video-section-main__content-hr">
                    <div class="ui-hr"></div>
                  </div>
                <?php endif; ?>
                <?php if ($query->have_posts()): ?>
                <div class="video-section-main__content-list">
                  <div class="video-list">
                    <?php while ($query->have_posts()): $query->the_post(); ?>
                    <div class="video-item">
                      <div class="video-item__figure">
                        <?php the_field('video_source') ?>
                      </div>
                      <div class="video-item__date">
                        <?php the_date('d.m.Y') ?>
                      </div>
                      <div class="video-item__title">
                        <?php the_title() ?>
                      </div>
                      <?php $video_tags = get_the_terms(get_the_ID(), 'video_tag') ?>
                      <?php if (is_array($video_tags)): ?>
                        <div class="video-item__tags">
                          <?php foreach($video_tags as $video_tag): ?>
                          <a href="<?php echo get_term_link($video_tag->term_id, $video_tag->taxonomy) ?>"><?php echo $video_tag->name ?></a>
                          <?php endforeach; ?>
                        </div>
                      <?php endif; ?>
                    </div>
                    <?php endwhile; ?>
                  </div>
                  <?php wp_pagenavi(['query' => $query]) ?>
                </div>
                <?php endif; ?>
              </div>
              <div class="video-section-main__calendar">
                <div class="video-section-main__calendar-title">
                  <div class="section-headline section-headline_gray">
                    <div class="section-headline__title">Архив видео</div>
                  </div>
                </div>
                <div class="video-section-main__calendar-body">
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
                  <div class="video-section-main__calendar-desc">
                    <div class="ui-text-small">Выберите <em>год, месяц и число</em>, чтобы посмотреть публикации</div>
                  </div>
                </div>
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
