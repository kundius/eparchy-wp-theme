<div class="footer">
  <div class="container footer__container">
    <div class="footer__sitename">
      Борисоглебская Епархия Воронежская Митрополия Московский Патриархат
    </div>

    <div class="footer-address">
      <div class="footer-address__title">
        Адрес<br />
        Епархиального управления:
      </div>
      <div class="footer-address__content">
        <?php the_field('address', 'options') ?>
      </div>
      <?php if ($contacts = get_field('contacts', 'options')): ?>
      <div class="footer-contacts">
        <?php foreach ($contacts as $item): ?>
        <div class="footer-contacts__row">
          <div class="footer-contacts__value">
          <?php echo $item['value'] ?>
          </div>
          <div class="footer-contacts__label">
          <?php echo $item['name'] ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>

    <div class="footer-share">
      <div class="footer-share__title">Поделиться:</div>
      <div class="footer-share__buttons">
        <script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
        <script src="https://yastatic.net/share2/share.js"></script>
        <div class="ya-share2" data-services="facebook,moimir,pinterest,odnoklassniki,vkontakte,twitter" data-image="https://i.picsum.photos/id/506/512/512.jpg?hmac=5t02sDUYYZJ43ysBnXVl51riM2w0Pce3D4HpwcybQBs"></div>
      </div>
    </div>

    <div class="footer-vk">
      <div class="footer-vk__title">Группа <strong>ВКонтакте</strong></div>
      <div class="footer-vk__link">
        <a href="https://vk.com/public107884988" target="_blank"><img src="<?php echo get_bloginfo('template_url') ?>/dist/images/vk-group.png" alt="" /></a>
      </div>
    </div>

    <div class="footer__first-menu">
      <?php wp_nav_menu([
        'theme_location' => 'footer_first_menu',
        'container' => false,
        'menu_class' => 'footer-menu'
      ]) ?>
    </div>

    <div class="footer__seconf-menu">
      <?php wp_nav_menu([
        'theme_location' => 'footer_second_menu',
        'container' => false,
        'menu_class' => 'footer-menu'
      ]) ?>
    </div>

    <div class="footer__third-menu">
      <?php wp_nav_menu([
        'theme_location' => 'footer_third_menu',
        'container' => false,
        'menu_class' => 'footer-menu'
      ]) ?>
    </div>

    <?php wp_nav_menu([
      'theme_location' => 'footer_fourth_menu',
      'container' => false,
      'menu_class' => 'footer-links'
    ]) ?>
  </div>
</div>

<div class="footline">
  <div class="container footline__container">
    <div class="footline__copyright">
      <?php the_field('copyright', 'options') ?>
    </div>
    <div class="footline__counters">
      <?php the_field('counters', 'options') ?>
    </div>
    <a class="footline__sitemap" href="<?php the_permalink(442) ?>"><?php echo get_the_title(442) ?></a>
    <a class="footline__creator" href="http://domenart-studio.ru">
      <img src="<?php echo get_bloginfo('template_url') ?>/dist/images/creator.png" alt="" />
    </a>
  </div>
</div>

<button class="scrollup js-scroll"></button>
