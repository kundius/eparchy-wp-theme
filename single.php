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

      <div class="portray-section">
        <div class="portray-section__bg"<?php if ($background = get_field('background')):?> style="background-image: url('<?php echo $background['url'] ?>')"<?php endif; ?>></div>
        
        <div class="container">
          <div class="portray-section-headline">
            <div class="breadcrumbs breadcrumbs_darken" typeof="BreadcrumbList" vocab="https://schema.org/">
              <?php bcn_display() ?>
            </div>
            <h1 class="portray-section-headline__title">
              <?php the_title() ?>
            </h1>
            <div class="portray-section-headline__meta">
              <div class="portray-section-headline__meta-date">
                Опубликовано: <?php the_date('d.m.Y') ?>
              </div>
              <?php $tags = get_the_terms(get_the_ID(), 'post_tag') ?>
              <?php if (is_array($tags)): ?>
              <div class="portray-section-headline__meta-tags">
                <?php foreach($tags as $tag): ?>
                <a href="<?php echo get_term_link($tag->term_id, $tag->taxonomy) ?>"><?php echo $tag->name ?></a>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="page-sheet">
          <div class="container">
            <div class="page-article-details">
              <div class="page-article-details__content content">
                <?php the_content() ?>
              </div>
              <div class="page-article-details__share">
                <script src="https://yastatic.net/share2/share.js"></script>
                <div class="ya-share2" data-curtain data-size="s" data-services="collections,vkontakte,facebook,odnoklassniki,messenger,twitter,viber,pinterest" data-image:pinterest="<?php the_post_thumbnail_url('full') ?>"></div>
              </div>
            </div>
          </div>

          <div class="page-article-materials">
            <div class="container">
              <div class="page-article-materials__title">
                <div class="section-headline section-headline_yellow">
                  <div class="section-headline__title">Материалы по теме:</div>
                </div>
              </div>
              <div class="page-article-materials__body">
                <?php if ($related->have_posts()): ?>
                <div class="materials-list">
                  <?php foreach ($related->posts as $item): ?>
                  <li class="materials-list-item">
                    <a href="<?php the_permalink($item) ?>" class="materials-list-item__title">
                      <div class="materials-list-item__icon">
                        <?php icon('document', 1.2) ?>
                      </div>
                      <?php echo get_the_title($item) ?>
                    </a>
                  </li>
                  <?php endforeach; ?>
                </div>
                <?php wp_pagenavi(['query' => $related]) ?>
                <?php endif; ?>
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
