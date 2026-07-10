<div class="modal fade" id="confirmationModalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-3">
                <h4 class="modal-title fw-bold" id="confirmationModalLabel">
                    <i class="bi bi-question-circle me-2"></i>Confirm New Record
                </h4>
                <button type="button" id="confirmSubmitBtnXAdd" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-0 text-dark fs-5">Are you sure you want to save this?</p>
            </div>
            <div class="modal-footer bg-light border-top-0">
                <button type="button" id="confirmSubmitBtnCancelAdd" class="btn btn-outline-secondary px-4 btn-lg" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmSubmitBtnAdd" class="btn btn-primary px-4 shadow-sm btn-lg">Yes, Save</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let timeLeft = 3;
    let countdown;
    let activeForm = null;

    const confirmModalElement = document.getElementById('confirmationModalAdd');
    const confirmSubmitBtn = document.getElementById('confirmSubmitBtnAdd');
    const confirmCancelBtn = document.getElementById('confirmSubmitBtnCancelAdd');
    // FETCH: Close header element target
    const confirmXBtn = document.getElementById('confirmSubmitBtnXAdd');

    // Prevent JavaScript execution if components are missing or names altered
    if (!confirmModalElement || !confirmSubmitBtn || !confirmCancelBtn || !confirmXBtn) return;

    const bsModal = new bootstrap.Modal(confirmModalElement);

    // 1. Monitor the layout for any form submission matching the addition workflow
    document.addEventListener('submit', function (event) {
        if (event.target && event.target.matches('[data-confirm-add]')) {
            const form = event.target;

            // Let the browser check native HTML5 'required' validation rules
            if (!form.checkValidity()) {
                return;
            }

            // Stop the form from executing immediately
            event.preventDefault();

            // Reference the specific target form for processing later
            activeForm = form;

            // Trigger the confirmation display natively
            bsModal.show();
        }
    });

    // 2. Execution logic on structural confirmations
    confirmSubmitBtn.addEventListener('click', function () {
        if (!activeForm) return;

        // Disable buttons right away so it cannot be double submitted
        confirmSubmitBtn.disabled = true;

        confirmCancelBtn.removeAttribute('data-bs-dismiss');
        confirmCancelBtn.disabled = true;

        // LOCKDOWN: Disable and unbind dismiss functions on header X button
        confirmXBtn.removeAttribute('data-bs-dismiss');
        confirmXBtn.disabled = true;
        confirmXBtn.style.pointerEvents = 'none';

        // Set the initial visual state immediately on click
        confirmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving in 3s...`;

        // Start the countdown sequence
        countdown = setInterval(() => {
            timeLeft--;

            if (timeLeft > 0) {
                confirmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving in ${timeLeft}s...`;
            } else {
                clearInterval(countdown);
                confirmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Submitting...`;

                // Safe to submit the cached form model directly
                activeForm.submit();
            }
        }, 1000);
    });

    // 3. Clean up tracking states when the modal framework closes
    confirmModalElement.addEventListener('hidden.bs.modal', function () {
        if (countdown) {
            clearInterval(countdown);
        }

        // Reset tracking states back to defaults
        timeLeft = 3;
        activeForm = null;

        // Restore components appearance and interactive attributes entirely
        confirmSubmitBtn.disabled = false;
        confirmSubmitBtn.innerHTML = `Yes, Save`;

        confirmCancelBtn.disabled = false;
        confirmCancelBtn.setAttribute('data-bs-dismiss', 'modal');

        // RESTORE: Re-enable native close actions on the X button
        confirmXBtn.disabled = false;
        confirmXBtn.style.pointerEvents = 'auto';
        confirmXBtn.setAttribute('data-bs-dismiss', 'modal');
    });
});
</script>
