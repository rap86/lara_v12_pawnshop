@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-lg">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">System Settings</h4>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSettingModal">
                        <i class="bi bi-gear-fill me-2"></i>Add Setting
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($settings as $setting)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm" style="width: 40px; height: 40px;">
                                                {{ $setting->id }}
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block mb-0 font-monospace">{{ $setting->key }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-secondary" title="{{ $setting->value }}">
                                            {{ $setting->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill px-2.5 py-1 border
                                            {{ $setting->status === 'active'
                                                ? 'bg-success-subtle text-success border-success-subtle'
                                                : 'bg-danger-subtle text-danger border-danger-subtle' }}">
                                            {{ ucfirst($setting->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-secondary">
                                            {{ $setting->details }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-secondary">
                                            {{ $setting->created_at }}
                                        </span>
                                    </td>
                                    <td class="text-secondary">{{ $setting->updated_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button"
                                                    class="btn btn-outline-success"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editSettingModal"
                                                    data-id="{{ $setting->id }}"
                                                    data-name="{{ $setting->name }}"
                                                    data-status="{{ $setting->status }}"
                                                    data-details="{{ $setting->details }}">
                                                <i class="bi bi-pencil-square"></i> Update
                                            </button>
                                            <button type="button" class="btn btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteSettingModal"
                                                    data-id="{{ $setting->id }}"
                                                    data-name="{{ $setting->name }}">
                                                <i class="bi bi-trash3"></i> Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-gear display-5 d-block mb-3 text-secondary"></i>
                                            <p class="mb-0 fw-medium">No configurations or settings found.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Custom Pagination Bar Render --}}
            @if($settings->hasPages())
                <div class="card-footer border-0 pt-4 py-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="small text-muted">
                            Showing {{ $settings->firstItem() }} to {{ $settings->lastItem() }} of {{ $settings->total() }} entries
                        </span>
                        <div>
                            {{ $settings->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@include('elements.bs_modal_info_update_setting')
@include('elements.bs_modal_info_add_setting')

@endsection
