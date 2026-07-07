<div class="modal fade" id="addUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold" id="addUserModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i>Register New System User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('users.store') }}" method="POST" data-confirm-add>
                @csrf
                <div class="modal-body p-4">

                    <div class="mb-3">
                        <label for="name" class="form-label small fw-semibold text-dark">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="e.g., Ronaldo Panuelos" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label small fw-semibold text-dark">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person-badge"></i></span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="e.g., ronaldo" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold text-dark">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="e.g., panuelos@yahoo.com">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label small fw-semibold text-dark">System Role</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-shield-lock"></i></span>
                            <select class="form-select" id="role" name="role" required>
                                <option value="" selected disabled>Select system access tier...</option>
                                <option value="clerk">Clerk</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label small fw-semibold text-dark">Status</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-shield-lock"></i></span>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" selected disabled>Select user status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label small fw-semibold text-dark">Branch</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-shield-lock"></i></span>
                            <select class="form-select" id="branch_id" name="branch_id" required>
                                <option value="" selected disabled>Select branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="text-muted my-3 opacity-25">

                    <div class="mb-3">
                        <label for="password" class="form-label small fw-semibold text-dark">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Minimum 8 characters" required>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label for="password_confirmation" class="form-label small fw-semibold text-dark">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-key-fill"></i></span>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-type password validation" required>
                        </div>
                    </div>

                </div>

                <div class="modal-footer bg-light border-top-0 px-4">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm">Save Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
