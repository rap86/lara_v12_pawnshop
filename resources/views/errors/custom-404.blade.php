<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Page not found!</title>
		<!--begin::Accessibility Meta Tags-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
		<meta name="color-scheme" content="light dark" />
		<meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
		<meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
		<!--end::Accessibility Meta Tags-->
		<!--begin::Primary Meta Tags-->
		<meta name="title" content="AdminLTE 4 | 404 Error Page" />
		<meta name="author" content="ColorlibHQ" />

		<link rel="stylesheet" href="{{ asset('adminlte/css/bootstrap-icons.min.css') }}">
		<link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">
	</head>
	<body class="bg-body-tertiary">
		<main class="d-flex align-items-center min-vh-100 py-5">
			<div class="container-fluid">
				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6 text-center">
						<div class="display-1 fw-bold text-danger lh-1 mb-3">404</div>
						<h1 class="h3 mb-3">Oops! Page not found.</h1>
						<p class="text-secondary mb-4"> We could not find the page you were looking for. Meanwhile, you may return to the dashboard or try searching for what you need. </p>
						<a href="{{ route('hereafterlogin') }}" class="btn btn-outline-secondary">
							<i class="bi bi-arrow-left me-1" aria-hidden="true"></i> Back to dashboard </a>
					</div>
				</div>
			</div>
		</main>

	</body>
</html>
