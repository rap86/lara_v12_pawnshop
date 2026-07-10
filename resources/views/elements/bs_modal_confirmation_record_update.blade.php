<div class="modal fade" id="confirmationModalUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white py-3">
                <h4 class="modal-title fw-bold" id="confirmationModalLabel">
                    <i class="bi bi-question-circle me-2"></i>Confirm Update Record
                </h4>
                <button type="button" id="confirmSubmitBtnXUpdate" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-0 text-dark fs-5">Are you sure you want to save your changes?</p>
            </div>
            <div class="modal-footer bg-light border-top-0">
                <button type="button" id="confirmSubmitBtnCancelUpdate" class="btn btn-outline-secondary px-4 btn-lg" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmSubmitBtnUpdate" class="btn btn-success px-4 shadow-sm btn-lg">Yes, Update</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let timeLeft = 3;
    let countdown;
    let activeForm = null;

    const confirmModalElement = document.getElementById('confirmationModalUpdate');
    const confirmSubmitBtn = document.getElementById('confirmSubmitBtnUpdate');
    const confirmCancelBtn = document.getElementById('confirmSubmitBtnCancelUpdate');
    // 1. FETCH THE 'X' BUTTON
    const confirmXBtn = document.getElementById('confirmSubmitBtnXUpdate');

    // Make sure to add confirmXBtn to your guard clause!
    if (!confirmModalElement || !confirmSubmitBtn || !confirmCancelBtn || !confirmXBtn) return;

    const bsModal = new bootstrap.Modal(confirmModalElement);

    document.addEventListener('submit', function (event) {
        if (event.target && event.target.matches('[data-confirm-update]')) {
            const form = event.target;
            if (!form.checkValidity()) return;
            event.preventDefault();
            activeForm = form;
            bsModal.show();
        }
    });

    confirmSubmitBtn.addEventListener('click', function () {
        if (!activeForm) return;

        // 2. LOCK EVERYTHING DOWN (Including the X button)
        confirmSubmitBtn.disabled = true;

        confirmCancelBtn.removeAttribute('data-bs-dismiss');
        confirmCancelBtn.disabled = true;

        confirmXBtn.removeAttribute('data-bs-dismiss');
        confirmXBtn.disabled = true;
        confirmXBtn.style.pointerEvents = 'none'; // Extra safety to prevent hover/clicks

        confirmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving in 3s...`;

        countdown = setInterval(() => {
            timeLeft--;
            if (timeLeft > 0) {
                confirmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving in ${timeLeft}s...`;
            } else {
                clearInterval(countdown);
                confirmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Submitting...`;
                activeForm.submit();
            }
        }, 1000);
    });

    confirmModalElement.addEventListener('hidden.bs.modal', function () {
        if (countdown) clearInterval(countdown);

        timeLeft = 3;
        activeForm = null;

        confirmSubmitBtn.disabled = false;
        confirmSubmitBtn.innerHTML = `Yes, Update`;

        confirmCancelBtn.disabled = false;
        confirmCancelBtn.setAttribute('data-bs-dismiss', 'modal');

        // 3. RESTORE THE 'X' BUTTON
        confirmXBtn.disabled = false;
        confirmXBtn.style.pointerEvents = 'auto';
        confirmXBtn.setAttribute('data-bs-dismiss', 'modal');
    });
});
</script>
