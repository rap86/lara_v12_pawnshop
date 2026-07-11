<div class="modal fade" id="addBranchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold" id="addBranchModalLabel">
                    <i class="bi bi-building-add me-2"></i>Register New Branch
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('branches.store') }}" method="POST" data-confirm-add>
                @csrf
                <div class="modal-body p-4">

                    <!-- Name Field (Large Inputs and Labels) -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold text-dark">Branch Name</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-building"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="e.g., Main Branch" required>
                        </div>
                    </div>

                    <!-- Location Field (Large Inputs and Labels) -->
                    <div class="mb-3">
                        <label for="location" class="form-label fw-semibold text-dark">Location</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" class="form-control" id="location" name="location" placeholder="e.g., Manila" required>
                        </div>
                    </div>

                    <!-- Code Field (Large Inputs and Labels) -->
                    <div class="mb-3">
                        <label for="code" class="form-label fw-semibold text-dark">Branch Code</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-hash"></i></span>
                            <input type="text" class="form-control" id="code" name="code" placeholder="e.g., MB" required>
                        </div>
                    </div>

                    <!-- Status Field (Large Inputs and Labels) -->
                    <div class="mb-3">
                        <label for="status" class="form-label fw-semibold text-dark">Status</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light text-secondary border-end-0"><i class="bi bi-toggle-on"></i></span>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" selected disabled>Select branch status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 px-4">
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-lg px-4 shadow-sm">Save Branch</button>
                </div>
            </form>
        </div>
    </div>
</div>
