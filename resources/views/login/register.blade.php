<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPP | {{ $title }}</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
  
</head>

<body>
    <div class="container">
        <div class="row px-3">
            <div class="col-sm-12 col-md-10 col-xl-8 card">
                <div class="card-body">
                    <h4 class="title text-center">Register</h4>
                        <div class="register">
                            <form action="/register" method="POST">
                                @csrf
                                {{-- siswa_id --}}
                                <input type="text" name="id" value="{{ $siswa + 1 }}" hidden>
                                <div class="col-sm-12 d-block d-sm-flex justify-content-between">
                                    <div class="form-input col-sm-6 mb-1">
                                        <div class="mb-1">
                                            <label for="nisn">NISN</label>
                                        </div>
                                        <input type="text" name="nisn" id="nisn" placeholder="NISN" class="form-control @error('nisn') is-invalid  @enderror" value="{{ old('nisn') }}" required autofocus>
                                        @error('nisn')
                                            <div class="invalid-feedback ">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-input col-sm-6 mb-1">
                                        <div class="mb-1">
                                            <label for="nis">NIS</label>
                                        </div>
                                        <input type="text" name="nis" id="nis" placeholder="NIS" class="form-control @error('nis') is-invalid  @enderror" value="{{ old('nis') }}" required>
                                        @error('nis')
                                            <div class="invalid-feedback ">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 d-block d-sm-flex">
                                    <div class="form-input col-sm-6 mb-1">
                                        <div class="mb-1">
                                            <label for="name">Nama</label>
                                        </div>
                                        <input type="text" name="name" id="name" placeholder="Name" class="form-control @error('name') is-invalid  @enderror" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback ">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-input col-sm-6 mb-1">
                                        <div class="mb-1">
                                            <label for="username">Username</label>
                                        </div>
                                        <input type="text" name="username" id="username" placeholder="Username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                                        @error('username')
                                            <div class="invalid-feedback ">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 d-block d-sm-flex mb-2">
                                    <div class="form-input col-sm-6 mb-1">
                                        <div class="mb-1">
                                            <label for="email">Email</label>
                                        </div>
                                        <input type="email" name="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid  @enderror" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback ">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-input col-sm-6 mb-1">
                                        <div class="mb-1">
                                            <label for="password">Password</label>
                                        </div>
                                        <input type="password" name="password" id="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required>
                                        @error('password')
                                            <div class="invalid-feedback ">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="login">
                                    <input type="submit" class="submit" value="Register">
                                </div>
                                <hr>
                                <div class="register text-center" style="font-size: 14px">
                                    <span><p>Already have a account? <a href="/">Login</a></p></span>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
