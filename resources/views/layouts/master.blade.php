<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🍎 Apple & Co Donuts</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Pangolin&family=Pacifico&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

/* 🌼 GLOBAL BASE STYLE */
body {
    background: 
        linear-gradient(rgba(255, 255, 255, 0.50), rgba(255, 255, 255, 0.55)),
        url("{{ asset('uploads/donat/unduhan (23)1.jpg') }}");
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    font-family: 'Nunito', sans-serif;
    padding-bottom: 50px;
}

/* 🎀 Page Container */
.container {
    background: #FFFFFF;
    border: 3px dashed #A0B48C;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 6px 6px 0px #9EB486;
    margin-top: 25px;
}


/* ✨ Titles */
h1, h2, h3, h4, h5 {
    font-family: 'Pangolin', cursive;
    color: #4C5B3C;
    border-bottom: 3px dotted #B0C7A1;
    display: inline-block;
    padding-bottom: 6px;
    margin-bottom: 20px;
}

/* 🍃 Navbar */
.navbar-custom {
    background: #D7E8C1;
    border-bottom: 4px dashed #7A8F63;
    padding: 15px;
    border-radius: 0 0 22px 22px;
    box-shadow: 0px 6px 0px #9EB486;
}

.navbar-brand {
    font-family: "Pacifico", cursive;
    font-size: 1.6rem;
    color: #4C5B3C !important;
}

.nav-link {
    font-weight: bold;
    color: #4C5B3C !important;
    transition: 0.3s;
    font-family: 'Pangolin';
}

.nav-link:hover {
    color: #7DA164 !important;
    transform: scale(1.08);
}


/* 🍪 Logout Button */
.logout-btn {
    font-family: 'Pangolin', cursive;
    background: #d95656;;
    border: 3px solid #B55353;
    border-radius: 15px;
    padding: 6px 18px;
    font-weight: bold;
    transition: 0.2s;
}

.logout-btn:hover {
    background: #d95656;
    transform: scale(1.08);
}


/* 🎀 Global Button Look */
.btn-custom, .btn-primary, .btn-secondary, .btn-success, .btn-warning, .btn-danger {
    border-radius: 14px !important;
    font-family: 'Pangolin', cursive !important;
    border: 2px solid #6E8A56 !important;
}

.btn-primary { background: #FFD88E !important; color: #4E3B13 !important; }
.btn-secondary { background: #b6a597ff !important ;}
.btn-success { background: #A5C98A !important; }
.btn-warning { background: #FFEE9D !important; color: #5E4C16 !important; }
.btn-danger  { background: #F27C7C !important; border-color: #B55353 !important; }

.btn:hover {
    transform: scale(1.1);
}


/* 🍄 Cute Inputs */
input, select, textarea {
    border-radius: 12px !important;
    border: 2px dashed #C1CFA5 !important;
    background: #FFFDE8 !important;
    padding: 6px 10px !important;
    font-size: 15px;
}


/* 🍩 Tables */
.table {
    border: 3px solid #A1B58B;
    background: #FFFFFF;
    border-radius: 12px;
}

.table th {
    background: #E8F1D5;
    font-family: 'Pangolin';
    text-align: center;
    color: #4F5E3F;
}

.table td {
    border-top: 2px dashed #C5D9B4;
    font-family: 'Pangolin';
    text-align: center;
    color: #5A6B49;
}


/* 🎀 Images */
img {
    border-radius: 18px;
    border: 3px dashed #d3e6c2;
    max-width: 120px;
    transition: 0.3s;
}

img:hover {
    transform: rotate(-2deg) scale(1.05);
}

</style>
</head>

<body>

    @include('layouts.navbar')

    <div class="container">
        @yield('content')
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
