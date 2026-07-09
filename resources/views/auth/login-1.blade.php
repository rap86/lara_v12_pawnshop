<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pawnshop</title>
        <link rel="stylesheet" href="{{ asset('adminlte/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/css/bootstrap-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">

        <style>
            /* 1. Remove Bootstrap's default single-element input focus border glow */
            .input-group .form-control:focus {
                border-color: #dee2e6;
                box-shadow: none;
            }

            /* 2. Apply a uniform blue border + shadow around the *entire* input container block on active focus */
            .input-group:focus-within {
                border-color: #86b7fe !important;
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
                border-radius: 0.375rem; /* Matches default theme rounding */
            }

            /* 3. Ensure internal component borders drop cleanly into the collective background ring */
            .input-group:focus-within .form-control,
            .input-group:focus-within .input-group-text {
                border-color: #86b7fe;
            }
        </style>
    </head>
    <body class="login-page d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #22252a 0%, #343a40 100%); min-height: 100vh;">

        <div class="login-box">
            <div class="card shadow-lg border-0 rounded-3">

                <div class="card-header text-center border-0 pt-4 pb-1 bg-transparent">
                    <a href="#" class="text-decoration-none">
                        <h2 class="mb-0 text-dark fw-bold" style="letter-spacing: -0.5px;">Login<span class="text-secondary fw-light">Moto</span></h2>
                    </a>
                </div>

                <div class="card-body login-card-body px-4 pb-4">
                    <p class="login-box-msg text-muted small mb-4">Sign in to start your session</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group mb-2 shadow-sm rounded border">
                            <input id="loginEmail" type="text" name="username" class="form-control border-end-0 py-2 fs-5" value="{{ old('email') }}" placeholder="Username" autocomplete="off"/>
                            <div class="input-group-text bg-white border-start-0 text-muted">
                                <span class="bi bi-person"></span>
                            </div>
                        </div>
                        @error('username')
                            <div class="text-danger small mb-2 ps-1"><i class="bi bi-exclamation-circle-fill me-1"></i> {{ $message }}</div>
                        @enderror

                        <div class="input-group mb-4 shadow-sm rounded border">
                            <input id="loginPassword" type="password" name="password" class="form-control border-end-0 py-2 fs-5" placeholder="Password" />
                            <div class="input-group-text bg-white border-start-0 text-muted" id="togglePassword" style="cursor: pointer;">
                                <span class="bi bi-lock-fill" id="lockIcon"></span>
                            </div>
                        </div>

                        <div class="row align-items-center mb-3">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-dark fw-medium shadow-sm py-2 px-3 rounded-2" style="background-color: #2d3238; border-color: #2d3238;">Sign In</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-3 pt-3 border-top border-light-subtle">
                        <a href="{{ url('/') }}" class="text-secondary small text-decoration-none d-inline-flex align-items-center link-dark">
                            <i class="bi bi-arrow-left me-1.5"></i> Back to Home
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <script>
            document.getElementById('togglePassword').addEventListener('click', function () {
                const passwordInput = document.getElementById('loginPassword');
                const lockIcon = document.getElementById('lockIcon');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    lockIcon.className = 'bi bi-eye-fill';
                } else {
                    passwordInput.type = 'password';
                    lockIcon.className = 'bi bi-lock-fill';
                }
            });
        </script>
    </body>
</html>
