<?php

use Illuminate\Support\Carbon;
?>

<style>
  .ticket {
    width: 600px;
    background-color: #f8f8f8;
    border: 2px solid #ff6b6b;
    border-radius: 10px;
    padding: 20px;
    max-width: 700px;
    margin: 0 auto;
    margin-bottom: 50%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

  }

  .ticket-header {
    text-align: center;
    margin-bottom: 15px;
  }

  .ticket-header h3 {
    margin: 0;
    font-size: 20px;
    color: #555;
  }

  .ticket-header .date {
    margin: 0;
    font-weight: bold;
    color: #888;
  }

  .ticket-body .info {
    margin: 5px 0;
    color: #555;
  }

  .ticket-body .info .label {
    font-weight: bold;
  }

  .ticket-controls {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  .ticket-type {
    flex-grow: 1;
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
    border-radius: 50%;
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

  .total-amount {
    text-align: center;
    margin-bottom: 15px;
  }

  .checkout-btn {
    width: 100%;
    padding: 10px;
    background-color: #ff6b6b;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    color: #fff;
    cursor: pointer;
  }

  .checkout-btn:hover {
    background-color: #ff8f8f;
  }

  @media (max-width: 700px) {
    .ticket {
      max-width: 100%;
      border-radius: 0;
    }
  }

  /* Modal styles */

  .form-row {
    display: flex;
    justify-content: space-between;
  }

  .form-row .col {
    flex-grow: 1;
    margin-right: 10px;
  }

  .modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
  }

  .modal-dialog {
    max-width: 400px;
    margin: 10% auto;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  }

  .modal-header {
    padding: 15px;
    background-color: #f8f8f8;
    border-bottom: 1px solid #eee;
    position: relative;
  }

  .modal-title {
    margin: 0;
  }

  .close {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 24px;
    font-weight: bold;
    color: #888;
    cursor: pointer;
  }

  .close:hover {
    color: #555;
  }

  .modal-body {
    padding: 20px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    font-weight: bold;
  }

  .form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    transition: border-color 0.3s;
  }

  .form-control:focus {
    outline: none;
    border-color: #ff6b6b;
  }

  .payment-method {
    margin-top: 10px;
  }

  .payment-method label {
    margin-right: 10px;
  }

  .modal-footer {
    padding: 15px;
    border-top: 1px solid #eee;
    text-align: right;
  }

  /* .btn-secondary {
    background-color: #ccc;
    color: #fff;
  } */

  /* .btn-primary {
    background-color: #ff6b6b;
    color: #fff;
  }
  
  #payButton{
    display: block;
    margin: 0 auto;
  } */

  #payButton {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    background-color: #4CAF50;
    color: #fff;
    cursor: pointer;
    display: block;
    margin: 0 auto;
  }


  .text-danger {
    color: #ff6b6b;
  }
</style>
<div class="ticket">
  <div class="ticket-header">
    <h3>{{$eventDetails->event_name}}</h3>
    <?php $date = Carbon::parse($eventDetails->start_date)->format('l d F Y'); ?>
    <p class="date"><?php echo $date; ?></p>
  </div>

  <div class="ticket-body">
    <p class="info"><span class="label">Location:</span> Event Location</p>
    <p class="info"><span class="label">Time:</span> Event Time</p>
    <div class="ticket-controls">
      <div class="ticket-type">
        <!-- <p class="info"><span class="label">Ticket Type:</span> VIP</p> -->
        <p class="info"><span class="label" id="ticket_price">Ticket Rate:</span>Rs:{{$eventDetails->ticket_price}}</p>
      </div>
      <div class="quantity">
        <button type="button" class="minus-btn">-</button>
        <input type="number" class="num-people" id="people_number" min="1" max="5" value="1" readonly>
        <button type="button" class="plus-btn">+</button>
      </div>
    </div>
    <!-- <div class="total-amount">
      <p class="info"><span class="label">Total Amount:</span> </p>
    </div> -->
    <!-- <button class="checkout-btn">Checkout to Pay</button>
  </div>
</div> -->
    <!-- Modal popup container -->
    <div class="modal" id="paymentModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="margin-left:35%">Payment Details</h5>
            <span class="close" onclick="closePaymentModal()">&times;</span>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="email">Email<span class="text-danger">*</span></label>
              <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
              <label for="phone">Phone Number<span class="text-danger">*</span></label>
              <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number" required>
            </div>
            <div class="form-group">
              <label for="paymentMethod">Payment Method</label>
              <div class="payment-method">
                <label>
                  <input type="radio" name="paymentMethod" value="card" onclick="showCardDetails()" checked> Card
                </label>
                <label>
                  <input type="radio" name="paymentMethod" value="upi" onclick="showUpiDetails()"> UPI
                </label>
              </div>
            </div>
            <div id="cardDetails">
              <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" placeholder="Enter your card number">
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col">
                    <label for="expiry">Expiry</label>
                    <input type="text" class="form-control" id="expiry" placeholder="MM/YY">
                  </div>
                  <div class="col">
                    <label for="cvv">CVV</label>
                    <input type="text" class="form-control" id="cvv" placeholder="Enter CVV">
                  </div>
                </div>
              </div>
            </div>
            <div id="upiDetails" style="display: none;">
              <div class="form-group">
                <label for="upiId">UPI ID</label>
                <input type="text" class="form-control" id="upiId" placeholder="Enter your UPI ID">
              </div>
            </div>
            <div class="form-group" style="margin-left: 35%;">
              <label for="totalAmount">Total Amount</label>
              <p id="totalAmount" class="form-control-static">Rs: 0</p>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" onclick="closePaymentModal()">Cancel</button> -->
            <button type="button" class="btn btn-primary" id="payButton">Pay</button>
          </div>
        </div>
      </div>
    </div>

    <div class="total-amount">
      <p class="info"><span class="label">Total Amount:</span> Rs: <span id="displayTotalAmount">0</span></p>
    </div>

    <!-- Modify the existing "Checkout to Pay" button -->
    <button class="checkout-btn" onclick="openPaymentModal()">Checkout to Pay</button>

    <!-- end of modal -->
    <script>
      // Get the ticket quantity input and plus/minus buttons
      const numPeopleInput = document.querySelector('.num-people');
      const plusBtn = document.querySelector('.plus-btn');
      const minusBtn = document.querySelector('.minus-btn');
      const ticketRate = <?php echo $eventDetails->ticket_price; ?>; // Get the ticket rate from PHP

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
        const ticketRate = <?php echo $eventDetails->ticket_price; ?>;
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