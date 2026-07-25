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
                        <i class="bi bi-hdd-network fs-3 text-dark"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1 tracking-tight fs-3">Add New API Gateway</h4>
                        <p class="text-white-50 small mb-0 opacity-75 fs-6">Configure a new service provider for the multi-channel 2FA system.</p>
                    </div>
                </div>
            </div>

            <!-- Added 'needs-validation' and 'novalidate' for custom Bootstrap feedback states -->
            <form class="createApiSettingForm needs-validation" action="{{ route('api_settings.store') }}" method="POST" data-confirm-add novalidate>
                @csrf

                <div class="card-body p-4 p-lg-4 bg-white">

                    <!-- SECTION 1: Core Configuration (Important Fields) -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2 py-1 me-2 rounded-2 fw-bold text-uppercase fs-6">01</span>
                            <h4 class="fw-bold text-dark mb-0 fs-5">Core Configuration</h4>
                        </div>

                        <div class="row g-4">
                            <!-- Service Provider -->
                            <div class="col-lg-4">
                                <label for="service_provider" class="form-label fw-bold text-dark fs-6 mb-2">Service Provider *</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-server fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3 @error('service_provider') is-invalid @enderror" id="service_provider" name="service_provider" value="{{ old('service_provider') }}" placeholder="e.g., Twilio, Telegram" required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    @error('service_provider')
                                        <div class="invalid-feedback fs-6 mt-2 d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback fs-6 mt-2">Please enter the provider name.</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- API Type -->
                            <div class="col-lg-4">
                                <label for="api_type" class="form-label fw-bold text-dark fs-6 mb-2">API Type *</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-diagram-3 fs-4"></i></span>
                                    <select class="form-select form-select-lg fs-5 py-3 @error('api_type') is-invalid @enderror" id="api_type" name="api_type" required>
                                        <option value="" disabled {{ old('api_type') ? '' : 'selected' }}>Select Gateway Type</option>
                                        <option value="telegram" {{ old('api_type') == 'telegram' ? 'selected' : '' }}>Telegram</option>
                                        <option value="viber" {{ old('api_type') == 'viber' ? 'selected' : '' }}>Viber</option>
                                        <option value="sms" {{ old('api_type') == 'sms' ? 'selected' : '' }}>SMS</option>
                                        <option value="email" {{ old('api_type') == 'email' ? 'selected' : '' }}>Email / SMTP</option>
                                    </select>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    @error('api_type')
                                        <div class="invalid-feedback fs-6 mt-2 d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback fs-6 mt-2">Please select a valid API type.</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Unique Code -->
                            <div class="col-lg-4">
                                <label for="unique_code" class="form-label fw-bold text-dark fs-6 mb-2">Unique Identifier *</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-upc-scan fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3 @error('unique_code') is-invalid @enderror" id="unique_code" name="unique_code" value="{{ old('unique_code') }}" placeholder="e.g., telegram_primary" required>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    @error('unique_code')
                                        <div class="invalid-feedback fs-6 mt-2 d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback fs-6 mt-2">A unique code identifier is required.</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Environment -->
                            <div class="col-lg-4">
                                <label for="environment" class="form-label fw-bold text-dark fs-6 mb-2">Environment *</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3 has-validation">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-shield-check fs-4"></i></span>
                                    <select class="form-select form-select-lg fs-5 py-3 @error('environment') is-invalid @enderror" id="environment" name="environment" required>
                                        <option value="sandbox" {{ old('environment', 'sandbox') == 'sandbox' ? 'selected' : '' }}>Sandbox (Test Mode)</option>
                                        <option value="production" {{ old('environment') == 'production' ? 'selected' : '' }}>Production (Live)</option>
                                    </select>
                                    <div class="valid-feedback fs-6 mt-2">Looks good!</div>
                                    @error('environment')
                                        <div class="invalid-feedback fs-6 mt-2 d-block">{{ $message }}</div>
                                    @else
                                        <div class="invalid-feedback fs-6 mt-2">Please select an environment mode.</div>
                                    @enderror
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
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1.5 rounded-pill border border-success border-opacity-25 fs-6 fw-bold"><i class="bi bi-shield-lock me-1"></i> Encrypted at Rest</span>
                        </div>

                        <div class="row g-4">
                            <!-- Base URL -->
                            <div class="col-lg-12">
                                <label for="base_url" class="form-label fw-bold text-dark fs-6 mb-2">Base URL</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-link-45deg fs-4"></i></span>
                                    <input type="url" class="form-control form-control-lg fs-5 py-3" id="base_url" name="base_url" value="{{ old('base_url') }}" placeholder="https://api.telegram.org">
                                </div>
                            </div>

                            <!-- API Key / Bot Token -->
                            <div class="col-lg-6">
                                <label for="api_key" class="form-label fw-bold text-dark fs-6 mb-2">API Key / Bot Token</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-key fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3" id="api_key" name="api_key" value="{{ old('api_key') }}" placeholder="Enter secure key">
                                </div>
                            </div>

                            <!-- Auth Token -->
                            <div class="col-lg-6">
                                <label for="auth_token" class="form-label fw-bold text-dark fs-6 mb-2">Auth Token / Secret</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-lock fs-4"></i></span>
                                    <input type="text" class="form-control form-control-lg fs-5 py-3" id="auth_token" name="auth_token" value="{{ old('auth_token') }}" placeholder="Enter authentication secret">
                                </div>
                            </div>

                            <!-- Config Payload -->
                            <div class="col-12">
                                <label for="config_payload" class="form-label fw-bold text-dark fs-6 mb-2">JSON Config Payload</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-braces fs-4"></i></span>
                                    <textarea class="form-control form-control-lg fs-5 p-3" id="config_payload" name="config_payload" rows="4" placeholder='{"Sender_ID": "MyPawnshop", "Header": "Auth"}' style="font-family: monospace;">{{ old('config_payload') }}</textarea>
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
                                <label for="priority" class="form-label fw-bold text-dark fs-6 mb-2">Routing Priority</label>
                                <div class="input-group input-group-lg shadow-sm rounded-3">
                                    <span class="input-group-text bg-light text-muted px-3"><i class="bi bi-sort-numeric-down fs-4"></i></span>
                                    <input type="number" class="form-control form-control-lg fs-5 py-3" id="priority" name="priority" value="{{ old('priority', 0) }}">
                                </div>
                            </div>

                            <!-- Toggle Switches -->
                            <div class="col-lg-8 d-flex gap-5 mt-lg-5">
                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input cs-pointer" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} style="transform: scale(1.5); margin-right: 15px;">
                                    <label class="form-check-label fw-bold text-dark fs-5 cs-pointer pt-1" for="is_active">Enable Gateway Status</label>
                                </div>

                                <div class="form-check form-switch form-check-lg">
                                    <input class="form-check-input cs-pointer" type="checkbox" role="switch" id="is_fallback" name="is_fallback" value="1" {{ old('is_fallback') ? 'checked' : '' }} style="transform: scale(1.5); margin-right: 15px;">
                                    <label class="form-check-label fw-bold text-dark fs-5 cs-pointer pt-1" for="is_fallback">Set as Emergency Fallback</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Crisp Flat Elegant Footer with perfectly aligned, same-height buttons -->
                <div class="card-footer bg-light border-top border-light-subtle p-4 d-flex flex-column flex-sm-row justify-content-sm-end align-items-stretch align-items-sm-center gap-3">
                    <a href="{{ route('api_settings.index') }}" class="btn btn-outline-secondary btn-lg px-4 py-3 fs-6 rounded-3 fw-bold text-nowrap text-center">
                        Cancel Configuration
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm rounded-3 fw-bold border-0 py-3 fs-6 text-nowrap d-flex align-items-center justify-content-center">
                        <i class="bi bi-floppy me-2 fs-5"></i>Save Gateway
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

    /* Ensure large toggle switches scale gracefully */
    .form-check-lg .form-check-input {
        margin-top: 0.2rem;
    }
    </style>
</div>
@endsection
