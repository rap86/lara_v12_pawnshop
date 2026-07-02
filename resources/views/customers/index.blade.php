@extends('layouts.app1')

@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users</h3>
                <a class="btn btn-secondary" href="{{ route('customers.create') }}">New Customer</a>
                <div class="card-tools">
                    <div class="input-group" style="width: 20rem">
                        <span class="input-group-text">
                            <i class="bi bi-search" aria-hidden="true"></i>
                        </span>
                        <input
                            id="table-filter"
                            type="search"
                            class="form-control"
                            placeholder="Filter rows…"
                            aria-label="Filter rows"
                        />
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="d-flex gap-2 mb-3">
                    <button id="export-csv" type="button" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-filetype-csv me-1" aria-hidden="true"></i> Export CSV
                    </button>
                    <button id="export-json" type="button" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-filetype-json me-1" aria-hidden="true"></i> Export JSON
                    </button>
                    <button id="print-table" type="button" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-printer me-1" aria-hidden="true"></i> Print
                    </button>
                </div>

                @if(count($customers) > 0)
                    {{-- Changed from <table> to a clean container <div> for Tabulator --}}
                    <div class="table-responsive">
                        <div id="users-table"></div>
                    </div>
                @else
                    <div class="alert alert-default">
                        <h1 class="text-danger">Customer not found!</h1>
                        <h6>Make sure you have typed the correct firstname/lastname of the customer.</h6>
                        <hr>
                        <a href="{{ route('customers.create') }}" class="btn btn-secondary btn-lg text-decoration-none">
                            <i class="fa fa-plus"> </i> Create a new customer.
                        </a>
                    </div>
                @endif
            </div>

            <div class="card-footer text-secondary small">
                Powered by <a href="https://tabulator.info/" target="_blank" rel="noopener">Tabulator</a> &mdash; vanilla JS, no jQuery required.
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 1. Safely feed the Laravel Eloquent collection directly into JS
        const tableData = @json($customers);

        // Optional custom date formatter to mimic your original Blade output
        const formatDate = (cell) => {
            const val = cell.getValue();
            if (!val) return "";
            const date = new Date(val);
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        };

        // Action button formatter
        const actionButtons = (cell) => {
            const id = cell.getData().id;
            // You can generate your route dynamic string here if needed
            return `<a href="/lara_v12_pawnshop/public/customers/${id}" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i> View</a>`;
        };

        // 2. Initialize Tabulator on the empty div container
        const table = new Tabulator('#users-table', {
            data: tableData, // Injecting the data array here
            layout: 'fitColumns',
            pagination: 'local', // Enable client-side pagination
            paginationSize: 10,
            paginationSizeSelector: [10, 25, 50, 100],
            movableColumns: true,
            // Match keys exactly with your Laravel Eloquent database columns
            columns: [
                { title: 'Id', field: 'id', width: 80, headerSort: true },
                { title: 'Firstname', field: 'first_name' },
                { title: 'Middlename', field: 'middle_name' },
                { title: 'Lastname', field: 'last_name' },
                { title: 'Birthdate', field: 'birthdate', formatter: formatDate },
                { title: 'Gender', field: 'gender' },
                { title: 'Action', formatter: actionButtons, hsortDownloads: false, headerSort: false, width: 100 }
            ],
        });

        // Global search filter logic
        document.getElementById('table-filter').addEventListener('input', (e) => {
            const value = e.target.value;
            if (value) {
                table.setFilter([
                    [
                        { field: 'first_name', type: 'like', value: value },
                        { field: 'last_name', type: 'like', value: value },
                    ],
                ]);
            } else {
                table.clearFilter();
            }
        });

        // Export and Print Actions
        document.getElementById('export-csv').addEventListener('click', () => table.download('csv', 'users.csv'));
        document.getElementById('export-json').addEventListener('click', () => table.download('json', 'users.json'));
        document.getElementById('print-table').addEventListener('click', () => table.print(false, true));
    });
</script>
