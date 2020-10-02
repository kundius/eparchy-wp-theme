
const items = document.querySelectorAll('.drawer-mainmenu .menu-item-has-children')

if (items.length > 0) {
  items.forEach(item => {
    const close = () => {
      item.classList.remove('menu-item-opened')
    }

    const open = () => {
      item.classList.add('menu-item-opened')
    }

    const toggle = () => {
      if (item.classList.contains('menu-item-opened')) {
        close()
      } else {
        open()
      }
    }

    const link = item.querySelector('a')
    const handler = document.createElement('button')
    handler.classList.add('menu-item-toggle')
    link.appendChild(handler)

    handler.addEventListener('click', (e) => {
      e.preventDefault()
      e.stopPropagation()
      toggle()
    })

    link.addEventListener('click', (e) => {
      if (!item.classList.contains('menu-item-opened')) {
        e.preventDefault()
        open()
      }
    })
  })
}
