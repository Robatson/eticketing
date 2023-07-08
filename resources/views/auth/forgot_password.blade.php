@extends('layout.app')

@section('title', 'eTicketing | Forgot Password Page')
@push('links')
    <style>
       body {
    padding: 20px;
}

label {
    display: block;
}

input.error {
    border: 1px solid red;
}

label.error {
    font-weight: normal;
    color: red;
}
</style>
@endpush
@section('body')
    <div class="login-section">
        <div class="wrapper">
            <div class="logo">
                <img src="https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-bird-symbols-png-logo-0.png" alt="">
            </div>
            <div class="text-center mt-4 name">
                Forgot Password
            </div>
            <div class="results">
                        @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail')}}
                        </div>
                        @endif
                        
                        @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    </div>
            <form action="{{url('/submit-forgot-password')}}" id="form" method="post" enctype="multipart/form-data" class="validate-form mt-2">
              @csrf
               
                <div class="form-group mb-3">
                    <input type="email" class="form-control" name="email" id="email"   placeholder="Email">
                    <span class="text-danger">@error('email'){{$message}}@enderror</span>
                </div>
                <button class="btn mt-3">Send Link</button>
            </form>
           
        </div>
    </div>
@endsection
@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>
<script>
$(document).ready(function () {
    $("#form").validate({
        rules: {
            "email": {
                required: true,
                email: true
            },
        },
        messages: {
            "email": {
                required: "Please enter your email"
            },
           
        },
       
    });

});
</script>
@endpush