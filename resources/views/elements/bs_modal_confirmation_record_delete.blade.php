<div class="modal fade" id="confirmationModalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white py-3">
                <h5 class="modal-title fw-bold" id="confirmationModalLabel">
                    <i class="bi bi-question-circle me-2"></i>Confirm Delete Record
                </h5>
                <button type="button" id="confirmSubmitBtnXDelete" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-0 text-dark fw-medium">Are you sure you want to delete this record?</p>
            </div>
            <div class="modal-footer bg-light border-top-0">
                <button type="button" id="confirmSubmitBtnCancelDelete" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmSubmitBtnDelete" class="btn btn-danger px-4 shadow-sm">Yes, Delete Record</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let timeLeft = 3;
    let countdown;
    let activeForm = null;

    const confirmModalElement = document.getElementById('confirmationModalDelete');
    const confirmSubmitBtn = document.getElementById('confirmSubmitBtnDelete');
    const confirmCancelBtn = document.getElementById('confirmSubmitBtnCancelDelete');
    // FETCH: Close header element target
    const confirmXBtn = document.getElementById('confirmSubmitBtnXDelete');

    // Terminate script execution gracefully if components do not match on current load
    if (!confirmModalElement || !confirmSubmitBtn || !confirmCancelBtn || !confirmXBtn) return;

    const bsModal = new bootstrap.Modal(confirmModalElement);

    // 1. Monitor the entire layout context for deletion form targets
    document.addEventListener('submit', function (event) {
        if (event.target && event.target.matches('[data-confirm-delete]')) {
            const form = event.target;

            // Let the browser check native HTML5 'required' validation rules
            if (!form.checkValidity()) {
                return;
            }

            // Interrupt the execution cycle to prompt user confirmation
            event.preventDefault();

            // Retain the form target instance securely
            activeForm = form;

            // Render confirmation frame
            bsModal.show();
        }
    });

    // 2. Structural execution handling on form validation approvals
    confirmSubmitBtn.addEventListener('click', function () {
        if (!activeForm) return;

        // Apply interactive restrictions immediately to halt secondary clicks
        confirmSubmitBtn.disabled = true;

        confirmCancelBtn.removeAttribute('data-bs-dismiss');
        confirmCancelBtn.disabled = true;

        // LOCKDOWN: Disable and unbind dismiss functions on header X button
        confirmXBtn.removeAttribute('data-bs-dismiss');
        confirmXBtn.disabled = true;
        confirmXBtn.style.pointerEvents = 'none';

        // Transition visual indicators instantly
        confirmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Deleting in 3s...`;

        // Start system timeout processing loops
        countdown = setInterval(() => {
            timeLeft--;

            if (timeLeft > 0) {
                confirmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Deleting in ${timeLeft}s...`;
            } else {
                clearInterval(countdown);
                confirmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Processing...`;

                // Dispatch the cached form tracking node
                activeForm.submit();
            }
        }, 1000);
    });

    // 3. Clean up context variables upon closing actions
    confirmModalElement.addEventListener('hidden.bs.modal', function () {
        if (countdown) {
            clearInterval(countdown);
        }

        // Restore baseline metric indicators
        timeLeft = 3;
        activeForm = null;

        // Restore operational statuses to interactive markup elements
        confirmSubmitBtn.disabled = false;
        confirmSubmitBtn.innerHTML = `Yes, Delete Record`;

        confirmCancelBtn.disabled = false;
        confirmCancelBtn.setAttribute('data-bs-dismiss', 'modal');

        // RESTORE: Re-enable native close actions on the X button
        confirmXBtn.disabled = false;
        confirmXBtn.style.pointerEvents = 'auto';
        confirmXBtn.setAttribute('data-bs-dismiss', 'modal');
    });
});
</script>
