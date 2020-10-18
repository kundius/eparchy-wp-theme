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
            <h1 class="portray-section-headline__title"><small>Результаты поиска для запроса:</small> "<?php echo $_GET['s'] ?>"</h1>
          </div>
        </div>

        <div class="page-sheet">
          <div class="container">
            <div class="page-articles-section">
              <div class="page-articles-section__content">
                <?php if (have_posts()): ?>
                <div class="page-articles-section__content-list">
                  <div class="articles-wide-grid">
                    <?php while (have_posts()): the_post(); ?>
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
                    </div>
                    <?php endwhile; ?>
                  </div>
                  <?php wp_pagenavi() ?>
                </div>
                <?php else: ?>
                  Материалов по данному запросу не найдено.
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
