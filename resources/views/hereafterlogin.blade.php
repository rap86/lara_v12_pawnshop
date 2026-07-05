@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-lg border-0 rounded-4 bg-white overflow-hidden" style="border-top: 6px solid rgb(104, 103, 103) !important;">
            <div class="card-body p-4 p-md-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-7">
                        <div class="d-flex align-items-center gap-2 mb-4 flex-wrap">
                            <span class="badge bg-danger text-white px-3 py-2 rounded-pill fw-bold tracking-wide">
                                <i class="bi bi-shield-check me-1"></i> BSP Compliant System </span>
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold tracking-wide">
                                <i class="bi bi-star-fill me-1"></i> Pilipino-Made </span>
                        </div>
                        <h1 class="display-5 fw-black text-dark mb-3 lh-sm"> Mabilis. Maaasahan. <br>
                            <span class="text-danger">The All-in-One Agencia System.</span>
                        </h1>
                        <p class="lead text-muted mb-4 fs-5" style="max-width: 620px;"> Designed for the modern Pinoy pawnshop. Manage standard pawn tickets ( <em>papel de benta</em>), track gold appraisal rates per gram, and run your integrated <em>pera padala</em> (remittance) network smoothly—all protected by automated cloud backups. </p>
                        <div class="d-flex gap-3 flex-wrap">
                            <button type="button" class="btn btn-success btn-lg px-4 fw-bold shadow-sm rounded-3">
                                <i class="bi bi-laptop me-2"></i> Subukan ang Demo </button>
                            <button type="button" class="btn btn-outline-dark btn-lg px-4 fw-semibold rounded-3">
                                <i class="bi bi-telephone-fill me-2"></i> Kausapin Kami </button>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4 offset-xl-1">
                        <div class="card border border-light-subtle shadow-sm bg-light rounded-4 overflow-hidden">
                            <div class="card-header bg-white border-bottom border-danger-subtle p-3 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center text-danger fw-bold gap-2 small">
                                    <i class="bi bi-shop fs-5"></i> AGENCIA DASHBOARD
                                </div>
                                <span class="badge bg-success px-2 py-1 small rounded-1">ONLINE</span>
                            </div>
                            <div class="card-body p-4">
                                <ul class="list-group list-group-flush rounded-3 mb-4 border shadow-sm bg-white">
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                        <span class="fw-semibold text-secondary">
                                            <i class="bi bi-gem text-warning me-2"></i> Sangla / Appraisal </span>
                                        <span class="badge bg-light text-success border border-success-subtle px-2.5">Active</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                        <span class="fw-semibold text-secondary">
                                            <i class="bi bi-send-dash text-success me-2"></i> Pera Padala </span>
                                        <span class="badge bg-light text-success border border-success-subtle px-2.5">Ready</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                        <span class="fw-semibold text-secondary">
                                            <i class="bi bi-receipt text-primary me-2"></i> Bayad Center </span>
                                        <span class="badge bg-light text-success border border-success-subtle px-2.5">Enabled</span>
                                    </li>
                                </ul>
                                <div class="p-3 text-center border border-warning-subtle rounded-3" style="background-color: #fffdf5;">
                                    <i class="bi bi-database-fill-check text-success fs-2 mb-1 d-block"></i>
                                    <h6 class="fw-bold text-dark mb-1">Ligtas ang Data</h6>
                                    <p class="text-muted small mb-0 lh-sm">Every transaction is instantly backed up to the cloud securely.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
