@extends('layouts.app')

@section('title')
    Approval
@endsection

@section('content')
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
        <ul class="navbar-nav d-flex">
            <li class="nav-item">
                <a class="nav-link text-primary" href="{{ url('/home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/requester/status-reservation') }}">History Reservation</a>
            </li>
        </ul>
    </nav>

    <div class="card border-0 shadow-sm p-2">
        <div class="card-body">
            <h5 class="card-title mb-3">Reservation List</h5>

            <table id="table" class="table table-bordered table-striped table-hover" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">No</th>
                        <th class="text-center text-nowrap">Tanggal</th>
                        <th class="text-center text-nowrap">No. Reservation</th>
                        <th class="text-center text-nowrap">User</th>
                        <th class="text-center text-nowrap">Section</th>
                        <th class="text-center text-nowrap">Reason</th>
                        <th class="text-center text-nowrap">Category</th>
                        <th class="text-center text-nowrap">Action</th>
                    </tr>
                </thead>
            </table>

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
                url: '{{ url('approval/material/get-list') }}',
                type: 'post',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: function(data) {
                    return {
                        ...data,
                        page: parseInt( $('#table').DataTable().page.info().page + 1),
                    }
                },
                beforeSend: function() {
                },
                dataSrc: function(json) {
                   return json.data;
                },
            },
            columns: [
                { data: "no", class: 'text-center', render: function (data, type, row, meta) {
                	return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: 'tanggal', class: 'text-nowrap' },
                { data: 'no_reservation', class: 'text-nowrap', render: function(data, type, row) {
                    let url = '{{ url('approval/detail') }}' + '/' + row.no_reservation;
                    return `<a href="${url}" title="Show Detail Reservation">${row.no_reservation}</a>`;
                }},
                { data: 'user', class: 'text-nowrap', render: function(data, type, row) {
                    return row.user?.username;
                }},
                { data: 'section', class: 'text-nowrap' },
                { data: 'reason', class: 'text-nowrap' },
                { data: 'category', class: 'text-nowrap' },
                { data: 'action', class: 'text-nowrap text-center d-flex justify-content-center', render: function(data, type, row) {
                    return `
                        <button type="button" class="btn btn-sm btn-success btn-approve me-2" data-id="${ row.id }">APPROVE</button>
                        <button type="button" class="btn btn-sm btn-danger btn-unapprove" data-id="${ row.id }">UNAPPROVE</button>
                    `;
                }},
            ]
        });
    }

    function approveOrReject(id, type) {
        $.ajax({
            url: '{{ url('approval/material/approve-or-reject') }}',
            type: 'post',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data: {
                id: id,
                type: type
            },
            beforeSend: function() {
                showLoading();
            },
            success: function(response) {
                alertSuccess(response.message);
                getDataTable();
            },
            error: function(xhr, stat, err) {
                alertError();
            }
        });
    }

    $(document).ready(function() {
        getDataTable();

        $(document).on('click', '.btn-approve', function() {
            approveOrReject($(this).data('id'), 'approve')
        });

        $(document).on('click', '.btn-unapprove', function() {
            approveOrReject($(this).data('id'), 'reject')
        });

    });
</script>
@endsection