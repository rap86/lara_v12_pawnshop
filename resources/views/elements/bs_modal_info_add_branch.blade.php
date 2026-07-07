<div class="modal fade" id="addBranchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold" id="addBranchModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i>Register New Branch
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('branches.store') }}" method="POST" data-confirm-add>
                @csrf
                <div class="modal-body p-4">

                    <div class="mb-3">
                        <label for="name" class="form-label small fw-semibold text-dark">Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="e.g., Main Branch" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label small fw-semibold text-dark">Location</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-person-badge"></i></span>
                            <input type="text" class="form-control" id="location" name="location" placeholder="e.g., Manila" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="code" class="form-label small fw-semibold text-dark">Code</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-envelope"></i></span>
                            <input type="text" class="form-control" id="code" name="code" placeholder="e.g., MB" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label small fw-semibold text-dark">Status</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-shield-lock"></i></span>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" selected disabled>Select branch status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
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
