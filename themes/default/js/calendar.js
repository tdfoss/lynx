/**
 * @Project NUKEVIET 4.x
 * @Author mynukeviet (contact@mynukeviet.com)
 * @Copyright (C) 2019 mynukeviet. All rights reserved
 * @Createdate Thu, 02 May 2019 10:41:47 GMT
 */

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: lang,
        timeZone : 'UTC',
        plugins : [ 'dayGrid', 'timeGrid', 'list' ],
        height: 700,
        header : {
            left : 'prev,next today',
            center : 'title',
            right : 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        navLinks : true, // can click day/week names to navigate views
        editable : true,
        eventLimit : true, // allow "more" link when too many events
        eventSources : [ {
            url : nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main&nocache=' + new Date().getTime(),
            method : 'POST',
            extraParams : {
                get_event_data : '1'
            },
            failure : function() {
                alert('there was an error while fetching events!');
            }
        } ]
    });
    
    calendar.render();
});