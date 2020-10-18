import Swiper, { Navigation, Pagination, Thumbs } from 'swiper'
import './polyfills'
import './archive-calendar'
import './off-canvas'
import './mainmenu'
import './drawermenu'
import HolidaysCalendar from './holidays-calendar'
import PublicationsCalendar from './publications-calendar'
import Tabs from './Tabs'
import MicroModal from 'micromodal'

MicroModal.init()

const openModalButtons = document.querySelectorAll('[data-open-modal]')
if (openModalButtons.length > 0) {
  openModalButtons.forEach(el => el.addEventListener('click', e => {
    e.preventDefault()
    MicroModal.show(el.dataset.openModal)
  }))
}

Swiper.use([Navigation, Pagination, Thumbs])

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

const tiledSwipers = document.querySelectorAll('[data-tiled-swiper]')
if (tiledSwipers.length > 0) {
  tiledSwipers.forEach(el => {
    const container = el.querySelector('.swiper-container')
    const date = el.querySelector('.tiled-slider__date')
    const slider = new Swiper(container, {
      simulateTouch: false,
      pagination: {
        clickable: true,
        el: el.querySelector('.swiper-pagination')
      },
      navigation: {
        nextEl: el.querySelector('[data-tiled-swiper-next]'),
        prevEl: el.querySelector('[data-tiled-swiper-prev]')
      }
    })
    date.innerHTML = slider.slides[0].dataset.tiledSwiperDate
    slider.on('slideChange', function () {
      date.innerHTML = slider.slides[slider.activeIndex].dataset.tiledSwiperDate
    })
  })
}

const holidaysCalendars = document.querySelectorAll('[data-holidays-calendar]')
if (holidaysCalendars.length > 0) {
  holidaysCalendars.forEach(el => new HolidaysCalendar(el).init())
}

const publicationsCalendars = document.querySelectorAll('[data-publications-calendar]')
if (publicationsCalendars.length > 0) {
  publicationsCalendars.forEach(el => new PublicationsCalendar(el).init())
}

const tabs = document.querySelectorAll('[data-tabs]')
if (tabs.length > 0) {
  tabs.forEach(el => new Tabs(el).init())
}

const swiperGalleryElements = document.querySelectorAll('[data-swiper-gallery]')
if (swiperGalleryElements.length > 0) {
  swiperGalleryElements.forEach(swiperGalleryElement => {
    const thumbSize = window.matchMedia('(max-width: 767px)').matches ? 48 : 100
    const html = document.querySelector('html')
    const body = document.querySelector('body')
    const parentElement = swiperGalleryElement.parentElement
    const mainElement = swiperGalleryElement.querySelector('[data-swiper-gallery-main]')
    const thumbsElement = swiperGalleryElement.querySelector('[data-swiper-gallery-thumbs]')
    const closeElements = swiperGalleryElement.querySelectorAll('[data-swiper-gallery-close]')
    const perView = Math.ceil(thumbsElement.offsetWidth / thumbSize)
    const windowPerView = Math.ceil(window.innerWidth / thumbSize)
  
    const galleryThumbs = new Swiper(thumbsElement, {
      allowTouchMove: false,
      slidesPerView: perView,
      freeMode: true,
      loopedSlides: 6,
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
      centerInsufficientSlides: true,
      navigation: {
        nextEl: '.slider-gallery-thumbs__next',
        prevEl: '.slider-gallery-thumbs__prev',
      }
    });
    const galleryTop = new Swiper(mainElement, {
      slidesPerView: 1,
      loop: true,
      loopedSlides: 6, //looped slides should be the same
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      thumbs: {
        swiper: galleryThumbs,
      },
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
    });

    const mainSlides = mainElement.querySelectorAll('.swiper-slide')
    if (mainSlides.length > 0) {
      mainSlides.forEach(el => el.addEventListener('click', () => {
        html.style.overflow = 'hidden'
        parentElement.style.height = `${swiperGalleryElement.offsetHeight}px`
        body.appendChild(swiperGalleryElement)
        swiperGalleryElement.classList.add('is-lightbox');
        galleryTop.update();
        galleryThumbs.update();
        galleryThumbs.params.slidesPerView = windowPerView;
        galleryThumbs.update();
      }))
    }

    if (closeElements.length > 0) {
      closeElements.forEach(el => el.addEventListener('click', () => {
        html.style.overflow = null
        parentElement.appendChild(swiperGalleryElement)
        parentElement.style.height = null
        swiperGalleryElement.classList.remove('is-lightbox');
        galleryTop.update();
        galleryThumbs.update();
        galleryThumbs.params.slidesPerView = perView;
        galleryThumbs.update();
      }))
    }
  })
}
