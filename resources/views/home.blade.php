@extends('layouts.app')

@section('content')
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Reservation</h5>

            <form method="post" id="form-add-reservation">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3 row">
                            <label class="col-form-label col-lg-3 col-sm-4">No. Reservation</label>
                            <div class="col-lg-9 col-sm-8">
                                <input type="text" class="form-control" name="no_reservation" id="no_reservation">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-form-label col-lg-3 col-sm-4">Tanggal</label>
                            <div class="col-lg-9 col-sm-8">
                                <input type="text" class="form-control" name="tanggal" id="tanggal">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-form-label col-lg-3 col-sm-4">Section</label>
                            <div class="col-lg-9 col-sm-8">
                                <input type="text" class="form-control" name="section" id="section">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-form-label col-lg-3 col-sm-4">Reason</label>
                            <div class="col-lg-9 col-sm-8">
                                <input type="text" class="form-control" name="reason" id="reason">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-form-label col-lg-3 col-sm-4">Category</label>
                            <div class="col-lg-9 col-sm-8">
                                <div class="d-flex" style="gap: 1rem;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="material_upper" id="material_upper" checked>
                                        <label class="form-check-label" for="material_upper">
                                          Material Upper
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="material_upper" id="accesories">
                                        <label class="form-check-label" for="accesories">
                                          Accesories / Bottom
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3 row">
                            <label class="col-form-label col-lg-3 col-sm-4">Developer</label>
                            <div class="col-lg-9 col-sm-8">
                                <input type="text" class="form-control" name="developer" id="developer">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-form-label col-lg-3 col-sm-4">Model</label>
                            <div class="col-lg-9 col-sm-8">
                                <input type="text" class="form-control" name="model" id="model">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-form-label col-lg-3 col-sm-4">Article</label>
                            <div class="col-lg-9 col-sm-8">
                                <input type="text" class="form-control" name="article" id="article">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3 row">
                            <label class="col-form-label col-lg-3 col-sm-4"></label>
                            <div class="col-lg-9 col-sm-8">
                                <button type="submit" class="btn btn-warning d-flex align-items-center" style="column-gap: 2px">
                                    <i data-feather="save" style="width: 13px;"></i>
                                    Reserve
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Detail Material</h5>

            <div class="mb-5">
                <form method="post" id="form-add-material">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3 row">
                                <label class="col-form-label col-lg-3 col-sm-4">Code Item</label>
                                <div class="col-lg-9 col-sm-8">
                                    <input type="text" class="form-control" name="code_item" id="code_item">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-lg-3 col-sm-4">Description</label>
                                <div class="col-lg-9 col-sm-8">
                                    <input type="text" class="form-control" name="description" id="description">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-lg-3 col-sm-4">Colour</label>
                                <div class="col-lg-9 col-sm-8">
                                    <input type="text" class="form-control" name="colour" id="colour">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-lg-3 col-sm-4">UoM</label>
                                <div class="col-lg-9 col-sm-8">
                                    <input type="text" class="form-control" name="uom" id="uom">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3 row">
                                <label class="col-form-label col-lg-3 col-sm-4">Size</label>
                                <div class="col-lg-9 col-lg-8">
                                    <input type="text" class="form-control" name="size" id="size">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label  col-lg-3 col-sm-4">Req Qty</label>
                                <div class="col-lg-9 col-sm-8">
                                    <input type="text" class="form-control" name="req_qty" id="req_qty">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-lg-3 col-sm-4">Issue Qty</label>
                                <div class="col-lg-9 col-sm-8">
                                    <input type="text" class="form-control" name="issue_qty" id="issue_qty">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-lg-3 col-sm-4">Stage & Season</label>
                                <div class="col-lg-9 col-sm-8">
                                    <input type="text" class="form-control" name="stage_and_season" id="stage_and_season">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="row">
                                <label class="col-lg-3 col-sm-4"></label>
                                <div class="col-lg-9 col-sm-8">
                                    <button type="submit" class="btn btn-warning d-flex align-items-center" style="column-gap: 2px">
                                        <i data-feather="plus" style="width: 14px;"></i>
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Code Item</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Colour</th>
                        <th class="text-center">UoM</th>
                        <th class="text-center">Size</th>
                        <th class="text-center">Req. Qty</th>
                        <th class="text-center">Issue Qty</th>
                        <th class="text-center">Stage & Season</th>
                        <th class="text-center">Information</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    
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
        $('#tanggal').datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            onClose: function(dateText, inst) {
                dateObject = $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay, 1));
            }
        }).datepicker("setDate", new Date());
    });
</script>
@endsection