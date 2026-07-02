@extends('layouts.app1')

@section('content')
<div class="row g-4">
    <div class="col-xl-3 col-lg-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-secondary text-white text-center py-4 rounded-top border-0">
                <div class="rounded-circle bg-white text-dark d-inline-flex align-items-center justify-content-center mb-3 fw-bold"
                        style="width: 85px; height: 85px; font-size: 1.75rem;" aria-hidden="true">
                    {{ strtoupper(substr($customers->first_name, 0, 1) . substr($customers->last_name, 0, 1)) }}
                </div>

                <h5 class="fw-bold mb-1">{{ $customers->first_name }} {{ $customers->middle_name }} {{ $customers->last_name }}</h5>
                <p class="text-light opacity-75 small mb-0">ID: #{{ $customers->id }}</p>
            </div>

            <div class="card-body pt-3">
                <ul class="list-group list-group-flush text-start small mb-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <span class="text-secondary"><i class="bi bi-phone me-2 text-dark"></i>Mobile</span>
                        <span class="fw-semibold text-dark">{{ $customers->cellphone_number ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <span class="text-secondary"><i class="bi bi-envelope me-2 text-dark"></i>Email</span>
                        <span class="fw-semibold text-dark text-break ps-2 text-end">{{ $customers->email }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <span class="text-secondary"><i class="bi bi-heart me-2 text-dark"></i>Status</span>
                        <span class="fw-semibold text-dark">{{ $customers->marital_status }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <span class="text-secondary"><i class="bi bi-person-vcard me-2 text-dark"></i>Gender</span>
                        <span class="fw-semibold text-dark">{{ $customers->gender }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <span class="text-secondary"><i class="bi bi-briefcase me-2 text-dark"></i>Occupation</span>
                        <span class="fw-semibold text-dark">{{ $customers->occupation }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        <span class="text-secondary"><i class="bi bi-cake2 me-2 text-dark"></i>Birthday</span>
                        <span class="fw-semibold text-dark">{{ $customers->birthdate }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        Address: {{ $customers->address }}
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        Details: {{ $customers->details }}
                    </li>
                </ul>

                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-primary d-flex align-items-center justify-content-center py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#updateProfileModal">
                        <i class="bi bi-pencil-square me-2"></i> Update Profile
                    </button>
                    <a href="#" class="btn btn-outline-secondary d-flex align-items-center justify-content-center py-2">
                        <i class="bi bi-cart-plus me-2"></i> Place Order
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-9 col-lg-8">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-transparent border-bottom p-0">
                <ul class="nav nav-tabs card-header-tabs m-0 px-3" id="profile-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active px-4 py-3 fw-medium text-dark" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab" aria-controls="activity" aria-selected="true">
                            <i class="bi bi-activity me-2"></i>Activity
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link px-4 py-3 fw-medium text-secondary" id="timeline-tab" data-bs-toggle="tab" data-bs-target="#timeline" type="button" role="tab" aria-controls="timeline" aria-selected="false">
                            <i class="bi bi-clock-history me-2"></i>Timeline
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link px-4 py-3 fw-medium text-secondary" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">
                            <i class="bi bi-gear me-2"></i>Settings
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content" id="profile-tabs-content">
                    <div class="tab-pane fade show active" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                        <h6 class="fw-bold mb-3 text-dark">Recent Activity</h6>
                        <p class="text-muted">No recent activities found for this customer.</p>
                    </div>

                    <div class="tab-pane fade" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                        <h6 class="fw-bold mb-3 text-dark">History Timeline</h6>
                        <p class="text-muted">Account timeline data goes here.</p>
                    </div>

                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                        <h6 class="fw-bold mb-3 text-dark">Account Settings</h6>
                        <p class="text-muted">Modify layout and configurations for this account.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="updateProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold" id="updateProfileModalLabel">
                    <i class="bi bi-person-gear me-2"></i>Update Customer Profile
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('customers.update', $customers->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body p-4">
                    <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wider">Personal Information</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label for="first_name" class="form-label small fw-semibold text-dark">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $customers->first_name) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="middle_name" class="form-label small fw-semibold text-dark">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name', $customers->middle_name) }}">
                        </div>
                        <div class="col-md-3">
                            <label for="last_name" class="form-label small fw-semibold text-dark">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $customers->last_name) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="gender" class="form-label small fw-semibold text-dark">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="Male" {{ old('gender', $customers->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $customers->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $customers->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>

                    <h6 class="text-uppercase fw-bold text-secondary mb-3 small tracking-wider">Contact & Location</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="cellphone_number" class="form-label small fw-semibold text-dark">Mobile Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-phone"></i></span>
                                <input type="text" class="form-control border-start-0" id="cellphone_number" name="cellphone_number" value="{{ old('cellphone_number', $customers->cellphone_number) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label small fw-semibold text-dark">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control border-start-0" id="email" name="email" value="{{ old('email', $customers->email) }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label small fw-semibold text-dark">Full Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-geo-alt"></i></span>
                                <input type="text" class="form-control border-start-0" id="address" name="address" placeholder="123 Street, City, State" value="{{ old('address', $customers->address) }}">
                            </div>
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
            </form>
        </div>
    </div>
</div>
@endsection
