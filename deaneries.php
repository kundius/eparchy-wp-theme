<?php
/*
Template Name: Благочиния
*/

$diocese_page_id = 395;
$diocese_page = get_post($diocese_page_id);
$deaneries_page_id = 381;
$deaneries_page = get_post($deaneries_page_id);
$districts_page_id = 411;
$districts_page = get_post($districts_page_id);

$deaneries_query = new WP_Query([
  'post_type' => 'page',
  'post_parent' => $deaneries_page_id,
  'posts_per_page' => -1,
  'orderby' => ['menu_order' => 'ASC']
]);

$diocese_query = new WP_Query([
  'post_type' => 'page',
  'post_parent' => $diocese_page_id,
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
          <?php get_template_part('partials/page-headline'); ?>

          <div class="grid-deaneries">
            <div class="grid-deaneries__mobile">
              <div class="tabs-alecto" data-tabs>
                <div class="tabs-alecto__head">
                  <div class="tabs-alecto__head-item active" data-tabs-switch="first">
                    Благочиния
                    <span></span>
                  </div>
                  <div class="tabs-alecto__head-item" data-tabs-switch="second">
                    Духовенство
                    <span></span>
                  </div>
                </div>
                <div class="tabs-alecto__body">
                  <div class="tabs-alecto__body-item active" data-tabs-body="first">
                    <ul class="list-anthea">
                      <?php foreach ($deaneries_query->posts as $item): ?>
                        <li>
                          <a href="<?php the_permalink($item) ?>" data-open-modal="deaneries-<?php echo $item->ID ?>"><?php echo get_the_title($item) ?></a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                  <div class="tabs-alecto__body-item" data-tabs-body="second">
                    <ul class="list-chryses">
                      <?php foreach ($diocese_query->posts as $item): ?>
                        <li>
                          <a href="<?php the_permalink($item) ?>"><?php echo get_the_title($item) ?></a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="grid-deaneries__deaneries-and-districts">
              <div class="grid-deaneries__deaneries">
                <div class="card-theia">
                  <div class="card-theia__title">Список благочиний</div>
                  <ul class="list-anthea">
                    <?php foreach ($deaneries_query->posts as $item): ?>
                      <li>
                        <a href="<?php the_permalink($item) ?>" data-open-modal="deaneries-<?php echo $item->ID ?>"><?php echo get_the_title($item) ?></a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
              <div class="grid-deaneries__districts">
                <div class="card-hestia card-hestia_districts">
                  <div class="card-hestia__body">
                    <div class="card-hestia__icon">
                      <?php icon('document', 2.5) ?>
                    </div>
                    <a href="<?php the_permalink($districts_page) ?>" class="card-hestia__title">
                      <?php echo get_the_title($districts_page) ?>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="grid-deaneries__diocese">
              <div class="card-ariadne card-ariadne_diocese">
                <div class="card-ariadne__title">Духовенство епархии</div>
                <ul class="list-chryses">
                  <?php foreach ($diocese_query->posts as $item): ?>
                    <li>
                      <a href="<?php the_permalink($item) ?>"><?php echo get_the_title($item) ?></a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>

            <?php if ($sites_of_departments = get_field('sites_of_departments')): ?>
            <div class="grid-deaneries__sites">
              <div class="card-tisiphone">
                <div class="card-tisiphone__title">Сайты отделов благочиний</div>
                <ul class="card-tisiphone__list">
                  <?php foreach ($sites_of_departments as $item): ?>
                  <li>
                    <?php echo $item['name'] ?>:
                    <a href="<?php echo $item['link'] ?>" target="_blank" rel="nofollow">
                      <?php echo $item['link'] ?>
                    </a>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>

        <?php get_template_part('partials/footer'); ?>
      </div>
    </div>

    <?php foreach ($deaneries_query->posts as $item): ?>
      <div class="modal modal_yellow micromodal-slide" id="deaneries-<?php echo $item->ID ?>" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
          <div class="dialog-deaneries modal__container" role="dialog" aria-modal="true" aria-labelledby="deaneries-<?php echo $item->ID ?>-title">
            <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            <?php
            $related_deaneries = new WP_Query([
              'post_type' => 'post',
              'posts_per_page' => -1,
              'order' => 'DESC',
              'orderby' => 'date',
              'meta_query' => [
                [
                  'key' => 'related_deaneries',
                  'compare' => 'LIKE',
                  'value' => '"' . $item->ID . '"'
                ]
              ]
            ]);
            ?>
            <div class="dialog-deaneries__title"><?php echo get_the_title($item) ?></div>
            <?php if (has_excerpt($item->ID)): ?>
            <div class="dialog-deaneries__excerpt"><?php echo get_the_excerpt($item) ?></div>
            <?php endif; ?>
            <?php if ($related_deaneries->have_posts()): ?>
            <div class="dialog-deaneries__subtitle">Публикации</div>
            <ul class="dialog-deaneries__list">
              <?php foreach ($related_deaneries->posts as $item): ?>
              <li>
                <a href="<?php the_permalink($item) ?>"><?php echo get_the_title($item) ?></a>
              </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <?php wp_footer() ?>
  </body>
</html>
