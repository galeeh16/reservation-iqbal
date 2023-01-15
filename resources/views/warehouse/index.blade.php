@extends('layouts.app')

@section('title')
    Warehouse
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Material List</h5>

            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modal-upload-excel">
                <i data-feather="file" style="width: 16px; height: 16px;"></i>
                Upload Excel
            </button>

            <table id="table" class="table table-bordered table-striped table-hover" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">No</th>
                        <th class="text-center text-nowrap">Action</th>
                        <th class="text-center text-nowrap">Status</th>
                        <th class="text-center text-nowrap">Code</th>
                        <th class="text-center text-nowrap">Name</th>
                        <th class="text-center text-nowrap">Description</th>
                        <th class="text-center text-nowrap">Colour</th>
                        <th class="text-center text-nowrap">Size</th>
                        <th class="text-center text-nowrap">UoM</th>
                        <th class="text-center text-nowrap">Created At</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>

    <div class="modal fade" id="modal-upload-excel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mb-0" class="modal-title">Add Data Material</h5>
                    <button type="button" class="btn-sm btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="form-upload-material" method="post">
                        <div class="mb-3">
                            <label for="">Upload Excel</label>
                            <input type="file" class="form-control" name="attachment" id="attachment">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-warning">Upload</button>
                        </div>
                    </form>
                </div>
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
                url: '{{ url('warehouse/material/get-list') }}',
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
                { data: 'action', render: function(data, type, row) {
                    return 'action';
                }},
                { data: 'status', render: function(data, type, row)  {
                    return 'status';
                }},
                { data: 'material_code', class: 'text-nowrap' },
                { data: 'material_name', class: 'text-nowrap' },
                { data: 'description', class: 'text-nowrap' },
                { data: 'colour', class: 'text-nowrap' },
                { data: 'size', class: 'text-nowrap' },
                { data: 'uom', class: 'text-nowrap' },
                { data: 'created_at', class: 'text-nowrap' },
            ]
        });
    }

    $(document).ready(function() {
        const modalAdd = new bootstrap.Modal(document.getElementById('modal-upload-excel'), {});

        getDataTable();

        $('#form-upload-material').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('attachment', $('#attachment')[0].files[0]);

            $.ajax({
                url: '{{ url('warehouse/material/upload') }}',
                type: 'post',
                data: formData,
                headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                contentType: false,
                processData: false,
                beforeSend: function() {
                    showLoading();
                },
                success: function(response) {
                    console.log(response);
                    modalAdd.hide();
                    alertSuccess(response.message);
                    getDataTable();
                },
                error: function(xhr, stat, err) {
                    alertError();
                }
            });


        });
    });
</script>
@endsection