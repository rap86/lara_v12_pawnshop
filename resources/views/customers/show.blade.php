@extends('layouts.app1')

@section('content')
<div class="row g-4">
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-secondary text-white text-center py-4 rounded-top border-0">
                <div class="rounded-circle bg-white text-dark d-inline-flex align-items-center justify-content-center mb-3 fw-bold"
                        style="width: 85px; height: 85px; font-size: 1.75rem;" aria-hidden="true">
                    {{ strtoupper(substr($customers->first_name, 0, 1) . substr($customers->last_name, 0, 1)) }}
                </div>

                <h4 class="fw-bold mb-1">{{ $customers->first_name }} {{ $customers->middle_name }} {{ $customers->last_name }}</h4>
                <p class="text-light opacity-75 small mb-0">ID: #{{ $customers->id }}</p>
            </div>

            <div class="card-body pt-3">
                <ul class="list-group list-group-flush text-start small mb-4 fs-5">
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
                        <span class="text-secondary"><i class="bi bi-building me-2 text-dark"></i>Branch</span>
                        <span class="fw-semibold text-dark">{{ $customers->branch->name ?? 'Main Branch' }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        Address: {{ $customers->address }}
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                        Details: {{ $customers->details }}
                    </li>
                </ul>

                <div class="d-grid gap-2">
                    <a href="{{ route('customers.edit', $customers->id) }}" class="btn btn-success btn-lg d-flex align-items-center justify-content-center py-2">
                        <i class="bi bi-pencil-square me-2"></i> Edit Profile
                    </a>
                    <a href="#" class="btn btn-outline-secondary btn-lg d-flex align-items-center justify-content-center py-2">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Disable Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-7">
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
@endsection
