@extends('layouts.app1')

@section('content')
<div class="row">
	<div class="col-12 col-sm-6 col-md-4">
		<div class="info-box">
			<span class="info-box-icon bg-primary text-white">
				<i class="bi bi-people"></i>
			</span>
			<div class="info-box-content">
				<span class="info-box-text">Customers</span>
				<span class="info-box-number h4 fw-bold">{{ number_format($customerTotalCount) }}</span>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-4">
		<div class="info-box">
			<span class="info-box-icon bg-warning text-dark">
				<i class="bi bi-person-gear"></i>
			</span>
			<div class="info-box-content">
				<span class="info-box-text">Users</span>
				<span class="info-box-number h4 fw-bold">{{ number_format($userTotalCount) }}</span>
			</div>
		</div>
	</div>
    <div class="col-12 col-sm-6 col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-danger text-white">
                <i class="bi bi-house"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Branches</span>
                <span class="info-box-number h4 fw-bold">{{ number_format($branchTotalCount) }}</span>
            </div>
        </div>
    </div>
</div>
<hr class="my-4" style="border-top: 2px solid #475569; opacity: 0.2;">
<!-- Section Header: Elegant & Clean Labeling -->
<div class="row mb-3 mt-4">
    <div class="col-12">
        <h5 class="text-secondary fw-semibold text-uppercase tracking-wider small mb-0" style="letter-spacing: 0.5px;">
            <i class="bi bi-diagram-3-fill me-2 text-dark"></i> Branches Overview
        </h5>
    </div>
</div>

<!-- Dynamic Grid: Automatically handles 4 cards on Row 1, and 2 cards on Row 2 -->
<div class="row g-4">
    @foreach($branchesCounts as $data)
        <div class="col-xl-3 col-md-6">
            <!-- Metric Card Structure -->
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100" style="border: 1px solid #e2e8f0 !important;">
                <div class="d-flex align-items-center">

                    <!-- Left Side: Visual Branch Icon Box (Restored to Slate Theme) -->
                    <div class="rounded-3 d-flex align-items-center justify-content-center text-white me-3 shadow-2xs"
                        style="width: 56px; height: 56px; background-color: #475569;">
                        <i class="bi bi-building fs-3"></i>
                    </div>

                    <!-- Right Side: Text Data Metrics -->
                    <div>
                        <span class="text-muted small fw-medium text-uppercase d-block mb-1" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                            {{ $data->branch_name }}
                        </span>
                        <h2 class="fw-bold mb-0 text-dark" style="font-size: 1.8rem; line-height: 1.2;">
                            {{ number_format($data->total) }}
                        </h2>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
