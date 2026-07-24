@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Card Container with soft styling and crisp shadow elevation -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- Elegant Premium Amber/Yellow Header with Subtle Gradient -->
            <div class="card-header bg-warning text-dark p-4 border-0 position-relative" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-dark bg-opacity-10 p-3 rounded-3 me-3 border border-dark border-opacity-10 shadow-sm d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                            <i class="bi bi-person-badge fs-3 text-dark"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1 tracking-tight fs-3">User Account Details</h4>
                            <p class="text-dark-50 small mb-0 opacity-75 fs-6">Review system access privileges, registered destinations, and active multi-channel 2FA protocols.</p>
                        </div>
                    </div>
                    <!-- Quick action context link to hop straight into editing using dark button styling for high contrast -->
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-dark btn-lg px-4 rounded-3 fw-semibold shadow-sm text-nowrap">
                        <i class="bi bi-pencil-square me-2"></i>Edit Profile
                    </a>
                </div>
            </div>

            <div class="card-body p-4 p-lg-4 bg-white">

                <!-- SECTION 1: Identity & Context -->
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">01</span>
                        <h4 class="fw-bold text-dark mb-0 fs-4">Personal Profile</h4>
                    </div>

                    <div class="row g-4">
                        <!-- Full Name -->
                        <div class="col-lg-4">
                            <label class="form-label text-muted fw-bold small text-uppercase mb-2">Full Name</label>
                            <div class="fs-5 py-2 px-3 bg-light rounded-3 border fw-semibold text-dark">
                                <i class="bi bi-person me-2 text-muted"></i>{{ $user->name }}
                            </div>
                        </div>

                        <!-- Username -->
                        <div class="col-lg-4">
                            <label class="form-label text-muted fw-bold small text-uppercase mb-2">Username</label>
                            <div class="fs-5 py-2 px-3 bg-light rounded-3 border fw-semibold text-dark">
                                <i class="bi bi-person-badge me-2 text-muted"></i>{{ $user->username }}
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="col-lg-4">
                            <label class="form-label text-muted fw-bold small text-uppercase mb-2">Email Address</label>
                            <div class="fs-5 py-2 px-3 bg-light rounded-3 border fw-semibold text-dark">
                                <i class="bi bi-envelope me-2 text-muted"></i>{{ $user->email }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: System Permissions & Infrastructure -->
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">02</span>
                        <h4 class="fw-bold text-dark mb-0 fs-4">Access & Assignment</h4>
                    </div>

                    <div class="row g-4">
                        <!-- System Role -->
                        <div class="col-md-6 col-lg-3">
                            <label class="form-label text-muted fw-bold small text-uppercase mb-2">System Role</label>
                            <div class="fs-5 py-2 px-3 bg-light rounded-3 border fw-semibold text-dark">
                                <i class="bi bi-shield-lock me-2 text-muted"></i>{{ ucfirst($user->role) }}
                            </div>
                        </div>

                        <!-- Account Status -->
                        <div class="col-md-6 col-lg-3">
                            <label class="form-label text-muted fw-bold small text-uppercase mb-2">Account Status</label>
                            <div class="py-2 px-3">
                                @if($user->status === 'active')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 fs-6 fw-bold rounded-pill"><i class="bi bi-check-circle-fill me-1"></i> Active Record</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-2 fs-6 fw-bold rounded-pill"><i class="bi bi-x-circle-fill me-1"></i> Inactive / Deactivated</span>
                                @endif
                            </div>
                        </div>

                        <!-- Assigned Branch -->
                        <div class="col-md-6 col-lg-3">
                            <label class="form-label text-muted fw-bold small text-uppercase mb-2">Assigned Branch</label>
                            <div class="fs-5 py-2 px-3 bg-light rounded-3 border fw-semibold text-dark">
                                <i class="bi bi-building me-2 text-muted"></i>{{ $user->branch ? $user->branch->name : 'No Branch Assigned' }}
                            </div>
                        </div>

                        <!-- Floating Staff Status -->
                        <div class="col-md-6 col-lg-3">
                            <label class="form-label text-muted fw-bold small text-uppercase mb-2">Deployment Strategy</label>
                            <div class="py-2 px-3">
                                @if($user->is_floating)
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-3 py-2 fs-6 fw-bold rounded-pill"><i class="bi bi-shuffle me-1"></i> Floating Staff Member</span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-3 py-2 fs-6 fw-bold rounded-pill"><i class="bi bi-geo-alt-fill me-1"></i> Permanent Branch Staff</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: Multi-Factor Authentication Configuration & Destination Targets -->
                <div class="mb-2 bg-light rounded-4 p-4 border border-light-subtle">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-white text-success border border-success border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">03</span>
                        <div>
                            <h4 class="fw-bold text-dark mb-0 fs-4">Two-Factor Authentication (2FA) Target Channels</h4>
                            <p class="text-muted small mb-0 fs-6">Review coordinates and verify individual opt-in routing channels enabled for this account profile.</p>
                        </div>
                    </div>

                    <!-- 2FA Destination Coordinates -->
                    <div class="row g-4 mb-4">
                        <!-- Phone Number -->
                        <div class="col-lg-4">
                            <label class="form-label text-muted fw-bold small text-uppercase mb-2">Phone Number (SMS)</label>
                            <div class="fs-5 py-2 px-3 bg-white rounded-3 border fw-semibold text-dark">
                                <i class="bi bi-phone me-2 text-muted"></i>{{ $user->phone_number ?: 'Not Configured' }}
                            </div>
                        </div>
                        <!-- Telegram Chat ID -->
                        <div class="col-lg-4">
                            <label class="form-label text-muted fw-bold small text-uppercase mb-2">Telegram Chat ID</label>
                            <div class="fs-5 py-2 px-3 bg-white rounded-3 border fw-semibold text-dark">
                                <i class="bi bi-telegram me-2 text-info"></i>{{ $user->chat_id_telegram ?: 'Not Configured' }}
                            </div>
                        </div>
                        <!-- Viber Chat ID -->
                        <div class="col-lg-4">
                            <label class="form-label text-muted fw-bold small text-uppercase mb-2">Viber User ID</label>
                            <div class="fs-5 py-2 px-3 bg-white rounded-3 border fw-semibold text-dark">
                                <i class="bi bi-violet me-2 text-purple"></i>{{ $user->chat_id_viber ?: 'Not Configured' }}
                            </div>
                        </div>
                    </div>

                    <!-- Option Cards Status for individual 2FA Switches -->
                    <div class="row g-3">
                        <!-- Gmail Switch Status -->
                        <div class="col-sm-6 col-xl-2.4">
                            <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center justify-content-between h-100">
                                <span class="text-dark fw-bold fs-5 mb-0"><i class="bi bi-google text-danger me-2"></i>Gmail</span>
                                <i class="bi {{ $user->two_factor_gmail ? 'bi-toggle2-on text-success' : 'bi-toggle2-off text-muted' }} fs-2"></i>
                            </div>
                        </div>
                        <!-- Yahoo Switch Status -->
                        <div class="col-sm-6 col-xl-2.4">
                            <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center justify-content-between h-100">
                                <span class="text-dark fw-bold fs-5 mb-0"><i class="bi bi-envelope-fill text-purple me-2"></i>Yahoo</span>
                                <i class="bi {{ $user->two_factor_yahoo ? 'bi-toggle2-on text-success' : 'bi-toggle2-off text-muted' }} fs-2"></i>
                            </div>
                        </div>
                        <!-- SMS Switch Status -->
                        <div class="col-sm-6 col-xl-2.4">
                            <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center justify-content-between h-100">
                                <span class="text-dark fw-bold fs-5 mb-0"><i class="bi bi-chat-text text-primary me-2"></i>SMS</span>
                                <i class="bi {{ $user->two_factor_sms ? 'bi-toggle2-on text-success' : 'bi-toggle2-off text-muted' }} fs-2"></i>
                            </div>
                        </div>
                        <!-- Telegram Switch Status -->
                        <div class="col-sm-6 col-xl-2.4">
                            <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center justify-content-between h-100">
                                <span class="text-dark fw-bold fs-5 mb-0"><i class="bi bi-telegram text-info me-2"></i>Telegram</span>
                                <i class="bi {{ $user->two_factor_telegram ? 'bi-toggle2-on text-success' : 'bi-toggle2-off text-muted' }} fs-2"></i>
                            </div>
                        </div>
                        <!-- Viber Switch Status -->
                        <div class="col-sm-6 col-xl-2.4">
                            <div class="p-3 bg-white border rounded-3 shadow-sm d-flex align-items-center justify-content-between h-100">
                                <span class="text-dark fw-bold fs-5 mb-0"><i class="bi bi-violet text-purple me-2"></i>Viber</span>
                                <i class="bi {{ $user->two_factor_viber ? 'bi-toggle2-on text-success' : 'bi-toggle2-off text-muted' }} fs-2"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Read Only Dashboard Quick Action Control Footer Matrix -->
            <div class="card-footer bg-light border-top border-light-subtle p-4 d-flex flex-column flex-sm-row justify-content-sm-end align-items-stretch align-items-sm-center">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-lg px-5 py-3 fs-5 rounded-3 fw-semibold text-center">
                    <i class="bi bi-arrow-left-short fs-4 align-middle"></i> Back to User Registry
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.tracking-tight { letter-spacing: -0.025em; }
.text-purple { color: #7360f2; }

@media (min-width: 1200px) {
    .col-xl-2\.4 {
        flex: 0 0 auto;
        width: 20%;
    }
}
</style>
@endsection
