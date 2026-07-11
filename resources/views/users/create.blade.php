@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Card Container with soft styling and crisp shadow elevation -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- Elegant Premium Green Header with Subtle Gradient -->
            <div class="card-header bg-primary text-white p-4 border-0 position-relative" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-20 p-3 rounded-3 me-3 border border-white border-opacity-25 shadow-sm d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-person-plus fs-3 text-white"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1 tracking-tight fs-3">Add New User</h4>
                        <p class="text-white-50 small mb-0 opacity-75 fs-6">Register a new user profile into the system management core.</p>
                    </div>
                </div>
            </div>

            <form class="editUserForm needs-validation" action="" method="POST" data-confirm-update novalidate>
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
                            <!-- Full Name (Scaled Labels & Input Setup) -->
                            <div class="col-lg-4">
                                <label for="edit_name" class="form-label fw-bold text-dark fs-5 mb-2">Full Name</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-person fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3" id="edit_name" name="name" placeholder="John Doe" required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    <div class="invalid-feedback fs-6 mt-2">Please enter a valid full name.</div>
                                </div>
                            </div>

                            <!-- Username (Scaled Labels & Input Setup) -->
                            <div class="col-lg-4">
                                <label for="edit_username" class="form-label fw-bold text-dark fs-5 mb-2">Username</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-person-badge fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3" id="edit_username" name="username" placeholder="johndoe" required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    <div class="invalid-feedback fs-6 mt-2">Please choose a unique system username.</div>
                                </div>
                            </div>

                            <!-- Email Address (Scaled Labels & Input Setup) -->
                            <div class="col-lg-4">
                                <label for="edit_email" class="form-label fw-bold text-dark fs-5 mb-2">Email Address</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-envelope fs-4"></i></span>
                                    <input type="email" class="form-control form-control-lg fs-5 py-3" id="edit_email" name="email" placeholder="johndoe@domain.com" required>
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
                            <!-- System Role (Scaled Labels & Input Setup) -->
                            <div class="col-lg-4">
                                <label for="edit_role" class="form-label fw-bold text-dark fs-5 mb-2">System Role</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-shield-lock fs-4"></i></span>
                                    <select class="form-select form-select-lg fs-5 py-3" id="edit_role" name="role" required>
                                        <option value="" disabled selected>Choose tier...</option>
                                        <option value="clerk">Clerk (Standard Access)</option>
                                        <option value="admin">Admin (Full Control)</option>
                                    </select>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    <div class="invalid-feedback fs-6 mt-2">Please select an access tier role.</div>
                                </div>
                            </div>

                            <!-- Status (Scaled Labels & Input Setup) -->
                            <div class="col-lg-4">
                                <label for="edit_status" class="form-label fw-bold text-dark fs-5 mb-2">Account Status</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-toggle-on fs-4"></i></span>
                                    <select class="form-select form-select-lg fs-5 py-3" id="edit_status" name="status" required>
                                        <option value="" disabled selected>Choose status...</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    <div class="invalid-feedback fs-6 mt-2">Please select a valid operational status.</div>
                                </div>
                            </div>

                            <!-- Branch (Scaled Labels & Input Setup) -->
                            <div class="col-lg-4">
                                <label for="edit_branch_id" class="form-label fw-bold text-dark fs-5 mb-2">Assigned Branch</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-building fs-4"></i></span>
                                    <select class="form-select form-select-lg fs-5 py-3" id="edit_branch_id" name="branch_id" required>
                                        <option value="" disabled selected>Choose branch...</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    <div class="invalid-feedback fs-6 mt-2">Please select an operational location branch.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: Multi-Factor Authentication Configuration -->
                    <div class="mb-5 bg-light rounded-4 p-4 border border-light-subtle">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-white text-success border border-success border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">03</span>
                            <div>
                                <h4 class="fw-bold text-dark mb-0 fs-4">Two-Factor Authentication (2FA)</h4>
                                <p class="text-muted small mb-0 fs-6">Select verification channels to receive transactional tokens.</p>
                            </div>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-12">
                                <label for="cellphone_number" class="form-label fw-bold text-dark fs-5 mb-2">Direct Contact Number</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-white text-muted px-3"><i class="bi bi-phone fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3" id="cellphone_number" name="cellphone_number" placeholder="e.g., +63917XXXXXXX" required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    <div class="invalid-feedback fs-6 mt-2">Contact number is required for secondary auth tokens.</div>
                                </div>
                            </div>
                        </div>

                        <!-- Clean Premium Option Cards for 2FA Channels -->
                        <div class="row g-3">
                            <div class="col-sm-6 col-xl-3">
                                <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center h-100">
                                    <div class="form-check form-switch form-switch-lg mb-0 fs-4 w-100 d-flex align-items-center">
                                        <input class="form-check-input cs-pointer" type="checkbox" id="2fa_gmail" name="two_factor[]" value="gmail">
                                        <label class="form-check-label text-dark fw-bold ms-3 fs-5" for="2fa_gmail"><i class="bi bi-google text-danger me-1"></i> Gmail</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center h-100">
                                    <div class="form-check form-switch form-switch-lg mb-0 fs-4 w-100 d-flex align-items-center">
                                        <input class="form-check-input cs-pointer" type="checkbox" id="2fa_sms" name="two_factor[]" value="sms">
                                        <label class="form-check-label text-dark fw-bold ms-3 fs-5" for="2fa_sms"><i class="bi bi-chat-text text-primary me-1"></i> SMS Gateway</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center h-100">
                                    <div class="form-check form-switch form-switch-lg mb-0 fs-4 w-100 d-flex align-items-center">
                                        <input class="form-check-input cs-pointer" type="checkbox" id="2fa_telegram" name="two_factor[]" value="telegram">
                                        <label class="form-check-label text-dark fw-bold ms-3 fs-5" for="2fa_telegram"><i class="bi bi-telegram text-info me-1"></i> Telegram</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center h-100">
                                    <div class="form-check form-switch form-switch-lg mb-0 fs-4 w-100 d-flex align-items-center">
                                        <input class="form-check-input cs-pointer" type="checkbox" id="2fa_viber" name="two_factor[]" value="viber">
                                        <label class="form-check-label text-dark fw-bold ms-3 fs-5" for="2fa_viber"><i class="bi bi-violet text-purple me-1"></i> Viber</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 4: Security Credentials Override -->
                    <div class="mb-2">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">04</span>
                                <h4 class="fw-bold text-dark mb-0 fs-4">Security Override</h4>
                            </div>
                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-1.5 rounded-pill border border-warning border-opacity-25 fs-6 fw-bold"><i class="bi bi-shield-exclamation me-1"></i> Optional Fields</span>
                        </div>

                        <div class="row g-4">
                            <!-- New Password -->
                            <div class="col-lg-6">
                                <label for="edit_password" class="form-label fw-bold text-dark fs-5 mb-2">New Password</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-key fs-4"></i></span>
                                    <input type="password" class="form-control form-control-lg fs-5 py-3" id="edit_password" name="password" placeholder="••••••••" minlength="8">
                                    <div class="invalid-feedback fs-6 mt-2">Password must be at least 8 characters long.</div>
                                </div>
                            </div>

                            <!-- Confirm New Password -->
                            <div class="col-lg-6">
                                <label for="edit_password_confirmation" class="form-label fw-bold text-dark fs-5 mb-2">Confirm New Password</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-key-fill fs-4"></i></span>
                                    <input type="password" class="form-control form-control-lg fs-5 py-3" id="edit_password_confirmation" name="password_confirmation" placeholder="••••••••">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Crisp Flat Elegant Footer with large buttons -->
                <div class="card-footer bg-light border-top border-light-subtle p-4 d-flex flex-column flex-sm-row justify-content-sm-end align-items-stretch align-items-sm-center gap-3">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-lg px-4 py-3 fs-5 rounded-3 fw-semibold text-nowrap text-center">
                        Discard Changes
                    </a>
                    <button type="submit" class="btn btn-success btn-lg px-4 shadow-sm rounded-3 fw-semibold border-0 py-3 fs-5 text-nowrap d-flex align-items-center justify-content-center">
                        <i class="bi bi-check-circle-fill me-2 fs-5"></i>Apply Updates
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
            const password = document.getElementById('edit_password');
            const confirmPassword = document.getElementById('edit_password_confirmation');

            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords do not match");
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

/* Keep feedback divs inside the input group layout correctly */
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

/* Elegant custom green focus integration matching the theme headers */
.input-group > .form-control:focus,
.input-group > .form-select:focus {
    border-color: #198754 !important;
    box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15) !important;
    z-index: 3;
}
</style>
@endsection
