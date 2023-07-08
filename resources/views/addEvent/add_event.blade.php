@extends('layout.event')

@section('title', 'eTicketing | Add Event')

@section('body')

@section('body')

<div class="page-content">
    <div class="form-v9-content" style="background-image:url('{{ asset('events/images/form-v9.jpg')}}');">
        <form class="form-detail" action="{{url('/store-event')}}" method="post" enctype="multipart/form-data" method="post">
            @csrf
            <h2>ADD EVENT</h2>
            <div class="form-row-total">
                <div class="form-row">

                    <input type="text" name="first_name" id="full-name" class="input-text" placeholder="First Name" required>
                </div>

                <div class="form-row">
                    <input type="text" name="last_name" id="your-email" class="input-text" placeholder="Last Name" required>
                </div>
            </div>
            <div class="form-row-total">
                <div class="form-row">
                    <input type="text" name="email" id="your-email" class="input-text" placeholder="Your Email" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
                </div>
                <div class="form-row">
                    <input type="tel" name="phone" id="comfirm-password" class="input-text" placeholder="Phone No." required>
                </div>
            </div>
            <div class="form-row-total">
                <div class="form-row">
                    <label for="email" class="form-label" style="margin-left:20px;">Start Date:</label>
                    <input type="date" name="start_date" id="password" class="input-text" placeholder="Start Date" required>
                </div>
                <div class="form-row">
                    <label for="email" class="form-label" style="margin-left:20px;">End Date:</label>
                    <input type="date" name="end_date" id="comfirm-password" class="input-text" placeholder="End DateS" required>
                </div>
            </div>
            <div class="form-row-total">
                <div class="form-row">
                    <input type="text" name="event_name" id="password" class="input-text" placeholder="Event Name" required>
                </div>
                <div class="form-row">
                    <input type="text" name="ticket_price" id="comfirm-password" class="input-text" placeholder="Ticket Price" required>
                </div>
            </div>
            <div class="form-row-total">
                <div class="form-row">
                    <input type="text" name="description" id="password" class="input-text" placeholder="Description" required>
                </div>
                <div class="form-row">
                    <input type="file" name="event_photo" id="comfirm-password" class="input-text" placeholder="Photo" required>

                </div>
            </div>


            <div class="form-row-last">
                <input type="submit" name="register" class="register" value="Register">
            </div>
        </form>
    </div>
</div>
@endsection