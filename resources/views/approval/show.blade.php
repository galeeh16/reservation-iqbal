@extends('layouts.app')

@section('css')
<style>
    .table-detail tr td {
        padding: 4px 8px 4px 0;
    }
</style>
@endsection

@section('title')
    Detail Reservation
@endsection

@section('content')
    <div class="d-flex justify-content-between mb-4">
        <div>
            <button type="button" class="btn btn-success me-2" onclick="approveOrReject('{{$reservation->id}}', 'approve')">APPROVE</button>
            <button type="button" class="btn btn-danger me-2" onclick="approveOrReject('{{$reservation->id}}', 'reject')">UNAPPROVE</button>
            <button type="button" class="btn btn-dark" onclick="downloadPdf('{{$reservation->no_reservation}}')">DOWNLOAD PDF</button>
        </div>
        <div>
            <a href="{{ url('/home') }}" class="btn btn-secondary d-flex align-items-center" style="gap: 2px;" >
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                </svg>
                Back
            </a>
        </div>
    </div>
    <div class="card border-0 shadow-sm p-2">
        <div class="card-body">
            <h5 class="card-title">Detail Reservation</h5>

            <div class="mb-5">
                <table class="table-detail" style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 160px;">No Reservation</td>
                        <td style="width: 10px;">:</td>
                        <td>{{ $reservation->no_reservation }}</td>
                    </tr>
                    <tr>
                        <td style="width: 160px;">Tanggal</td>
                        <td style="width: 10px;">:</td>
                        <td>{{ $reservation->tanggal }}</td>
                    </tr>
                    <tr>
                        <td style="width: 160px;">Section</td>
                        <td style="width: 10px;">:</td>
                        <td>{{ $reservation->section }}</td>
                    </tr>
                    <tr>
                        <td style="width: 160px;">Reason</td>
                        <td style="width: 10px;">:</td>
                        <td>{{ $reservation->reason }}</td>
                    </tr>
                    <tr>
                        <td style="width: 160px;">Category</td>
                        <td style="width: 10px;">:</td>
                        <td>{{ $reservation->category }}</td>
                    </tr>
                    <tr>
                        <td style="width: 160px;">Developer</td>
                        <td style="width: 10px;">:</td>
                        <td>{{ $reservation->developer }}</td>
                    </tr>
                    <tr>
                        <td style="width: 160px;">Model</td>
                        <td style="width: 10px;">:</td>
                        <td>{{ $reservation->model }}</td>
                    </tr>
                    <tr>
                        <td style="width: 160px;">Article</td>
                        <td style="width: 10px;">:</td>
                        <td>{{ $reservation->article }}</td>
                    </tr>
                    <tr>
                        <td style="width: 160px; vertical-align: top;">Remarks</td>
                        <td style="width: 10px; vertical-align: top;">:</td>
                        <td>
                            <textarea spellcheck="false" name="remarks" id="remarks" rows="5" class="form-control" style="resize: none;">{{ $reservation->remarks }}</textarea>
                        </td>
                    </tr>
                </table>
            </div>

            <h5 class="card-title">Detail Material</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center text-nowrap">No</th>
                            <th class="text-center text-nowrap">Code Item</th>
                            <th class="text-center text-nowrap">Description</th>
                            <th class="text-center text-nowrap">Colour</th>
                            <th class="text-center text-nowrap">UoM</th>
                            <th class="text-center text-nowrap">Size</th>
                            <th class="text-center text-nowrap">Req. Qty</th>
                            {{-- <th class="text-center text-nowrap">Stage & Season</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materials as $material)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $material->material_code }}</td>
                                <td>{{ $material->description }}</td>
                                <td>{{ $material->colour }}</td>
                                <td>{{ $material->uom }}</td>
                                <td>{{ $material->size }}</td>
                                <td>{{ $material->req_qty }}</td>
                                {{-- <td>{{ $material->reason }}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function approveOrReject(id, type) {
        $.ajax({
            url: '{{ url('approval/material/approve-or-reject') }}',
            type: 'post',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data: {
                id: id,
                type: type,
                remarks: $('#remarks').val()
            },
            beforeSend: function() {
                showLoading();
            },
            success: function(response) {
                Swal.fire('', response.message, 'success')
                .then(val => {
                    if (val.isConfirmed) {
                        window.location.reload();
                    }
                });
            },
            error: function(xhr, stat, err) {
                alertError();
            }
        });
    }

    function downloadPdf(no_reservation) {
        $.ajax({
    		url: '{{ url('approval/detail/pdf/RES-000001') }}',
            type: "get",
            headers: { 'X-CSRF-TOKEN' : '{{csrf_token()}}' },
			xhr: function() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 2) {
                        if (xhr.status == 200) {
                            xhr.responseType = "blob";
                        } else {
                            xhr.responseType = "text";
                        }
                    }
                };
                return xhr;
            },
			success: function(data, status, xhr) {
				var fileName = xhr.getResponseHeader('content-disposition').split('filename=')[1].split(';')[0];
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                a.href = url;
                a.download = fileName.replace(/\"/g, '');
                document.body.append(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            },
			error: function(xhr, stat, err) {
				if (xhr.status == 400 || xhr.status == 404) {
					
				}
			}
    	})
    }
</script>
@endsection