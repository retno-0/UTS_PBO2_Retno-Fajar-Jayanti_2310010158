<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Toko Donat</title>

    <link href="https://fonts.googleapis.com/css2?family=Pangolin&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(255, 255, 255, 0.45), rgba(255, 255, 255, 0.55)),
        url("{{ asset('uploads/donat/unduhan (23)1.jpg') }}");
            background-size: cover;
            font-family: 'Nunito', sans-serif;
        }

        .login-card {
            width: 380px;
            background: #FFFFFFCC;
            backdrop-filter: blur(6px);
            padding: 30px;
            border-radius: 25px;
            margin-top: 100px;
            border: 4px dashed #A1B58B;
            box-shadow: 6px 6px 0px #B9C8A2;
            position: relative;
        }

        .login-title {
            font-family: 'Pangolin', cursive;
            font-size: 1.6rem;
            text-align: center;
            color: #4C5B3C;
        }

        .form-control {
            border: 2px dashed #A1B58B;
            border-radius: 15px;
            background: #F9FFE8;
        }

        .form-control:focus {
            border: 2px solid #7FA46A;
            box-shadow: none;
            background: #FFFFFF;
        }

        .btn-login {
            width: 100%;
            font-family: 'Pangolin', cursive;
            background: #A5C98A;
            border: 3px solid #768F63;
            padding: 8px;
            border-radius: 18px;
            font-size: 18px;
            transition: 0.2s;
        }

        .btn-login:hover {
            transform: scale(1.05);
            background: #92B878;
        }

        .alert {
            font-size: 14px;
            border-radius: 12px;
        }
    </style>
</head>

<body>

<div class="d-flex justify-content-center">
    <div class="login-card">

        <div class="login-title">🍎Login🍎</div>
        <p class="text-center text-muted" style="font-family:'Pangolin';">
            Ayo masuk duluuu
        </p>

        {{-- Error message --}}
        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="m-0 p-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM LOGIN --}}
        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <label class="mt-2">Email</label>
            <input type="email" name="email" class="form-control" required>

            <label class="mt-3">Password</label>
            <input type="password" name="password" class="form-control" required>

            <button type="submit" class="btn-login mt-4">Login</button>
        </form>

    </div>
</div>

</body>
</html>
