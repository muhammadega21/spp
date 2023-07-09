<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPP | {{ $title }}</title>
    <link rel="stylesheet" href="{{ url("css/style.css") }}">
    <link rel="stylesheet" href="{{ url("css/login.css") }}">
    <link rel="stylesheet" href="{{ url("bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ url("fontawesome/css/all.min.css") }}">
    <script src="{{ url("js/jquery-3.6.4.min.js") }}"></script>
</head>

<body>
    <div class="container">
        <div class="row px-3">
            <div class="col-sm-8 col-lg-5 card">
                <div class="card-body">
                        <h4 class="title text-center">Login</h4>
                        <div class="login">
                            <form action="/login" method="POST">
                                @csrf
                                @if (session('success'))
                                    <div id="flash-message" class="alert alert-success">
                                        {{ session('success') }}
                                        <i id="close" class="fa-solid fa-xmark text-danger" data-bs-dismiss="alert" style="position: absolute; right: 15px; top: 15px; cursor: pointer; font-size: 20px"></i>
                                    </div>
                                @endif
        
                                @if (session('loginError'))
                                    <div id="flash-message" class="alert alert-danger">
                                        {{ session('loginError') }}
                                        <i id="close" class="fa-solid fa-xmark text-danger" data-bs-dismiss="alert" style="position: absolute; right: 15px; top: 15px; cursor: pointer; font-size: 20px"></i>
                                    </div>
                                @endif
                                <div class="form-input">
                                    <div class="mb-1">
                                        <label for="email">Email</label>
                                    </div>
                                    <span><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <div class="invalid-feedback ">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-input mt-1">
                                    <div class="mb-1">
                                        <label for="password">Password</label>
                                    </div>
                                    <span><i class="fa-solid fa-lock icon"></i></span>
                                    <div class="inputPassword">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                        <i id="showPassword" class="fa-solid fa-eye-slash"></i>
                                    </div>
                                </div>
                                <input type="submit" class="submit" value="LOGIN">
                                <div class="action">
                                    <div class="check" style="user-select: none;">
                                        <input type="checkbox" class="checkbox" id="checkbox">
                                        <label for="checkbox">Remember me</label>
                                    </div>
                                    <div class="forgot">
                                        <span><a href="">Forgot Password?</a></span>
                                    </div>
                                </div>
                                <hr>
                                <div id="asd" class="register text-center" style="font-size: 14px">
                                    <span ><p>Don't have an account? <a href="/register">Register</a></p></span>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url("js/script.js") }}"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
