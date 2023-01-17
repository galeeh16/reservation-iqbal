<form method="post" id="form-add-reservation" autocomplete="off" spellcheck="false">
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            {{-- <div class="mb-3 row">
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
            </div> --}}
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
                            <input class="form-check-input" type="radio" name="category" id="material_upper" value="material_upper" checked>
                            <label class="form-check-label" for="material_upper">
                              Material Upper
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" id="accesories" value="accesories">
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