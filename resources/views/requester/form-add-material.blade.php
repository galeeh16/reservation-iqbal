<form method="post" id="form-add-material" autocomplete="off" spellcheck="false">
    <input type="hidden" id="material_id" name="material_id">
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="mb-3 row">
                <label class="col-form-label col-lg-3 col-sm-4">Code Item</label>
                <div class="col-lg-9 col-sm-8">
                    <div class="d-flex">
                        <input type="text" class="form-control" name="code_item" id="code_item" required style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                        <button type="button" class="btn btn-warning px-4" id="btn-search-code-item" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-form-label col-lg-3 col-sm-4">Description</label>
                <div class="col-lg-9 col-sm-8">
                    <input type="text" class="form-control" name="description" id="description" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-form-label col-lg-3 col-sm-4">Colour</label>
                <div class="col-lg-9 col-sm-8">
                    <input type="text" class="form-control" name="colour" id="colour" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-form-label col-lg-3 col-sm-4">UoM</label>
                <div class="col-lg-9 col-sm-8">
                    <input type="text" class="form-control" name="uom" id="uom" readonly>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="mb-3 row">
                <label class="col-form-label col-lg-3 col-sm-4">Size</label>
                <div class="col-lg-9 col-lg-8">
                    <select name="size" id="size" class="form-control form-select">

                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-form-label  col-lg-3 col-sm-4">Req Qty</label>
                <div class="col-lg-9 col-sm-8">
                    <input type="text" class="form-control" name="req_qty" id="req_qty">
                </div>
            </div>
            {{-- <div class="mb-3 row">
                <label class="col-form-label col-lg-3 col-sm-4">Issue Qty</label>
                <div class="col-lg-9 col-sm-8">
                    <input type="number" class="form-control" name="issue_qty" id="issue_qty" value="0">
                </div>
            </div> --}}
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