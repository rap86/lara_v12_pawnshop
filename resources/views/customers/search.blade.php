@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Unified Main Content Card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="border: 1px solid #e2e8f0 !important;">

            <!-- Integrated Header: Clean, High-Contrast Secondary Slate -->
            @if($customers->isNotEmpty())
                <div class="card-header text-white p-4 border-0 position-relative rounded-top-4" style="background-color: #475569;">
                    <div class="row align-items-center">
                        <div class="col-12 d-flex align-items-center gap-3">
                            <!-- High Contrast Dark Icon Box - Fixed Visibility -->
                            <div class="bg-dark rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 54px; height: 54px; background-color: #1e293b !important;">
                                <i class="bi bi-search fs-3 text-white"></i>
                            </div>
                            <div>
                                <span class="text-white-50 fw-semibold uppercase tracking-wider small d-block mb-0.5" style="font-size: 0.85rem; letter-spacing: 0.5px;">CUSTOMER DIRECTORY</span>
                                <h3 class="fw-bold mb-0 text-white fs-3">
                                    Showing Results for: <span class="text-warning fw-extrabold">"{{ request('search') }}"</span>
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
                <!-- Dynamically Balanced Pure Bootstrap Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                        <thead class="border-bottom text-uppercase tracking-wider text-dark small font-weight-bold" style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0 !important;">
                            <tr class="text-dark fw-bold fs-6 text-center">
                                <th class="py-3">No.</th>
                                <th class="py-3">Full Name</th>
                                <th class="py-3">Birthdate</th>
                                <th class="py-3">Gender</th>
                                <th class="py-3">Options</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0 bg-white">
                            @foreach($customers as $customer)
                                <tr class="text-center" style="border-bottom: 1px solid #f1f5f9;">
                                    <!-- ID Counter Section: Centered Soft Circle Badge (Font-weight bold removed) -->
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center rounded-circle fs-6 shadow-2xs text-secondary mx-auto"
                                                style="width: 44px; height: 44px; background-color: #f1f5f9; border: 1px solid #cbd5e1;">
                                            {{ $customer->id }}
                                        </div>
                                    </td>
                                    <!-- Full Name: Clean Typography (Font-weight bold removed) -->
                                    <td class="text-dark fs-5 text-capitalize">
                                        {{ $customer->first_name }} {{ $customer->last_name }}
                                    </td>
                                    <!-- Birthdate Section (Font-weight bold removed) -->
                                    <td class="text-dark fs-5">
                                        {{ $customer->birthdate ? \Carbon\Carbon::parse($customer->birthdate)->format('M j, Y') : '—' }}
                                    </td>
                                    <!-- Gender Section: Centered Badge -->
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
                                    <!-- Action Button: Updated to Outline Secondary exclusively -->
                                    <td>
                                        <a href="{{ route('customers.show', $customer->id) }}"
                                            class="btn btn-outline-secondary px-4 py-2 rounded-3 fs-6 shadow-2xs">
                                            <i class="bi bi-eye-fill me-2"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Framed Pagination Footer -->
                @if($customers->hasPages())
                    <div class="card-footer bg-light border-top border-light pt-4 py-3 px-4">
                        {{ $customers->appends(request()->query())->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>

<style>
    /* Readable sizing adjustments */
    .fs-5 { font-size: 1.15rem !important; }
    .fs-6 { font-size: 1rem !important; }

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
