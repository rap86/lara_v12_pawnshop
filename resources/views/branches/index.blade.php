@extends('layouts.app1')

@section('content')
<div class="card shadow-lg">
    <div class="card-header border-0">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-0 text-dark">Company Branches</h4>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBranchModal">
                <i class="bi bi-building me-2"></i>Add Branch
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Branch Name</th>
                        <th>Branch Code</th>
                        <th>Location / City</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Date Opened</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($branches as $branch)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm" style="width: 40px; height: 40px;">
                                        {{ $branch->id }}
                                    </div>
                                    <div>
                                        <span class="fw-bold text-dark d-block mb-0">{{ $branch->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $branch->code }}</td>
                            <td><span class="text-dark font-monospace">{{ $branch->location }}</span></td>
                            <td>
                                @switch(strtolower($branch->type))
                                    @case('hq')
                                    @case('headquarters')
                                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2.5 py-1">
                                            <i class="bi bi-shield-lock-fill me-1"></i> HQ
                                        </span>
                                        @break

                                    @case('sub-branch')
                                        <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-2.5 py-1">
                                            <i class="bi bi-briefcase-fill me-1"></i> Sub-Branch
                                        </span>
                                        @break

                                    @default
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1">
                                            <i class="bi bi-person-fill me-1"></i> {{ ucfirst($branch->type) }}
                                        </span>
                                @endswitch
                            </td>
                            <td>
                                <span class="badge rounded-pill px-2.5 py-1 border
                                    {{ $branch->status === 'active'
                                        ? 'bg-success-subtle text-success border-success-subtle'
                                        : 'bg-danger-subtle text-danger border-danger-subtle' }}">
                                    {{ ucfirst($branch->status) }}
                                </span>
                            </td>
                            <td class="text-secondary">{{ $branch->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button"
                                            class="btn btn-outline-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editBranchModal"
                                            data-id="{{ $branch->id }}"
                                            data-name="{{ $branch->name }}"
                                            data-code="{{ $branch->code }}"
                                            data-location="{{ $branch->location }}"
                                            data-type="{{ $branch->type }}"
                                            data-status="{{ $branch->status }}">
                                        <i class="bi bi-pencil-square"></i> Update
                                    </button>
                                    <button type="button" class="btn btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteBranchModal"
                                            data-id="{{ $branch->id }}"
                                            data-name="{{ $branch->name }}">
                                        <i class="bi bi-trash3"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-building display-5 d-block mb-3 text-secondary"></i>
                                    <p class="mb-0 fw-medium">No registered branches found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- Custom Pagination Bar Render --}}
    @if($branches->hasPages())
        <div class="card-footer border-0 pt-4 py-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <span class="small text-muted">
                    Showing {{ $branches->firstItem() }} to {{ $branches->lastItem() }} of {{ $branches->total() }} entries
                </span>
                <div>
                    {{ $branches->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endif
</div>


@include('elements.bs_modal_info_add_branch')


@include('elements.bs_modal_info_update_branch')


@include('elements.bs_modal_info_delete_branch')

@endsection
