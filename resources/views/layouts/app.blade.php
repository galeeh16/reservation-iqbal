<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Reservation')</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    {{-- Datatable --}}
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    {{-- Jquery UI --}}
    <link rel="stylesheet" href="{{ asset('jquery-ui/jquery-ui.min.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html, body {
            font-family: 'Poppins', sans-serif;
            font-size: 14px !important;
        }
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
            margin: 0;
        }
        .text-danger {
            font-size: 13px !important;
        }
        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
        .bg-lightblue {
            background-color: #9ddcff;
        }
        .table tr th {
            font-weight: 500 !important;
            font-size: 14px;
        }
        .dataTables_info,
        .dataTables_length,
        .dataTables_filter,
        .paginate_button .page-link {
            font-size: 14px !important;
        }
        .table tr td,
        label.col-form-label,
        label.form-check-label,
        .form-control,
        .form-select {
            font-size: 14px !important;
        }
        .form-control:focus,
        .form-control:active,
        .form-control.is-invalid:active,
        .form-control.is-valid:active {
            box-shadow: none !important;
            -webkit-box-shadow: none !important;
            -moz-box-shadow: none !important;
        }
        .btn.btn-sm {
            font-size: 12px !important;
        }
        .btn {
            font-size: 13px !important;
        }
        .dataTables_length, 
        .dataTables_filter {
            margin-bottom: 1rem !important;
        }
        .dataTables_info,
        .dataTables_paginate {
            margin-top: 1rem  !important;
            padding-top: 0 !important;
        }
        input.form-control:read-only {
            background-color: #dedede; 
        }
    </style>
</head>
<body class="bg-light">
    
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg bg-lightblue border-0 ">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" style="gap: 8px;" href="{{ url('/') }}">
                    <div class="bg-white" style="padding: 0; border-radius: 5px;">
                        <img src="{{ asset('logo.png') }}" style="width: 35px;" alt="PT. Panarub">
                    </div>
                    PT. Panarub Industry
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="ms-auto text-dark d-flex align-items-center" style="gap: 10px;">
                    <div style="width: 40px; height: 40px;" class="border border-dark rounded-circle d-flex align-items-center justify-content-center">
                        <i data-feather="user" style="width: 18px; height: 18px;"></i>
                    </div>
                    <div>
                        <div class="text-muted"><b>{{ session()->get('username') }}</b></div>
                        <div>{{ session()->get('name') }}</div>
                    </div>
                    <div class="ms-1">
                        <a href="{{ url('/logout') }}" class="text-danger" title="Logout">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        
        <div class="container py-4">
            <div class="mb-4">
                <div>
                    <a href="{{ url('warehouse/material') }}">Menu Warehouse Material</a>
                </div>
                <div>
                    <a href="{{ url('warehouse/reservation') }}">Menu Warehouse Reservation</a>
                </div>
                <div>
                    <a href="{{ url('requester/status-reservation') }}">Status Reservation</a>
                </div>
            </div>
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('jquery-ui/jquery-ui.min.js') }}"></script>

    <script>
        feather.replace();

        function rupiah(number) {
			let formatNumbering = new Intl.NumberFormat("id-ID", {minimumFractionDigits: 0});
    		return formatNumbering.format(number)
		}

		function showLoading() {
			Swal.fire({
				icon: '',
				title: '',
				text: 'Sedang memproses...',
				showConfirmButton: false,
			});
		}

		function hideLoading() {
			swal.close();
		}

		function alertSuccess(msg = 'Sukses') {
			Swal.fire('', msg, 'success');
		}

		function alertError(msg = 'Whoops, something went wrong.', type='error') {
			Swal.fire('', msg, type);
		}

		function date_format(datetime, hours) {
			let ta = new Date(datetime);
			let month = (1 + ta.getMonth()).toString();
			let mta = month.length > 1 ? month : '0' + month;
			let date = ta.getDate().toString();
			let tgl = date.length > 1 ? date : '0' + date;

			return tgl + '-' + mta + '-' + ta.getFullYear();
		}
    </script>

    @yield('script')

</body>
</html>