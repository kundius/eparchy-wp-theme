<?php
/*
Template Name: О епархии
*/
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
          <div class="about-eparchy">
            <?php get_template_part('partials/page-headline'); ?>

            <div class="about-eparchy__intro">
              Русская Православная Церковь<br />
              Московский Патриархат Воронежская Митрополия<br />
              Борисоглебская епархия
            </div>

            <div class="about-eparchy-blocks">
              <div class="about-eparchy-blocks__documents">
                <div class="about-eparchy-documents">
                  <div class="about-eparchy-documents__body">
                    <div class="about-eparchy-documents__title">Официальные документы епархии</div>
                    <ul class="about-eparchy-documents__list">
                      <li>
                        <a href="#">Указы</a>
                      </li>
                      <li>
                        <a href="#">Распоряжения</a>
                      </li>
                      <li>
                        <a href="#">Циркуляры</a>
                      </li>
                      <li>
                        <a href="#">Хиротонии</a>
                      </li>
                    </ul>
                    <div></div>
                  </div>
                </div>
              </div>
              <div class="about-eparchy-blocks__history-and-management">
                <div class="about-eparchy-blocks__history">
                  <div class="about-eparchy-history">
                    <div class="about-eparchy-history__body">
                      <div class="about-eparchy-history__title">История</div>
                    </div>
                  </div>
                </div>
                <div class="about-eparchy-blocks__management">
                  <div class="about-eparchy-management">
                    <div class="about-eparchy-management__body">
                      <div class="about-eparchy-management__title">Епархиальное управление</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="about-eparchy__content">
              <div class="about-eparchy__content-title">Заголовок текстового блока</div>
              <div class="about-eparchy__content-hr">
                <div class="ui-hr ui-hr_small"></div>
              </div>
              <?php the_content() ?>
            </div>
          </div>
          <?php endwhile; endif; ?>
        </div>

        <?php get_template_part('partials/footer'); ?>
      </div>
    </div>
  </body>
</html>
