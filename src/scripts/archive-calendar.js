const wrapper = document.querySelector('[data-archive-calendar]')

if (wrapper) {
  const prevYearEl = wrapper.querySelector('[data-archive-calendar-prev-year]')
  const yearEl = wrapper.querySelector('[data-archive-calendar-year]')
  const nextYearEl = wrapper.querySelector('[data-archive-calendar-next-year]')
  const monthsEl = wrapper.querySelector('[data-archive-calendar-months]')
  const monthsArray = Array.prototype.slice.call(monthsEl.children)
  const daysEl = wrapper.querySelector('[data-archive-calendar-days]')
  const params = wrapper.dataset.archiveCalendar ? JSON.parse(wrapper.dataset.archiveCalendar) : {};

  let year, month

  const handleDayClick = e => {
    if (params.url) {
      window.location = params.url
        .replace('%year%', e.target.dataset.year)
        .replace('%month%', e.target.dataset.month)
        .replace('%day%', e.target.dataset.day)
    }
  }

  const updateDays = () => {
    const date = new Date(year, month)
    daysEl.innerHTML = ''
    while (date.getMonth() == month) {
      const el = document.createElement('button')
      el.innerHTML = date.getDate()
      el.dataset.day = date.getDate()
      el.dataset.month = month + 1
      el.dataset.year = year
      if (parseInt(params.day) === parseInt(el.dataset.day)) {
        el.classList.add('active')
      }
      daysEl.appendChild(el)
      el.addEventListener('click', handleDayClick)
      date.setDate(date.getDate() + 1)
    }
  }

  const setYear = (value) => {
    year = value
    yearEl.innerHTML = value
    updateDays()
  }

  const setMonth = (value) => {
    month = value
    monthsArray.forEach(el => el.classList.remove('active'))
    monthsEl.children[value].classList.add('active')
    updateDays()
  }

  setYear(params.year || new Date().getFullYear())
  setMonth(params.month ? params.month - 1 : new Date().getMonth())

  nextYearEl.addEventListener('click', () => {
    setYear(year + 1)
  })

  prevYearEl.addEventListener('click', () => {
    setYear(year - 1)
  })

  monthsArray.forEach(el => el.addEventListener('click', () => {
    setMonth(monthsArray.indexOf(el))
  }))
}
