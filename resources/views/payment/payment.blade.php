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


  </style>
</head>
<body>
  <!-- <div class="header">
    <h1>Event Ticket Payment</h1>
   
  </div> -->
  
  <div class="container">
  <h2>{{$event->event_name}}</h2>
  <?php $date = Carbon::parse($event->start_date)->format('l d F Y'); ?>
  <h2><?php echo $date; ?></h2>
    
    <form>
      <label for="name">Email:</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>
      
      <label for="email">Phone:</label>
      <input type="tel" id="phone" name="phone" placeholder="Enter your phone" required>
      
      <br><br>
      <div class="quantity">
        <button type="button" class="minus-btn">-</button>
        <input type="number" class="num-people" id="people_number" min="1" max="5" value="1" readonly>Ticket
        <button type="button" class="plus-btn">+</button>
      </div>
      <div class="total-amount">
      <p class="info"><span class="label">Total Amount:</span> Rs: <span id="displayTotalAmount">0</span></p>
    </div>
      
      <!-- <div class="total">
        <label for="total">Ticket Price:</label>
        <span id="ticket-price">Rs 10.00</span>
      </div> -->
      
      <input type="submit" value="Submit">
      
    </form>
  </div>
  
  <!-- <div class="footer">
    <p>&copy; 2023 Event Ticket Payment. All rights reserved.</p>
  </div> -->

  <!-- <script>
    // Calculate total price based on quantity
    var quantityInput = document.getElementById('quantity');
    var ticketPriceElement = document.getElementById('ticket-price');

    function updateTicketPrice() {
      var quantity = quantityInput.value;
      var pricePerTicket = 10.00; // Change this to the actual ticket price
      var totalPrice = (quantity * pricePerTicket).toFixed(2);
      ticketPriceElement.textContent = 'Rs ' + totalPrice;
    }

    // Update ticket price when quantity changes
    quantityInput.addEventListener('change', updateTicketPrice);
    quantityInput.addEventListener('keyup', updateTicketPrice);

    // Plus/minus buttons functionality
    var minusButton = document.querySelector('.minus-btn');
    var plusButton = document.querySelector('.plus-btn');

    minusButton.addEventListener('click', function() {
      if (quantityInput.value > 1) {
        quantityInput.value--;
        updateTicketPrice();
      }
    });

    plusButton.addEventListener('click', function() {
      quantityInput.value++;
      updateTicketPrice();
    });
  </script> -->

  <script>
      // Get the ticket quantity input and plus/minus buttons
      const numPeopleInput = document.querySelector('.num-people');
      const plusBtn = document.querySelector('.plus-btn');
      const minusBtn = document.querySelector('.minus-btn');
      const ticketRate = <?php echo $event->ticket_price; ?>; // Get the ticket rate from PHP

      // Add event listeners for plus/minus buttons
      plusBtn.addEventListener('click', () => {
        let numPeople = parseInt(numPeopleInput.value);
        if (numPeople < 5) {
          numPeople++;
          numPeopleInput.value = numPeople;
          updateTotalAmount(numPeople);
        } else {
          alert("Only 5 tickets can be booked at a time.");
        }
      });

      minusBtn.addEventListener('click', () => {
        let numPeople = parseInt(numPeopleInput.value);
        if (numPeople > 1) {
          numPeople--;
          numPeopleInput.value = numPeople;
          updateTotalAmount(numPeople);
        } else {
          alert("Minimum 1 ticket.");
        }
      });

      // Function to update the total amount based on the number of tickets
      function updateTotalAmount(numPeople) {
        const totalAmount = numPeople * ticketRate; // Calculate the total amount
        const totalAmountElement = document.getElementById('displayTotalAmount');
        const modalTotalAmountElement = document.getElementById('totalAmount');

        totalAmountElement.textContent = totalAmount; // Update the total amount in the main page
        modalTotalAmountElement.textContent = `Rs: ${totalAmount}`; // Update the total amount in the payment modal
      }

      updateTotalAmount(1);
    </script>
    <script>
      function openPaymentModal() {
        document.getElementById('paymentModal').style.display = 'block';
        updateTotalAmount3();
      }

      function closePaymentModal() {
        document.getElementById('paymentModal').style.display = 'none';
      }

      function showCardDetails() {
        document.getElementById('cardDetails').style.display = 'block';
        document.getElementById('upiDetails').style.display = 'none';
      }

      function showUpiDetails() {
        document.getElementById('upiDetails').style.display = 'block';
        document.getElementById('cardDetails').style.display = 'none';
      }

      function updateTotalAmount3() {
        const numPeople = parseInt(document.querySelector('.num-people').value);
        const ticketRate = <?php echo $event->ticket_price; ?>;
        const totalAmount = numPeople * ticketRate;
        document.getElementById('totalAmount').textContent = `Rs: ${totalAmount}`;
      }

      document.getElementById('payButton').addEventListener('click', function() {
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phone').value;
        var paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;

        // Perform payment processing based on the selected payment method and collected data

        // Close the modal after payment processing
        // closePaymentModal();
      });
    </script>
</body>
</html>
