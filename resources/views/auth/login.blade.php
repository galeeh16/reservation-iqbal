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
                            <div class="mb-3 position-relative">
                                <label for="password" class="col-form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required>
                                
                                <div class="position-absolute" id="eye" onclick="showHidePassword('eye')" style="bottom: 7px; right: 12px; cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" color="#999" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </div>

                                <div class="position-absolute" id="eye-slash" onclick="showHidePassword('eye-slash')" style="bottom: 7px; right: 12px; cursor: pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" color="#999" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                        <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                        <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                    </svg>
                                </div>

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
        function showHidePassword(divId) {
            if (divId === 'eye') {
                $('#eye').hide();
                $('#eye-slash').show();
                $('#password').attr('type', 'password');
            } else {
                $('#eye').show();
                $('#eye-slash').hide();
                $('#password').attr('type', 'text');
            }
        }

        $(document).ready(function() {
            // hide eye 
            $('#eye').hide();

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