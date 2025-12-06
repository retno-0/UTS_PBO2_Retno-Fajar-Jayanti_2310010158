@extends('layouts.master')
@section('content')

<h3>Edit Donat</h3>

<form id="editDonatForm" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $donat->id }}">

    <div class="mb-3">
        <label>Nama Donat</label>
        <input type="text" name="nama" class="form-control" value="{{ $donat->nama }}" required>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="text" name="harga" class="form-control" value="{{ number_format($donat->harga,0,'.','.') }}" oninput="formatRibuan(this)" required>
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ $donat->stok }}" required>
    </div>

    <div class="mb-3">
        <label>Foto Lama</label><br>
        @if($donat->foto)
            <img src="{{ asset('uploads/donat/'.$donat->foto) }}" width="150" id="fotoLama" alt="{{ $donat->nama }}">
        @else
            <p>Tidak ada foto</p>
        @endif
    </div>

    <div class="mb-3">
        <label>Ganti Foto (opsional)</label>
        <input type="file" name="foto" class="form-control" id="fotoBaru">
        <div id="previewFoto" style="margin-top:10px;"></div>
    </div>

    <button class="btn btn-warning">Update</button>
    <a href="{{ route('donat.index') }}" class="btn btn-secondary">Kembali</a>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function formatRibuan(input) {
    let angka = input.value.replace(/\D/g, "");
    input.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Preview foto baru sebelum submit
$('#fotoBaru').on('change', function(){
    let reader = new FileReader();
    reader.onload = function(e){
        $('#previewFoto').html('<img src="'+e.target.result+'" width="150">');
    }
    reader.readAsDataURL(this.files[0]);
});

// AJAX submit
$('#editDonatForm').on('submit', function(e){
    e.preventDefault();
    let id = $("input[name=id]").val();
    let formData = new FormData(this);

    $.ajax({
        url: "/donat/update/"+id,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            alert('Donat berhasil diperbarui!');
            location.href = "{{ route('donat.index') }}"; // redirect ke index setelah update
        },
        error: function(err){
            console.log(err);
            alert('Terjadi kesalahan saat update.');
        }
    });
});
</script>

@endsection
