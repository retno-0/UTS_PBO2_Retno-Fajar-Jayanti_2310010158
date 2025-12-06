@extends('layouts.master')

@section('content')

<h3>Transaksi Pembelian Donat</h3>

<form action="/checkout/proses" method="POST">
    @csrf

    <div class="row">
        <div class="col-md-6">

            <div class="card mb-3">
                <div class="card-header bg-dark text-white">
                    Pilih Donat
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Pilih</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($donat as $d)
                            <tr>
                                <td>
                                    <input type="checkbox" name="donat_id[]" value="{{ $d->id }}" class="donat-checkbox">
                                </td>

                                <td>{{ $d->nama }}</td>

                                <td>
                                    <input type="hidden" class="harga" value="{{ $d->harga }}">
                                    Rp {{ number_format($d->harga) }}
                                </td>

                                <td>
                                    <input type="number" 
                                           name="qty[]" 
                                           class="form-control qty" 
                                           min="1" 
                                           value="1"
                                           disabled>
                                </td>

                                <td>
                                    <input type="text" 
                                           class="form-control subtotal" 
                                           readonly 
                                           value="0">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>

        </div>

        <div class="col-md-6">

            <div class="card">
                <div class="card-header bg-primary text-white">
                    Data Pembeli
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label>Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="form-control">
                            <option>Cash</option>
                            <option>Transfer</option>
                            <option>QRIS</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Metode Pengantaran</label>
                        <select name="delivery_method" class="form-control">
                            <option>Pick Up</option>
                            <option>Delivery</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Total Bayar</label>
                        <input type="text" id="total" name="total" class="form-control" readonly>
                    </div>

                    <button class="btn btn-success w-100">
                        Proses Pembayaran
                    </button>

                </div>
            </div>

        </div>
    </div>

</form>

<script>
// Saat checkbox diklik
document.querySelectorAll(".donat-checkbox").forEach((cb, index) => {

    cb.addEventListener("change", function() {
        let qty = document.querySelectorAll(".qty")[index];
        let subtotal = document.querySelectorAll(".subtotal")[index];
        let harga = document.querySelectorAll(".harga")[index].value;

        if (this.checked) {
            qty.disabled = false;
            subtotal.value = qty.value * harga;
        } else {
            qty.disabled = true;
            subtotal.value = 0;
        }

        hitungTotal();
    });

});

// Saat qty berubah
document.querySelectorAll(".qty").forEach((q, index) => {
    q.addEventListener("input", function() {
        let harga = document.querySelectorAll(".harga")[index].value;
        let subtotal = document.querySelectorAll(".subtotal")[index];

        subtotal.value = harga * this.value;

        hitungTotal();
    });
});

// Hitung total semua subtotal
function hitungTotal() {
    let total = 0;

    document.querySelectorAll(".subtotal").forEach(sub => {
        total += parseInt(sub.value);
    });

    document.getElementById("total").value = total;
}
</script>

@endsection
