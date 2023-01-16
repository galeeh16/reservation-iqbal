<div id="modal-edit-material" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-0">Edit Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="form-edit-material">
                    <input type="hidden" name="id_material_requester_edit" id="id_material_requester_edit">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3 row">
                                <label class="col-form-label col-lg-3 col-sm-4">Code Item</label>
                                <div class="col-lg-9 col-sm-8">
                                    <div class="d-flex">
                                        <input type="text" class="form-control" name="code_item_edit" id="code_item_edit" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-lg-3 col-sm-4">Description</label>
                                <div class="col-lg-9 col-sm-8">
                                    <input type="text" class="form-control" name="description_edit" id="description_edit" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-lg-3 col-sm-4">Colour</label>
                                <div class="col-lg-9 col-sm-8">
                                    <input type="text" class="form-control" name="colour_edit" id="colour_edit" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-lg-3 col-sm-4">UoM</label>
                                <div class="col-lg-9 col-sm-8">
                                    <input type="text" class="form-control" name="uom_edit" id="uom_edit" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="mb-3 row">
                                <label class="col-form-label col-lg-3 col-sm-4">Size</label>
                                <div class="col-lg-9 col-lg-8">
                                    <select name="size_edit" id="size_edit" class="form-control form-select">

                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label  col-lg-3 col-sm-4">Req Qty</label>
                                <div class="col-lg-9 col-sm-8">
                                    <input type="number" class="form-control" name="req_qty_edit" id="req_qty_edit">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-form-label col-lg-3 col-sm-4">Stage & Season</label>
                                <div class="col-lg-9 col-sm-8">
                                    <input type="text" class="form-control" name="stage_and_season_edit" id="stage_and_season_edit">
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
                                        <i data-feather="save" style="width: 14px;"></i>
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>