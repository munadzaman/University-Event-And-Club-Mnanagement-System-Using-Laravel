$(document).ready(function () {
  var calendarE4 = document.getElementById('fc-bg-events');
  var fcBgEvents = new FullCalendar.Calendar(calendarE4, {
      header: {
          left: 'prev,next today',
          center: 'title',
          right: "dayGridMonth,timeGridWeek,timeGridDay"
      },
      defaultDate: '2024-04-17',
      navLinks: true,
      businessHours: true,
      plugins: ['dayGrid', 'timeGrid', 'interaction'],
      // editable: true,
      events: function(info, successCallback, failureCallback) {
          // Make an AJAX request to fetch events data from the server
          $.ajax({
              url: '/calender/calendar-events/', // Endpoint to fetch events data dynamically
              type: 'GET',
              success: function(response) {
                  // Parse the JSON data
                  var events = [];
                  response.forEach(function(eventData) {
                      var event = {
                          title: eventData.name,
                          start: eventData.start_date,
                          end: eventData.end_date,
                          color: eventData.color, 

                      };
                      events.push(event);
                  });
                  // Pass the parsed events data to FullCalendar for rendering
                  successCallback(events);
              },
              error: function(xhr, status, error) {
                  console.error(error);
                  // Handle error
                  failureCallback(error);
              }
          });
      }
  });

  fcBgEvents.render();
});
