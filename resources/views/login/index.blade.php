<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPP | {{ $title }}</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
  
</head>

<body>
    <div class="container">
        <div class="row px-3">
            <div class="col-sm-8 col-lg-5 card">
                <div class="card-body">
                        <h4 class="title text-center">Login</h4>
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
                            <input type="email" name="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autofocus required>
                            @error('email')
                                <class class="invalid-feedback ">
                                    {{ $message }}
                                </class>
                            @enderror
                        </div>
                        <div class="form-input mt-1">
                            <div class="mb-1">
                                <label for="password">Password</label>
                            </div>
                            <span><i class="fa-solid fa-lock icon"></i></span>
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
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
                        <div class="register text-center" style="font-size: 14px">
                            <span><p>Don't have an account? <a href="/register">Register</a></p></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
