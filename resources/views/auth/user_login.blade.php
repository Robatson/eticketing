@extends('layout.app')

@section('title', 'eTicketing | Login Page')
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

.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
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
                Login
            </div>
            <div class="results">
                        @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{Session::get('fail')}}
                        </div>
                        @endif
                    </div>
                    @php if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pass']))
                   {
                      $login_email = $_COOKIE['login_email'];
                      $login_pass  = $_COOKIE['login_pass'];
                      $is_remember = "checked='checked'";
                   }
                   else{
                      $login_email ='';
                      $login_pass = '';
                      $is_remember = "";
                    }
                   @endphp
            <form action="{{url('/check-login')}}"  id="form" method="post" enctype="multipart/form-data" class="validate-form mt-2">
              @csrf
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="email" id="email" value="{{$login_email}}"  placeholder="Email">
                </div>
                <div class="form-group mb-3">
                
                    <input type="password" class="form-control" name="password" id="password" value="{{$login_pass}}" placeholder="Password">
                    <span id="toggle_pwd"  class="fa fa-fw fa-eye field-icon " style="margin-right: 5%;"></span>
                   
                </div>
               
                <div class="form-group row">
                              <div class="col-md-6 offset-md-1">
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name="rememberme"> Remember Me
                                      </label>
                                  </div>
                              </div>
                          </div>
                <button class="btn mt-3">Login</button>
            </form>
            <div class="text-center fs-6">
                <a href="forgot-password">Forget password?</a> or <a href="register">Sign up</a>
            </div>
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
            "password": {
                required: true,
              
                
            }
        },
        messages: {
            "email": {
                required: "Please enter your email"
            },
            "password": {
                required: "Please enter an password",
               
            }
        },
        // submitHandler: function (form) { // for demo
        //     alert('valid form submitted'); // for demo
        //     return false; // for demo
        // }
    });

});
</script>
    

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
        $(function () {
            $("#toggle_pwd").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
               var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
                $("#password").attr("type", type);
            });
        });
</script>
@endpush