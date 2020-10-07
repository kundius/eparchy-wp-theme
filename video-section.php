<?php
/*
Template Name: Раздел видео
*/
$date = get_field('date');
$tags = get_field('video_tags');
$background = get_field('background');
$url = get_the_permalink(get_the_ID());

$calendar_params = [
  'url' =>  $url . '?date=%year%-%month%-%day%'
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
			'taxonomy' => 'video_tag',
			'field' => 'slug',
			'terms' => array_map(function ($item) {
        return $item->slug;
      }, $tags)
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

      <?php if (have_posts()): while (have_posts()): the_post(); ?>
      <div class="video-section">
        <div class="video-section__bg"<?php if (!empty($background)):?> style="background-image: url('<?php echo $background['url'] ?>')"<?php endif; ?>></div>

        <div class="container">
          <div class="video-section-headline">
            <div class="breadcrumbs breadcrumbs_darken" typeof="BreadcrumbList" vocab="https://schema.org/">
              <?php bcn_display() ?>
            </div>
            <h1 class="video-section-headline__title"><?php the_title() ?></h1>
            <?php if (!empty($date) || !empty($tags)): ?>
            <div class="video-section-headline__meta">
              <?php if (!empty($date)): ?>
              <div class="video-section-headline__meta-date">
                <?php echo $date ?>
              </div>
              <?php endif; ?>
              <?php if (!empty($tags)): ?>
              <div class="video-section-headline__meta-tags">
                <?php foreach ($tags as $tag): ?>
                <a href="<?php echo get_term_link($tag->term_id, $tag->taxonomy) ?>"><?php echo $tag->name ?></a>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="page-sheet">
          <div class="container">
            <div class="video-section-main">
              <?php if (has_excerpt()): ?>
              <div class="video-section-main__excerpt">
                <?php the_excerpt() ?>
              </div>
              <?php endif; ?>
              <div class="video-section-main__content">
                <?php if (has_excerpt()): ?>
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
                <?php if ('' !== get_post()->post_content): ?>
                <div class="video-section-main__content-text">
                  <?php the_content() ?>
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
      <?php endwhile; endif; ?>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
