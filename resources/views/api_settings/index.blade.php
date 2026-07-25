@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-lg">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">API Gateway Registry</h4>
                        <p class="text-muted small mb-0 mt-1">Manage 2FA service providers and connection routing.</p>
                    </div>
                    <a href="{{ route('api_settings.create') }}" class="btn btn-primary shadow-sm rounded-3 px-4 py-2 fw-bold">
                        <i class="bi bi-plus-lg me-2"></i> Add New Gateway
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Provider Details</th>
                                <th>API Type</th>
                                <th>Environment</th>
                                <th>Status Routing</th>
                                <th>Gateway Health</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($apiSettings as $setting)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!-- Dynamic Initial Avatar -->
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm" style="width: 40px; height: 40px; font-size: 1.1rem;">
                                                {{ strtoupper(substr($setting->service_provider, 0, 1)) }}
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block mb-0">{{ $setting->service_provider }}</span>
                                                <span class="text-muted small" style="font-family: monospace;">{{ $setting->unique_code }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- API Type -->
                                    <td>
                                        <span class="badge px-3 py-2 fw-bold fs-6 rounded-3 shadow-2xs text-secondary d-inline-block text-uppercase" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                            <i class="bi bi-diagram-3 me-1"></i> {{ $setting->api_type }}
                                        </span>
                                    </td>

                                    <!-- Environment -->
                                    <td>
                                        @if($setting->environment === 'production')
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill">Production</span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-3 py-1 rounded-pill text-dark">Sandbox</span>
                                        @endif
                                    </td>

                                    <!-- Operational Status -->
                                    <td>
                                        <div class="d-flex flex-column gap-1 align-items-start">
                                            @if($setting->is_active)
                                                <span class="badge bg-primary px-2 py-1 rounded-2"><i class="bi bi-check-circle me-1"></i> Active</span>
                                            @else
                                                <span class="badge bg-secondary px-2 py-1 rounded-2"><i class="bi bi-dash-circle me-1"></i> Disabled</span>
                                            @endif

                                            @if($setting->is_fallback)
                                                <span class="badge bg-info text-dark px-2 py-1 rounded-2"><i class="bi bi-life-preserver me-1"></i> Primary Fallback</span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Health Status -->
                                    <td>
                                        @if($setting->last_status === 'success')
                                            <span class="text-success fw-bold"><i class="bi bi-circle-fill small me-1"></i> Online</span>
                                        @elseif($setting->last_status === 'failed')
                                            <span class="text-danger fw-bold"><i class="bi bi-exclamation-circle-fill me-1"></i> Failing</span>
                                        @else
                                            <span class="text-muted fw-bold"><i class="bi bi-question-circle-fill me-1"></i> Untested</span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td>
                                        <a href="{{ route('api_settings.show', $setting->id) }}"
                                        class="btn btn-outline-secondary px-4 py-2 rounded-3 fs-6 shadow-2xs">
                                            <i class="bi bi-pencil-square me-2"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-hdd-network display-5 d-block mb-3 text-secondary"></i>
                                            <p class="mb-0 fw-medium">No API gateways configured yet.</p>
                                            <a href="{{ route('api_settings.create') }}" class="btn btn-link mt-2">Configure your first gateway</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
