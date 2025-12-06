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

    backdrop-filter: blur(2px);
    font-family: 'Poppins', sans-serif;

    transition: 0.4s ease;
}


    .dashboard-box {
        background: #ffffffff;
        border-radius: 25px;
        padding: 40px;
        backdrop-filter: blur(4px);
        box-shadow: 0px 4px 12px #4f674833;
    }

    h1 {
        font-family: "Pacifico", cursive;
        color: #d95656;
        font-size: 42px;
    }

    p {
        font-size: 18px;
        color: #444;
    }

    .btn-cute {
        background-color: #F27C7C;
        border: none;
        border-radius: 30px;
        padding: 12px 30px;
        font-size: 18px;
        color: white;
        transition: 0.3s;
    }

    .btn-cute:hover {
        background: #d95656;
        transform: scale(1.07);
    }
</style>

<link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;500&display=swap" rel="stylesheet">

<div class="d-flex justify-content-center align-items-center" style="height:75vh;">
    <div class="dashboard-box text-center">
        <h1>Welcome Admin 🍎</h1>
        <p class="mt-3">Hope your day is as sweet as donuts!  
        Yuk mulai kelola isi toko cantikmu 💞</p>

        <a href="{{ route('donat.index') }}" class="btn btn-cute mt-4">Kelola Donat</a>
    </div>
</div>

@endsection
