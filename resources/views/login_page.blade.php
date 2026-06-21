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
	<body class="login-page bg-body-secondary">
		<div class="login-box">
			<div class="card card-outline card-secondary">
			<div class="card-header">
                <a href="#" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
				<h1 class="mb-0"><b>Pawnshop</b>Moto</h1>
                </a>
			</div>
			<div class="card-body login-card-body">
				<p class="login-box-msg">Sign in to start your session</p>
				<form action="#" method="#">
					<div class="input-group mb-1">
						<div class="form-floating">
							<input id="loginEmail" type="email" class="form-control" value="" placeholder="" autocomplete="off" />
							<label for="loginEmail">Username</label>
						</div>
						<div class="input-group-text">
							<span class="bi bi-envelope"></span>
						</div>
					</div>
					<div class="input-group mb-1">
						<div class="form-floating">
							<input id="loginPassword" type="password" class="form-control" placeholder="" />
							<label for="loginPassword">Password</label>
						</div>
						<div class="input-group-text">
							<span class="bi bi-lock-fill"></span>
						</div>
					</div>
					<div class="row">
						<div class="col-8 d-inline-flex align-items-center">
							<div class="form-check">
							</div>
						</div>
						<div class="col-4">
							<div class="d-grid gap-2">
								<button type="submit" class="btn btn-primary">Sign In</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</html>
