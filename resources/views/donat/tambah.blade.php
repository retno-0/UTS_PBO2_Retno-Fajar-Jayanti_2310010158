@extends('layouts.master')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm p-4" style="max-width: 600px; margin:auto;">

        <h3 class="mb-3">Tambah Donat</h3>

        <form id="donatForm" enctype="multipart/form-data" method="POST" action="{{ route('donat.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Donat</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="text" name="harga" class="form-control" oninput="formatRibuan(this)" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                <div class="mt-3 text-center">
                    <img id="previewImage" src="#" alt="Preview Foto" 
                        style="display: none; width: 200px; border-radius: 10px;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('donat.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function formatRibuan(input) {
    let angka = input.value.replace(/\D/g, "");
    input.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};

document.getElementById('foto').addEventListener('change', function(event) {
    var file = event.target.files[0];
    var preview = document.getElementById('previewImage');

    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.style.display = 'block';
            preview.src = e.target.result;
        }
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        preview.src = '#';
    }
});
</script>

@endsection
