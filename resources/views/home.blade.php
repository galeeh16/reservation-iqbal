@extends('layouts.app')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">List Material</h5>

            {{-- <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#modal-add">
                <i data-feather="plus" style="width: 16px; height: 16px;"></i>
                Add Data
            </button> --}}

            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">No Reservation</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Section</th>
                        <th class="text-center">Reason</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Developer</th>
                        <th class="text-center">Model Article</th>
                        <th class="text-center">Information</th>
                        <th class="text-center">User Request</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $no = 1;
                    @endphp
                    @for($i = 0; $i < 10; $i++)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>CODE001</td>
                            <td>Desc</td>
                            <td>Yellow</td>
                            <td>13</td>
                            <td>24</td>
                            <td>200</td>
                            <td>1</td>
                            <td class="text-danger">
                                UNCONFIRM
                            </td>
                            <td>Developer</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-success">Confirm</button>
                                <button type="button" class="btn btn-sm btn-danger">Unconfirm</button>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal-add" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Data</h5>
                </div>
                <div class="modal-body">
                    <form action=""></form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function() {

    });
</script>
@endsection