
<div class="modal fade" id="confirmationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold" id="confirmationModalLabel">
                    <i class="bi bi-question-circle me-2"></i>Confirm New Record
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p class="mb-0 text-dark fw-medium">Are you sure you want to register and save this customer's details to the registry?</p>
            </div>
            <div class="modal-footer bg-light border-top-0">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmSubmitBtn" class="btn btn-primary px-4 shadow-sm">Yes, Save Records</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let timeLeft = 3;
    const form = document.getElementById('createFormGlobal');
    const confirmModalElement = document.getElementById('confirmationModal');
    const confirmSubmitBtn = document.getElementById('confirmSubmitBtn');

    // Initialize Bootstrap's Modal object API wrapper instances natively
    const bsModal = new bootstrap.Modal(confirmModalElement);

    form.addEventListener('submit', function (event) {
        // 1. Let the browser check native HTML5 'required' validation rules
        if (!form.checkValidity()) {
            return;
        }

        // 2. If valid, STOP the form from submitting right away
        event.preventDefault();

        // 3. Open your beautiful confirmation modal
        bsModal.show();
    });

    // 4. When the user confirms inside the modal
    confirmSubmitBtn.addEventListener('click', function () {
        // DISABLE the button right away so it cannot be clicked again
        confirmSubmitBtn.disabled = true;

        // Set the initial visual state immediately on click
        confirmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving in 3s...`;

        // Start the countdown sequence
        const countdown = setInterval(() => {
            timeLeft--;

            if (timeLeft > 0) {
                // Dynamically update the countdown number text on the button
                confirmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving in ${timeLeft}s...`;
            } else {
                // Timer finished! Stop the interval loop
                clearInterval(countdown);

                confirmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Submitting...`;

                // 5. FIXED: Now it's safe to submit the form to the database
                form.submit();
            }
        }, 1000); // Triggers every 1 second
    });
});
</script>
