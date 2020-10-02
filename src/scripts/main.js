import Swiper, { Navigation, Pagination } from 'swiper'
import './archive-calendar'
import './off-canvas'
import './mainmenu'
import './drawermenu'
import ECalendar from './ecalendar'
import Tabs from './Tabs'

Swiper.use([Navigation, Pagination])

/* Новости на первом экране главной */
const introNewsSwiper = new Swiper('.js-intro-news-swiper', {
  simulateTouch: false,
  pagination: {
    clickable: true,
    el: '.swiper-pagination'
  }
})

/* Актуальные новости */
const latestNewsSwiper = new Swiper('.js-latest-news-swiper', {
  simulateTouch: false,
  pagination: {
    clickable: true,
    el: '.swiper-pagination'
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev'
  }
})

/* Баннеры благочиний */
const deansBannersSwiper = new Swiper('.js-deans-banners-swiper', {
  simulateTouch: false,
  navigation: {
    nextEl: '.js-deans-banners-swiper-next',
    prevEl: '.js-deans-banners-swiper-prev'
  }
})

const tiledTalksSwiper = new Swiper('.js-tiled-swiper-talks', {
  simulateTouch: false,
  pagination: {
    clickable: true,
    el: '.swiper-pagination'
  }
})

const tiledArticlesSwiper = new Swiper('.js-tiled-swiper-articles', {
  simulateTouch: false,
  pagination: {
    clickable: true,
    el: '.swiper-pagination'
  }
})

const tiledInterviewsSwiper = new Swiper('.js-tiled-swiper-interviews', {
  simulateTouch: false,
  pagination: {
    clickable: true,
    el: '.swiper-pagination'
  },
  navigation: {
    nextEl: '.js-tiled-swiper-interviews-next',
    prevEl: '.js-tiled-swiper-interviews-prev'
  }
})

const ecalendars = document.querySelectorAll('[data-ecalendar]')
if (ecalendars.length > 0) {
  ecalendars.forEach(el => new ECalendar(el).init())
}

const tabs = document.querySelectorAll('[data-tabs]')
if (tabs.length > 0) {
  tabs.forEach(el => new Tabs(el).init())
}
