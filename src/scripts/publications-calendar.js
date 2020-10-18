require('es6-promise').polyfill()
require('isomorphic-fetch')

class PublicationsCalendar {
  constructor (wrapper) {
    this.elements = {
      wrapper,
      date: wrapper.querySelector('[data-publications-calendar-date]'),
      forward: wrapper.querySelector('[data-publications-calendar-forward]'),
      backward: wrapper.querySelector('[data-publications-calendar-backward]'),
      body: wrapper.querySelector('[data-publications-calendar-body]'),
      content: wrapper.querySelector('[data-publications-calendar-content]')
    }

    this.data = {}
    this.loading = 0
    this.activeDay = null

    this.handleBackward = this.handleBackward.bind(this)
    this.handleForward = this.handleForward.bind(this)
  }

  init () {
    this.elements.forward.addEventListener('click', this.handleForward)
    this.elements.backward.addEventListener('click', this.handleBackward)

    this.year = new Date().getFullYear()
    this.month = new Date().getMonth()

    this.renderCalendar()
  }

  renderCalendar () {
    let dates = []
    let mon = this.month
    let d = new Date(this.year, mon)
    let table = '<table><thead><tr><th>пн</th><th>вт</th><th>ср</th><th>чт</th><th>пт</th><th>сб</th><th>вс</th></thead></tr><tbody><tr>'

    this.elements.date.innerHTML = `${d.toLocaleDateString('ru-RU', { month: 'long' })} ${this.year}`

    for (let i = 0; i < this.getDay(d); i++) {
      const prevDate = new Date(d.getTime())
      prevDate.setDate(prevDate.getDate() - (this.getDay(prevDate) - i))
      table += '<td><button data-publications-calendar-day="' + this.formatDateKey(prevDate) + '" class="ecalendar-control__day ecalendar-control__day_past">' + prevDate.getDate() + '<span class="ecalendar-control__markers"></span></button></td>'
      dates.push(this.formatDateKey(prevDate))
    }

    while (d.getMonth() == mon) {
      const is_current = d.getDate() === new Date().getDate() && d.getMonth() === new Date().getMonth()

      table += '<td>'
      table += '<button data-publications-calendar-day="' + this.formatDateKey(d) + '" class="ecalendar-control__day'
      if (is_current) {
        table += ' ecalendar-control__day_current'
      }
      table += '">'
      table += d.getDate()
      table += '<span class="ecalendar-control__markers">'
      if (is_current) {
        table += '<span class="ecalendar-control__marker-current"></span>'
      }
      table += '</span>'
      table += '</button>'
      table += '</td>'

      if (this.getDay(d) % 7 == 6) {
        table += '</tr><tr>'
      }

      dates.push(this.formatDateKey(d))

      d.setDate(d.getDate() + 1)
    }

    if (this.getDay(d) != 0) {
      for (let i = this.getDay(d); i < 7; i++) {
        const futureDate = new Date(d.getTime())
        futureDate.setDate(futureDate.getDate() + (i - this.getDay(d)))
        table += '<td><button data-publications-calendar-day="' + this.formatDateKey(futureDate) + '" class="ecalendar-control__day ecalendar-control__day_future">' + futureDate.getDate() + '<span class="ecalendar-control__markers"></span></button></td>'
        dates.push(this.formatDateKey(futureDate))
      }
    }

    table += '</tr></tbody></table>'

    this.elements.body.innerHTML = table
    this.elements.body.querySelectorAll('[data-publications-calendar-day]').forEach(el => {
      el.addEventListener('click', () => this.showDay(el.dataset.publicationsCalendarDay))
    })

    this.loadCalendarData(dates)
  }

  formatDateKey (date) {
    return `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`
  }

  getDay (date) {
    let day = date.getDay()
    if (day == 0) day = 7
    return day - 1
  }

  loadCalendarData (dates) {
    this.loading += 1
    if (this.loading > 0) {
      this.elements.wrapper.classList.add('loading')
    }
    const formData = new FormData()
    formData.append('dates', dates)
    formData.append('action', 'get_publications_data')
    fetch(myajax.url, {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(json => {
        this.data = {...this.data, ...json}

        this.elements.body.querySelectorAll('[data-publications-calendar-day]').forEach(el => {
          const markers = el.querySelector('.ecalendar-control__markers')

          if (this.data[el.dataset.publicationsCalendarDay] && this.data[el.dataset.publicationsCalendarDay].length > 0 && !markers.querySelector('.ecalendar-control__marker-primary')) {
            markers.innerHTML += '<span class="ecalendar-control__marker-primary"></span>'
          }
        })
      })
      .finally(() => {
        this.loading -= 1
        if (this.loading === 0) {
          this.elements.wrapper.classList.remove('loading')
        }
        if (!this.activeDay && this.data[this.formatDateKey(new Date())]) {
          this.showDay(this.formatDateKey(new Date()))
        }
      })
  }

  handleForward () {
    if (this.month === 11) {
      this.month = 0
      this.year = this.year + 1
    } else {
      this.month = this.month + 1
    }

    this.renderCalendar()
  }

  handleBackward () {
    if (this.month === 0) {
      this.month = 11
      this.year = this.year - 1
    } else {
      this.month = this.month - 1
    }

    this.renderCalendar()
  }

  showDay (day) {
    const data = this.data[day]
    const dayDate = new Date(day)

    let html = ''
    html += '<div class="ecalendar-dates">'
    html += '<div class="ecalendar-dates__row">'
    html += '<div class="ecalendar-dates__row-value">'
    html += dayDate.toLocaleDateString('ru-RU', { month: 'long', day: 'numeric' })
    html += '</div>'
    html += '</div>'
    html += '</div>'
    if (data.length > 0) {
      data.forEach(item => {
        html += '<div>'
        html += '<a href="' + item.url + '">'
        html += item.title
        html += '</a>'
        html += '</div>'
      })
    } else {
      html += '<div>В этот день нет событий.</div>'
    }
    this.elements.content.innerHTML = html
    this.activeDay = day
  }
}

export default PublicationsCalendar
