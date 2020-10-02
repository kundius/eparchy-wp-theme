import { isVisible } from './utils'

const items = document.querySelectorAll('.mainmenu .menu-item-has-children')

if (items.length > 0) {
  items.forEach(el => {
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
