@extends('layout.app')

@section('title', 'eTicketing | Forgot Password Page')
@push('links')
    <style>

label.error {
    font-weight: normal;
    color: red;
}


    </style>
@endpush
@section('body')
  
  
  <main class="login-form">
    <div class="cotainer"><br><br>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Reset Password</div>
                    <div class="card-body">
    
                        <form action="{{ url('/submit-reset-password') }}" id="form" method="POST">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                            <!-- <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6"> -->
                                    <input type="hidden" id="email_address" class="form-control" name="email" value="{{$rst_pswrd->email}}" readonly  autofocus>
                                    <!-- @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div> -->
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password"  autofocus>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div><br>
                           
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation"  autofocus>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div><br>
    
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </form>
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
@endsection
@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>
<script>
jQuery('#form').validate({
    rules: {
        "password": {
            minlength: 6,
            required: true
        },
        "password_confirmation": {
          required: true,
          equalTo: "#password",
        }
       
    },
      messages: {
            "password": {
            minLength: "Password must be at least 6 charachters",
            required: "Please Enter Your Password."
        },
            "password_confirmation": {
                required: "PLEASE RE-ENTER YOUR PASSWORD",
            equalTo: "The password and confimation fields don't match"
        }
    },
});

$('button').click(function () {
    console.log($('#form').valid());
});
</script>
@endpush