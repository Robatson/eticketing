<?php
use Illuminate\Support\Carbon;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Payment Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #00bcd4, #ff4081);
    }
    
    .header {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }
    
    .footer {
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
      font-size: 14px;
    }
    
    .container {
      max-width: 400px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .container h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    
    .container label {
      display: block;
      margin-bottom: 10px;
      color: #555;
    }
    
    .container input[type="email"],
    .container input[type="tel"],
    .container select {
      width: 90%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    
    .container .quantity {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }
    h2 {
  text-decoration: underline;
}
    
    .container .quantity label {
      flex-basis: 70%;
    }
    
    .container .quantity input {
      width: 50px;
      text-align: center;
    }
    
    .container .total {
      margin-top: 20px;
    }
    
    .container .total label {
      font-weight: bold;
    }
    
    .container input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .total-amount {
    text-align: center;
    margin-bottom: 15px;
  }
  .quantity {
    display: flex;
    align-items: center;
  }

  .quantity input {
    width: 30px;
    text-align: center;
    border: none;
    background-color: transparent;
    font-weight: bold;
    color: #555;
  }

  .quantity button {
    width: 30px;
    height: 30px;
    background-color: #ff6b6b;
    border: none;
    border-radius: 70%;
    font-size: 16px;
    color: #fff;
    cursor: pointer;
    margin: 0 5px;
  }

  .quantity button:focus {
    outline: none;
  }

  .quantity button:hover {
    background-color: #ff8f8f;
  }

  .razorpay_btn {
  position: relative;
  margin-left: 25%;
  display: block;
  width: 200px;
  height: 36px;
  border-radius: 18px;
  background-color: #1c89ff;
  border: solid 1px transparent;
  color: #fff;
  font-size: 18px;
  font-weight: 300;
  cursor: pointer;
  transition: all .1s ease-in-out;
 
  
}

  </style>
</head>
<body>
  <div class="container">
    <h2>{{$event->event_name}}</h2>
    <?php $date = Carbon::parse($event->start_date)->format('l d F Y'); ?>
    <h2><?php echo $date; ?></h2>

    <form>
      <label for="name">Email:</label>
      <input type="email" id="email" class="email" name="email" placeholder="Enter your email" required>
      <span id="email_error"></span><br>
      <label for="email">Phone:</label>
      <input type="tel" id="phone" name="phone" class="phone" placeholder="Enter your phone" required>
      <span id="phone_error"></span><br>
      <br><br>
      <div class="quantity">
        <button type="button" class="minus-btn">-</button>
        <input type="number" class="num-people" id="people_number" min="1" max="5" value="1" readonly>
        <button type="button" class="plus-btn">+</button>
      </div>
      <div class="total-amount">
        <p class="info">Total Amount: Rs: <span id="displayTotalAmount">0</span><span class="label" id="ticketLabel"> Ticket</span></p>
      </div>

      <!-- <input type="submit" value="Submit"> -->
      <button type="button" class="razorpay_btn">Pay</button>
    </form>
  </div>

  <!-- FOR RAZORPAY -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

  const numPeopleInput = document.querySelector('.num-people');
  const plusBtn = document.querySelector('.plus-btn');
  const minusBtn = document.querySelector('.minus-btn');
  const ticketRate = <?php echo $event->ticket_price; ?>; // Get the ticket rate from PHP

  let totalAmount = ticketRate; // Initialize totalAmount with the default ticket rate

  // Add event listeners for plus/minus buttons
  plusBtn.addEventListener('click', () => {
    let numPeople = parseInt(numPeopleInput.value);
    if (numPeople < 5) {
      numPeople++;
      numPeopleInput.value = numPeople;
      updateTotalAmount(numPeople);
    } 
  });

  minusBtn.addEventListener('click', () => {
    let numPeople = parseInt(numPeopleInput.value);
    if (numPeople > 1) {
      numPeople--;
      numPeopleInput.value = numPeople;
      updateTotalAmount(numPeople);
    } 
  });

  // Function to update the total amount based on the number of tickets
  function updateTotalAmount(numPeople) {
    totalAmount = numPeople * ticketRate; // Calculate the total amount
    const totalAmountElement = document.getElementById('displayTotalAmount');
    const ticketLabel = document.getElementById('ticketLabel');

    totalAmountElement.textContent = totalAmount; // Update the total amount in the main page

    // Update the ticket label based on the number of tickets
    if (numPeople === 1) {
      ticketLabel.textContent = "  " + "(" + numPeople + ' Ticket' + ")";
      minusBtn.style.display = 'none';
    } else {
      ticketLabel.textContent = "  " + "(" + numPeople + ' Tickets' + ")";
      minusBtn.style.display = 'inline-block';
    }
    if (numPeople === 5) {
      plusBtn.style.display = 'none';
    } else {
      plusBtn.style.display = 'inline-block';
    }
  }

  updateTotalAmount(1);

  $(document).ready(function () {
    $('.razorpay_btn').click(function (e) {
      var email = $('.email').val();
      var phone = $('.phone').val();
      if (!email) {
        email_error = "Email is required";
        $('#email_error').html('');
        $('#email_error').html(email_error);

      } else {
        email_error = "";
        $('#email_error').html('');
      }
      if (!phone) {
        phone_error = "Phone is required";
        $('#phone_error').html('');
        $('#phone_error').html(phone_error);

      } else {
        phone_error = "";
        $('#phone_error').html('');
      }
      if (email_error != "" || phone_error != "") {
        return false;
      }

      var options = {
        "key": "rzp_test_ampnuz3NWUHF0M",
        "amount": totalAmount * 100, // Use the totalAmount variable here
        "currency": "INR",
        "name": "Eticketing ",
        "description": "Thank you for choosing us",
        "image": "https://example.com/your_logo",
        "handler": function (response) {
          alert(response.razorpay_payment_id);
          alert(response.razorpay_order_id);
          alert(response.razorpay_signature);
        },
        "theme": {
          "color": "#3399cc"
        }
      };

      var prefill = {
        "contact": phone,
        "email": email // Add this line to include the email value
      };

      options.prefill = prefill;

      var rzp1 = new Razorpay(options);

      rzp1.on('payment.failed', function (response) {
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
      });

      rzp1.open();
      e.preventDefault();
    });
  });

</script>


</body>
</html>
