@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-lg rounded-3">
            <!-- Card Header matching the update form context -->
            <div class="card-header bg-success text-white py-3 border-0">
                <h5 class="card-title fw-bold fs-4 mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Update System User Details
                </h5>
            </div>

            <form class="editUserForm" action="" method="POST" data-confirm-update>
                @csrf
                @method('PUT')

                <div class="card-body p-4">

                    <!-- Group 1: Basic Information Grid (Large Fields) -->
                    <div class="row g-3 mb-4">
                        <!-- Full Name -->
                        <div class="col-lg-4">
                            <label for="edit_name" class="form-label fw-semibold text-dark fs-6 mb-2">Full Name</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person fs-5"></i></span>
                                <input type="text" class="form-control form-control-lg" id="edit_name" name="name" value="{{ $user->name }}" required>
                            </div>
                        </div>

                        <!-- Username -->
                        <div class="col-lg-4">
                            <label for="edit_username" class="form-label fw-semibold text-dark fs-6 mb-2">Username</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person-badge fs-5"></i></span>
                                <input type="text" class="form-control form-control-lg" id="edit_username" name="username" required>
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="col-lg-4">
                            <label for="edit_email" class="form-label fw-semibold text-dark fs-6 mb-2">Email Address</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-envelope fs-5"></i></span>
                                <input type="email" class="form-control form-control-lg" id="edit_email" name="email" required>
                            </div>
                        </div>
                    </div>

                    <!-- Group 2: Access & Assignment Grid (Large Fields) -->
                    <div class="row g-3 mb-4">
                        <!-- System Role -->
                        <div class="col-lg-4">
                            <label for="edit_role" class="form-label fw-semibold text-dark fs-6 mb-2">System Role</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-shield-lock fs-5"></i></span>
                                <select class="form-select form-select-lg" id="edit_role" name="role" required>
                                    <option value="clerk">Clerk</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-lg-4">
                            <label for="edit_status" class="form-label fw-semibold text-dark fs-6 mb-2">Status</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-toggle-on fs-5"></i></span>
                                <select class="form-select form-select-lg" id="edit_status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Branch -->
                        <div class="col-lg-4">
                            <label for="edit_branch_id" class="form-label fw-semibold text-dark fs-6 mb-2">Branch</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-building fs-5"></i></span>
                                <select class="form-select form-select-lg" id="edit_branch_id" name="branch_id" required>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Settings: Phone Number -->
                    <div class="row g-3 mb-4">
                        <div class="col-lg-12">
                            <label for="cellphone_number" class="form-label fw-semibold text-dark fs-6 mb-2">Contact Number</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-phone fs-5"></i></span>
                                <input type="text" class="form-control form-control-lg" id="cellphone_number" name="cellphone_number" placeholder="e.g., 09..." required>
                            </div>
                        </div>
                    </div>

                    <!-- 2FA Information Banner -->
                    <div class="p-3 bg-light rounded border border-dashed mb-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill text-secondary me-2 fs-5"></i>
                            <p class="small text-muted mb-0 fw-medium">Select preferred operational tiers to receive your security 2FA validation codes.</p>
                        </div>
                    </div>

                    <!-- 2FA Options Grid (Large Checkboxes) -->
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-check fs-4">
                                <input class="form-check-input" type="checkbox" id="2fa_gmail" name="two_factor[]" value="gmail">
                                <label class="form-check-label fs-5 fw-medium text-dark ms-1" for="2fa_gmail">Gmail</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-check fs-4">
                                <input class="form-check-input" type="checkbox" id="2fa_sms" name="two_factor[]" value="sms">
                                <label class="form-check-label fs-5 fw-medium text-dark ms-1" for="2fa_sms">SMS</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-check fs-4">
                                <input class="form-check-input" type="checkbox" id="2fa_telegram" name="two_factor[]" value="telegram">
                                <label class="form-check-label fs-5 fw-medium text-dark ms-1" for="2fa_telegram">Telegram</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-check fs-4">
                                <input class="form-check-input" type="checkbox" id="2fa_viber" name="two_factor[]" value="viber">
                                <label class="form-check-label fs-5 fw-medium text-dark ms-1" for="2fa_viber">Viber</label>
                            </div>
                        </div>
                    </div>

                    <!-- Security Warning Banner -->
                    <div class="p-3 bg-light rounded border border-dashed mb-4 mt-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-shield-exclamation text-secondary me-2 fs-5"></i>
                            <p class="small text-muted mb-0 fw-medium">Leave password fields blank if you do not wish to modify the user's current security credentials.</p>
                        </div>
                    </div>

                    <!-- Group 3: Security Grid (Large Fields) -->
                    <div class="row g-3">
                        <!-- New Password -->
                        <div class="col-lg-6">
                            <label for="edit_password" class="form-label fw-semibold text-dark fs-6 mb-2">New Password</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-key fs-5"></i></span>
                                <input type="password" class="form-control form-control-lg" id="edit_password" name="password" placeholder="Minimum 8 characters (Optional)">
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="col-lg-6">
                            <label for="edit_password_confirmation" class="form-label fw-semibold text-dark fs-6 mb-2">Confirm New Password</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-key-fill fs-5"></i></span>
                                <input type="password" class="form-control form-control-lg" id="edit_password_confirmation" name="password_confirmation" placeholder="Re-type new password">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Card Footer -->
                <div class="card-footer bg-light border-top-0 px-4 py-3 d-flex justify-content-end gap-2">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-lg px-4">Cancel</a>
                    <button type="submit" class="btn btn-success text-white btn-lg px-4 shadow-sm">Update Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
