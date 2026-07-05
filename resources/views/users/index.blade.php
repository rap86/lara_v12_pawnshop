@extends('layouts.app1')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-0 text-dark">System Users</h4>
                <p class="text-muted small mb-0">Manage system administrators and pawnshop staff members.</p>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-person-plus-fill me-2"></i>Add System User
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Account Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm" style="width: 40px; height: 40px;">
                                        {{ $user->id }}
                                    </div>
                                    <div>
                                        <span class="fw-bold text-dark d-block mb-0">{{ $user->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->username }}</td>
                            <td><span class="text-dark font-monospace">{{ $user->email }}</span></td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-2.5 py-1 border
                                    {{ $user->status === 'active'
                                        ? 'bg-success-subtle text-success border-success-subtle'
                                        : 'bg-danger-subtle text-danger border-danger-subtle' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="text-secondary">{{ $user->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button"
                                            class="btn btn-outline-success btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editUserModal"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}"
                                            data-username="{{ $user->username }}"
                                            data-email="{{ $user->email }}"
                                            data-role="{{ $user->role }}"
                                            data-status="{{ $user->status }}">
                                        <i class="bi bi-pencil-square"></i> Update
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteUserModal"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }}">
                                        <i class="bi bi-trash3"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-people display-5 d-block mb-3 text-secondary"></i>
                                    <p class="mb-0 fw-medium">No registered system users found.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Custom Pagination Bar Render --}}
    @if($users->hasPages())
        <div class="card-footer bg-white border-top py-3 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <span class="small text-muted">
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
                </span>
                <div>
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endif
</div>

{{-- This is for user registration --}}
@include('elements.bs_modal_info_add_user')

{{-- This is for user info update --}}
@include('elements.bs_modal_info_update_user')

{{-- This is for user info delete --}}
@include('elements.bs_modal_info_delete_user')
@endsection
