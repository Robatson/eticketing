<head>
    <meta charset="UTF-8">
    <title>Admin Log In</title>

    <link rel="stylesheet" href="{{asset('admin/assets/admin_admin/style.css')}}" />

</head>

<body>

    <form action="{{url('admin/check-login')}}" id="form" method="post" enctype="multipart/form-data" class="validate-form mt-2">
        @csrf
        <h2>Admin Login</h2>
        <div class="results">
            @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{Session::get('fail')}}
            </div>
            @endif
        </div>
        <div>
            <input type="email" name="email" class="text-field" placeholder="Email" value="{{old('email')}}" />
            @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
        </div>
        <div>
            <input type="password" name="password" class="text-field" placeholder="Password" />
            @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
        </div>
        <!-- <input type="button"  class="button" value="Log In" /> -->
        <button class="button">Login</button>
    </form>

</body>

</html>
