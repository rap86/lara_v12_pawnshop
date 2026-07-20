<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LoginMoto - Pawnshop Management System</title>
        <link rel="stylesheet" href="{{ asset('adminlte/css/bootstrap-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">

        <style>
            /* Quick override to stop AdminLTE layout scripts from hijacking your body styles */
            html, body {
                height: 100% !important;
                min-height: 100% !important;
                background-color: #f8f9fa !important;
            }
        </style>
    </head>
    <body class="d-flex flex-column m-0 p-0">

        <nav class="navbar shadow-sm py-3 px-4 w-full" style="background-color: #2d3238; z-index: 1050;">
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <a class="navbar-brand fw-bold fs-3 text-white m-0" href="#" style="letter-spacing: -0.5px;">
                    Login<span class="text-secondary fw-light">Moto</span>
                </a>
                <div class="d-flex gap-2">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('hereafterlogin') }}" class="btn btn-outline-light rounded-pill px-4 btn-sm">Go to Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-light rounded-pill px-4 btn-sm fw-medium">Log In</a>
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <main class="flex-grow-1 d-flex align-items-center justify-content-center py-5 px-3">
            <div class="text-center w-100" style="max-w: 600px; margin: 0 auto;">
                <div class="mb-4 text-dark display-1 opacity-75">
                    <i class="bi bi-safe2" style="color: #2d3238;"></i>
                </div>
                <h1 class="display-5 fw-bold text-dark mb-3" style="letter-spacing: -1px;">Secure Management</h1>
                <p class="text-muted fs-5 mb-4 px-lg-5" style="line-height: 1.6;">
                    Streamline tracking, ticket inventories, collateral verification audits, and core operational reporting metrics seamlessly within a singular secure system portal ecosystem.
                </p>

                <div class="d-flex justify-content-center">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 py-2 fs-6 fw-medium shadow-sm border-0 rounded-3" style="background-color: #2d3238;">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Access Employee Session
                    </a>
                </div>
            </div>
        </main>

        <footer class="py-3 bg-white border-top text-center text-muted small w-100 mt-auto">
            <div class="container-fluid">
                Copyright &copy; 2014-<?php echo Date('Y')?> <a href="#" class="text-decoration-none text-dark fw-semibold">LoginMoto System</a>. All rights reserved.
            </div>
        </footer>

    </body>
</html>
