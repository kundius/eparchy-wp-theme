<?php
/*
Template Name: О епархии
*/

$history_page_id = 429;
$documents_page_id = 28;
$administration_page_id = 431;

$documents_query = new WP_Query([
  'post_type' => 'page',
  'post_parent' => $documents_page_id,
  'posts_per_page' => -1,
  'orderby' => ['menu_order' => 'ASC']
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
          <?php if (have_posts()): while (have_posts()): the_post(); ?>
          <div class="grid-eparchy">
            <?php get_template_part('partials/page-headline'); ?>

            <div class="grid-eparchy__intro">
              Русская Православная Церковь<br />
              Московский Патриархат Воронежская Митрополия<br />
              Борисоглебская епархия
            </div>

            <div class="grid-eparchy__sections">
              <div class="grid-eparchy-sections">
                <div class="grid-eparchy-sections__documents">
                  <div class="card-ariadne">
                    <div class="card-ariadne__title">Официальные документы епархии</div>
                    <ul class="list-chryses">
                      <?php foreach ($documents_query->posts as $item): ?>
                      <li><a href="<?php the_permalink($item) ?>"><?php echo get_the_title($item) ?></a></li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>

                <div class="grid-eparchy-sections__history-and-administration">
                  <div class="grid-eparchy-sections__history">
                    <div class="card-hestia card-hestia_history">
                      <div class="card-hestia__body">
                        <a href="<?php the_permalink($history_page_id) ?>" class="card-hestia__title">
                          <?php echo get_the_title($history_page_id) ?>
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="grid-eparchy-sections__administration">
                    <div class="card-hestia card-hestia_2">
                      <div class="card-hestia__body">
                        <a href="<?php the_permalink($administration_page_id) ?>" class="card-hestia__title">
                          <?php echo get_the_title($administration_page_id) ?>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="grid-eparchy__content content">
              <?php the_content() ?>
            </div>
          </div>
          <?php endwhile; endif; ?>
        </div>

        <?php get_template_part('partials/footer'); ?>
      </div>
    </div>

    <?php wp_footer() ?>
  </body>
</html>
