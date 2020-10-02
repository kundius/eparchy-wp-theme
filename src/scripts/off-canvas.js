const html = document.querySelector('html')
const toggle = document.querySelectorAll('[data-off-canvas-toggle]')

let timer = null
let opened = false

const show = () => {
  if (timer) {
    clearTimeout(timer)
  }
  // overlay.style.display = 'block'
  html.style.overflow = 'hidden'
  html.classList.add('off-canvas-opened')
  opened = true
}

const hide = () => {
  if (timer) {
    clearTimeout(timer)
  }
  timer = setTimeout(() => {
    html.style.overflow = null
    // overlay.style.display = 'none'
  }, 500)
  html.classList.remove('off-canvas-opened')
  opened = false
}

const handleToggle = () => {
  if (opened) {
    hide()
  } else {
    show()
  }
}

if (toggle.length > 0) {
  toggle.forEach(el => el.addEventListener('click', handleToggle))
}
