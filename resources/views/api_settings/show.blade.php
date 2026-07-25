@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Card Container with soft styling and crisp shadow elevation -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

            <!-- Vibrant Warning Header with Subtle Gradient & Edit Button -->
            <div class="card-header p-4 border-0 position-relative" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-50 p-3 rounded-3 me-3 border border-white border-opacity-50 shadow-sm d-flex align-items-center justify-content-center" style="width: 56px; height: 56px;">
                            <i class="bi bi-eye fs-3 text-dark"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1 tracking-tight fs-3 text-dark">View API Gateway</h4>
                            <p class="text-dark small mb-0 opacity-75 fs-6 fw-medium">Details and configuration for {{ $apiSetting->service_provider }}.</p>
                        </div>
                    </div>

                    <!-- Header Edit Button -->
                    <a href="{{ route('api_settings.edit', $apiSetting->id) }}" class="btn btn-dark btn-lg shadow-sm rounded-3 px-4 py-2 fw-bold d-flex align-items-center">
                        <i class="bi bi-pencil-square me-2"></i> Edit Gateway
                    </a>
                </div>
            </div>

            <div class="card-body p-4 p-lg-4 bg-white">

                <!-- SECTION 1: Core Configuration -->
                <div class="mb-5">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">01</span>
                        <h4 class="fw-bold text-dark mb-0 fs-5">Core Configuration</h4>
                    </div>

                    <div class="row g-4">
                        <!-- Service Provider -->
                        <div class="col-lg-4">
                            <label class="form-label fw-bold text-muted fs-6 mb-2">Service Provider</label>
                            <div class="input-group input-group-lg shadow-sm rounded-3">
                                <span class="input-group-text bg-light border-0 text-muted px-3"><i class="bi bi-server fs-4"></i></span>
                                <div class="form-control form-control-lg bg-light border-0 fs-5 py-3 text-dark fw-medium">
                                    {{ $apiSetting->service_provider }}
                                </div>
                            </div>
                        </div>

                        <!-- API Type -->
                        <div class="col-lg-4">
                            <label class="form-label fw-bold text-muted fs-6 mb-2">API Type</label>
                            <div class="input-group input-group-lg shadow-sm rounded-3">
                                <span class="input-group-text bg-light border-0 text-muted px-3"><i class="bi bi-diagram-3 fs-4"></i></span>
                                <div class="form-control form-control-lg bg-light border-0 fs-5 py-3 text-dark fw-medium text-uppercase">
                                    {{ $apiSetting->api_type }}
                                </div>
                            </div>
                        </div>

                        <!-- Unique Code -->
                        <div class="col-lg-4">
                            <label class="form-label fw-bold text-muted fs-6 mb-2">Unique Identifier</label>
                            <div class="input-group input-group-lg shadow-sm rounded-3">
                                <span class="input-group-text bg-light border-0 text-muted px-3"><i class="bi bi-upc-scan fs-4"></i></span>
                                <div class="form-control form-control-lg bg-light border-0 fs-5 py-3 text-dark fw-medium" style="font-family: monospace;">
                                    {{ $apiSetting->unique_code }}
                                </div>
                            </div>
                        </div>

                        <!-- Environment -->
                        <div class="col-lg-4">
                            <label class="form-label fw-bold text-muted fs-6 mb-2">Environment</label>
                            <div class="input-group input-group-lg shadow-sm rounded-3">
                                <span class="input-group-text bg-light border-0 text-muted px-3"><i class="bi bi-shield-check fs-4"></i></span>
                                <div class="form-control form-control-lg bg-light border-0 py-3 d-flex align-items-center">
                                    @if($apiSetting->environment === 'production')
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill fs-6">Production (Live)</span>
                                    @else
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-3 py-2 rounded-pill text-dark fs-6">Sandbox (Test Mode)</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: Connection Credentials -->
                <div class="mb-5">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">02</span>
                            <h4 class="fw-bold text-dark mb-0 fs-5">Connection Credentials</h4>
                        </div>
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-1.5 rounded-pill border border-success border-opacity-25 fs-6 fw-bold"><i class="bi bi-shield-lock me-1"></i> Secured View</span>
                    </div>

                    <div class="row g-4">
                        <!-- Base URL -->
                        <div class="col-lg-12">
                            <label class="form-label fw-bold text-muted fs-6 mb-2">Base URL</label>
                            <div class="input-group input-group-lg shadow-sm rounded-3">
                                <span class="input-group-text bg-light border-0 text-muted px-3"><i class="bi bi-link-45deg fs-4"></i></span>
                                <div class="form-control form-control-lg bg-light border-0 fs-5 py-3 text-primary fw-medium">
                                    {{ $apiSetting->base_url ?: 'No Base URL configured' }}
                                </div>
                            </div>
                        </div>

                        <!-- API Key / Bot Token (Masked for Security) -->
                        <div class="col-lg-6">
                            <label class="form-label fw-bold text-muted fs-6 mb-2">API Key / Bot Token</label>
                            <div class="input-group input-group-lg shadow-sm rounded-3">
                                <span class="input-group-text bg-light border-0 text-muted px-3"><i class="bi bi-key fs-4"></i></span>
                                <div class="form-control form-control-lg bg-light border-0 fs-5 py-3 text-muted">
                                    @if($apiSetting->api_key)
                                        •••••••••••••••••••••••• (Encrypted)
                                    @else
                                        <span class="fst-italic">Not configured</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Auth Token (Masked for Security) -->
                        <div class="col-lg-6">
                            <label class="form-label fw-bold text-muted fs-6 mb-2">Auth Token / Secret</label>
                            <div class="input-group input-group-lg shadow-sm rounded-3">
                                <span class="input-group-text bg-light border-0 text-muted px-3"><i class="bi bi-lock fs-4"></i></span>
                                <div class="form-control form-control-lg bg-light border-0 fs-5 py-3 text-muted">
                                    @if($apiSetting->auth_token)
                                        •••••••••••••••••••••••• (Encrypted)
                                    @else
                                        <span class="fst-italic">Not configured</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Config Payload -->
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted fs-6 mb-2">JSON Config Payload</label>
                            <div class="input-group input-group-lg shadow-sm rounded-3">
                                <span class="input-group-text bg-light border-0 text-muted px-3 align-items-start pt-3"><i class="bi bi-braces fs-4"></i></span>
                                <div class="form-control form-control-lg bg-light border-0 fs-6 p-3 text-dark" style="font-family: monospace; min-height: 100px; white-space: pre-wrap;">{{ $apiSetting->config_payload ? json_encode($apiSetting->config_payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : 'No additional JSON configuration.' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: Operational Flags -->
                <div class="mb-2">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">03</span>
                        <h4 class="fw-bold text-dark mb-0 fs-5">Operational Settings</h4>
                    </div>

                    <div class="row g-4 align-items-center">
                        <!-- Priority -->
                        <div class="col-lg-4">
                            <label class="form-label fw-bold text-muted fs-6 mb-2">Routing Priority</label>
                            <div class="input-group input-group-lg shadow-sm rounded-3">
                                <span class="input-group-text bg-light border-0 text-muted px-3"><i class="bi bi-sort-numeric-down fs-4"></i></span>
                                <div class="form-control form-control-lg bg-light border-0 fs-5 py-3 text-dark fw-bold">
                                    {{ $apiSetting->priority }}
                                </div>
                            </div>
                        </div>

                        <!-- Badges for Toggles -->
                        <div class="col-lg-8 d-flex gap-4 mt-lg-5">
                            <div class="d-flex align-items-center bg-light px-4 py-3 rounded-3 shadow-sm flex-grow-1">
                                <div class="me-3">
                                    @if($apiSetting->is_active)
                                        <i class="bi bi-check-circle-fill text-success fs-3"></i>
                                    @else
                                        <i class="bi bi-x-circle-fill text-danger fs-3"></i>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">Gateway Status</h6>
                                    <span class="text-muted small">{{ $apiSetting->is_active ? 'Currently Active and routing traffic.' : 'Currently Disabled.' }}</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center bg-light px-4 py-3 rounded-3 shadow-sm flex-grow-1">
                                <div class="me-3">
                                    @if($apiSetting->is_fallback)
                                        <i class="bi bi-shield-fill-check text-primary fs-3"></i>
                                    @else
                                        <i class="bi bi-shield-x text-secondary fs-3"></i>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">Emergency Fallback</h6>
                                    <span class="text-muted small">{{ $apiSetting->is_fallback ? 'Assigned as primary fallback.' : 'Not configured as fallback.' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Crisp Flat Elegant Footer with back button -->
            <div class="card-footer bg-light border-top border-light-subtle p-4 d-flex justify-content-end">
                <a href="{{ route('api_settings.index') }}" class="btn btn-outline-secondary btn-lg px-5 py-3 fs-6 rounded-3 fw-bold text-nowrap text-center">
                    <i class="bi bi-arrow-left me-2"></i> Back to Registry
                </a>
            </div>
        </div>
    </div>

    <style>
    .tracking-tight { letter-spacing: -0.025em; }
    </style>
</div>
@endsection
