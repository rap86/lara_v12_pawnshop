@extends('layouts.app1')

@section('content')
<div class="card border-0 shadow-lg">
    <div class="card-header bg-primary text-white py-3">
        <h5 class="card-title mb-0 fw-bold">
            <i class="bi bi-person-plus me-2"></i>Add New Customer
        </h5>
    </div>

    <form action="{{ route('customers.store') }}" method="POST" data-confirm-add>
        @csrf

        <div class="card-body p-4">
            <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wider">Personal Information</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="first_name" class="form-label fs-5 fw-semibold text-dark">First Name *</label>
                    <input type="text" class="form-control form-control-lg @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="middle_name" class="form-label fs-5 fw-semibold text-dark">Middle Name *</label>
                    <input type="text" class="form-control form-control-lg @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" required>
                    @error('middle_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="last_name" class="form-label fs-5 fw-semibold text-dark">Last Name *</label>
                    <input type="text" class="form-control form-control-lg @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wider">Contact & Location</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="gender" class="form-label fs-5 fw-semibold text-dark">Gender *</label>
                    <select class="form-select form-select-lg @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                        <option value="" selected disabled>Select Gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="cellphone_number" class="form-label fs-5 fw-semibold text-dark">Mobile Number *</label>
                    <input type="text"
                           class="form-control form-control-lg @error('cellphone_number') is-invalid @enderror"
                           id="cellphone_number"
                           name="cellphone_number"
                           value="{{ old('cellphone_number') }}"
                           inputmode="numeric"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           required>
                    @error('cellphone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="email" class="form-label fs-5 fw-semibold text-dark">Email Address</label>
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-envelope"></i></span>
                        <input type="text" class="form-control form-control-lg border-start-0" id="email" name="email" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="col-12">
                    <label for="address" class="form-label fs-5 fw-semibold text-dark">Full Address *</label>
                    <input type="text" class="form-control form-control-lg @error('address') is-invalid @enderror" id="address" name="address" placeholder="123 Street, City, State" value="{{ old('address') }}" required>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wider">Background & Description</h6>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="marital_status" class="form-label fs-5 fw-semibold text-dark">Marital Status</label>
                    <select class="form-select form-select-lg" id="marital_status" name="marital_status">
                        <option value="" selected disabled>Select Status</option>
                        <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Divorced" {{ old('marital_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="Widowed" {{ old('marital_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="occupation" class="form-label fs-5 fw-semibold text-dark">Occupation</label>
                    <input type="text" class="form-control form-control-lg" id="occupation" name="occupation" value="{{ old('occupation') }}">
                </div>

                <div class="col-md-4">
                    <label for="birthdate" class="form-label fs-5 fw-semibold text-dark">Birthday</label>
                    <input type="date" class="form-control form-control-lg" id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                </div>

                <div class="col-12 mt-3">
                    <label for="details" class="form-label fs-5 fw-semibold text-dark">Additional Details</label>
                    <textarea class="form-control form-control-lg" id="details" name="details" rows="3" placeholder="Enter any extra comments, preferences, or technical notes here...">{{ old('details') }}</textarea>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light border-top-0 px-4 py-3 d-flex flex-column flex-sm-row justify-content-sm-end gap-2">
            <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary btn-lg px-4 order-2 order-sm-1">
                <i class="bi bi-x-circle me-2"></i>Cancel
            </a>
            <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm order-1 order-sm-2">
                <i class="bi bi-floppy me-2"></i>Save Record
            </button>
        </div>
    </form>
</div>
@endsection
