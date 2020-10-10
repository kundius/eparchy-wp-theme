<?php
$category = get_queried_object();
$background = get_field('background', $category);
$date = get_field('date', $category);
$tags = get_field('tags', $category);
$calendar_params = [
  'url' =>  get_term_link($category->term_id, $category->taxonomy) . '?date=%year%-%month%-%day%'
];
$query_params = [
  'post_type' => 'post',
  'posts_per_page' => 10,
  'order' => 'DESC',
  'orderby' => 'date',
  'paged' => get_query_var('paged') ?: 1,
  'tax_query' => [
    'relation' => 'AND',
    [
			'taxonomy' => $category->taxonomy,
			'field' => 'id',
			'terms' => [$category->term_id]
    ]
  ]
];

if ($_GET['tags']) {
  $query_params['tax_query'][] = [
    'taxonomy' => 'post_tag',
    'field' => 'id',
    'operator' => 'AND',
    'terms' => explode(',', $_GET['tags'])
  ];
}

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
        <div class="portray-section__bg"<?php if (!empty($background)):?> style="background-image: url('<?php echo $background['url'] ?>')"<?php endif; ?>></div>
        
        <div class="container">
          <div class="portray-section-headline">
            <div class="breadcrumbs breadcrumbs_darken" typeof="BreadcrumbList" vocab="https://schema.org/">
              <?php bcn_display() ?>
            </div>
            <h1 class="portray-section-headline__title"><?php echo $category->name ?></h1>
            <?php if (!empty($date) || !empty($tags)): ?>
            <div class="portray-section-headline__meta">
              <?php if (!empty($date)): ?>
              <div class="portray-section-headline__meta-date">
                <?php echo $date ?>
              </div>
              <?php endif; ?>
              <?php if (!empty($tags)): ?>
              <div class="portray-section-headline__meta-tags">
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
            <div class="page-articles-section">
              <?php if ($category->description): ?>
              <div class="page-articles-section__excerpt">
                <?php echo $category->description ?>
              </div>
              <?php endif; ?>
              <div class="page-articles-section__content">
                <?php if ($category->description): ?>
                  <div class="page-articles-section__content-hr">
                    <div class="ui-hr"></div>
                  </div>
                <?php endif; ?>
                <?php if ($query->have_posts()): ?>
                <div class="page-articles-section__content-list">
                  <div class="articles-wide-grid">
                    <?php while ($query->have_posts()): $query->the_post(); ?>
                    <div class="articles-wide-item">
                      <div class="articles-wide-item__image">
                        <?php the_post_thumbnail([800, 460]) ?>
                      </div>
                      <div class="articles-wide-item__date">
                        <?php the_date('d.m.Y') ?>
                      </div>
                      <a href="<?php the_permalink() ?>" class="articles-wide-item__title">
                        <?php the_title() ?>
                      </a>
                      <?php $post_tags = get_the_terms(get_the_ID(), 'post_tag') ?>
                      <?php if (is_array($post_tags)): ?>
                        <div class="articles-wide-item__tags">
                          <?php foreach($post_tags as $post_tag): ?>
                          <a href="<?php echo get_term_link($post_tag->term_id, $post_tag->taxonomy) ?>"><?php echo $post_tag->name ?></a>
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
              <div class="page-articles-section__calendar">
                <div class="page-articles-section__calendar-title">
                  <div class="section-headline section-headline_gray">
                    <div class="section-headline__title">Архив статей</div>
                  </div>
                </div>
                <div class="page-articles-section__calendar-body">
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
                  <div class="page-articles-section__calendar-desc">
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
