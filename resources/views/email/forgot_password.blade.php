<h1>Forgot Password Email</h1>
<b>This password reset link is valid only for 10 minutes</b><br>
You can reset password form below link:
<a href="{{ route('reset.password.get', ['token' => $reset_pss->token]) }}">Reset Password</a>
