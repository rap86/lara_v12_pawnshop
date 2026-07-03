@extends('layouts.app1')

@section('content')
<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white py-3">
        <h5 class="card-title mb-0 fw-bold">
            <i class="bi bi-person-plus me-2"></i>Add New Customer
        </h5>
    </div>

    <form id="customerCreateForm" action="{{ route('customers.store') }}" method="POST">
        @csrf

        <div class="card-body p-4">
            <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wider">Personal Information</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <label for="first_name" class="form-label small fw-semibold text-dark">First Name *</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="middle_name" class="form-label small fw-semibold text-dark">Middle Name</label>
                    <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" required>
                    @error('middle_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="last_name" class="form-label small fw-semibold text-dark">Last Name *</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="gender" class="form-label small fw-semibold text-dark">Gender *</label>
                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                        <option value="" selected disabled>Select Gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wider">Contact & Location</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="cellphone_number" class="form-label small fw-semibold text-dark">Mobile Number</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control @error('cellphone_number') is-invalid @enderror" id="cellphone_number" name="cellphone_number" value="{{ old('cellphone_number') }}" required>
                        @error('cellphone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label small fw-semibold text-dark">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control border-start-0" id="email" name="email" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="col-12">
                    <label for="address" class="form-label small fw-semibold text-dark">Full Address</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control  @error('address') is-invalid @enderror" id="address" name="address" placeholder="123 Street, City, State" value="{{ old('address') }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wider">Background & Description</h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="marital_status" class="form-label small fw-semibold text-dark">Marital Status</label>
                    <select class="form-select" id="marital_status" name="marital_status">
                        <option value="" selected disabled>Select Status</option>
                        <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Divorced" {{ old('marital_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="Widowed" {{ old('marital_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="occupation" class="form-label small fw-semibold text-dark">Occupation</label>
                    <input type="text" class="form-control" id="occupation" name="occupation" value="{{ old('occupation') }}">
                </div>

                <div class="col-md-4">
                    <label for="birthdate" class="form-label small fw-semibold text-dark">Birthday</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                </div>

                <div class="col-12 mt-3">
                    <label for="details" class="form-label small fw-semibold text-dark">Additional Details</label>
                    <textarea class="form-control" id="details" name="details" rows="3" placeholder="Enter any extra comments, preferences, or technical notes here...">{{ old('details') }}</textarea>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light border-top-0 px-4 py-3 text-end">
            <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary px-4 me-2">Cancel</a>
            <button type="submit" class="btn btn-primary px-4 shadow-sm">Save Customer</button>
        </div>
    </form>
</div>


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
    let timeLeft = 5;
    const form = document.getElementById('customerCreateForm');
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
        confirmSubmitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving in 5s...`;

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
@endsection
