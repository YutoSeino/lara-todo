import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";

var calendarEl = document.getElementById("calendar");
document.addEventListener('DOMContentLoaded', function() {
    let calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
        initialView: "dayGridMonth",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
        },
        locale: "ja",
        timeZone: 'Asia/Tokyo',
        buttonText: {
            today: '今月',
            month: '月',
            week: '週',
            day: '日',
            list: 'リスト'
        },
        events: '/event-get',
    });
    calendar.render();
});