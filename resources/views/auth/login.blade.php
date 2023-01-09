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
<body class="bg-light">
    <div class="container mt-5 pt-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6 col-lg-5 col-xs-12">
                <div class="card border-0 shadow">
                    <div class="card-body p-lg-5 p-md-4 p-xs-3">
                        <h4 class="mb-5">PT. Panarub Industry</h4>

                        <form action="" method="post" id="form-login">
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
</body>
</html>