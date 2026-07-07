@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-lg">
            <div class="card-header border-0">
                <span class="fs-5 fw-semibold align-middle">Customer Registry</span>
                <div class="float-end">
                    <a href="{{ route('prints.print_customer_info') }}" target="_blank" class="btn btn-outline-dark shadow-sm">
                        <i class="bi bi-printer me-1"></i> Print Customer List
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($customers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th>id</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Birthdate</th>
                                    <th>Gender</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;?>
                                @foreach($customers as $customer)
                                    <tr class="text-center">
                                        <td>{{ $i++; }}</td>
                                        <td>{{ $customer->first_name }}</td>
                                        <td>{{ $customer->middle_name }}</td>
                                        <td>{{ $customer->last_name }}</td>
                                        <td>{{ $customer->birthdate ? \Carbon\Carbon::parse($customer->birthdate)->format('M j, Y') : '' }}</td>
                                        <td>{{ $customer->gender }}</td>
                                        <td>
                                            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-outline-dark">
                                                <i class="bi bi-eye"></i> View Records
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-person-x text-muted" style="font-size: 5rem;"></i>
                        </div>
                        <h3 class="text-secondary">No matching customers found</h3>
                        <p class="text-muted medium">We couldn't find anything matching "<strong>{{ request('search') }}</strong>". Try checking your spelling.</p>

                        <div class="d-flex justify-content-center gap-2 mt-4">
                            <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-1"></i> Clear Filter
                            </a>
                            <a href="{{ route('customers.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-1"></i> Create New Customer
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-footer border-0 pt-4 py-3 px-4">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
