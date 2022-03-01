
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lazer</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/auth.css') }}">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12 auth-container">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="{{ asset('images/logo/logo.png') }}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Reset Password</h1>
                    @if(session('status')) 
                        <div class="login-alert alert alert-success">
                            {{ session('status')}}
                        </div>
                    @endif
                    @error('email')
                        <div class="login-alert alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    @if ($errors->has('password'))
                        <div class="login-alert alert alert-danger">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    @if ($errors->has('password_confirmation'))
                        <div class="login-alert alert alert-danger">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                    <form action="{{ route('reset-password') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-icon-left">
                                    <label for="email-id-icon">Email</label>
                                    <div class="position-relative">
                                        <input type="email" name="email" class="form-control form-control-lg" value="{{ $_GET['email'] ?? old('email') }}">
                                        <div class="form-control-icon">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group has-icon-left">
                                    <label for="password-id-icon">New Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="password" class="form-control form-control-lg">
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group has-icon-left">
                                    <label for="password-id-icon">Confirm Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="password_confirmation" class="form-control form-control-lg">
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
 
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Reset</button>
                    </form>

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600' style="font-size: 1rem;"> <a href="{{ route('login') }}" class="font-bold">Log in</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>