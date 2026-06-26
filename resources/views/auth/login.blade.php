<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pawnshop</title>
        <link rel="stylesheet" href="{{ asset('adminlte/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/css/bootstrap-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
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

                        <div class="input-group mb-2 shadow-sm rounded">
                            <input id="loginEmail" type="email" name="email" class="form-control border-end-0 py-2 fs-5" value="{{ old('email') }}" placeholder="Username" autocomplete="off"/>
                            <div class="input-group-text bg-white border-start-0 text-muted">
                                <span class="bi bi-person"></span>
                            </div>
                        </div>
                        @error('email')
                            <div class="text-danger small mb-2 ps-1"><i class="bi bi-exclamation-circle-fill me-1"></i> {{ $message }}</div>
                        @enderror

                        <div class="input-group mb-4 shadow-sm rounded">
                            <input id="loginPassword" type="password" name="password" class="form-control border-end-0 py-2 fs-5" placeholder="Password" />
                            <div class="input-group-text bg-white border-start-0 text-muted">
                                <span class="bi bi-lock-fill"></span>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-6"></div>

                            <div class="col-6">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-dark fw-medium shadow-sm py-2 px-3 rounded-2" style="background-color: #2d3238; border-color: #2d3238;">Sign In</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
