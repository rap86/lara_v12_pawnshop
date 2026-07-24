<div class="modal fade" id="editSettingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSettingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success text-white py-3">
                <h5 class="modal-title fw-bold" id="editSettingModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Update Setting Info
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="editSettingForm" action="" method="POST" data-confirm-update>
                @csrf
                @method('PUT')

                <div class="modal-body p-4">

                    <!-- Setting Name Field (Large) -->
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-semibold text-dark">Setting Name</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-sliders"></i></span>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                    </div>

                    <!-- Status Field (Large) -->
                    <div class="mb-3">
                        <label for="edit_status" class="form-label fw-semibold text-dark">Status</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-toggle-on"></i></span>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="" disabled>Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Details Field (Large) -->
                    <div class="mb-3">
                        <label for="edit_details" class="form-label fw-semibold text-dark">Details</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-file-text"></i></span>
                            <textarea class="form-control" id="edit_details" name="details" rows="5" required></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer bg-light border-top-0 px-4">
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-lg text-white px-4 shadow-sm">Update Setting</button>
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
            const button = event.relatedTarget;

            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const status = button.getAttribute('data-status');
            const details = button.getAttribute('data-details');

            const form = document.querySelector('.editSettingForm');
            if (form) {
                form.action = `/system_settings/${id}`;
            }

            if(document.getElementById('edit_name')) document.getElementById('edit_name').value = name || '';
            if(document.getElementById('edit_status')) document.getElementById('edit_status').value = status || '';
            if(document.getElementById('edit_details')) document.getElementById('edit_details').value = details || '';
        });
    }
});
</script>
