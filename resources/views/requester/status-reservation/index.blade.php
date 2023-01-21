@extends('layouts.app')

@section('title')
    Status Reservation
@endsection

@section('content')
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
        <ul class="navbar-nav d-flex">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/home') }}">Home</a>
            </li>
            @if (session()->get('role') == '3')
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/warehouse/reservation') }}">Reservation</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link text-primary" href="{{ url('/requester/status-reservation') }}">History Reservation</a>
            </li>
          </ul>
    </nav>

    <div class="card border-0 shadow-sm p-2">
        <div class="card-body">
            <h5 class="mb-3 card-title">List Reservation</h5>

            <form method="post" id="form-filter">
                <div class="mb-5 row">
                    <p>Filter By :</p>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3 row">
                            <label class="col-lg-3 col-sm-4">Periode</label>
                            <div class="col-lg-9 col-sm-8">
                                <div class="d-flex align-items-center w-100">
                                    <input type="text" class="form-control" name="date_from" id="date_from" required>
                                    <div class="mx-2 text-center" style="width: 100px;">s/d</div>
                                    <input type="text" class="form-control" name="date_to" id="date_to" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-3 col-sm-4">Status</label>
                            <div class="col-lg-9 col-sm-8">
                                <select name="status" id="status" class="form-control form-select" required>
                                    <option value="all">All</option>
                                    <option value="0">ANTRIAN</option>
                                    <option value="1">APPROVE</option>
                                    <option value="2">INAPPROVE</option>
                                    <option value="3">COMPLETE</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-lg-3 col-sm-4"></label>
                            <div class="col-lg-9 col-sm-8">
                                <button type="submit" class="btn btn-warning d-flex align-items-center" style="column-gap: 4px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                                    Apply
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table id="table" class="table table-bordered table-striped table-hover" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center text-nowrap">No</th>
                            <th class="text-center text-nowrap">Tanggal</th>
                            <th class="text-center text-nowrap">No Reservation</th>
                            <th class="text-center text-nowrap">User</th>
                            <th class="text-center text-nowrap">Section</th>
                            <th class="text-center text-nowrap">Reason</th>
                            <th class="text-center text-nowrap">Category</th>
                            <th class="text-center text-nowrap">Information</th>
                            <th class="text-center text-nowrap">Tanggal Approve Matplan</th>
                            <th class="text-center text-nowrap">Tanggal Complete Warehouse</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function getDataTable() {
        var datatable = $('#table').DataTable({
            processing: true,
            serverSide: true,
            searchDelay: 500,
            destroy: true,
            deferRender: true,
            scrollX: true,
            ordering: false,
            order: [[ 0, "asc" ]],
            columnsDef: [
                { target: 0, ordering: false}
            ],
            ajax: {
                url: '{{ url('requester/status-reservation/get-list') }}',
                type: 'post',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: function(data) {
                    return {
                        ...data,
                        status: $('#status').val(),
                        date_from: $('#date_from').val(),
                        date_to: $('#date_to').val(),
                        page: parseInt( $('#table').DataTable().page.info().page + 1),
                    }
                },
                dataSrc: function(json) {
                   return json.data;
                },
            },
            columns: [
                { data: "no", class: 'text-center', render: function (data, type, row, meta) {
                	return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'tanggal' },
                { data: 'no_reservation', class: 'text-nowrap', render: function(data, type, row) {
                    let url = '{{ url('/requester/status-reservation') }}' + '/' + row.no_reservation;
                    return `<a href="${url}" title="Show Detail Reservation">${row.no_reservation}</a>`;
                }},
                { data: 'user', class: 'text-nowrap', render: function(data, type, row) {
                    return row.user?.username;
                }},
                { data: 'section', class: 'text-nowrap' },
                { data: 'reason', class: 'text-nowrap' },
                { data: 'category', class: 'text-nowrap' },
                { data: 'status', class: 'text-nowrap text-center', render: function(data, type, row) {
                    let str = '';
                    if (row.status == '0') {
                        return 'ANTRIAN'; 
                    } else if (row.status == '1') {
                        return 'APPROVE';
                    } else if (row.status == '2') {
                        return 'INAPPROVE';
                    } else if (row.status == '3') {
                        return 'COMPLETE';
                    } else {
                        return 'UNKNOWN STATUS';
                    }
                }},
                { data: 'tanggal_approve_matplan', class: 'text-nowrap text-center' },
                { data: 'tanggal_complete_warehouse', class: 'text-nowrap text-center' },
            ]
        });
    }

    $(document).ready(function() {
        getDataTable();

        $('#date_from').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            onClose: function(dateText, inst) {
                dateObject = $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay, 1));
            }
        // }).datepicker("setDate", new Date(new Date().getFullYear(), new Date().getMonth(), 1));
        }).datepicker("setDate", new Date());

        $('#date_to').datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            onClose: function(dateText, inst) {
                dateObject = $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay, 1));
            }
        }).datepicker("setDate", new Date());

        // $('#status').on('change', function() {
        //     getDataTable();
        // });

        $('#form-filter').on('submit', function(e) {
            e.preventDefault();
            getDataTable();
        });
    });
</script>
@endsection