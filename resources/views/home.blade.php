@extends('layouts.master')

@section('content')

<style>
    body {
        background: 
        linear-gradient(rgba(255, 255, 255, 0.45), rgba(255, 255, 255, 0.55)),
        url("{{ asset('uploads/donat/unduhan (23)1.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        font-family: 'Poppins', sans-serif;
    }

    .home-box {
        background: #ffffffff;
        border-radius: 25px;
        padding: 45px;
        backdrop-filter: blur(5px);
        box-shadow: 0px 5px 12px #4f674833;
    }

    h1 {
        font-family: "Pacifico", cursive;
        color: #d95656;
        font-size: 45px;
    }

    p {
        font-size: 18px;
        color: #444;
    }

    .btn-cute {
        background-color: #d95656;
        border: none;
        border-radius: 30px;
        padding: 12px 35px;
        font-size: 18px;
        color: white;
        transition: 0.3s ease;
    }

    .btn-cute:hover {
        background-color: #d95656;
        transform: scale(1.07);
    }
</style>

<link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;500&display=swap" rel="stylesheet">


<div class="d-flex justify-content-center align-items-center" style="height:75vh;">
    <div class="home-box text-center">
        <h1>Welcome to Apple & Co 🍎</h1>
        <p class="mt-3">Nikmati manisnya hari ini dengan donat favoritmu!<br>
        Dapatkan promo spesial: beli 3 gratis 1 setiap hari Sabtu!</p>
        <a href="{{ route('donat.index') }}" class="btn btn-cute mt-4">Lihat Donat & Promo</a>
    </div>
</div>

@endsection
