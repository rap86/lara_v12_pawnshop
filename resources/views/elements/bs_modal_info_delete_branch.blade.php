<div class="modal fade" id="deleteBranchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white py-3">
                <h5 class="modal-title fw-bold" id="deleteBranchModalLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i>Delete Branch Record
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="deleteBranchForm" action="" method="POST" data-confirm-delete>
                @csrf
                @method('DELETE')

                <div class="modal-body p-4 text-center">
                    <i class="bi bi-trash3 text-danger display-4 mb-3 d-block"></i>
                    <p class="fs-5 fw-semibold text-dark mb-1">Are you sure you want to delete this user?</p>
                    <p class="text-muted small">This action cannot be undone. You are about to permanently remove <strong id="delete_branch_name" class="text-dark">this account</strong> from the system.</p>
                </div>

                <div class="modal-footer bg-light border-top-0 px-4 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger text-white px-4 shadow-sm">Permanently Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModalElement = document.getElementById('deleteBranchModal');

    if (deleteModalElement) {
        deleteModalElement.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            const button = event.relatedTarget;

            // Extract info from data-bs-* attributes
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');

            // Dynamically point the form action to your route structure
            const form = document.getElementsByClassName('deleteBranchForm')[0];
            form.action = `/branches/${id}`;

            // Show the username inside the warning text
            document.getElementById('delete_branch_name').textContent = name;
        });
    }
});
</script>
