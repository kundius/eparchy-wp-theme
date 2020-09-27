const wrapper = document.querySelector('[data-archive-calendar]')

if (wrapper) {
  const prevYearEl = wrapper.querySelector('[data-archive-calendar-prev-year]')
  const yearEl = wrapper.querySelector('[data-archive-calendar-year]')
  const nextYearEl = wrapper.querySelector('[data-archive-calendar-next-year]')
  const monthsEl = wrapper.querySelector('[data-archive-calendar-months]')
  const monthsArray = Array.from(monthsEl.children)
  const daysEl = wrapper.querySelector('[data-archive-calendar-days]')

  let year, month

  const handleDayClick = e => {
    console.log(e.target.dataset)
  }

  const updateDays = () => {
    const date = new Date(year, month)
    daysEl.innerHTML = ''
    while (date.getMonth() == month) {
      const el = document.createElement('button')
      el.innerHTML = date.getDate()
      el.dataset.day = date.getDate()
      el.dataset.month = month
      el.dataset.year = year
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

  setYear(new Date().getFullYear())
  setMonth(new Date().getMonth())

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
