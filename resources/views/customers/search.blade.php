@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-lg border-0">
            @if($customers->isNotEmpty())
                <!-- Clean White Card Header -->
                <div class="card-header bg-white p-4 border-bottom position-relative rounded-top-4">
                    <div class="row align-items-center">
                        <div class="col-12 d-flex align-items-center gap-3">
                            <!-- High Contrast Dark Icon Box -->
                            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 54px; height: 54px; background-color: #f1f5f9;">
                                <i class="bi bi-search fs-3 text-secondary"></i>
                            </div>
                            <div>
                                <span class="text-muted fw-semibold uppercase tracking-wider small d-block mb-0.5" style="font-size: 0.85rem; letter-spacing: 0.5px;">CUSTOMER DIRECTORY</span>
                                <h3 class="fw-bold mb-0 text-dark fs-3">
                                    Showing Results for: <span class="text-primary fw-extrabold">"{{ request('search') }}"</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Card Body Content Router -->
            @if($customers->isEmpty())
                <!-- Custom Empty State -->
                <div class="card-body rounded-4 bg-white">
                    <div class="text-center py-5 my-3">
                        <div class="mb-4">
                            <div class="d-inline-flex p-4 rounded-circle bg-secondary bg-opacity-10 mb-2">
                                <i class="bi bi-person-x text-secondary" style="font-size: 5rem;"></i>
                            </div>
                        </div>
                        <h2 class="text-dark fw-bold mb-3">We couldn't find that customer</h2>
                        <p class="text-muted fs-5 mx-auto mb-4" style="max-width: 500px;">
                            No results found for "<strong>{{ request('search') }}</strong>". Please make sure the name is spelled correctly.
                        </p>

                        <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
                            <a href="{{ route('customers.create') }}" class="btn btn-primary btn-lg rounded-3 px-5 py-3 fw-bold fs-5 shadow">
                                <i class="bi bi-plus-lg me-2"></i> Create New Customer
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Spaced Padded Table Wrapper -->
                <div class="table-responsive px-2 pb-5">
                    <table class="table table-hover align-middle mb-0">
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
                                            <span class="badge px-3 py-2 fw-bold fs-6 rounded-3 text-primary d-inline-block" style="background-color: #e0f2fe; border: 1px solid #bae6fd;">
                                                <i class="bi bi-gender-male me-1"></i> Male
                                            </span>
                                        @elseif(strtolower($customer->gender) == 'female')
                                            <span class="badge px-3 py-2 fw-bold fs-6 rounded-3 text-danger d-inline-block" style="background-color: #fce7f3; border: 1px solid #fbcfe8;">
                                                <i class="bi bi-gender-female me-1"></i> Female
                                            </span>
                                        @else
                                            <span class="badge px-3 py-2 fw-bold fs-6 rounded-3 text-secondary d-inline-block" style="background-color: #f1f5f9; border: 1px solid #cbd5e1;">
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
             @endif

            {{-- Custom Pagination Bar Render --}}
            @if($customers->hasPages())
                <div class="card-footer bg-light border-top border-light pt-4 py-3 px-4">
                    {{ $customers->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Readable sizing adjustments */
    .fs-5 { font-size: 1.15rem !important; }
    .fs-6 { font-size: 1rem !important; }

    /* Custom Table Row Padding & Explicit Left Offset alignment */
    .table th, .table td {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
        padding-left: 1rem;
        padding-right: 1rem;
    }
    .table th:first-child, .table td:first-child {
        padding-left: 1.5rem !important; /* Extra Left Padding for clean side align */
    }

    /* Soft Zebra stripes */
    .table-striped tbody tr:nth-of-type(odd) { background-color: #ffffff; }
    .table-striped tbody tr:nth-of-type(even) { background-color: #f8fafc; }

    .table-hover tbody tr:hover {
        background-color: #f1f5f9 !important;
        transition: background-color 0.15s ease;
    }

    .shadow-2xs { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04); }
    .mt-0.5 { margin-top: 0.125rem; }

    .hover-scale:hover {
        background-color: #1d4ed8 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
    }
</style>
@endsection
