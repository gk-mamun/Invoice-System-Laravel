
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lazer</title>
    <link rel="icon" href="{{ asset('images/logo/favicon.png') }}" type="image/gif">
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
                        <a href=""><img src="{{ asset('images/logo/company-logo.jpg') }}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                        @if(session('status')) 
                            <div class="login-alert ">
                                {{ session('status')}}
                            </div>
                        @endif

                    <form action="{{ route('user-login') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control " placeholder="Email" name="email">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control " placeholder="Password" name="password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="remember" name="remember">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>

                    <div class="text-center mt-5 text-lg fs-4 auth-footer-text">
                        
                        <p><a href="{{ route('password-reset-request') }}" class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
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