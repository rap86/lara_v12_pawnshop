<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication</title>
    <link rel="stylesheet" href="{{ asset('adminlte/css/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}">

    <style>
        /* Target core behaviors for the standalone OTP inputs */
        .otp-field input {
            width: 50px;
            height: 55px;
            font-size: 24px;
            text-align: center;
        }
        /* Remove the up/down arrows for number inputs */
        .otp-field input::-webkit-outer-spin-button,
        .otp-field input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body class="login-page bg-light">

<div class="login-box" style="width: 430px;">
    <div class="card card-outline card-dark shadow-lg">
        <div class="card-body login-card-body text-center p-4">

            <div class="mb-3">
                <i class="bi bi-shield-lock text-primary" style="font-size: 3rem;"></i>
            </div>

            <h2 class="login-box-msg fw-bold text-dark pb-0 mb-3 fs-3">
                Two-Factor<br>Authentication
            </h2>

            <form id="otp-form" action="{{ route('settings.input_validation') }}" method="POST">
                @csrf <div class="otp-field d-flex justify-content-center gap-2 mb-4">
                    <input type="number" class="form-control" maxlength="1" oninput="moveToNext(this, 1)" onkeydown="moveBack(event, 1)" required autocomplete="off" autofocus>
                    <input type="number" class="form-control" maxlength="1" oninput="moveToNext(this, 2)" onkeydown="moveBack(event, 2)" required autocomplete="off">
                    <input type="number" class="form-control" maxlength="1" oninput="moveToNext(this, 3)" onkeydown="moveBack(event, 3)" required autocomplete="off">
                    <input type="number" class="form-control" maxlength="1" oninput="moveToNext(this, 4)" onkeydown="moveBack(event, 4)" required autocomplete="off">
                    <input type="number" class="form-control" maxlength="1" oninput="moveToNext(this, 5)" onkeydown="moveBack(event, 5)" required autocomplete="off">
                    <input type="number" class="form-control" maxlength="1" oninput="moveToNext(this, 6)" onkeydown="moveBack(event, 6)" required autocomplete="off">
                </div>

                <input type="hidden" name="full_code" id="full_code">

                @if ($errors->has('otp'))
                    <div class="alert alert-danger p-2 small mb-3 text-start">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $errors->first('otp') }}
                    </div>
                @endif

                <p class="text-secondary small mb-4 px-2">
                    A message with a verification code has been sent to your devices. Enter the code to continue.
                </p>

                <div class="mb-3 small text-muted">
                    <i class="bi bi-hourglass-split me-1"></i> Code expires in: <span id="timer" class="fw-bold text-dark">05:00</span>
                </div>

                <div class="mb-4">
                    <button type="button" id="resend" class="btn btn-link btn-sm text-decoration-none p-0" disabled onclick="resendOTP()">
                        <i class="bi bi-arrow-clockwise me-1"></i>Request code again
                    </button>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100 fw-semibold py-2">
                            Verify Code
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    // 1. Auto-focus jumping behavior across inputs
    function moveToNext(current, index) {
        if (current.value.length >= 1 && index < 6) {
            document.querySelectorAll('.otp-field input')[index].focus();
        }
        combineCode();
    }

    // Handles backspacing behavior safely
    function moveBack(event, index) {
        if (event.key === "Backspace" && event.target.value === "" && index > 1) {
            document.querySelectorAll('.otp-field input')[index - 2].focus();
        }
    }

    // Concatenates the digits into our single tracking input item
    function combineCode() {
        let code = "";
        document.querySelectorAll('.otp-field input').forEach(input => {
            code += input.value;
        });
        document.getElementById('full_code').value = code;
    }

    // 2. Countdown Timer Logic (5 Minutes)
    let timeLeft = 5 * 60;
    const timerElement = document.getElementById('timer');
    const resendButton = document.getElementById('resend');

    const countdown = setInterval(() => {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;

        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        timerElement.textContent = `${minutes}:${seconds}`;

        if (timeLeft <= 0) {
            clearInterval(countdown);
            timerElement.textContent = "00:00";
            resendButton.disabled = false;
        } else {
            timeLeft--;
        }
    }, 1000);

    function resendOTP() {
        window.location.reload();
    }
    // FIX 2: Removed duplicate combineCode() block from here to optimize performance.
</script>

</body>
</html>
