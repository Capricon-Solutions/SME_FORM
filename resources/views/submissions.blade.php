@extends('layouts.app')

@section('datatables-css')
<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet">
<style>
    .dataTables_wrapper .dataTables_length, 
    .dataTables_wrapper .dataTables_filter, 
    .dataTables_wrapper .dataTables_info, 
    .dataTables_wrapper .dataTables_processing, 
    .dataTables_wrapper .dataTables_paginate {
        margin-bottom: 15px;
        color: var(--gray-700);
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--primary) !important;
        border-color: var(--primary) !important;
        color: white !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: var(--primary-dark) !important;
        border-color: var(--primary-dark) !important;
        color: white !important;
    }
    table.dataTable tbody tr:hover {
        background-color: rgba(58, 87, 232, 0.05);
    }
    table.dataTable th {
        font-weight: 600;
        border-bottom-width: 1px !important;
    }
    table.dataTable td {
        padding: 12px 10px;
        vertical-align: middle;
    }
    .table-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        padding: 15px;
        margin-top: 20px;
    }
    .badge-services {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 50px;
        background-color: rgba(58, 87, 232, 0.1);
        color: var(--primary);
        font-size: 0.8rem;
        margin-right: 5px;
        margin-bottom: 5px;
    }
</style>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="form-container">
            <div class="form-header">
                <h2 class="mb-1">Form Submissions</h2>
                <p class="text-muted mb-0">All submitted form data</p>
            </div>

            <div class="table-responsive table-container">
                <table id="submissions-table" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Business Name</th>
                            <th>Employees</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Services</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($forms as $form)
                            <tr>
                                <td><strong>{{ $form->name }}</strong></td>
                                <td>{{ $form->business_name }}</td>
                                <td class="text-center">{{ $form->no_of_employees }}</td>
                                <td>{{ $form->contact_number }}</td>
                                <td>{{ $form->email }}</td>
                                <td>
                                    @if(is_array($form->services))
                                        @foreach($form->services as $service)
                                            <span class="badge-services">{{ str_replace('_', ' ', ucfirst($service)) }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge-services">{{ str_replace('_', ' ', ucfirst($form->services)) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No submissions found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('datatables-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#submissions-table').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            dom: '<"top"fl>rt<"bottom"ip><"clear">',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                lengthMenu: "_MENU_ per page",
            },
            columnDefs: [
                { responsivePriority: 1, targets: [0, 1, 5] }, // Name, Business, Services are highest priority
                { responsivePriority: 2, targets: [3, 4] },  // Contact, Email are medium priority
                { responsivePriority: 3, targets: [2] }   // Employees is lowest priority
            ]
        });
    });
</script>
@endsection 