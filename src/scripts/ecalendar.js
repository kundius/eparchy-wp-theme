import 'regenerator-runtime/runtime'

class ECalendar {
  constructor (wrapper) {
    this.elements = {
      wrapper,
      date: wrapper.querySelector('[data-ecalendar-date]'),
      forward: wrapper.querySelector('[data-ecalendar-forward]'),
      backward: wrapper.querySelector('[data-ecalendar-backward]'),
      body: wrapper.querySelector('[data-ecalendar-body]')
    }

    this.handleBackward = this.handleBackward.bind(this)
    this.handleForward = this.handleForward.bind(this)
    this.handleDayClick = this.handleDayClick.bind(this)
  }

  init () {
    this.elements.forward.addEventListener('click', this.handleForward)
    this.elements.backward.addEventListener('click', this.handleBackward)

    this.year = new Date().getFullYear()
    this.month = new Date().getMonth()

    this.renderCalendar()
  }

  async renderCalendar () {
    let mon = this.month
    let d = new Date(this.year, mon)
   
    let table = '<table><thead><tr><th>пн</th><th>вт</th><th>ср</th><th>чт</th><th>пт</th><th>сб</th><th>вс</th></thead></tr><tbody><tr>'
   
    for (let i = 0; i < this.getDay(d); i++) {
      const prevDate = new Date(d.getTime())
      prevDate.setDate(prevDate.getDate() - (this.getDay(prevDate) - i))
      table += '<td><button class="ecalendar-control__day ecalendar-control__day_past">' + prevDate.getDate() + '</button></td>'
    }
   
    while (d.getMonth() == mon) {
      const info = await this.loadDayInfo(d.getDate())
      const is_current = d.getDate() === new Date().getDate() && d.getMonth() === new Date().getMonth()

      const markers = []
      if (is_current) {
        markers.push('<span class="ecalendar-control__marker-current"></span>')
      }
      if (info.is_holidays) {
        markers.push('<span class="ecalendar-control__marker-primary"></span>')
      }
      if (info.is_fasting) {
        markers.push('<span class="ecalendar-control__marker-post"></span>')
      }
      if (info.is_solid_weeks) {
        markers.push('<span class="ecalendar-control__marker-weeks"></span>')
      }
      if (info.is_commemoration) {
        markers.push('<span class="ecalendar-control__marker-memorial"></span>')
      }

      const button = document.createElement('button')
      button.dataset.info = info
      button.classList.add('ecalendar-control__day')
      if (is_current) {
        button.classList.add('ecalendar-control__day_current')
      }
      button.innerHTML = d.getDate()
      if (markers.length > 0) {
        const markersEl = document.createElement('span')
        markersEl.classList.add('ecalendar-control__markers')
        markersEl.innerHTML = markers.join('')
        button.appendChild(markersEl)
      }

      table += '<td>' + button.outerHTML + '</td>'

      if (this.getDay(d) % 7 == 6) { 
        table += '</tr><tr>'
      }
   
      d.setDate(d.getDate() + 1)
    }
   
    if (this.getDay(d) != 0) {
      for (let i = this.getDay(d); i < 7; i++) {
        const futureDate = new Date(d.getTime())
        futureDate.setDate(futureDate.getDate() + (i - this.getDay(d)))
        table += '<td><button class="ecalendar-control__day ecalendar-control__day_future">' + futureDate.getDate() + '</button></td>'
      }
    }
   
    table += '</tr></tbody></table>'
   
    this.elements.body.innerHTML = table
    this.elements.date.innerHTML = `${d.toLocaleDateString('ru-RU', { month: 'long' })} ${this.year}`
    // this.loadDaysInfo()
    // this.elements.body.querySelectorAll('[data-ecalendar-day]').forEach(el => el.addEventListener('click', this.handleDayClick))
  }

  getDay (date) {
    let day = date.getDay()
    if (day == 0) day = 7
    return day - 1
  }

  async loadDayInfo (day) {
  //   const days = this.elements.body.querySelectorAll('[data-ecalendar-day]')
  //   for (let i = 0; i < days.length; i++) {
      const formData = new FormData()
      formData.append('day', day)
      formData.append('year', this.year)
      formData.append('month', this.month)
      formData.append('action', 'get_day_info')
      const response = await fetch(myajax.url, {
        method: 'POST',
        body: formData
      })
      const json = await response.json()
      return json
  //     console.log(json)
  //     // .then(response => response.json())
  //     // .then(json => {
  //     //   console.log(json)
  //     // })
  //   }
  //   // this.elements.body.querySelectorAll('[data-ecalendar-day]')
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

  handleDayClick (e) {
    let formData = new FormData()
    formData.append('day', e.target.dataset.ecalendarDay)
    formData.append('year', this.year)
    formData.append('month', this.month)
    formData.append('action', 'get_day_info')
    fetch(myajax.url, {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(json => {
      console.log(json)
    })

    // axios.get(`https://script.pravoslavie.ru/cache_calendar_php/var=varname&php=1&hrams=0&hram=0&date=${e.target.dataset.ecalendarDay}.ls`)
    // .then(function (response) {
    //   // handle success
    //   console.log(response);
    // })
    // .catch(function (error) {
    //   // handle error
    //   console.log(error);
    // })
    // .then(function () {
    //   // always executed
    // });

    // fetch(`https://script.pravoslavie.ru/cache_calendar_php/var=varname&php=1&hrams=0&hram=0&date=${e.target.dataset.ecalendarDay}.ls`, {
    //   mode: 'no-cors',
    //   // headers: {
    //   //   'Access-Control-Allow-Origin':'*'
    //   // }
    // })
    // .then(response => {
    //   console.log(response)
    // })
    // .catch(response => {
    //   console.log(response)
    // })

    // if (response.ok) { // если HTTP-статус в диапазоне 200-299
    //   // получаем тело ответа (см. про этот метод ниже)
    //   let json = await response.json();
    // } else {
    //   alert("Ошибка HTTP: " + response.status);
    // }
    // 
    // console.log(e.target.dataset.ecalendarDay)
  }
}

export default ECalendar
