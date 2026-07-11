<div class="modal fade" id="editBranchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editBranchModalLabel" aria-hidden="true">
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

                    <!-- Branch Name (Updated to Large) -->
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-semibold text-dark">Branch Name</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-building"></i></span>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                    </div>

                    <!-- Location (Updated to Large) -->
                    <div class="mb-3">
                        <label for="edit_location" class="form-label fw-semibold text-dark">Location</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" class="form-control" id="edit_location" name="location" required>
                        </div>
                    </div>

                    <!-- Code (Fixed invalid input type and updated to Large) -->
                    <div class="mb-3">
                        <label for="edit_code" class="form-label fw-semibold text-dark">Branch Code</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-hash"></i></span>
                            <input type="text" class="form-control" id="edit_code" name="code" required>
                        </div>
                    </div>

                    <!-- Status (Updated to Large) -->
                    <div class="mb-3">
                        <label for="edit_status" class="form-label fw-semibold text-dark">Status</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-toggle-on"></i></span>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 px-4">
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-lg text-white px-4 shadow-sm">Update Branch</button>
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
            const button = event.relatedTarget;

            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const location = button.getAttribute('data-location');
            const code = button.getAttribute('data-code');
            const status = button.getAttribute('data-status');

            const form = document.getElementsByClassName('editBranchForm')[0];
            form.action = `/branches/${id}`;

            document.getElementById('edit_name').value = name;
            document.getElementById('edit_location').value = location;
            document.getElementById('edit_code').value = code;
            document.getElementById('edit_status').value = status;
        });
    }
});
</script>
