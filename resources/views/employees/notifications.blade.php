<div id="notifications-container" class="bg-purple-100 rounded-lg py-5 px-6 mb-4 text-base text-purple-700 mb-3" role="alert">
    RVM Admin sent a task! <a href="#">Check it out now.</a>
  </div>

  <script>
    channel.bind('my-event', function(data) {
        var template = $('#notification-template').html();
        var notification = template.replace('{{ message }}', data.message);
                                //   .replace('{{ date }}', data.date);
        $('#notifications-container').append(notification);
    });

    var notifications = $('#notifications-container').children();
    if (notifications.length > 10) {
        notifications.first().remove();
    }

  </script>