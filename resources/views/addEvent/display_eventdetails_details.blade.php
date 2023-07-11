
<?php

use Illuminate\Support\Carbon;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Event Details</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    /* Reset some default styles */
    body, h1, h2, p, ul, li {
      margin: 0;
      padding: 0;
    }

    /* Basic styling */
    body {
      font-family: 'Roboto', sans-serif;
      background: url("/image/background.jpg");
    }

    main {
      padding: 20px;
      display: flex;
      justify-content: center;
    }

    .event-details {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      text-align: left;
      max-width: 1000px;
      max-height: 1000px;
      animation: fade-in 1s ease-in-out;
    }

    @keyframes fade-in {
      0% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }

    .event-details h2 {
      margin-bottom: 10px;
      font-family: 'Oswald', sans-serif;
      font-size: 24px;
      color: #333;
    }

    .event-details img {
      width: 100%;
      max-width: 700px;
      margin-bottom: 10px;
      border-radius: 5px;
    }

    .event-details p {
      margin-bottom: 10px;
      font-size: 16px;
      color: #555;
    }

    .event-details button {
      display: inline-block;
      padding: 10px 30px;
      background-color: #ffcc00;
      color: #333;
      text-decoration: none;
      border-radius: 50px;
      margin-top: 20px;
      font-family: 'Oswald', sans-serif;
      font-size: 16px;
      text-transform: uppercase;
      transition: background-color 0.3s ease-in-out;
    }

    .event-details a:hover {
      background-color: #fff;
    }
  </style>
</head>
<body>
  <main>
    <div class="event-details">
      <h2>{{$eventDetails->event_name}}</h2>
      <div class="event-image">
        <img src="event-image.jpg" alt="Event Image">
      </div>
     

                        
      <div class="event-info">
      <?php $date = Carbon::parse($eventDetails->start_date)->format('l d F Y'); ?>
        <p>Date: <span class="event-date"><?php echo $date; ?></span></p>
        <p>Time: <span class="event-time">{{$eventDetails->time}}</span></p>
        <p>Venue: <span class="event-venue">{{$eventDetails->venue}}</span></p>
        <p>Description: <span class="event-description">{{$eventDetails->description}}</span></p>
        <p>Ticket Price: <span class="event-ticket-price">Rs {{$eventDetails->ticket_price}}</span></p>
        <!-- <button type="button" id="bookTicketButton" data-event-name="{{$eventDetails->event_name}}" data-ticket-price="{{$eventDetails->ticket_price}}" data-slug="{{$eventDetails->slug}}">Buy Tickets</button> -->
        <button type="button" id="bookTicketButton"> <a href="{{ URL::to('payment/'.$eventDetails->slug) }}">Buy Tickets</button> 
      </div>
    </div>
  </main>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#bookTicketButton').on('click', function(e) {
        e.preventDefault();

        var eventName = $(this).data('event-name');
        var ticketPrice = $(this).data('ticket-price');
        var slug = $(this).data('slug');

        // Send AJAX request to the server
        $.ajax({
          url: '/payment',
          method: 'post',
          data: {
            event_name: eventName,
            ticket_price: ticketPrice,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            var url = '/payment';
            window.location.href = url;
          },
          error: function(xhr) {
            // Handle the error
          }
        });
      });
    });
  </script> -->
</body>
</html>
