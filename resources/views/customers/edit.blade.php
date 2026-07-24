@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Card Container with soft styling and crisp shadow elevation -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- Elegant Premium Green Header with Subtle Gradient -->
            <div class="card-header bg-success text-white p-4 border-0 position-relative" style="background: linear-gradient(135deg, #157347 0%, #0f5132 100%);">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-20 p-3 rounded-3 me-3 border border-white border-opacity-25 shadow-sm d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-pencil-square fs-3 text-dark"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1 tracking-tight fs-3">Edit Customer Record</h4>
                        <p class="text-white-50 small mb-0 opacity-75 fs-6">Modify profile metrics, contact information, and system parameters for this account.</p>
                    </div>
                </div>
            </div>
            <!-- SYSTEM VALIDATION ERRORS (Add this block) -->
            @if ($errors->any())
                <div class="alert alert-danger p-lg-4 mb-4 border-0 rounded-0 bg-danger bg-opacity-10 text-danger">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-exclamation-triangle-fill fs-4 me-2"></i>
                        <h5 class="mb-0 fw-bold">Update Failed! Please fix these errors:</h5>
                    </div>
                    <ul class="mb-0 fs-6">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Added 'needs-validation' and 'novalidate' for custom Bootstrap feedback states -->
            <form class="editCustomerForm needs-validation" action="{{ route('customers.update', $customer->id) }}" method="POST" data-confirm-update novalidate>
                @csrf
                @method('PUT')

                <div class="card-body p-4 p-lg-4 bg-white">

                    <!-- SECTION 1: Personal Information -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">01</span>
                            <h4 class="fw-bold text-dark mb-0 fs-5">Personal Information</h4>
                        </div>

                        <div class="row g-4">
                            <!-- First Name -->
                            <div class="col-lg-4">
                                <label for="first_name" class="form-label fw-bold text-dark fs-6 mb-2">First Name *</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-person fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3 @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $customer->first_name) }}" placeholder="John" required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    @error('first_name')
                                        <div class="invalid-feedback fs-6 mt-2 d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback fs-6 mt-2">Please enter a valid first name.</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Middle Name -->
                            <div class="col-lg-4">
                                <label for="middle_name" class="form-label fw-bold text-dark fs-6 mb-2">Middle Name *</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-person fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3 @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name" value="{{ old('middle_name', $customer->middle_name) }}" placeholder="Lee" required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    @error('middle_name')
                                        <div class="invalid-feedback fs-6 mt-2 d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback fs-6 mt-2">Please enter a valid middle name.</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-lg-4">
                                <label for="last_name" class="form-label fw-bold text-dark fs-6 mb-2">Last Name *</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-person fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3 @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $customer->last_name) }}" placeholder="Doe" required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    @error('last_name')
                                        <div class="invalid-feedback fs-6 mt-2 d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback fs-6 mt-2">Please enter a valid last name.</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: Contact & Location -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">02</span>
                            <h4 class="fw-bold text-dark mb-0 fs-5">Contact & Location</h4>
                        </div>

                        <div class="row g-4">
                            <!-- Gender -->
                            <div class="col-lg-4">
                                <label for="gender" class="form-label fw-bold text-dark fs-6 mb-2">Gender *</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-gender-ambiguous fs-4"></i></span>
                                    <select class="form-select form-select-lg fs-5 py-3 @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                        <option value="" disabled>Select Gender</option>
                                        <option value="Male" {{ old('gender', $customer->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $customer->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender', $customer->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    @error('gender')
                                        <div class="invalid-feedback fs-6 mt-2 d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback fs-6 mt-2">Please select a valid gender option.</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Mobile Number -->
                            <div class="col-lg-4">
                                <label for="cellphone_number" class="form-label fw-bold text-dark fs-6 mb-2">Mobile Number *</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-phone fs-4"></i></span>
                                    <input type="text"
                                           class="form-control form-control-lg fs-5 py-3 @error('cellphone_number') is-invalid @enderror"
                                           id="cellphone_number"
                                           name="cellphone_number"
                                           value="{{ old('cellphone_number', $customer->cellphone_number) }}"
                                           placeholder="e.g., 0917XXXXXXX"
                                           inputmode="numeric"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                           required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    @error('cellphone_number')
                                        <div class="invalid-feedback fs-6 mt-2 d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback fs-6 mt-2">Contact number is required.</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="col-lg-4">
                                <label for="email" class="form-label fw-bold text-dark fs-6 mb-2">Email Address</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-envelope fs-4"></i></span>
                                    <input type="email" class="form-control form-control-lg fs-5 py-3" id="email" name="email" value="{{ old('email', $customer->email) }}" placeholder="johndoe@domain.com">
                                </div>
                            </div>

                            <!-- Branch -->
                            <div class="col-lg-4">
                                <!-- Fixed typo: Changed Lifor to for -->
                                <label for="branch_id" class="form-label fw-semibold text-dark fs-6 mb-2">Branch</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <!-- High visibility building icon for branch -->
                                    <span class="input-group-text bg-light text-muted px-3">
                                        <i class="bi bi-building fs-4"></i>
                                    </span>

                                    @php
                                        $user = auth()->user();
                                        $isClerk = ($user->role === 'clerk');

                                        // Set the selected branch value:
                                        // Checks old input first (on validation error), falls back to the database record,
                                        // and forcefully falls back to a clerk's home branch if neither is present.
                                        $selectedBranch = old('branch_id', $customer->branch_id ?? ($isClerk ? $user->branch_id : ''));
                                    @endphp

                                    <!--
                                    Dynamic Name Attribute:
                                    If clerk: name is 'branch_id_display' so the browser ignores it, and the hidden input safely sends the data.
                                    If admin: name is 'branch_id' so the selection saves directly to the database.
                                    -->
                                    <select class="form-select form-select-lg fs-5 py-3 @error('branch_id') is-invalid @enderror"
                                            id="branch_id"
                                            name="{{ $isClerk ? 'branch_id_display' : 'branch_id' }}"
                                            @if($isClerk) disabled style="background-color: #e9ecef; opacity: 0.8; cursor: not-allowed;" @endif
                                            required>

                                        <option value="" disabled {{ empty($selectedBranch) ? 'selected' : '' }}>Select branch</option>

                                        <!-- Loop through actual branch data dynamically -->
                                        @foreach($sidebarBranches as $branch)
                                            <option value="{{ $branch->id }}" {{ $selectedBranch == $branch->id ? 'selected' : '' }}>
                                                {{ $branch->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <!-- HTML Form Rule Guardrail: Disabled selects do not submit data.
                                        This hidden field handles underlying payload safety for clerks. -->
                                    @if($isClerk)
                                        <input type="hidden" name="branch_id" value="{{ $selectedBranch }}">
                                    @endif

                                    @error('branch_id')
                                        <div class="invalid-feedback fs-6 mt-2 d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback fs-6 mt-2">Please select a valid branch.</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Full Address -->
                            <div class="col-8">
                                <label for="address" class="form-label fw-bold text-dark fs-6 mb-2">Full Address *</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-geo-alt fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3 @error('address') is-invalid @enderror" id="address" name="address" placeholder="123 Street, City, State" value="{{ old('address', $customer->address) }}" required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    @error('address')
                                        <div class="invalid-feedback fs-6 mt-2 d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback fs-6 mt-2">Please provide an operational physical address.</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: Background & Description -->
                    <div class="mb-2">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">03</span>
                                <h4 class="fw-bold text-dark mb-0 fs-5">Background & Description</h4>
                            </div>
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1.5 rounded-pill border border-success border-opacity-25 fs-6 fw-bold"><i class="bi bi-shield-exclamation me-1"></i> Optional Fields</span>
                        </div>

                        <div class="row g-4">
                            <!-- Marital Status -->
                            <div class="col-lg-4">
                                <label for="marital_status" class="form-label fw-bold text-dark fs-6 mb-2">Marital Status</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-heart fs-4"></i></span>
                                    <select class="form-select form-select-lg fs-5 py-3" id="marital_status" name="marital_status">
                                        <option value="" disabled {{ old('marital_status', $customer->marital_status) ? '' : 'selected' }}>Select Status</option>
                                        <option value="Single" {{ old('marital_status', $customer->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Married" {{ old('marital_status', $customer->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                                        <option value="Divorced" {{ old('marital_status', $customer->marital_status) == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="Widowed" {{ old('marital_status', $customer->marital_status) == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Occupation -->
                            <div class="col-lg-4">
                                <label for="occupation" class="form-label fw-bold text-dark fs-6 mb-2">Occupation</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-briefcase fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3" id="occupation" name="occupation" value="{{ old('occupation', $customer->occupation) }}" placeholder="Software Engineer">
                                </div>
                            </div>

                            <!-- Birthday -->
                            <div class="col-lg-4">
                                <label for="birthdate" class="form-label fw-bold text-dark fs-6 mb-2">Birthday</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-calendar-event fs-4"></i></span>
                                    <input type="date" class="form-control form-control-lg fs-5 py-3" id="birthdate" name="birthdate" value="{{ old('birthdate', $customer->birthdate) }}">
                                </div>
                            </div>

                            <!-- Additional Details -->
                            <div class="col-12">
                                <label for="details" class="form-label fw-bold text-dark fs-6 mb-2">Additional Details</label>
                                <textarea class="form-control form-control-lg shadow-sm rounded-3 fs-5 p-3" id="details" name="details" rows="3" placeholder="Enter any extra comments, preferences, or technical notes here...">{{ old('details', $customer->details) }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Crisp Flat Elegant Footer with perfectly aligned, same-height buttons -->
                <div class="card-footer bg-light border-top border-light-subtle p-4 d-flex flex-column flex-sm-row justify-content-sm-end align-items-stretch align-items-sm-center gap-3">
                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-outline-secondary btn-lg px-4 py-3 fs-6 rounded-3 fw-bold text-nowrap text-center">
                        Discard Changes
                    </a>
                    <button type="submit" class="btn btn-success btn-lg px-4 shadow-sm rounded-3 fw-bold border-0 py-3 fs-6 text-nowrap d-flex align-items-center justify-content-center">
                        <i class="bi bi-check-circle-fill me-2 fs-5"></i>Apply Updates
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript to intercept submission and render validation colors -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.needs-validation');

        if (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        }
    });
    </script>

    <style>
    .tracking-tight { letter-spacing: -0.025em; }
    .cs-pointer { cursor: pointer; }

    /* Keep feedback divs inside the input group layout correctly */
    .input-group.has-validation {
        flex-wrap: wrap;
    }
    .input-group > .valid-feedback,
    .input-group > .invalid-feedback {
        display: none;
        width: 100%;
    }
    .was-validated .input-group > .form-control:valid ~ .valid-feedback,
    .was-validated .input-group > .form-select:valid ~ .valid-feedback,
    .was-validated .input-group > .form-control:invalid ~ .invalid-feedback,
    .was-validated .input-group > .form-select:invalid ~ .invalid-feedback {
        display: block;
    }

    /* Elegant custom focus integration with Bootstrap input groups */
    .input-group > .form-control:focus,
    .input-group > .form-select:focus {
        border-color: #198754 !important;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15) !important;
        z-index: 3;
    }
    </style>
</div>
@endsection
