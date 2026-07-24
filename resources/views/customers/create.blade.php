@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Card Container with soft styling and crisp shadow elevation -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- Elegant Premium Blue Header with Subtle Gradient -->
            <div class="card-header bg-primary text-white p-4 border-0 position-relative" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                <div class="d-flex align-items-center">
                    <div class="bg-white bg-opacity-20 p-3 rounded-3 me-3 border border-white border-opacity-25 shadow-sm d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                        <i class="bi bi-person-plus fs-3 text-dark"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1 tracking-tight fs-3">Add New Customer</h4>
                        <p class="text-white-50 small mb-0 opacity-75 fs-6">Register a new customer profile into the system management core.</p>
                    </div>
                </div>
            </div>

            <!-- Added 'needs-validation' and 'novalidate' for custom Bootstrap feedback states -->
            <form class="createCustomerForm needs-validation" action="{{ route('customers.store') }}" method="POST" data-confirm-add novalidate>
                @csrf

                <div class="card-body p-4 p-lg-4 bg-white">

                    <!-- SECTION 1: Personal Information -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">01</span>
                            <h4 class="fw-bold text-dark mb-0 fs-5">Personal Information</h4>
                        </div>

                        <div class="row g-4">
                            <!-- First Name -->
                            <div class="col-lg-4">
                                <label for="first_name" class="form-label fw-bold text-dark fs-6 mb-2">First Name *</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-person fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3 @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="John" required>
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
                                    <input type="text" class="form-control form-control-lg fs-5 py-3 @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" placeholder="Lee" required>
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
                                    <input type="text" class="form-control form-control-lg fs-5 py-3 @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Doe" required>
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
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">02</span>
                            <h4 class="fw-bold text-dark mb-0 fs-5">Contact & Location</h4>
                        </div>

                        <div class="row g-4">
                            <!-- Gender -->
                            <div class="col-lg-4">
                                <label for="gender" class="form-label fw-bold text-dark fs-6 mb-2">Gender *</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-gender-ambiguous fs-4"></i></span>
                                    <select class="form-select form-select-lg fs-5 py-3 @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    @error('gender')
                                        <div class="invalid-feedback fs-6 mt-2 d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback fs-6 mt-2">Please select a option tier gender.</div>
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
                                        value="{{ old('cellphone_number') }}"
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
                                    <input type="email" class="form-control form-control-lg fs-5 py-3" id="email" name="email" value="{{ old('email') }}" placeholder="johndoe@domain.com">
                                </div>
                            </div>

                            <!-- Branch -->
                            <div class="col-lg-4">
                                <label Lifor="branch_id" class="form-label fw-semibold text-dark fs-6 mb-2">Branch</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <!-- High visibility building icon for branch -->
                                    <span class="input-group-text bg-light text-muted px-3">
                                        <i class="bi bi-building fs-4"></i>
                                    </span>

                                    @php
                                        $user = auth()->user();
                                        $isClerk = ($user->role === 'clerk');

                                        // Set the default selected branch value
                                        // If there's validation error fallback (old data), use it; if clerk, force their branch; otherwise use empty string
                                        $selectedBranch = old('branch_id', ($isClerk ? $user->branch_id : ''));
                                    @endphp

                                    <select class="form-select form-select-lg fs-5 py-3 @error('branch_id') is-invalid @enderror"
                                            id="branch_id"
                                            name="branch_id_display"
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

                                    <!-- HTML Form Rule Guardrail: Disabled fields do not submit data to the controller.
                                        If the user is a clerk, this hidden field safely passes their forced branch ID. -->
                                    @if($isClerk)
                                        <input type="hidden" name="branch_id" value="{{ $user->branch_id }}">
                                    @else
                                        <!-- Rename select name above to branch_id dynamically via standard fallback if not disabled -->
                                        <script>document.getElementById('branch_id').setAttribute('name', 'branch_id');</script>
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
                                    <input type="text" class="form-control form-control-lg fs-5 py-3 @error('address') is-invalid @enderror" id="address" name="address" placeholder="123 Street, City, State" value="{{ old('address') }}" required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    @error('address')
                                        <div class="invalid-feedback fs-6 mt-2 d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback fs-6 mt-2">Please provide a operational physical address.</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: Background & Description -->
                    <div class="mb-2">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">03</span>
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
                                        <option value="" disabled {{ old('marital_status') ? '' : 'selected' }}>Select Status</option>
                                        <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                                        <option value="Divorced" {{ old('marital_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="Widowed" {{ old('marital_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Occupation -->
                            <div class="col-lg-4">
                                <label for="occupation" class="form-label fw-bold text-dark fs-6 mb-2">Occupation</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-briefcase fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3" id="occupation" name="occupation" value="{{ old('occupation') }}" placeholder="Software Engineer">
                                </div>
                            </div>

                            <!-- Birthday -->
                            <div class="col-lg-4">
                                <label for="birthdate" class="form-label fw-bold text-dark fs-6 mb-2">Birthday</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-calendar-event fs-4"></i></span>
                                    <input type="date" class="form-control form-control-lg fs-5 py-3" id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                                </div>
                            </div>

                            <!-- Additional Details -->
                            <div class="col-12">
                                <label for="details" class="form-label fw-bold text-dark fs-6 mb-2">Additional Details</label>
                                <textarea class="form-control form-control-lg shadow-sm rounded-3 fs-5 p-3" id="details" name="details" rows="3" placeholder="Enter any extra comments, preferences, or technical notes here...">{{ old('details') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Crisp Flat Elegant Footer with perfectly aligned, same-height buttons -->
                <div class="card-footer bg-light border-top border-light-subtle p-4 d-flex flex-column flex-sm-row justify-content-sm-end align-items-stretch align-items-sm-center gap-3">
                    <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary btn-lg px-4 py-3 fs-6 rounded-3 fw-bold text-nowrap text-center">
                        Cancel Registration
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm rounded-3 fw-bold border-0 py-3 fs-6 text-nowrap d-flex align-items-center justify-content-center">
                        <i class="bi bi-floppy me-2 fs-5"></i>Save Record
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
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15) !important;
        z-index: 3;
    }
    </style>
</div>
@endsection
