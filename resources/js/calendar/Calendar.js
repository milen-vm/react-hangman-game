class Calendar {
    #currentDate = new Date();
    #weekDays = ['Пон', 'Вт', 'Ср', 'Чет', 'Пет', 'Суб', 'Нед'];
    #calendar;
    #monthYear;
    #events;
    #modal;

    constructor() {
        this.#setElements();
        // this.#renderCalendar();
        this.#getEvents();

    }

    cl = (item) => console.log(item);
    dcr = (el) => document.createElement(el);

    #getEvents() {
        fetch('/calendar/json', {method: 'GET', headers: {}})
            .then(response => response.json())
            .then(body => {
                this.cl(body)
                this.#events = body;

                this.#renderCalendar();
            });
    }

    #setElements() {
        this.#calendar = document.getElementById('calendar');
        this.#monthYear = document.getElementById('monthYear');
        this.#modal = document.getElementById('eventModal');
    }

    #renderCalendar(date = this.#currentDate) {
        this.#calendar.innerHTML = '';

        const year = date.getFullYear();
        const month = date.getMonth();
        const today = new Date(date.valueOf());

        const totalDays = new Date(year, month + 1, 0).getDate();
        const firstDayOfMonth = new Date(year, month, 1).getDay() - 1;

        this.#monthYear.textContent = date.toLocaleDateString('bg-BG', {
            month: 'long',
            year: 'numeric'
        });
        
        this.#weekDays.forEach(day => {
            const dayDiv = document.createElement('div');
            dayDiv.className = 'day-name';
            dayDiv.textContent = day;
            this.#calendar.appendChild(dayDiv);
        });

        for(let i = 0; i < firstDayOfMonth; i++) {
            this.#calendar.appendChild(document.createElement('div'));
        }

        let weekDay = firstDayOfMonth;
        for(let day = 1; day <= totalDays; day++) {
            const dateStr = `${String(day).padStart(2, '0')}-${String(month + 1).padStart(2,'0')}-${year}`;

            const cell = document.createElement('div');
            cell.className = 'day';
            if(weekDay === 5 || weekDay === 6) {
                cell.classList.add('free-day');
            }

            if(
                day === today.getDate() &&
                month === today.getMonth() &&
                year === today.getFullYear()
            ) {
                cell.classList.add('today');
            }

            const dateDiv = document.createElement('div');
            dateDiv.className = 'date-number';
            dateDiv.textContent = day;

            cell.appendChild(dateDiv);

            if(++weekDay > 6) {
                weekDay = 0;
            }

            const eventsToday = this.#events.filter(e => e.starts_at === dateStr);    // TODO: define events variable
            const eventBox = document.createElement('div');
            eventBox.className = 'events';

            eventsToday.forEach(item => {
                const ev = this.dcr('div');
                ev.className = 'event';

                const title = this.dcr('div');
                title.className = 'course';
                title.textContent = item.title;

                const discription = this.dcr('div');
                discription.className = 'instructor';
                discription.textContent = item.discription;

                const time = this.dcr('div');
                time.className = 'time';
                time.textContent = item.starts_at + ' - ' + item.ends_at;

                ev.appendChild(title);
                ev.appendChild(discription);
                ev.appendChild(time);
                eventBox.appendChild(ev);
            })

            // Overlay buttons
            const overlay = this.dcr('div');
            overlay.className = 'day-overlay';

            const addBtn = this.dcr('button');
            addBtn.className = 'overlay-btn';
            addBtn.textContent = '+ Add';
            addBtn.onclick = e => {
                e.stopPropagation();
                // TODO: oppenModalForAdd(dateStr);
            };

            overlay.appendChild(addBtn);

            if(eventsToday.length > 0) {
                const editBtn = this.dcr('button');
                editBtn.className = 'overlay-btn';
                editBtn.textContent = 'Edit';
                editBtn.onclick = e => {
                    e.stopPropagation;
                    // TODO: oppenModalForAdd(eventsToday);
                };

                overlay.appendChild(editBtn);
            }

            cell.appendChild(overlay);
            cell.appendChild(eventBox);
            this.#calendar.appendChild(cell);
        }
    }
}

export default Calendar;