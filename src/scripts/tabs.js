class Tabs {
  constructor (wrapper) {
    this.elements = {
      wrapper,
      switch: wrapper.querySelectorAll('[data-tabs-switch]'),
      body: wrapper.querySelectorAll('[data-tabs-body]')
    }

    this.active = null
  }

  init () {
    this.elements.switch.forEach(el => el.addEventListener('click', () => {
      this.setTab(el.dataset.tabsSwitch)
    }))

    this.elements.switch[0].dispatchEvent(new Event('click'))
  }

  setTab (name) {
    this.active = name

    this.elements.switch.forEach(el => {
      if (el.dataset.tabsSwitch === name) {
        el.classList.add('active')
      } else {
        el.classList.remove('active')
      }
    })

    this.elements.body.forEach(el => {
      if (el.dataset.tabsBody === name) {
        el.classList.add('active')
      } else {
        el.classList.remove('active')
      }
    })
  }
}

export default Tabs
