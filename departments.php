<?php
/*
Template Name: Епархиальные отделы
*/
$query = new WP_Query([
  'post_type' => 'page',
  'post_parent' => get_the_ID(),
  'posts_per_page' => -1,
  'orderby' => ['menu_order' => 'ASC']
]);
$groups = array_chunk($query->posts, round(count($query->posts) / 2));
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
          <?php get_template_part('partials/page-headline'); ?>

          <div class="grid-departaments">
            <?php foreach ($groups as $group): ?>
            <div class="grid-departaments__cell">
              <div class="card-theia">
                <ul class="list-anthea">
                  <?php foreach ($group as $post): ?>
                    <li>
                      <a href="<?php the_permalink($post->ID) ?>" data-open-modal="departament-<?php echo $post->ID ?>">
                        <?php echo $post->post_title ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <?php endforeach; ?>
          </div>

          <?php the_content() ?>
          <?php endwhile; endif; ?>
        </div>

        <?php get_template_part('partials/footer'); ?>
      </div>
    </div>

    <?php foreach ($query->posts as $post): ?>
      <div class="modal modal_yellow micromodal-slide" id="departament-<?php echo $post->ID ?>" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
          <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="departament-<?php echo $post->ID ?>-title">
            <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>

            <div class="dialog-departaments">
              <div class="dialog-departaments__title"><?php echo $post->post_title ?></div>
              <?php if ($introtext = get_field('introtext', $post->ID)): ?>
              <div class="dialog-departaments__introtext">
                <?php echo $introtext ?>
              </div>
              <?php endif; ?>
              <?php $administrator = get_field('administrator', $post->ID) ?>
              <?php if ($administrator['image'] || $administrator['description']): ?>
              <div class="dialog-departaments__administrator">
                <?php if (!empty($administrator['image'])): ?>
                <div class="dialog-departaments__administrator-figure">
                  <img src="<?php echo $administrator['image']['url'] ?>" alt="" />
                </div>
                <?php endif; ?>
                <div class="dialog-departaments__administrator-info">
                  <div class="dialog-departaments__administrator-title">
                    Руководитель отдела
                  </div>
                  <div class="dialog-departaments__administrator-description">
                    <?php echo $administrator['description'] ?>
                  </div>
                  <div class="dialog-departaments__administrator-more">
                    <a href="<?php the_permalink($post->ID) ?>" class="more-button"><span></span>Больше</a>
                  </div>
                </div>
              </div>
              <?php else: ?>
              <a href="<?php the_permalink($post->ID) ?>" class="more-button"><span></span>Больше</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <?php wp_footer() ?>
  </body>
</html>
