<div class="modal fade" id="editBranchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success text-white py-3">
                <h5 class="modal-title fw-bold" id="editBranchModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Update Branch Info
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="editBranchForm" action="" method="POST" data-confirm-update>
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
                        <label for="edit_location" class="form-label small fw-semibold text-dark">Location</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person-badge"></i></span>
                            <input type="text" class="form-control" id="edit_location" name="location" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_code" class="form-label small fw-semibold text-dark">Code</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-envelope"></i></span>
                            <input type="code" class="form-control" id="edit_code" name="code" required>
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
    const editModalElement = document.getElementById('editBranchModal');

    if (editModalElement) {
        editModalElement.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            const button = event.relatedTarget;

            // Extract info from data-bs-* attributes
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const location = button.getAttribute('data-location');
            const code = button.getAttribute('data-code');
            const status = button.getAttribute('data-status');

            // Update the form's action URL dynamically targeting route('users.update', id)
            const form = document.getElementsByClassName('editBranchForm')[0];
            form.action = `/branches/${id}`;

            // Populate the input targets
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_location').value = location;
            document.getElementById('edit_code').value = code;
            document.getElementById('edit_status').value = status;

        });
    }
});
</script>
