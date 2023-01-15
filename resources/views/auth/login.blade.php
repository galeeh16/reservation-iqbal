<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <style>
        html, body {
            font-family: 'Poppins', sans-serif;
            font-size: 14px !important;
        }
        .form-control, ::placeholder {
            font-size: 14px !important;
        }
        ::placeholder {
            color: #a7afbe !important;
        }
    </style>
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6 col-lg-5 col-xs-12">
                <div class="card border-0 shadow">
                    <div class="card-body p-lg-5 p-md-4 p-xs-3">
                        <div class="d-flex align-items-center mb-5" style="gap: 1rem;">
                            <div style="width: 45px;">
                                <img src="{{ asset('logo.png') }}" style="width: 45px;" alt="PT. Panarub">
                            </div>
                            <h3 class="">PT. Panarub Industry</h3>
                        </div>

                        <div id="error-message">

                        </div>

                        <form method="post" id="form-login" autocomplete="off" spellcheck="false">
                            {{ csrf_field() }}

                            <div class="mb-3">
                                <label for="username" class="col-form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="col-form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-warning">Login</button>
                            </div>
                        </form>

                        <div class="mt-4 text-secondary text-center">
                            <small>{{ date('Y') }} &copy; All Right Reserved.</small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#form-login').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ url('login') }}',
                    type: 'post',
                    headers: { 'X-CSRF-TOKEN': '{{csrf_token()}}' },
                    data: {
                        username: $('#username').val(),
                        password: $('#password').val()
                    },
                    success: function(response) {
                        $('#error-message').html(`
                            <div class="alert alert-suuccess">
                                ${ response.message }
                            </div>
                        `);

                        window.location.href = '{{ url('home') }}';
                    },
                    error: function(xhr, stat, err) {
                        if (xhr.status == 401) {
                            $('#error-message').html(`
                                <div class="alert alert-danger">
                                    ${ xhr.responseJSON.message }
                                </div>
                            `);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>