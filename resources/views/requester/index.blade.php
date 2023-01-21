@extends('layouts.app')

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

    <div class="card border-0 shadow-sm p-2 mb-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Detail Reservation</h5>

            @include('requester.form-add-reservation')
        </div>
    </div>

    <div class="card border-0 shadow-sm p-2">
        <div class="card-body">
            <h5 class="card-title mb-4">Detail Material</h5>

            <div class="mb-5">
                @include('requester.form-add-material')
            </div>

            <div class="table-responsive">
                <table id="table-material" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center text-nowrap">No</th>
                            <th class="text-center text-nowrap">Code Item</th>
                            <th class="text-center text-nowrap">Description</th>
                            <th class="text-center text-nowrap">Colour</th>
                            <th class="text-center text-nowrap">UoM</th>
                            <th class="text-center text-nowrap">Size</th>
                            <th class="text-center text-nowrap">Req. Qty</th>
                            {{-- <th class="text-center text-nowrap">Issue Qty</th> --}}
                            <th class="text-center text-nowrap">Stage & Season</th>
                            {{-- <th class="text-center text-nowrap">Information</th> --}}
                            <th class="text-center text-nowrap">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-material">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal edit --}}
    @include('requester.modal-edit-material')
@endsection

@section('script')
<script>
    function getListMaterial() {
        $.ajax({
            url: '{{ url('/requester/list-material') }}',
            type: 'get',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function(response) {
                let no = 1;
                let table = '';

                // let information = '';
                for (let i = 0; i < response.length; i++) {
                    // if (response[i].status == null || response[i].status == '') {
                    //     information = '<div class="text-danger"></div>'
                    // }

                    // <td class="text-nowrap">${ response[i].material?.information == null ? '-' : response[i].material?.information }</td> 
                    // <td class="text-nowrap">${ response[i].issue_qty }</td>
                    table += `
                        <tr>
                            <td class="text-center">${ no++ }</td>
                            <td class="text-nowrap">${ response[i].material?.material_code }</td>
                            <td class="text-nowrap">${ response[i].material?.description }</td>
                            <td class="text-nowrap">${ response[i].material?.colour }</td>
                            <td class="text-nowrap">${ response[i].material?.uom }</td>
                            <td class="text-nowrap">${ response[i].size }</td>
                            <td class="text-nowrap">${ response[i].req_qty }</td>
                           
                            <td class="text-nowrap">${ response[i].stage_and_season }</td>
                            
                            <td class="text-center d-flex">
                                <button type="button" class="btn btn-info btn-sm btn-edit me-2"
                                    data-id="${response[i].id}"
                                    data-code="${response[i].material?.material_code}"
                                    data-description="${response[i].material?.description}"
                                    data-colour="${response[i].material?.colour}"
                                    data-uom="${response[i].material?.uom}"
                                    data-size="${response[i].size}"
                                    data-req_qty="${response[i].req_qty}"
                                    data-stage_and_season="${response[i].stage_and_season}"
                                >
                                    Edit
                                </button>    
                                <button type="button" class="btn btn-danger btn-sm btn-delete"
                                    data-id="${response[i].id}"
                                    data-material-code="${response[i].material?.material_code}"
                                >
                                    Delete
                                    </button>    
                            </td>
                        </tr>
                    `;
                }

                $('#tbody-material').html(table)
            },
            error: function(xhr, stat, err) {
                alertError();
            }
        });
    }

    function addMaterial() {
        $.ajax({
            url: '{{ url('/requester/add-material') }}',
            type: 'post',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data: {
                material_id: $('#material_id').val(),
                code_item: $('#code_item').val(),
                description: $('#description').val(),
                colour: $('#colour').val(),
                uom: $('#uom').val(),
                size: $('#size').val(),
                req_qty: $('#req_qty').val(),
                issue_qty: $('#issue_qty').val(),
                stage_and_season: $('#stage_and_season').val(),
            },
            beforeSend: function() {
                showLoading();
            },
            success: function(response) {
                swal.close();
                $('#code_item').val('');
                resetFormAddMaterial();
                getListMaterial();
            },
            error: function(xhr, stat, err) {
                swal.close();
                
                $('p.text-danger').remove();
                $('.is-invalid').removeClass('is-invalid');

                if (xhr.status == 422) {
                    $.each(xhr.responseJSON.errors, (key, val) => {
                        let el = $('#' + key);
                        let newVal = `<p class="text-danger">${val}</p>`;

                        el
                        .removeClass('is-invalid')
                        .addClass(val.length > 0 ? 'is-invalid' : '')
                        .find('p.text-danger')
                        .remove();
                        
                        el.after(newVal);
                    });
                }
            }
        });
    }

    function resetFormAddMaterial() {
        $('p.text-danger').remove();
        $('.is-invalid').removeClass('is-invalid');
        $('#materal_id').val('');
        $('#description').val('');
        $('#colour').val('');
        $('#uom').val('');
        $('#size').html('');
        $('#req_qty').val('');
        $('#issue_qty').val('0');
        $('#stage_and_season').val('');
    }
    function resetFormAddReservation() {
        $('p.text-danger').remove();
        $('.is-invalid').removeClass('is-invalid');
        $('#section').val('');
        $('#reason').val('');
        $('#developer').val('');
        $('#model').val('');
        $('#article').val('');
    }

    function deleteMaterialById(id) {
        $.ajax({
            url: '{{ url('/requester/delete-material') }}' + '/' + id,
            type: 'delete',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            beforeSend: function() {
                showLoading();
            },
            success: function(response) {
                alertSuccess(response.message);
                getListMaterial();
            },
            error: function(xhr) {
                alertError();
            }
        })
    }

    const modalEditMaterial = new bootstrap.Modal(document.getElementById('modal-edit-material'), {});

    function getMaterialByCodeItem(id, code, description, colour, uom, size, req_qty, stage_and_season) {
        $.ajax({
            url: '{{ url('/requester/search-code-item') }}',
            type: 'post',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data: {
                code_item: code
            },
            beforeSend: function() {
                showLoading();
            },
            success: function(response) {
                swal.close();
                
                let optionSize = '<option value="">Select Size</option>';
                for (let i = 0; i < response.length; i++) {
                    optionSize += `<option value="${response[i].size}">${response[i].size}</option>`;
                }
                $('#size_edit').html(optionSize);
                
                modalEditMaterial.show();

                $('#id_material_requester_edit').val(id)
                $('#code_item_edit').val(code);
                $('#description_edit').val(description);
                $('#colour_edit').val(colour);
                $('#uom_edit').val(uom);
                $('#size_edit').val(size);
                $('#req_qty_edit').val(req_qty);
                $('#stage_and_season_edit').val(stage_and_season);

            },
            error: function(xhr, stat, err) {
               alertError()
            }
        })
    }

    function editMaterialById() {
        $.ajax({
            url: '{{ url('/requester/edit-material') }}' + '/' + $('#id_material_requester_edit').val(),
            type: 'put',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            beforeSend: function() {
                showLoading();
            },
            data: {
                description_edit: $('#description_edit').val(),
                colour_edit: $('#colour_edit').val(),
                uom_edit: $('#uom_edit').val(),
                size_edit: $('#size_edit').val(),
                req_qty_edit: $('#req_qty_edit').val(),
                stage_and_season_edit: $('#stage_and_season_edit').val(),
            },
            success: function(response) {
                modalEditMaterial.hide();
                alertSuccess(response.message);
                getListMaterial();
            },
            error: function(xhr, stat, err) {
                swal.close();
                
                $('p.text-danger').remove();
                $('.is-invalid').removeClass('is-invalid');

                if (xhr.status == 422) {
                    $.each(xhr.responseJSON.errors, (key, val) => {
                        let el = $('#' + key);
                        let newVal = `<p class="text-danger">${val}</p>`;

                        el
                        .removeClass('is-invalid')
                        .addClass(val.length > 0 ? 'is-invalid' : '')
                        .find('p.text-danger')
                        .remove();
                        
                        el.after(newVal);
                    });
                }
            }
        })
    }

    function addReservation() {
        $.ajax({
            url: '{{ url('/requester/add-reservation') }}',
            type: 'post',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            beforeSend: function() {
                showLoading();
            },
            data: {
                section: $('#section').val(),
                reason: $('#reason').val(),
                category: $('[name="category"]:checked').val(),
                developer: $('#developer').val(),
                model: $('#model').val(),
                article: $('#article').val(),
            },
            success: function(response) {
                alertSuccess(response.message);
                resetFormAddMaterial();
                resetFormAddReservation();
                getListMaterial();
            },
            error: function(xhr, stat, err) {
                swal.close();
                
                $('p.text-danger').remove();
                $('.is-invalid').removeClass('is-invalid');

                if (xhr.status == 422) {
                    $.each(xhr.responseJSON.errors, (key, val) => {
                        let el = $('#' + key);
                        let newVal = `<p class="text-danger">${val}</p>`;

                        el
                        .removeClass('is-invalid')
                        .addClass(val.length > 0 ? 'is-invalid' : '')
                        .find('p.text-danger')
                        .remove();
                        
                        el.after(newVal);
                    });
                }
            }
        });
    }



    $(document).ready(function() {
        $('#tanggal').datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            onClose: function(dateText, inst) {
                dateObject = $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay, 1));
            }
        }).datepicker("setDate", new Date());

        getListMaterial();

        // Button search code item onclick function 
        $('#btn-search-code-item').on('click', function() {
            $.ajax({
                url: '{{ url('/requester/search-code-item') }}',
                type: 'post',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: {
                    code_item: $('#code_item').val()
                },
                beforeSend: function() {
                    showLoading();
                },
                success: function(response) {
                    if (response.length > 0) {
                        swal.close();

                        $('#material_id').val(response[0].id);
                        $('#description').val(response[0].description);
                        $('#colour').val(response[0].colour);
                        $('#uom').val(response[0].uom);

                        let optionSize = '<option value="">Select Size</option>';

                        for (let i = 0; i < response.length; i++) {
                            optionSize += `<option value="${response[i].size}">${response[i].size}</option>`;
                        }

                        $('#size').html(optionSize);

                    } else {
                        resetFormAddMaterial();
                        alertError('Data tidak ditemukan', 'warning');
                        
                    }
                },
                error: function(xhr, stat, err) {
                    swal.close();
                    console.log(xhr);
                }
            });
        });

        // Form add material on submit event 
        $('#form-add-material').on('submit', function(e) {
            e.preventDefault();

            addMaterial();
        });

        // Button delete on click event 
        $(document).on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            let materialCode = $(this).data('material-code');
            
            Swal.fire({
                title: '',
                text: "Are you sure delete item " + materialCode + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteMaterialById(id);
                }
            }).catch(swal.noop);
        });

        $(document).on('click', '.btn-edit', function() {
            let id = $(this).data('id');
            let code = $(this).data('code');
            let description = $(this).data('description');
            let colour = $(this).data('colour');
            let uom = $(this).data('uom');
            let size = $(this).data('size');
            let req_qty = $(this).data('req_qty');
            let stage_and_season = $(this).data('stage_and_season');
            getMaterialByCodeItem(id, code, description, colour, uom, size, req_qty, stage_and_season);
        });

        $('#form-edit-material').on('submit', function(e) {
            e.preventDefault();
            editMaterialById();
        });

        $('#form-add-reservation').on('submit', function(e) {
            e.preventDefault();
            addReservation();
        });


    });
</script>
@endsection