<div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success text-white py-3">
                <h5 class="modal-title fw-bold" id="editUserModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Update System User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="editUserForm" action="" method="POST" data-confirm-update>
                @csrf
                @method('PUT')

                <div class="modal-body p-4">

                    <div class="mb-3">
                        <label for="edit_name" class="form-label small fw-semibold text-dark">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_username" class="form-label small fw-semibold text-dark">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person-badge"></i></span>
                            <input type="text" class="form-control" id="edit_username" name="username" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_email" class="form-label small fw-semibold text-dark">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_role" class="form-label small fw-semibold text-dark">System Role</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-shield-lock"></i></span>
                            <select class="form-select" id="edit_role" name="role" required>
                                <option value="clerk">Clerk</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label small fw-semibold text-dark">Status</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-shield-lock"></i></span>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded border border-dashed mb-3 mt-4">
                        <div class="d-flex">
                            <i class="bi bi-info-circle-fill text-secondary me-2 fs-5"></i>
                            <p class="small text-muted mb-0 fw-medium">Leave password fields blank if you do not wish to modify the user's current security credentials.</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_password" class="form-label small fw-semibold text-dark">New Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control" id="edit_password" name="password" placeholder="Minimum 8 characters (Optional)">
                        </div>
                    </div>

                    <div class="mb-0">
                        <label for="edit_password_confirmation" class="form-label small fw-semibold text-dark">Confirm New Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-key-fill"></i></span>
                            <input type="password" class="form-control" id="edit_password_confirmation" name="password_confirmation" placeholder="Re-type new password">
                        </div>
                    </div>

                </div>

                <div class="modal-footer bg-light border-top-0 px-4">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success text-white px-4 shadow-sm">Update Account</button>
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
            // Button that triggered the modal
            const button = event.relatedTarget;

            // Extract info from data-bs-* attributes
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const username = button.getAttribute('data-username');
            const email = button.getAttribute('data-email');
            const role = button.getAttribute('data-role');
            const status = button.getAttribute('data-status');

            // Update the form's action URL dynamically targeting route('users.update', id)
            const form = document.getElementsByClassName('editUserForm')[0];
            form.action = `/users/${id}`;

            // Populate the input targets
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;
            document.getElementById('edit_status').value = status;

            // Reset password entry forms on open context
            document.getElementById('edit_password').value = '';
            document.getElementById('edit_password_confirmation').value = '';
        });
    }
});
</script>
