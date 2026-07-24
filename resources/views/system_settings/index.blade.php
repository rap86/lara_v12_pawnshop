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
                                <th style="width:30%;">Details</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($system_settings as $system_setting)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm" style="width: 40px; height: 40px;">
                                                {{ $system_setting->id }}
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block mb-0 font-monospace">{{ $system_setting->key }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-secondary" title="{{ $system_setting->value }}">
                                            {{ $system_setting->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill px-2.5 py-1 border
                                            {{ $system_setting->status === 'active'
                                                ? 'bg-success-subtle text-success border-success-subtle'
                                                : 'bg-danger-subtle text-danger border-danger-subtle' }}">
                                            {{ ucfirst($system_setting->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-secondary">
                                            {{ $system_setting->details }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-secondary">
                                            {{ $system_setting->created_at }}
                                        </span>
                                    </td>
                                    <td class="text-secondary">{{ $system_setting->updated_at->format('M d, Y h:i A') }}</td>
                                    <td>

                                        <button type="button" class="btn btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModalSystemSetting"
                                                data-id="{{ $system_setting->id }}"
                                                data-name="{{ $system_setting->name }}">
                                            <i class="bi bi-trash3"></i> Delete
                                        </button>
                                            <button type="button"
                                                class="btn btn-success"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editSettingModal"
                                                data-id="{{ $system_setting->id }}"
                                                data-name="{{ $system_setting->name }}"
                                                data-status="{{ $system_setting->status }}"
                                                data-details="{{ $system_setting->details }}">
                                            <i class="bi bi-pencil-square"></i> Update
                                        </button>
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
            @if($system_settings->hasPages())
                <div class="card-footer bg-light border-top border-light pt-4 py-3 px-4">
                    {{ $system_settings->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@include('elements.bs_modal_info_update_system_setting')
@include('elements.bs_modal_info_add_system_setting')
@include('elements.bs_modal_info_delete_system_setting')
@endsection
