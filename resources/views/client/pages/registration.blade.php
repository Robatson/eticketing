@extends('layout.app')

@section('title', 'eTicketing | Registration')

@push('links')
    <style>
        label.error {
          color: red !important:
        }
        .card-img-left {
          width: 45%;
          /* Link to your background image using in the property below! */
          background: scroll center url('https://source.unsplash.com/WEQbe2jBg40/414x512');
          background-size: cover;
        }

        .btn-login {
          font-size: 0.9rem;
          letter-spacing: 0.05rem;
          padding: 0.75rem 1rem;
        }

        .btn-google {
          color: white !important;
          background-color: #ea4335;
        }

        .btn-facebook {
          color: white !important;
          background-color: #3b5998;
        }
        label.error {
    font-weight: normal;
    color: red;
}
    </style>
@endpush

@section('body')
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
          <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
            <div class="card-img-left d-none d-md-flex">
              {{-- Background image for card set in CSS! --}}
            </div>
            <div class="card-body p-4 p-sm-5">
            @if(Session::get('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif
            @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{Session::get('fail')}}
            </div>
            @endif
              <h5 class="card-title text-center mb-5 fw-light fs-5">Register</h5>

              <form id="register-form" action="{{ url('/store-registration') }}" method="post" class="mt-2">
              @csrf
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}"  >
                  <span class="text-danger">@error('username'){{$message}}@enderror</span>
                  <label for="floatingInputUsername">Username</label>
                  <div class="error" id="error-username"> </div>
                </div>
  
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" >
                  <span class="text-danger">@error('email'){{$message}}@enderror</span>
                  <label for="floatingInputEmail">Email address</label>
                  <div class="error" id="error-email"> </div>
                </div>
  
                <hr>
  
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="password" name="password" >
                  <span class="text-danger">@error('password'){{$message}}@enderror</span>
                  <label for="floatingPassword">Password</label>
                  <div class="error" id="error-password"></div>
                </div>
  
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="password-confirm" name="password_confirmation" >
                  <span class="text-danger">@error('password'){{$message}}@enderror</span>
                  <label for="floatingPasswordConfirm">Confirm Password</label>
                  <div class="error" id="error-password-confirm"> </div>
                </div>
  
                <div class="d-grid mb-2">
                  <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Register</button>
                </div>
  
                <a class="d-block text-center mt-2 small" href="login">Have an account? Sign In</a>
  
                <hr class="my-4">
  
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>
<script>
  $(document).ready(function() {
    $('#register-form').validate({
      rules: {
        username: {
          required: true,
        },
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minLength: 8,
        },
        password_confirmation: {
          required: true,
          equalTo: "#password",
        }
      },
      messages: {
        username: {
          required: "PLEASE ENTER YOUR NAME",
        },
        email: {
          required: "PLEASE ENTER YOUR EMAIL ADDRESS",
          email: "PLEASE ENTER A VALID EMAIL ADDRESS",
        },
        password: {
          required: "PLEASE ENTER YOUR PASSWORD",
          minLength: "PASSWORD SHOULD HAVE ATLEAST 8 CHARACTER",
        },
        password_confirmation: {
          required: "PLEASE RE-ENTER YOUR PASSWORD",
          equalTo: "ENTERED PASSWORD IS NOT MATCHED"
        },
      },
      errorPlacement: function(error, element) {
        if($(element).attr('id') === 'username') {
          error.appendTo($(element).parents('div').find($('#error-username')))
        }
        if($(element).attr('id') === 'email') {
          error.appendTo($(element).parents('div').find($('#error-email')))
        }
        if($(element).attr('id') === 'password') {
          error.appendTo($(element).parents('div').find($('#error-password')))
        }
        if($(element).attr('id') === 'password-confirm') {
          error.appendTo($(element).parents('div').find($('#error-password-confirm')))
        }
      }
    })
  })
</script>
@endpush