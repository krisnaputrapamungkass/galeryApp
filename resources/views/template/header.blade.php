<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Galery Foto Kambing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                {{-- <a class="navbar-brand fw-bold fs-4 text-primary" href="#">Galery Foto No</a> --}}
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand fw-bold fs-4 text-primary d-flex align-items-center" href="#">
                        <img src="https://cdn-icons-png.flaticon.com/512/1375/1375106.png" alt="Logo" height="30" class="me-2">
                        Galery Foto
                    </a>

                <ul class="mb-2 navbar-nav me-auto mb-lg-0">
                    @if (Auth::check() == true)
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('beranda.index') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Album</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">Like</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                        </li>
                    @endif
                </ul>

                <!-- Theme Switcher -->
                <div class="me-3">
                    <button class="btn btn-link nav-link" id="themeSwitcher">
                        <i class="bi bi-sun-fill theme-icon-active" data-theme-icon-active="bi-sun-fill"></i>
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="registrasi" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Registrasi
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('users.store') }}" method="post" id="registrationForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Username</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" id="confirmPassword" class="form-control" required>
                                        <div class="invalid-feedback" id="passwordError">
                                            Password tidak cocok.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="namaLengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="namaLengkap" name="nama_lengkap" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="5" required></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" id="submitBtn">Daftar</button>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const form = document.getElementById('registrationForm');
                                    const password = document.getElementById('password');
                                    const confirmPassword = document.getElementById('confirmPassword');
                                    const passwordError = document.getElementById('passwordError');
                                    const submitBtn = document.getElementById('submitBtn');
                            
                                    // Validasi password saat tombol submit ditekan
                                    submitBtn.addEventListener('click', function() {
                                        if (password.value !== confirmPassword.value) {
                                            confirmPassword.classList.add('is-invalid');
                                            passwordError.style.display = 'block';
                                            return false;
                                        } else {
                                            confirmPassword.classList.remove('is-invalid');
                                            passwordError.style.display = 'none';
                                            form.submit();
                                        }
                                    });
                            
                                    // Validasi password saat mengetik
                                    confirmPassword.addEventListener('input', function() {
                                        if (password.value !== confirmPassword.value) {
                                            confirmPassword.classList.add('is-invalid');
                                            passwordError.style.display = 'block';
                                        } else {
                                            confirmPassword.classList.remove('is-invalid');
                                            passwordError.style.display = 'none';
                                        }
                                    });
                                });
                            </script>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Login Galery</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('users.login') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">login</button>
                                <!-- Button trigger modal -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="d-flex" role="search">
                    <input class="form-control me-3 " type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success me-2" type="submit">Search</button>
                    @if (Auth::check() == true)
                        <input type="text" value="{{ Auth::user()->name }}" readonly class="form-control me-2">
                        <a class="btn btn-outline-danger" href="{{ route('users.logout') }}">Logout</a>
                    @else
                        <!-- Button trigger modal -->
                        <button type="button" class="ml-2 btn btn-outline-primary me-2" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Login
                        </button>
                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                            data-bs-target="#registrasi">
                            Registrasi
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </nav>

    @if ($errors->any())
        <div class="container mt-1 ">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="container mt-1 ">
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Theme Switcher Script -->
    <script>
        const themeSwitcher = document.getElementById('themeSwitcher');
        const html = document.querySelector('html');
        const themeIcon = themeSwitcher.querySelector('i');

        // Check for saved theme preference
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            html.setAttribute('data-bs-theme', savedTheme);
            updateIcon(savedTheme);
        } else {
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            html.setAttribute('data-bs-theme', systemTheme);
            updateIcon(systemTheme);
        }

        // Theme switcher click handler
        themeSwitcher.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            html.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });

        // Update theme icon
        function updateIcon(theme) {
            if (theme === 'dark') {
                themeIcon.classList.remove('bi-sun-fill');
                themeIcon.classList.add('bi-moon-fill');
            } else {
                themeIcon.classList.remove('bi-moon-fill');
                themeIcon.classList.add('bi-sun-fill');
            }
        }
    </script>
</body>
</html>