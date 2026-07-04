<<div class="modal fade" id="updateProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold" id="updateProfileModalLabel">
                    <i class="bi bi-person-gear me-2"></i>Update Customer Profile
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="createFormGlobal" action="{{ route('customers.update', $customers->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body p-4">
                    <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wider">Personal Information</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label for="first_name" class="form-label small fw-semibold text-dark">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $customers->first_name) }}" required>
                            @error('first_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="middle_name" class="form-label small fw-semibold text-dark">Middle Name</label>
                            <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name" value="{{ old('middle_name', $customers->middle_name) }}" required>
                            @error('middle_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="last_name" class="form-label small fw-semibold text-dark">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $customers->last_name) }}" required>
                            @error('last_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="gender" class="form-label small fw-semibold text-dark">Gender</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Male" {{ old('gender', $customers->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $customers->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $customers->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wider">Contact & Location</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="cellphone_number" class="form-label small fw-semibold text-dark">Mobile Number</label>
                            <input type="text" class="form-control @error('cellphone_number') is-invalid @enderror" id="cellphone_number" name="cellphone_number" value="{{ old('cellphone_number', $customers->cellphone_number) }}" required>
                            @error('cellphone_number')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label small fw-semibold text-dark">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-envelope"></i></span>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $customers->email) }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label small fw-semibold text-dark">Full Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="123 Street, City, State" value="{{ old('address', $customers->address) }}" required>
                            @error('address')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wider">Background & Description</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="marital_status" class="form-label small fw-semibold text-dark">Marital Status</label>
                            <select class="form-select" id="marital_status" name="marital_status">
                                <option value="Single" {{ old('marital_status', $customers->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Married" {{ old('marital_status', $customers->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Divorced" {{ old('marital_status', $customers->marital_status) == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                <option value="Widowed" {{ old('marital_status', $customers->marital_status) == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="occupation" class="form-label small fw-semibold text-dark">Occupation</label>
                            <input type="text" class="form-control" id="occupation" name="occupation" value="{{ old('occupation', $customers->occupation) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="birthdate" class="form-label small fw-semibold text-dark">Birthday</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate', $customers->birthdate) }}">
                        </div>
                        <div class="col-12 mt-3">
                            <label for="details" class="form-label small fw-semibold text-dark">Additional Details</label>
                            <textarea class="form-control" id="details" name="details" rows="3" placeholder="Enter any extra comments or notes...">{{ old('details', $customers->details) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-top-0 px-4">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal" id="btnCancelProcedure">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Save Changes</button>
            </div>
                </div>
            </form>
        </div>
    </div>
</div>
