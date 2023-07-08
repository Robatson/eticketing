@extends('layout.admin')
<?php

use App\UserRequest; ?>
@section('title', 'eTicketing | Admin View Event')

@section('body')
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Event Status</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> Sl no. </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Phone no. </th>
                                <th> Event Name </th>
                                <th> Start Date </th>
                                <th> End Date </th>
                                <th> Ticket Price</th>
                                <th> Status </th>
                            </tr>
                        </thead>
                        <?php $slno = 1; ?>
                        <tbody>
                            @foreach ($event as $event )
                            <tr>
                                <td> {{$slno++}} </td>
                                <td> {{$event->first_name}}
                                    {{$event->last_name}}
                                </td>
                                <td> {{$event->email}} </td>
                                <td> {{$event->phone}} </td>
                                <td> {{$event->event_name}} </td>
                                <td> {{$event->start_date6}} </td>
                                <td> {{$event->end_date}} </td>
                                <td> {{$event->ticket_price}} </td>
                                <td>
                                    <select class="form-control rfaupdatestatus" name="status" id="rfastatus" onchange="updaterfastatus({{$event->id}},$(this).val());" style="width:100%; padding: 6px 12px;">
                                        <option value="Approved" {{($event->status == 'Approved') ? 'selected' : '' }}>Approved</option>
                                        <option value="On Hold" {{($event->status == 'On Hold') ? 'selected' : '' }}>On Hold</option>
                                        <option value="Reject" {{($event->status == 'Reject') ? 'selected' : '' }}>Reject</option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script type="text/javascript">
    function updaterfastatus(id, statusvalue) {
        let status = statusvalue;
        let reqid = id;
        let description = '';

        jQuery.ajax({
            url: "{{url('admin/viewupdate-request-status/')}}" + "/" + reqid+ "/" + status,
            method: 'POST',
            data: {
                '_token': "{{ csrf_token() }}",
                'status': status,

            },
            success: (data) => {
                alert(data);
                console.log(data);
                $("#successmsg").append(data);
                $('#successmsg').show();
                setInterval(function() {
                    location.reload();
                }, 1000);
            },
        });
    }

    $("#filter_tables").on('click', function() {
        $("#filter_show").toggle();


    });

    $('.Open tbody > tr').slice(11).hide();
    $('.Approved tbody > tr').slice(11).hide();

    $('.On Hold tbody > tr').slice(11).hide();
    $('.Reject tbody > tr').slice(11).hide();
</script>