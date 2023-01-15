@extends('layouts.app')

@section('title')
    Reservation
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5>Reservation List</h5>

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
                url: '{{ url('warehouse/reservation/get-list') }}',
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
                { data: 'tanggal' },
                { data: 'no_reservation' },
                { data: 'user', class: 'text-nowrap', render: function(data, type, row) {
                    return row.user?.username;
                }},
                { data: 'section', class: 'text-nowrap' },
                { data: 'reason', class: 'text-nowrap' },
                { data: 'category', class: 'text-nowrap' },
                { data: 'status', class: 'text-nowrap text-center' },
            ]
        });
    }

    $(document).ready(function() {
        getDataTable();
    });
</script>
@endsection