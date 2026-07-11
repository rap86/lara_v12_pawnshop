@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-lg">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold mb-0 text-dark">Customer Registry</h4>
                    </div>
                    <a href="{{ route('prints.print_customer_info') }}" target="_blank" class="btn btn-primary">
                        <i class="bi bi-person-plus me-2"></i> Print Customer
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Mobile</th>
                                <th>Birthdate</th>
                                <th>Branch</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $customer)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm" style="width: 40px; height: 40px;">
                                                {{ $customer->id }}
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block mb-0">{{ $customer->first_name }} {{ $customer->last_name }}</span>
                                            </div>
                                        </div>
                                    </td>
									<td>
										@if(strtolower($customer->gender) == 'male')
											<span class="badge px-3 py-2 fw-bold fs-6 rounded-3 shadow-2xs text-primary d-inline-block" style="background-color: #e0f2fe; border: 1px solid #bae6fd;">
												<i class="bi bi-gender-male me-1"></i> Male
											</span>
										@elseif(strtolower($customer->gender) == 'female')
											<span class="badge px-3 py-2 fw-bold fs-6 rounded-3 shadow-2xs text-danger d-inline-block" style="background-color: #fce7f3; border: 1px solid #fbcfe8;">
												<i class="bi bi-gender-female me-1"></i> Female
											</span>
										@else
											<span class="badge px-3 py-2 fw-bold fs-6 rounded-3 shadow-2xs text-secondary d-inline-block" style="background-color: #f1f5f9; border: 1px solid #cbd5e1;">
												{{ $customer->gender ?? '—' }}
											</span>
										@endif
									</td>
									<td>{{ $customer->cellphone_number }}</td>
									<td>{{ $customer->birthdate ? \Carbon\Carbon::parse($customer->birthdate)->format('M j, Y') : '—' }}</td>
									<td>{{ $customer->branch?->name }}</td>
									<td>
										<a href="{{ route('customers.show', $customer->id) }}"
											class="btn btn-outline-secondary px-4 py-2 rounded-3 fs-6 shadow-2xs">
											<i class="bi bi-eye-fill me-2"></i> View
										</a>
									</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-people display-5 d-block mb-3 text-secondary"></i>
                                            <p class="mb-0 fw-medium">No customers registered yet</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Custom Pagination Bar Render --}}
            @if($customers->hasPages())
                <div class="card-footer bg-light border-top border-light pt-4 py-3 px-4">
                    {{ $customers->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
