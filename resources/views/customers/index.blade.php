@extends('layouts.app1')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary card-outline">
            <div class="card-header">
                <span class="fs-5">Customer Registry</span>
            </div>
            <div class="card-body">
                @if($customers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover align-middle">
                            <thead>
                                <tr class="text-center">
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Birthdate</th>
                                    <th>Gender</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                    <tr class="text-center">
                                        <td>{{ $customer->first_name }}</td>
                                        <td>{{ $customer->middle_name }}</td>
                                        <td>{{ $customer->last_name }}</td>
                                        <td>{{ $customer->birthdate ? \Carbon\Carbon::parse($customer->birthdate)->format('M j, Y') : '' }}</td>
                                        <td>{{ $customer->gender }}</td>
                                        <td>
                                            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-secondary btn-sm">
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
            <div class="card-footer pt-3">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
