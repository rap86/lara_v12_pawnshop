@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Card Container with soft styling and crisp shadow elevation -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- Elegant Premium Green Header with Subtle Gradient -->
            <div class="card-header bg-success text-white p-4 border-0 position-relative" style="background: linear-gradient(135deg, #157347 0%, #0f5132 100%);">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-20 p-3 rounded-3 me-3 border border-white border-opacity-25 shadow-sm d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-pencil-square fs-3 text-dark"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1 tracking-tight fs-3">Account Configuration</h4>
                        <p class="text-white-50 small mb-0 opacity-75 fs-6">Modify system privileges, authentication methods, and security tiers.</p>
                    </div>
                </div>
            </div>

            <!-- RESTFUL Edit Form Actions Layer Mapping to PUT route matrix -->
            <form class="editUserForm needs-validation" action="{{ route('users.update', $user->id) }}" method="POST" data-confirm-update novalidate>
                @csrf
                @method('PUT')

                <div class="card-body p-4 p-lg-5 bg-white">

                    <!-- SECTION 1: Identity & Context -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">01</span>
                            <h4 class="fw-bold text-dark mb-0 fs-4">Personal Profile</h4>
                        </div>

                        <div class="row g-4">
                            <!-- Full Name -->
                            <div class="col-lg-4">
                                <label for="name" class="form-label fw-bold text-dark fs-5 mb-2">Full Name</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-person fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3" id="name" name="name" placeholder="John Doe" value="{{ old('name', $user->name) }}" required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    <div class="invalid-feedback fs-6 mt-2">Please enter a valid full name.</div>
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="col-lg-4">
                                <label for="username" class="form-label fw-bold text-dark fs-5 mb-2">Username</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-person-badge fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3" id="username" name="username" placeholder="johndoe" value="{{ old('username', $user->username) }}" required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    <div class="invalid-feedback fs-6 mt-2">Please choose a unique system username.</div>
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="col-lg-4">
                                <label for="email" class="form-label fw-bold text-dark fs-5 mb-2">Email Address</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-envelope fs-4"></i></span>
                                    <input type="email" class="form-control form-control-lg fs-5 py-3" id="email" name="email" placeholder="johndoe@domain.com" value="{{ old('email', $user->email) }}" required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    <div class="invalid-feedback fs-6 mt-2">Please provide a valid corporate email address.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: System Permissions & Infrastructure -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">02</span>
                            <h4 class="fw-bold text-dark mb-0 fs-4">Access & Assignment</h4>
                        </div>

                        <div class="row g-4">
                            <!-- System Role -->
                            <div class="col-md-6 col-lg-3">
                                <label for="role" class="form-label fw-bold text-dark fs-5 mb-2">System Role</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-shield-lock fs-4"></i></span>
                                    <select class="form-select form-select-lg fs-5 py-3" id="role" name="role" required>
                                        <option value="" disabled>Choose tier...</option>
                                        <option value="clerk" {{ old('role', $user->role) == 'clerk' ? 'selected' : '' }}>Clerk (Standard Access)</option>
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin (Full Control)</option>
                                    </select>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    <div class="invalid-feedback fs-6 mt-2">Please select an access tier role.</div>
                                </div>
                            </div>

                            <!-- Account Status -->
                            <div class="col-md-6 col-lg-3">
                                <label for="status" class="form-label fw-bold text-dark fs-5 mb-2">Account Status</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-toggle-on fs-4"></i></span>
                                    <select class="form-select form-select-lg fs-5 py-3" id="status" name="status" required>
                                        <option value="" disabled>Select status...</option>
                                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    <div class="invalid-feedback fs-6 mt-2">Please select a valid operational status.</div>
                                </div>
                            </div>

                            <!-- Assigned Branch -->
                            <div class="col-md-6 col-lg-3">
                                <label for="branch_id" class="form-label fw-bold text-dark fs-5 mb-2">Assigned Branch</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-building fs-4"></i></span>
                                    <select class="form-select form-select-lg fs-5 py-3" id="branch_id" name="branch_id" required>
                                        <option value="" disabled>Choose branch...</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ old('branch_id', $user->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    <div class="invalid-feedback fs-6 mt-2">Please select an operational location branch.</div>
                                </div>
                            </div>

                            <!-- Floating Staff Toggle -->
                            <div class="col-md-6 col-lg-3 d-flex align-items-end">
                                <div class="p-3 bg-light border rounded-3 shadow-sm d-flex align-items-center w-100 style-lg-input">
                                    <div class="form-check form-switch form-switch-lg mb-0 fs-6 w-100 d-flex align-items-center">
                                        <input class="form-check-input cs-pointer" type="checkbox" id="is_floating" name="is_floating" value="1" {{ old('is_floating', $user->is_floating) ? 'checked' : '' }}>
                                        <label class="form-check-label text-dark fw-bold ms-3 fs-6" for="is_floating"><i class="bi bi-shuffle text-warning me-1"></i> Floating Staff</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: Multi-Factor Authentication Configuration & Destination Targets -->
                    <div class="mb-5 bg-light rounded-4 p-4 border border-light-subtle">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-white text-success border border-success border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">03</span>
                            <div>
                                <h4 class="fw-bold text-dark mb-0 fs-4">Two-Factor Authentication (2FA) Delivery Gateways</h4>
                                <p class="text-muted small mb-0 fs-6">Provide contact coordinates and toggle individual channels for security token delivery.</p>
                            </div>
                        </div>

                        <!-- 2FA Destination Coordinates -->
                        <div class="row g-4 mb-4">
                            <!-- Phone Number -->
                            <div class="col-lg-4">
                                <label for="phone_number" class="form-label fw-bold text-dark fs-5 mb-2">Phone Number (SMS)</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-white text-muted px-3"><i class="bi bi-phone fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3" id="phone_number" name="phone_number" placeholder="e.g., +63917XXXXXXX" value="{{ old('phone_number', $user->phone_number) }}">
                                </div>
                            </div>
                            <!-- Telegram Chat ID -->
                            <div class="col-lg-4">
                                <label for="chat_id_telegram" class="form-label fw-bold text-dark fs-5 mb-2">Telegram Chat ID</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-white text-muted px-3"><i class="bi bi-telegram text-info fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3" id="chat_id_telegram" name="chat_id_telegram" placeholder="e.g., 582910482" value="{{ old('chat_id_telegram', $user->chat_id_telegram) }}">
                                </div>
                            </div>
                            <!-- Viber Chat ID -->
                            <div class="col-lg-4">
                                <label for="chat_id_viber" class="form-label fw-bold text-dark fs-5 mb-2">Viber User ID</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-white text-muted px-3"><i class="bi bi-violet text-purple fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3" id="chat_id_viber" name="chat_id_viber" placeholder="e.g., vbr-usr-77a19..." value="{{ old('chat_id_viber', $user->chat_id_viber) }}">
                                </div>
                            </div>
                        </div>

                        <!-- Option Cards for individual 2FA Switches -->
                        <div class="row g-3">
                            <!-- Gmail Switch -->
                            <div class="col-sm-6 col-xl-2.4">
                                <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center h-100">
                                    <div class="form-check form-switch form-switch-lg mb-0 fs-4 w-100 d-flex align-items-center">
                                        <input class="form-check-input cs-pointer" type="checkbox" id="two_factor_gmail" name="two_factor_gmail" value="1" {{ old('two_factor_gmail', $user->two_factor_gmail) ? 'checked' : '' }}>
                                        <label class="form-check-label text-dark fw-bold ms-3 fs-5" for="two_factor_gmail"><i class="bi bi-google text-danger me-1"></i> Gmail</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Yahoo Switch -->
                            <div class="col-sm-6 col-xl-2.4">
                                <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center h-100">
                                    <div class="form-check form-switch form-switch-lg mb-0 fs-4 w-100 d-flex align-items-center">
                                        <input class="form-check-input cs-pointer" type="checkbox" id="two_factor_yahoo" name="two_factor_yahoo" value="1" {{ old('two_factor_yahoo', $user->two_factor_yahoo) ? 'checked' : '' }}>
                                        <label class="form-check-label text-dark fw-bold ms-3 fs-5" for="two_factor_yahoo"><i class="bi bi-envelope-fill text-purple me-1"></i> Yahoo</label>
                                    </div>
                                </div>
                            </div>
                            <!-- SMS Switch -->
                            <div class="col-sm-6 col-xl-2.4">
                                <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center h-100">
                                    <div class="form-check form-switch form-switch-lg mb-0 fs-4 w-100 d-flex align-items-center">
                                        <input class="form-check-input cs-pointer" type="checkbox" id="two_factor_sms" name="two_factor_sms" value="1" {{ old('two_factor_sms', $user->two_factor_sms) ? 'checked' : '' }}>
                                        <label class="form-check-label text-dark fw-bold ms-3 fs-5" for="two_factor_sms"><i class="bi bi-chat-text text-primary me-1"></i> SMS</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Telegram Switch -->
                            <div class="col-sm-6 col-xl-2.4">
                                <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center h-100">
                                    <div class="form-check form-switch form-switch-lg mb-0 fs-4 w-100 d-flex align-items-center">
                                        <input class="form-check-input cs-pointer" type="checkbox" id="two_factor_telegram" name="two_factor_telegram" value="1" {{ old('two_factor_telegram', $user->two_factor_telegram) ? 'checked' : '' }}>
                                        <label class="form-check-label text-dark fw-bold ms-3 fs-5" for="two_factor_telegram"><i class="bi bi-telegram text-info me-1"></i> Telegram</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Viber Switch -->
                            <div class="col-sm-6 col-xl-2.4">
                                <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center h-100">
                                    <div class="form-check form-switch form-switch-lg mb-0 fs-4 w-100 d-flex align-items-center">
                                        <input class="form-check-input cs-pointer" type="checkbox" id="two_factor_viber" name="two_factor_viber" value="1" {{ old('two_factor_viber', $user->two_factor_viber) ? 'checked' : '' }}>
                                        <label class="form-check-label text-dark fw-bold ms-3 fs-5" for="two_factor_viber"><i class="bi bi-violet text-purple me-1"></i> Viber</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 4: Security Credentials -->
                    <div class="mb-2">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">04</span>
                                <h4 class="fw-bold text-dark mb-0 fs-4">Security Credentials</h4>
                            </div>
                        </div>

                        <div class="row g-4">
                            <!-- Password -->
                            <div class="col-lg-6">
                                <label for="password" class="form-label fw-bold text-dark fs-5 mb-2">Password</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-key fs-4"></i></span>
                                    <input type="password" class="form-control form-control-lg fs-5 py-3" id="password" name="password" placeholder="••••••••" minlength="8">
                                    <div class="invalid-feedback fs-6 mt-2">Password must be at least 8 characters long if provided.</div>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-lg-6">
                                <label for="password_confirmation" class="form-label fw-bold text-dark fs-5 mb-2">Confirm Password</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-key-fill fs-4"></i></span>
                                    <input type="password" class="form-control form-control-lg fs-5 py-3" id="password_confirmation" name="password_confirmation" placeholder="••••••••">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Footer Operations Group -->
                <div class="card-footer bg-light border-top border-light-subtle p-4 d-flex flex-column flex-sm-row justify-content-sm-end align-items-stretch align-items-sm-center gap-3">
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-secondary btn-lg px-4 py-3 fs-5 rounded-3 fw-semibold text-nowrap text-center">
                        Cancel & Discard
                    </a>
                    <button type="submit" class="btn btn-success btn-lg px-4 shadow-sm rounded-3 fw-semibold border-0 py-3 fs-5 text-nowrap d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-check-fill me-2 fs-5"></i>Save Profile Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.needs-validation');

    if (form) {
        form.addEventListener('submit', function (event) {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');

            if (password.value.length > 0 || confirmPassword.value.length > 0) {
                if (password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity("Passwords do not match");
                } else {
                    confirmPassword.setCustomValidity("");
                }
            } else {
                confirmPassword.setCustomValidity("");
            }

            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    }
});
</script>

<style>
.tracking-tight { letter-spacing: -0.025em; }
.cs-pointer { cursor: pointer; }
.text-purple { color: #7360f2; }

@media (min-width: 1200px) {
    .col-xl-2\.4 {
        flex: 0 0 auto;
        width: 20%;
    }
}

.style-lg-input {
    height: calc(3.5rem + 2px);
}

.input-group.has-validation {
    flex-wrap: wrap;
}
.input-group > .valid-feedback,
.input-group > .invalid-feedback {
    display: none;
    width: 100%;
}
.was-validated .input-group > .form-control:valid ~ .valid-feedback,
.was-validated .input-group > .form-select:valid ~ .valid-feedback,
.was-validated .input-group > .form-control:invalid ~ .invalid-feedback,
.was-validated .input-group > .form-select:invalid ~ .invalid-feedback {
    display: block;
}

.input-group > .form-control:focus,
.input-group > .form-select:focus {
    border-color: #198754 !important;
    box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15) !important;
    z-index: 3;
}
</style>
@endsection
