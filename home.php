<?php
/*
Template Name: Главная
*/
?>
<!DOCTYPE html>
<html lang="ru" itemscope itemtype="http://schema.org/WebSite">
  <head>
    <?php get_template_part('partials/head'); ?>
  </head>
  <body>
    <div class="off-canvas-bar">
      <button class="off-canvas-bar__close" data-off-canvas-toggle></button>

      <div class="off-canvas-bar__body">
        <a href="/" class="drawer-logo">
          <img src="<?php echo get_bloginfo('template_url') ?>/dist/images/logo.svg" alt="" class="drawer-logo__image" />
          <span class="drawer-logo__first">Русская Православная Церковь</span>
          <span class="drawer-logo__second">Борисоглебская&nbsp;&nbsp;Епархия</span>
          <span class="drawer-logo__third">Московский Патриархат Воронежская Митрополия</span>
        </a>

        <?php wp_nav_menu([
          'theme_location' => 'main_menu',
          'container' => false,
          'menu_class' => 'drawer-mainmenu'
        ]) ?>

        <?php wp_nav_menu([
          'theme_location' => 'header_menu',
          'container' => false,
          'menu_class' => 'drawer-secondmenu'
        ]) ?>
      </div>
    </div>

    <div class="off-canvas-page">
      <div class="off-canvas-page__overlay" data-off-canvas-toggle></div>

      <?php get_template_part('partials/header'); ?>

      <div class="home-intro">
        <div class="container">
          <div class="home-intro__body">
            <div class="intro-news">
              <div class="intro-news__title">Новости</div>
              <div class="intro-news__list">
                <div class="swiper-container js-intro-news-swiper">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="intro-news-list">
                        <div class="ui-grid">
                          <div class="ui-width-1-2">
                            <div class="intro-news-item-s">
                              <div class="intro-news-item-s__figure">
                                <img src="https://i.picsum.photos/id/785/512/512.jpg?hmac=gm6zCOH9mTUmObXpLyhxplD-B1Lc-Xg_ZZPKOUaDXYQ" alt="" class="intro-news-item-s__figure-image" />
                              </div>
                              <div class="intro-news-item-s__date">24.05.2018</div>
                              <a class="intro-news-item-s__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                            </div>
                            <div class="intro-news-item-s">
                              <div class="intro-news-item-s__figure">
                                <img src="https://i.picsum.photos/id/614/512/512.jpg?hmac=141tn-P1ynSKGJhRXnLf1uGDRKZGEfnQyysBVquCKqw" alt="" class="intro-news-item-s__figure-image" />
                              </div>
                              <div class="intro-news-item-s__date">24.05.2018</div>
                              <a class="intro-news-item-s__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                            </div>
                            <div class="intro-news-item-s">
                              <div class="intro-news-item-s__figure">
                                <img src="https://i.picsum.photos/id/1031/512/512.jpg?hmac=HbcP_RUC994jfQpkEm6tNJ83M5EAebzvs-8LYeuoYjg" alt="" class="intro-news-item-s__figure-image" />
                              </div>
                              <div class="intro-news-item-s__date">24.05.2018</div>
                              <a class="intro-news-item-s__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                            </div>
                          </div>
                          <div class="ui-width-1-2">
                            <div class="intro-news-item-m">
                              <div class="intro-news-item-m__figure">
                                <img src="https://i.picsum.photos/id/506/512/512.jpg?hmac=5t02sDUYYZJ43ysBnXVl51riM2w0Pce3D4HpwcybQBs" alt="" class="intro-news-item-m__figure-image" />
                              </div>
                              <a class="intro-news-item-m__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                              <div class="intro-news-item-m__footer">
                                <div class="intro-news-item-m__date">24.05.2018</div>
                                <div class="intro-news-item-m__ago">1 час назад</div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="ui-grid">
                    <div class="ui-width-1-2"></div>
                    <div class="ui-width-1-2">
                      <div class="swiper-pagination"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="page-sheet home-page-sheet">
        <div class="container">
          <div class="home-news">
            <div class="home-news__relevant-title">
                <div class="section-headline section-headline_gray">
                  <div class="section-headline__title">Актуальные новости</div>
                  <a href="#" class="section-headline__link">смотреть все</a>
                  <div></div>
                </div>
            </div>

            <div class="home-news__relevant-body">
              <div class="latest-news">
                <div class="swiper-container js-latest-news-swiper">
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="ui-grid ui-grid-large@m">
                        <div class="ui-width-1-3">
                          <div class="latest-news-m">
                            <div class="latest-news-m__head">
                              <div class="latest-news-m__head-date">24.05.2018</div>
                              <div class="latest-news-m__head-ago">1 час назад</div>
                            </div>
                            <div class="latest-news-m__figure">
                              <img src="https://i.picsum.photos/id/416/362/265.jpg?hmac=mpbuoOQzNYv6tuHR2HK18v1IpkcBdkru_ft3X-mgpXE" alt="" class="latest-news-m__figure-image" />
                            </div>
                            <a class="latest-news-m__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                          </div>
                        </div>
                        <div class="ui-width-1-3">
                          <div class="latest-news-l">
                            <div class="latest-news-l__head">
                              <div class="latest-news-l__head-date">24.05.2018</div>
                              <div class="latest-news-l__head-ago">1 час назад</div>
                            </div>
                            <div class="latest-news-l__figure">
                              <img src="https://i.picsum.photos/id/1031/512/512.jpg?hmac=HbcP_RUC994jfQpkEm6tNJ83M5EAebzvs-8LYeuoYjg" alt="" class="latest-news-l__figure-image" />
                            </div>
                            <div class="latest-news-l__info">
                              <div class="latest-news-l__info-day">12</div>
                              <div>
                                <div class="latest-news-l__info-date">мая ‘18</div>
                                <a class="latest-news-l__info-title" href="#">Паломническая поездка в Тамбов</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="ui-width-1-6">
                          <div class="latest-news-s">
                            <div class="latest-news-s__date">24.05.2018</div>
                            <div class="latest-news-s__figure">
                              <img src="https://i.picsum.photos/id/614/512/512.jpg?hmac=141tn-P1ynSKGJhRXnLf1uGDRKZGEfnQyysBVquCKqw" alt="" class="latest-news-s__figure-image" />
                            </div>
                            <a class="latest-news-s__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                          </div>
                        </div>
                        <div class="ui-width-1-6">
                          <div class="latest-news-s">
                            <div class="latest-news-s__date">24.05.2018</div>
                            <div class="latest-news-s__figure">
                              <img src="https://i.picsum.photos/id/506/512/512.jpg?hmac=5t02sDUYYZJ43ysBnXVl51riM2w0Pce3D4HpwcybQBs" alt="" class="latest-news-s__figure-image" />
                            </div>
                            <a class="latest-news-s__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="ui-grid ui-grid-large@m">
                        <div class="ui-width-1-3">
                          <div class="latest-news-m">
                            <div class="latest-news-m__head">
                              <div class="latest-news-m__head-date">24.05.2018</div>
                              <div class="latest-news-m__head-ago">1 час назад</div>
                            </div>
                            <div class="latest-news-m__figure">
                              <img src="https://i.picsum.photos/id/416/362/265.jpg?hmac=mpbuoOQzNYv6tuHR2HK18v1IpkcBdkru_ft3X-mgpXE" alt="" class="latest-news-m__figure-image" />
                            </div>
                            <a class="latest-news-m__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                          </div>
                        </div>
                        <div class="ui-width-1-3">
                          <div class="latest-news-l">
                            <div class="latest-news-l__head">
                              <div class="latest-news-l__head-date">24.05.2018</div>
                              <div class="latest-news-l__head-ago">1 час назад</div>
                            </div>
                            <div class="latest-news-l__figure">
                              <img src="https://i.picsum.photos/id/1031/512/512.jpg?hmac=HbcP_RUC994jfQpkEm6tNJ83M5EAebzvs-8LYeuoYjg" alt="" class="latest-news-l__figure-image" />
                            </div>
                            <div class="latest-news-l__info">
                              <div class="latest-news-l__info-day">12</div>
                              <div>
                                <div class="latest-news-l__info-date">мая ‘18</div>
                                <a class="latest-news-l__info-title" href="#">Паломническая поездка в Тамбов</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="ui-width-1-6">
                          <div class="latest-news-s">
                            <div class="latest-news-s__date">24.05.2018</div>
                            <div class="latest-news-s__figure">
                              <img src="https://i.picsum.photos/id/614/512/512.jpg?hmac=141tn-P1ynSKGJhRXnLf1uGDRKZGEfnQyysBVquCKqw" alt="" class="latest-news-s__figure-image" />
                            </div>
                            <a class="latest-news-s__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                          </div>
                        </div>
                        <div class="ui-width-1-6">
                          <div class="latest-news-s">
                            <div class="latest-news-s__date">24.05.2018</div>
                            <div class="latest-news-s__figure">
                              <img src="https://i.picsum.photos/id/506/512/512.jpg?hmac=5t02sDUYYZJ43ysBnXVl51riM2w0Pce3D4HpwcybQBs" alt="" class="latest-news-s__figure-image" />
                            </div>
                            <a class="latest-news-s__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="latest-news__nav">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="home-news__eparchy-title">
              <div class="section-headline section-headline_blue">
                <div class="section-headline__title">Новости епархии</div>
                <a href="#" class="section-headline__link">смотреть все</a>
              </div>
            </div>

            <div class="home-news__eparchy-body">
              <div class="eparchy-news">
                <div class="eparchy-news-item-l">
                  <div class="eparchy-news-item-l__figure">
                    <img src="https://i.picsum.photos/id/33/800/800.jpg?hmac=lfMKDRbFpYvLoMTnr1nACUg88A_YgMgEzdoWK1BMRX4" alt="" class="eparchy-news-item-l__figure-image" />
                  </div>
                  <a href="#" class="eparchy-news-item-l__title">Заголовок-название актуальной новости месяца/ недели, может быть в 1, 2, 3 строки, название выводится от нижней строки вверх</a>
                </div>
                <div class="eparchy-news-item-m">
                  <div class="eparchy-news-item-m__figure">
                    <img src="https://i.picsum.photos/id/33/800/800.jpg?hmac=lfMKDRbFpYvLoMTnr1nACUg88A_YgMgEzdoWK1BMRX4" alt="" class="eparchy-news-item-m__figure-image" />
                  </div>
                  <div class="eparchy-news-item-m__info">
                    <div class="eparchy-news-item-m__rubrics">
                      <a href="#">Епархиальное управление</a>
                    </div>
                    <a href="#" class="eparchy-news-item-m__title">Заголовок-название актуальной новости месяца/ недели, может быть в 1, 2, 3 строки, название выводится от нижней строки вверх</a>
                    <div class="eparchy-news-item-m__date">30 марта 2018</div>
                  </div>
                </div>
                <div class="eparchy-news-item-m">
                  <div class="eparchy-news-item-m__figure">
                    <img src="https://i.picsum.photos/id/33/800/800.jpg?hmac=lfMKDRbFpYvLoMTnr1nACUg88A_YgMgEzdoWK1BMRX4" alt="" class="eparchy-news-item-m__figure-image" />
                  </div>
                  <div class="eparchy-news-item-m__info">
                    <div class="eparchy-news-item-m__rubrics">
                      <a href="#">Епархиальное управление</a>
                    </div>
                    <a href="#" class="eparchy-news-item-m__title">Заголовок-название актуальной новости месяца/ недели, может быть в 1, 2, 3 строки, название выводится от нижней строки вверх</a>
                    <div class="eparchy-news-item-m__date">30 марта 2018</div>
                  </div>
                </div>
                <div class="eparchy-news-item-m">
                  <div class="eparchy-news-item-m__figure">
                    <img src="https://i.picsum.photos/id/33/800/800.jpg?hmac=lfMKDRbFpYvLoMTnr1nACUg88A_YgMgEzdoWK1BMRX4" alt="" class="eparchy-news-item-m__figure-image" />
                  </div>
                  <div class="eparchy-news-item-m__info">
                    <div class="eparchy-news-item-m__rubrics">
                      <a href="#">Епархиальное управление</a>
                    </div>
                    <a href="#" class="eparchy-news-item-m__title">Заголовок-название актуальной новости месяца/ недели, может быть в 1, 2, 3 строки, название выводится от нижней строки вверх</a>
                    <div class="eparchy-news-item-m__date">30 марта 2018</div>
                  </div>
                </div>
                <div class="eparchy-news-item-m">
                  <div class="eparchy-news-item-m__figure">
                    <img src="https://i.picsum.photos/id/33/800/800.jpg?hmac=lfMKDRbFpYvLoMTnr1nACUg88A_YgMgEzdoWK1BMRX4" alt="" class="eparchy-news-item-m__figure-image" />
                  </div>
                  <div class="eparchy-news-item-m__info">
                    <div class="eparchy-news-item-m__rubrics">
                      <a href="#">Епархиальное управление</a>
                    </div>
                    <a href="#" class="eparchy-news-item-m__title">Заголовок-название актуальной новости месяца/ недели, может быть в 1, 2, 3 строки, название выводится от нижней строки вверх</a>
                    <div class="eparchy-news-item-m__date">30 марта 2018</div>
                  </div>
                </div>
              </div>

              <nav class="navigation pagination" role="navigation">
                <div class="nav-links">
                  <a class="prev page-numbers" href="#"></a>
                  <span class="page-numbers current">1</span>
                  <a class="page-numbers" href="#">2</a>
                  <span class="page-numbers dots">…</span>
                  <a class="page-numbers" href="#">86</a>
                  <a class="page-numbers" href="#">87</a>
                  <a class="next page-numbers" href="#"></a>
                </div>
              </nav>
              <div class="ui-hr ui-hr_small"></div>
            </div>

            <div class="home-news__deans-title">
              <div class="section-headline section-headline_green">
                <div class="section-headline__title">Новости благочиний</div>
                <a href="#" class="section-headline__link">смотреть все</a>
              </div>
            </div>

            <div class="home-news__deans-body">
              <div class="deans-news-primary">
                <div class="deans-news-primary__date">
                  <div>24.05.2018</div>
                  <div>1 час назад</div>
                </div>
                <div class="deans-news-primary__figure">
                  <img src="https://i.picsum.photos/id/974/560/305.jpg?hmac=9sEVsg87ibcyf3oqY3ITHG8PMB1oagXwHFsVLDsrujY" alt="" class="deans-news-primary__figure-image" />
                </div>
                <a href="#" class="deans-news-primary__title">Божественная литургия в день празднования иконы Божией Матери именуемой «Достойно есть»</a>
                <div class="deans-news-primary__desc">24 июня 2018 года, в неделю 4-ю по Пятидесятнице, в день празднования иконы Божией Матери, именуемой «Достойно есть», Глава Борисоглебской епархии, епископ Сергий, возглавил служение Божественной литургии в Знаменском кафедральном соборе и Крестный ход с иконой Божией Матери... «Достойно Есть» до Старособорной площади города Борисоглебска.</div>
              </div>

              <div class="home-news__deans-hr">
                <div class="ui-hr"></div>
              </div>

              <div class="home-news__deans-news-and-bunners">
                <div class="home-news__deans-news">
                  <div class="deans-news-list">
                    <div class="deans-news-item">
                      <div class="deans-news-item__figure">
                        <img src="https://i.picsum.photos/id/785/512/512.jpg?hmac=gm6zCOH9mTUmObXpLyhxplD-B1Lc-Xg_ZZPKOUaDXYQ" alt="" class="deans-news-item__figure-image" />
                      </div>
                      <div class="deans-news-item__info">
                        <div class="deans-news-item__headline">
                          <div class="deans-news-item__date">24.05.2018</div>
                          <div class="deans-news-item__rubrics">
                            <a href="#">Служения</a>
                          </div>
                        </div>
                        <a class="deans-news-item__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                      </div>
                    </div>
                    <div class="deans-news-item">
                      <div class="deans-news-item__figure">
                        <img src="https://i.picsum.photos/id/785/512/512.jpg?hmac=gm6zCOH9mTUmObXpLyhxplD-B1Lc-Xg_ZZPKOUaDXYQ" alt="" class="deans-news-item__figure-image" />
                      </div>
                      <div class="deans-news-item__info">
                        <div class="deans-news-item__headline">
                          <div class="deans-news-item__date">24.05.2018</div>
                          <div class="deans-news-item__rubrics">
                            <a href="#">Служения</a>
                          </div>
                        </div>
                        <a class="deans-news-item__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                      </div>
                    </div>
                    <div class="deans-news-item">
                      <div class="deans-news-item__figure">
                        <img src="https://i.picsum.photos/id/785/512/512.jpg?hmac=gm6zCOH9mTUmObXpLyhxplD-B1Lc-Xg_ZZPKOUaDXYQ" alt="" class="deans-news-item__figure-image" />
                      </div>
                      <div class="deans-news-item__info">
                        <div class="deans-news-item__headline">
                          <div class="deans-news-item__date">24.05.2018</div>
                          <div class="deans-news-item__rubrics">
                            <a href="#">Служения</a>
                          </div>
                        </div>
                        <a class="deans-news-item__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                      </div>
                    </div>
                    <div class="deans-news-item">
                      <div class="deans-news-item__figure">
                        <img src="https://i.picsum.photos/id/785/512/512.jpg?hmac=gm6zCOH9mTUmObXpLyhxplD-B1Lc-Xg_ZZPKOUaDXYQ" alt="" class="deans-news-item__figure-image" />
                      </div>
                      <div class="deans-news-item__info">
                        <div class="deans-news-item__headline">
                          <div class="deans-news-item__date">24.05.2018</div>
                          <div class="deans-news-item__rubrics">
                            <a href="#">Служения</a>
                          </div>
                        </div>
                        <a class="deans-news-item__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                      </div>
                    </div>
                    <div class="deans-news-item">
                      <div class="deans-news-item__figure">
                        <img src="https://i.picsum.photos/id/785/512/512.jpg?hmac=gm6zCOH9mTUmObXpLyhxplD-B1Lc-Xg_ZZPKOUaDXYQ" alt="" class="deans-news-item__figure-image" />
                      </div>
                      <div class="deans-news-item__info">
                        <div class="deans-news-item__headline">
                          <div class="deans-news-item__date">24.05.2018</div>
                          <div class="deans-news-item__rubrics">
                            <a href="#">Служения</a>
                          </div>
                        </div>
                        <a class="deans-news-item__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                      </div>
                    </div>
                    <div class="deans-news-item">
                      <div class="deans-news-item__figure">
                        <img src="https://i.picsum.photos/id/785/512/512.jpg?hmac=gm6zCOH9mTUmObXpLyhxplD-B1Lc-Xg_ZZPKOUaDXYQ" alt="" class="deans-news-item__figure-image" />
                      </div>
                      <div class="deans-news-item__info">
                        <div class="deans-news-item__headline">
                          <div class="deans-news-item__date">24.05.2018</div>
                          <div class="deans-news-item__rubrics">
                            <a href="#">Служения</a>
                          </div>
                        </div>
                        <a class="deans-news-item__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                      </div>
                    </div>
                    <div class="deans-news-item">
                      <div class="deans-news-item__figure">
                        <img src="https://i.picsum.photos/id/785/512/512.jpg?hmac=gm6zCOH9mTUmObXpLyhxplD-B1Lc-Xg_ZZPKOUaDXYQ" alt="" class="deans-news-item__figure-image" />
                      </div>
                      <div class="deans-news-item__info">
                        <div class="deans-news-item__headline">
                          <div class="deans-news-item__date">24.05.2018</div>
                          <div class="deans-news-item__rubrics">
                            <a href="#">Служения</a>
                          </div>
                        </div>
                        <a class="deans-news-item__title" href="#">29 апреля — Божественная литургия в Знаменском кафедральном соборе, г. Борисоглебск</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="home-news__deans-bunners">
                  <div class="deans-banners">
                    <div class="deans-banners-swiper">
                      <div class="swiper-container js-deans-banners-swiper">
                        <div class="swiper-wrapper">
                          <div class="swiper-slide">
                            <a href="#" class="deans-banners-swiper-item">
                              <img src="https://i.picsum.photos/id/478/166/406.jpg?hmac=q-asZBGWaJGrQ0Wpjaco1a32780UvOBxmyzEV8YOC68" alt="" class="deans-banners-swiper-item__image" />
                              <span class="deans-banners-swiper-item__title">
                                Храмы Борисоглебской епархии
                              </span>
                            </a>
                          </div>
                          <div class="swiper-slide">
                            <a href="#" class="deans-banners-swiper-item">
                              <img src="https://i.picsum.photos/id/576/166/406.jpg?hmac=t4L6lVfAqsCsnjG0Ba6MqitZITVUHhIUQwxJ0cP04L4" alt="" class="deans-banners-swiper-item__image" />
                              <span class="deans-banners-swiper-item__title">
                                Храмы Борисоглебской епархии
                              </span>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="deans-banners-swiper__nav">
                        <div class="swiper-button-prev js-deans-banners-swiper-prev"></div>
                        <div class="swiper-button-next js-deans-banners-swiper-next"></div>
                      </div>
                    </div>
                    <div class="deans-banners-group">
                      <a href="#" class="deans-banners-union">Православный телеканал «Союз»</a>
                      <a href="#" class="deans-banners-ways">Маршруты<br />паломничества</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="home-publications">
            <div class="home-publications__articles-title">
              <div class="section-headline section-headline_gray">
                <div class="section-headline__title">Беседы, публикации</div>
                <a href="#" class="section-headline__link">смотреть все</a>
              </div>
            </div>

            <div class="home-publications__articles-latest">
              <div class="latest-publication">
                <div class="latest-publication__figure">
                  <img src="https://i.picsum.photos/id/416/362/265.jpg?hmac=mpbuoOQzNYv6tuHR2HK18v1IpkcBdkru_ft3X-mgpXE" alt="" class="latest-publication__figure-image" />
                </div>
                <div class="latest-publication__date">24.05.2018</div>
                <a class="latest-publication__title" href="#">Название статьи, интервью</a>
                <div class="latest-publication__desc">24 июня 2018 года, в неделю 4-ю по Пятидесятнице, в день празднования иконы Божией Матери, именуемой «Достойно есть», Глава Борисоглебской епархии, епископ Сергий, возглавил служение Божественной литургии в Знаменском кафедральном соборе и Крестный ход с иконой Божией Матери... «Достойно Есть» до Старособорной площади города Борисоглебска.</div>
              </div>

              <div class="home-publications__articles-more">
                <a href="#" class="more-button"><span></span>Больше</a>
              </div>
            </div>

            <div class="home-publications__sliders">
              <div class="home-publications__talks">
                <div class="tiled-slider tiled-slider_orange">
                  <div class="swiper-container js-tiled-swiper-talks">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide tiled-slider-item">
                        <div class="tiled-slider-item__head">
                          <div class="tiled-slider-item__head-date">30.03.<wbr />2018</div>
                          <div class="tiled-slider-item__head-label">Беседы</div>
                        </div>
                        <div class="tiled-slider-item__body">
                          <div class="tiled-slider-item__figure">
                            <img src="https://i.picsum.photos/id/335/384/208.jpg?hmac=FsVokg5294uls6MdLL8zVNM6ySDJKCAenY8iqk6OFnc" alt="" class="tiled-slider-item__figure-image" />
                          </div>
                          <a href="#" class="tiled-slider-item__title">Беседа на тему «Воскресение Христово, как смысл нашей жизни»</a>
                        </div>
                      </div>
                      <div class="swiper-slide tiled-slider-item">
                        <div class="tiled-slider-item__head">
                          <div class="tiled-slider-item__head-date">30.03.<wbr />2018</div>
                          <div class="tiled-slider-item__head-label">Беседы</div>
                        </div>
                        <div class="tiled-slider-item__body">
                          <div class="tiled-slider-item__figure">
                            <img src="https://i.picsum.photos/id/335/384/208.jpg?hmac=FsVokg5294uls6MdLL8zVNM6ySDJKCAenY8iqk6OFnc" alt="" class="tiled-slider-item__figure-image" />
                          </div>
                          <a href="#" class="tiled-slider-item__title">Беседа на тему «Воскресение Христово, как смысл нашей жизни»</a>
                        </div>
                      </div>
                      <div class="swiper-slide tiled-slider-item">
                        <div class="tiled-slider-item__head">
                          <div class="tiled-slider-item__head-date">30.03.<wbr />2018</div>
                          <div class="tiled-slider-item__head-label">Беседы</div>
                        </div>
                        <div class="tiled-slider-item__body">
                          <div class="tiled-slider-item__figure">
                            <img src="https://i.picsum.photos/id/335/384/208.jpg?hmac=FsVokg5294uls6MdLL8zVNM6ySDJKCAenY8iqk6OFnc" alt="" class="tiled-slider-item__figure-image" />
                          </div>
                          <a href="#" class="tiled-slider-item__title">Беседа на тему «Воскресение Христово, как смысл нашей жизни»</a>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-pagination"></div>
                  </div>
                </div>
              </div>

              <div class="home-publications__articles">
                <div class="tiled-slider tiled-slider_red">
                  <div class="swiper-container js-tiled-swiper-articles">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide tiled-slider-item">
                        <div class="tiled-slider-item__head">
                          <div class="tiled-slider-item__head-date">30.03.<wbr />2018</div>
                          <div class="tiled-slider-item__head-label">ПУБЛИКАЦИИ</div>
                        </div>
                        <div class="tiled-slider-item__body">
                          <div class="tiled-slider-item__figure">
                            <img src="https://i.picsum.photos/id/335/384/208.jpg?hmac=FsVokg5294uls6MdLL8zVNM6ySDJKCAenY8iqk6OFnc" alt="" class="tiled-slider-item__figure-image" />
                          </div>
                          <a href="#" class="tiled-slider-item__title">Беседа на тему «Воскресение Христово, как смысл нашей жизни»</a>
                        </div>
                      </div>
                      <div class="swiper-slide tiled-slider-item">
                        <div class="tiled-slider-item__head">
                          <div class="tiled-slider-item__head-date">30.03.<wbr />2018</div>
                          <div class="tiled-slider-item__head-label">ПУБЛИКАЦИИ</div>
                        </div>
                        <div class="tiled-slider-item__body">
                          <div class="tiled-slider-item__figure">
                            <img src="https://i.picsum.photos/id/335/384/208.jpg?hmac=FsVokg5294uls6MdLL8zVNM6ySDJKCAenY8iqk6OFnc" alt="" class="tiled-slider-item__figure-image" />
                          </div>
                          <a href="#" class="tiled-slider-item__title">Беседа на тему «Воскресение Христово, как смысл нашей жизни»</a>
                        </div>
                      </div>
                      <div class="swiper-slide tiled-slider-item">
                        <div class="tiled-slider-item__head">
                          <div class="tiled-slider-item__head-date">30.03.<wbr />2018</div>
                          <div class="tiled-slider-item__head-label">ПУБЛИКАЦИИ</div>
                        </div>
                        <div class="tiled-slider-item__body">
                          <div class="tiled-slider-item__figure">
                            <img src="https://i.picsum.photos/id/335/384/208.jpg?hmac=FsVokg5294uls6MdLL8zVNM6ySDJKCAenY8iqk6OFnc" alt="" class="tiled-slider-item__figure-image" />
                          </div>
                          <a href="#" class="tiled-slider-item__title">Беседа на тему «Воскресение Христово, как смысл нашей жизни»</a>
                        </div>
                      </div>
                    </div>
                    <div class="swiper-pagination"></div>
                  </div>
                </div>
              </div>

              <div class="home-publications__interviews">
                <div class="tiled-slider tiled-slider_green tiled-slider_has-nav">
                  <div class="swiper-container js-tiled-swiper-interviews">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide tiled-slider-item">
                        <div class="tiled-slider-item__head">
                          <div class="tiled-slider-item__head-date">30.03.<wbr />2018</div>
                          <div class="tiled-slider-item__head-label">Интервью</div>
                        </div>
                        <div class="tiled-slider-item__body">
                          <div class="tiled-slider-item__video">
                            <iframe class="tiled-slider-item__video-iframe" src="https://www.youtube.com/embed/yfsfDP0svf8?controls=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <button class="tiled-slider-item__video-play"></button>
                            <a href="#" class="tiled-slider-item__video-title">Беседа на тему «Воскресение Христово, как смысл нашей жизни»</a>
                          </div>
                        </div>
                      </div>
                      <div class="swiper-slide tiled-slider-item">
                        <div class="tiled-slider-item__head">
                          <div class="tiled-slider-item__head-date">30.03.<wbr />2018</div>
                          <div class="tiled-slider-item__head-label">Интервью</div>
                        </div>
                        <div class="tiled-slider-item__body">
                          <div class="tiled-slider-item__video">
                            <iframe class="tiled-slider-item__video-iframe" src="https://www.youtube.com/embed/yfsfDP0svf8?controls=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <button class="tiled-slider-item__video-play"></button>
                            <a href="#" class="tiled-slider-item__video-title">Беседа на тему «Воскресение Христово, как смысл нашей жизни»</a>
                          </div>
                        </div>
                      </div>
                      <div class="swiper-slide tiled-slider-item">
                        <div class="tiled-slider-item__head">
                          <div class="tiled-slider-item__head-date">30.03.<wbr />2018</div>
                          <div class="tiled-slider-item__head-label">Интервью</div>
                        </div>
                        <div class="tiled-slider-item__body">
                          <div class="tiled-slider-item__video">
                            <iframe class="tiled-slider-item__video-iframe" src="https://www.youtube.com/embed/yfsfDP0svf8?controls=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <button class="tiled-slider-item__video-play"></button>
                            <a href="#" class="tiled-slider-item__video-title">Беседа на тему «Воскресение Христово, как смысл нашей жизни»</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tiled-slider__prev swiper-button-prev js-tiled-swiper-interviews-prev"></div>
                  <div class="tiled-slider__next swiper-button-next js-tiled-swiper-interviews-next"></div>
                </div>
              </div>
            </div>

            <div class="home-publications__calendar-title">
              <div class="section-headline section-headline_gray">
                <div class="section-headline__title">Архив статей</div>
              </div>
            </div>

            <div class="home-publications__calendar-body">
              <div class="archive-calendar" data-archive-calendar>
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

              <div class="home-publications__calendar-desc">
                <div class="ui-text-small">Выберите <em>год, месяц и число</em>, чтобы посмотреть публикации</div>
              </div>
            </div>
          </div>

          <div class="home-ecalendar">
            <div class="home-ecalendar__title">
              <div class="section-headline section-headline_gray">
                <div class="section-headline__title">Епархиальный календарь</div>
              </div>
            </div>

            <div class="home-ecalendar__body">
              <div class="tabs-panel" data-tabs>
                <div class="tabs-panel__head">
                  <div class="tabs-panel__head-item active" data-tabs-switch="first">
                    Месяцеслов
                    <span></span>
                  </div>
                  <div class="tabs-panel__head-item" data-tabs-switch="second">
                    Церковные праздники, епархиальные памятные даты, торжества
                  </div>
                </div>
                <div class="tabs-panel__body">
                  <div class="tabs-panel__body-item active" data-tabs-body="first">
                    <div class="ecalendar" data-ecalendar>
                      <div class="ecalendar__legend-and-control">
                        <div class="ecalendar-legend">
                          <div class="ecalendar-legend__row ecalendar-legend__row_current">Текущая дата</div>
                          <div class="ecalendar-legend__row ecalendar-legend__row_primary">Главные праздники</div>
                          <div class="ecalendar-legend__row ecalendar-legend__row_weeks">Сплошные седмицы</div>
                          <div class="ecalendar-legend__row ecalendar-legend__row_post">Дни поста</div>
                          <div class="ecalendar-legend__row ecalendar-legend__row_memorial">Дни особого<br />поминовения<br />усопших</div>
                        </div>
                        
                        <div class="ecalendar-control">
                          <div class="ecalendar-control__headline">
                            <button class="ecalendar-control__headline-prev" data-ecalendar-backward></button>
                            <div class="ecalendar-control__headline-year" data-ecalendar-date></div>
                            <button class="ecalendar-control__headline-next" data-ecalendar-forward></button>
                          </div>
                          <div class="ecalendar-control__body" data-ecalendar-body>

                          </div>
                        </div>
                      </div>

                      <div class="ecalendar-content" data-ecalendar-content></div>
                    </div>
                  </div>
                  <div class="tabs-panel__body-item" data-tabs-body="second">
                    second
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="home-analytics">
            <div class="home-analytics__title">
              <div class="section-headline section-headline_yellow">
                <div class="section-headline__title">Актуальная аналитика</div>
                <a href="#" class="section-headline__link">смотреть все</a>
                <div></div>
              </div>
            </div>

            <div class="home-analytics__body">
              <div class="analytics-grid">
                <div class="analytics-grid-item">
                  <img src="https://i.picsum.photos/id/33/800/800.jpg?hmac=lfMKDRbFpYvLoMTnr1nACUg88A_YgMgEzdoWK1BMRX4" alt="" class="analytics-grid-item__image" />
                  <a href="#" class="analytics-grid-item__title">Чтобы люди нашли Церковь, Церковь должна искать Христа</a>
                </div>
                <div class="analytics-grid-item">
                  <a href="#" class="analytics-grid-item__title">Церковь занимается не прогнозами, а людьми</a>
                </div>
                <div class="analytics-grid-item">
                  <img src="https://i.picsum.photos/id/33/800/800.jpg?hmac=lfMKDRbFpYvLoMTnr1nACUg88A_YgMgEzdoWK1BMRX4" alt="" class="analytics-grid-item__image" />
                  <a href="#" class="analytics-grid-item__title">Владимир Легойда: Верую, ибо достойно. Рождественское</a>
                </div>
                <div class="analytics-grid-item">
                  <img src="https://i.picsum.photos/id/33/800/800.jpg?hmac=lfMKDRbFpYvLoMTnr1nACUg88A_YgMgEzdoWK1BMRX4" alt="" class="analytics-grid-item__image" />
                  <a href="#" class="analytics-grid-item__title">Монастырь во имя преподобного Серафима Саровского <br /><br />с. Новомакарово</a>
                </div>
                <div class="analytics-grid-item">
                  <a href="#" class="analytics-grid-item__title">«Екатеринбургские останки»: об истине и сенсациях</a>
                </div>
                <div class="analytics-grid-item">
                  <img src="https://i.picsum.photos/id/33/800/800.jpg?hmac=lfMKDRbFpYvLoMTnr1nACUg88A_YgMgEzdoWK1BMRX4" alt="" class="analytics-grid-item__image" />
                  <a href="#" class="analytics-grid-item__title">Святейший Патриарх Кирилл призвал паству к участию в выборах</a>
                </div>
                <div class="analytics-grid-item">
                  <img src="https://i.picsum.photos/id/33/800/800.jpg?hmac=lfMKDRbFpYvLoMTnr1nACUg88A_YgMgEzdoWK1BMRX4" alt="" class="analytics-grid-item__image" />
                  <a href="#" class="analytics-grid-item__title">Рождество: почему и зачем Бог стал Человеком?</a>
                </div>
                <div class="analytics-grid-item">
                  <img src="https://i.picsum.photos/id/33/800/800.jpg?hmac=lfMKDRbFpYvLoMTnr1nACUg88A_YgMgEzdoWK1BMRX4" alt="" class="analytics-grid-item__image" />
                  <a href="#" class="analytics-grid-item__title">О церковном браке и «церковном разводе»</a>
                </div>
                <div class="analytics-grid-item">
                  <a href="#" class="analytics-grid-item__title">Название статьи, может быть не в одну строку, а в две, три, четыре или больше строк, если длина названия блока превышает данный, его высота увеличивается</a>
                </div>
                <div class="analytics-banners">
                  <a href="#" class="analytics-banners__union">
                    Православный телеканал<br> «Союз»
                  </a>
                  <a href="#" class="analytics-banners__routes">
                    Маршруты<br> паломничества
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php get_template_part('partials/footer'); ?>
      </div>
    </div>
  </body>
</html>
