<div class="modal fade" id="addUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold fs-4" id="addUserModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i>Register New System User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('users.store') }}" method="POST" data-confirm-add>
                @csrf
                <div class="modal-body p-4">

                    <!-- Group 1: Basic Information Grid (Large Fields) -->
                    <div class="row g-3 mb-4">
                        <!-- Full Name -->
                        <div class="col-lg-4">
                            <label for="name" class="form-label fw-semibold text-dark fs-6 mb-2">Full Name</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person fs-5"></i></span>
                                <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="e.g., Ronaldo Panuelos" required>
                            </div>
                        </div>

                        <!-- Username -->
                        <div class="col-lg-4">
                            <label for="username" class="form-label fw-semibold text-dark fs-6 mb-2">Username</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person-badge fs-5"></i></span>
                                <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="e.g., ronaldo" required>
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="col-lg-4">
                            <label for="email" class="form-label fw-semibold text-dark fs-6 mb-2">Email Address</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-envelope fs-5"></i></span>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="e.g., panuelos@yahoo.com">
                            </div>
                        </div>
                    </div>

                    <!-- Group 2: Access & Assignment Grid (Large Fields) -->
                    <div class="row g-3 mb-4">
                        <!-- System Role -->
                        <div class="col-lg-4">
                            <label for="role" class="form-label fw-semibold text-dark fs-6 mb-2">System Role</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-shield-lock fs-5"></i></span>
                                <select class="form-select form-select-lg" id="role" name="role" required>
                                    <option value="" selected disabled>Select access tier...</option>
                                    <option value="clerk">Clerk</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-lg-4">
                            <label for="status" class="form-label fw-semibold text-dark fs-6 mb-2">Status</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-toggle-on fs-5"></i></span>
                                <select class="form-select form-select-lg" id="status" name="status" required>
                                    <option value="" selected disabled>Select status...</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Branch -->
                        <div class="col-lg-4">
                            <label for="branch_id" class="form-label fw-semibold text-dark fs-6 mb-2">Branch</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-building fs-5"></i></span>
                                <select class="form-select form-select-lg" id="branch_id" name="branch_id" required>
                                    <option value="" selected disabled>Select branch...</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-6">
                            <label for="name" class="form-label fw-semibold text-dark fs-6 mb-2">Number</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person fs-5"></i></span>
                                <input type="text" class="form-control form-control-lg" id="cellphone_number" name="cellphone_number" placeholder="e.g., 09..." required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="name" class="form-label fw-semibold text-dark fs-6 mb-2">Code Receiver</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person fs-5"></i></span>
                                <input type="text" class="form-control form-control-lg" id="code_receiver" name="code_receiver" placeholder="e.g., Email, Telegram, Viber..." required>
                            </div>
                        </div>
                    </div>

                    <hr class="text-muted my-4 opacity-25">

                    <!-- Group 3: Security Grid (Large Fields) -->
                    <div class="row g-3">
                        <!-- Password -->
                        <div class="col-lg-6">
                            <label for="password" class="form-label fw-semibold text-dark fs-6 mb-2">Password</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-key fs-5"></i></span>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Minimum 8 characters" required>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-lg-6">
                            <label for="password_confirmation" class="form-label fw-semibold text-dark fs-6 mb-2">Confirm Password</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-key-fill fs-5"></i></span>
                                <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="Re-type password validation" required>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer bg-light border-top-0 px-4 py-3">
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">Save Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
