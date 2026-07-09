<div class="modal fade" id="editSettingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSettingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success text-white py-3">
                <h5 class="modal-title fw-bold" id="editUserModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Update Settings
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="editSettingForm" action="" method="POST" data-confirm-update>
                @csrf
                @method('PUT')

                <div class="modal-body p-4">

                    <div class="mb-3">
                        <label for="edit_name" class="form-label small fw-semibold text-dark">Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label small fw-semibold text-dark">Status</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-shield-lock"></i></span>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="" disabled>Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_details" class="form-label small fw-semibold text-dark">Details</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person"></i></span>
                            <textarea class="form-control" id="edit_details" name="details" rows="5" required></textarea>
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
    const editModalElement = document.getElementById('editSettingModal');

    if (editModalElement) {
        editModalElement.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            const button = event.relatedTarget;

            // Using .getAttribute ensures it reads the raw custom attribute strings safely
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const status = button.getAttribute('data-status');
            const details = button.getAttribute('data-details');

            // Find the form container
            const form = document.querySelector('.editSettingForm');
            if (form) {
                form.action = `/settings/${id}`;
            }

            // Populate the input targets safely checking if they exist
            if(document.getElementById('edit_name')) document.getElementById('edit_name').value = name || '';
            if(document.getElementById('edit_status')) document.getElementById('edit_status').value = status || '';
            if(document.getElementById('edit_details')) document.getElementById('edit_details').value = details || '';
        });
    }
});
</script>
