<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src='https://code.jquery.com/jquery-3.7.0.min.js'
        integrity='sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=' crossorigin='anonymous'></script>
</head>

<body>
    @if (session()->has('error'))
        <script>
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif

    <div class="bg-no-repeat bg-cover bg-center relative"
        style="background-image: url(https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80&w=873&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D);">
        <div class="absolute bg-linear-to-r from-green-600 to-green-900/30 opacity-75 inset-0 z-0"></div>
        <div class="min-h-screen sm:flex sm:flex-row mx-0 justify-center">
            <div class="flex-col flex  self-center p-10 sm:max-w-5xl xl:max-w-2xl  z-10">
                <div class="self-start hidden lg:flex flex-col  text-white">
                    <img src="" class="mb-3">
                    <h1 class="mb-3 font-bold text-5xl">E-SPP</h1>
                    <p class="pr-3">Selamat datang di Website E-SPP, tempat yang tepat untuk mengelokasi informasi SPP
                        Siswa</p>
                </div>
            </div>
            <form action="{{ route('login') }}" method="POST" class="flex justify-center self-center  z-10">
                @csrf

                <div class="p-12 bg-white mx-auto rounded-2xl w-100 ">
                    <div class="mb-4">
                        <h3 class="font-semibold text-2xl text-gray-800">Sign In </h3>
                        <p class="text-gray-500">Silahkan login terlebih dahulu</p>
                    </div>
                    <div class="space-y-5">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 tracking-wide">Email</label>
                            <input type="text" class=" w-full input @error('email') input-error @enderror mt-1"
                                name="email" placeholder="mail@gmail.com">
                            @error('email')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                                Password
                            </label>
                            <input type="password"
                                class="w-full input input @error('password') input-error @enderror mt-1" name="password"
                                placeholder="Masukkan password">
                            @error('password')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full flex justify-center bg-green-400  hover:bg-green-500 text-gray-100 p-3  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
                                Sign in
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</body>

</html>
