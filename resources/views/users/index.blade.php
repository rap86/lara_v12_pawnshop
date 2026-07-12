@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-lg">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">System Users</h4>
                    </div>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="bi bi-person-plus me-2"></i> Add Sytem User
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Branch</th>
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
                                    <td>
                                        @switch(strtolower($user->role))
                                            @case('admin')
                                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-2.5 py-1">
                                                    <i class="bi bi-shield-lock-fill me-1"></i> Admin
                                                </span>
                                                @break

                                            @case('manager')
                                                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-2.5 py-1">
                                                    <i class="bi bi-briefcase-fill me-1"></i> Manager
                                                </span>
                                                @break

                                            @default
                                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1">
                                                    <i class="bi bi-person-fill me-1"></i> {{ ucfirst($user->role) }}
                                                </span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill px-2.5 py-1 border
                                            {{ $user->status === 'active'
                                                ? 'bg-success-subtle text-success border-success-subtle'
                                                : 'bg-danger-subtle text-danger border-danger-subtle' }}">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->branch->name }}
                                    </td>
                                    <td class="text-secondary">{{ $user->created_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteUserModal"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}">
                                            <i class="bi bi-trash3"></i> Delete
                                        </button>
                                        <a href="{{ route('users.show',  $user->id) }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-eye me-2"></i> View
                                        </a>
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
                <div class="card-footer bg-light border-top border-light pt-4 py-3 px-4">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- This is for user info delete --}}
@include('elements.bs_modal_info_delete_user')
@endsection
