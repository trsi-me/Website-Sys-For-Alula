// Dark Mode Toggle
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleDarkMode');
    if (toggleBtn) {
        const isDarkMode = localStorage.getItem('darkMode') === 'enabled';
        
        if (isDarkMode) {
            document.body.classList.add('dark-mode');
            toggleBtn.textContent = '☀️ الوضع النهاري';
        }

        toggleBtn.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            toggleBtn.textContent = isDark ? '☀️ الوضع النهاري' : '🌙 الوضع الليلي';
            localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
        });
    }

    // Calendar for Events Page
    const calendarGrid = document.querySelector('.calendar-grid');
    if (calendarGrid) {
        const currentMonthEl = document.getElementById('currentMonth');
        const prevMonthBtn = document.getElementById('prevMonth');
        const nextMonthBtn = document.getElementById('nextMonth');
        
        let currentDate = new Date();
        
        function renderCalendar() {
            // Clear existing calendar
            calendarGrid.innerHTML = '';
            
            // Add day names
            const dayNames = ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
            dayNames.forEach(day => {
                const dayEl = document.createElement('div');
                dayEl.className = 'day-name';
                dayEl.textContent = day;
                calendarGrid.appendChild(dayEl);
            });
            
            // Set month name
            const monthNames = ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 
                               'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];
            currentMonthEl.textContent = `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
            
            // Get first day of month
            const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
            const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
            
            // Add empty cells for days before first day
            // Note: getDay() returns 0 for Sunday, 1 for Monday, etc. but our week starts on Sunday (index 0)
            for (let i = 0; i < firstDay.getDay(); i++) {
                const emptyCell = document.createElement('div');
                emptyCell.className = 'calendar-day empty';
                calendarGrid.appendChild(emptyCell);
            }
            
            // Add days of the month
            for (let i = 1; i <= lastDay.getDate(); i++) {
                const dayCell = document.createElement('div');
                dayCell.className = 'calendar-day';
                dayCell.textContent = i;
                
                // Add event indicator for some days (for demonstration, every 5th day has an event)
                if (i % 5 === 0) {
                    dayCell.classList.add('has-event');
                    dayCell.innerHTML = `${i} <span class="event-indicator">●</span>`;
                }
                
                calendarGrid.appendChild(dayCell);
            }
        }
        
        if (prevMonthBtn) {
            prevMonthBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });
        }
        
        if (nextMonthBtn) {
            nextMonthBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            });
        }
        
        renderCalendar();
    }
});