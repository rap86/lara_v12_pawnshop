@extends('layouts.app1')

@section('content')
<div class="row">
	<div class="col-md-4">
		<div class="info-box">
			<span class="info-box-icon bg-primary text-white">
				<i class="bi bi-people"></i>
			</span>
			<div class="info-box-content">
				<span class="info-box-text">Total Customers</span>
				<span class="info-box-number h4 fw-bold">{{ number_format($customerCount) }}</span>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="info-box">
			<span class="info-box-icon bg-warning text-dark">
				<i class="bi bi-person-gear"></i>
			</span>
			<div class="info-box-content">
				<span class="info-box-text">System Users</span>
				<span class="info-box-number h4 fw-bold">{{ number_format($userCount) }}</span>
			</div>
		</div>
	</div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-success text-white">
                <i class="bi bi-cash-stack"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Total Transactions</span>
                <span class="info-box-number h4 fw-bold">88</span>
            </div>
        </div>
    </div>
</div>
@endsection
