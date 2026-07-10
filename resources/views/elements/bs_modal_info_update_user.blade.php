<div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <!-- Changed modal size from modal-md to modal-xl -->
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success text-white py-3">
                <h5 class="modal-title fw-bold fs-4" id="editUserModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Update System User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="editUserForm" action="" method="POST" data-confirm-update>
                @csrf
                @method('PUT')

                <div class="modal-body p-4">

                    <!-- Group 1: Basic Information Grid (Large Fields) -->
                    <div class="row g-3 mb-4">
                        <!-- Full Name -->
                        <div class="col-lg-4">
                            <label for="edit_name" class="form-label fw-semibold text-dark fs-6 mb-2">Full Name</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person fs-5"></i></span>
                                <input type="text" class="form-control form-control-lg" id="edit_name" name="name" required>
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

                    <div class="row g-1 mb-4">
                        <div class="col-lg-12">
                            <label for="name" class="form-label fw-semibold text-dark fs-6 mb-2">Number</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-phone fs-5"></i></span>
                                <input type="text" class="form-control form-control-lg" id="cellphone_number" name="cellphone_number" placeholder="e.g., 09..." required>
                            </div>
                        </div>
                    </div>


                     <div class="p-3 bg-light rounded border border-dashed mb-4 mt-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill text-secondary me-2 fs-5"></i>
                            <p class="small text-muted mb-0 fw-medium">Select where you want to receive your 2fa validation.</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-3">
                        <div class="form-check fs-4">
                            <input class="form-check-input" type="checkbox" id="utilityLargeCheck">
                            <label class="form-check-label" for="utilityLargeCheck">
                                Gmail
                            </label>
                        </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-check fs-4">
                                <input class="form-check-input" type="checkbox" id="utilityLargeCheck">
                                <label class="form-check-label" for="utilityLargeCheck">
                                SMS
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-check fs-4">
                                <input class="form-check-input" type="checkbox" id="utilityLargeCheck">
                                <label class="form-check-label" for="utilityLargeCheck">
                                Telegram
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-check fs-4">
                                <input class="form-check-input" type="checkbox" id="utilityLargeCheck">
                                <label class="form-check-label" for="utilityLargeCheck">
                                Viber
                                </label>
                            </div>
                        </div>
                    </div>


                    <!-- Context Alert Banner -->
                    <div class="p-3 bg-light rounded border border-dashed mb-4 mt-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill text-secondary me-2 fs-5"></i>
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

                <div class="modal-footer bg-light border-top-0 px-4 py-3">
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success text-white btn-lg px-4 shadow-sm">Yes, Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editModalElement = document.getElementById('editUserModal');

    if (editModalElement) {
        editModalElement.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const username = button.getAttribute('data-username');
            const email = button.getAttribute('data-email');
            const role = button.getAttribute('data-role');
            const status = button.getAttribute('data-status');
            const branch_id = button.getAttribute('data-branch_id');

            const form = document.getElementsByClassName('editUserForm')[0];
            form.action = `/users/${id}`;

            document.getElementById('edit_name').value = name;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;
            document.getElementById('edit_status').value = status;
            document.getElementById('edit_branch_id').value = branch_id;

            document.getElementById('edit_password').value = '';
            document.getElementById('edit_password_confirmation').value = '';
        });
    }
});
</script>
