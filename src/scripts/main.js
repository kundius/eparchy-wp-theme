import Swiper, { Navigation, Pagination } from 'swiper'
import 'swiper/swiper-bundle.css'

Swiper.use([Navigation, Pagination])

const isVisible = elem => !!elem && !!( elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length ) // source (2018-03-11): https://github.com/jquery/jquery/blob/master/src/css/hiddenVisibleSelectors.js 

/* Основное меню */
const menuItems = document.querySelectorAll('.menu-item-has-children')
if (menuItems.length > 0) {
  menuItems.forEach(el => {
    let timer = null

    const outsideClickListener = event => {
      if (!el.contains(event.target) && isVisible(el)) {
        el.classList.remove('menu-item-clicked')
        document.removeEventListener('click', outsideClickListener)
      }
    }

    el.addEventListener('mouseenter', e => {
      clearTimeout(timer)
      timer = setTimeout(() => {
        el.classList.add('menu-item-hovered')
      }, 300)
    })

    el.addEventListener('mouseleave', e => {
      clearTimeout(timer)
      timer = setTimeout(() => {
        el.classList.remove('menu-item-hovered')
      }, 300)
    })

    const arrow = document.createElement('button')
    arrow.classList.add('menu-item-arrow')
    arrow.addEventListener('click', e => {
      e.preventDefault()
      if (el.classList.contains('menu-item-clicked')) {
        el.classList.remove('menu-item-clicked')
        document.removeEventListener('click', outsideClickListener)
      } else {
        el.classList.add('menu-item-clicked')
        document.addEventListener('click', outsideClickListener)
      }
    })
    el.appendChild(arrow)
  })
}

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
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev'
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
