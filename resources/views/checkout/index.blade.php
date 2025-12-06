@extends('layouts.master')

@section('content')
<div class="container">
    <h3>Checkout</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(empty($cart))
        <p>Keranjang kosong!</p>
    @else
        @php
            $totalQty = 0;
            $totalPrice = 0;
            $today = \Carbon\Carbon::now()->format('N'); // 6 = Sabtu
        @endphp

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nama Donat</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                    @php
                        $subtotal = $item['harga'] * $item['qty'];
                        $totalPrice += $subtotal;
                        $totalQty += $item['qty'];
                    @endphp
                    <tr>
                        <td>{{ $item['nama'] }}</td>
                        <td>Rp {{ number_format($item['harga']) }}</td>
                        <td>{{ $item['qty'] }}</td>
                        <td>Rp {{ number_format($subtotal) }}</td>
                    </tr>
                @endforeach

                {{-- Cek promo: beli 3 tepat & hari Sabtu --}}
                @if($totalQty == 3 && $today == 6)
                    <tr>
                        <td colspan="2" class="text-center">Promo Sabtu!</td>
                        <td>1</td>
                        <td>Rp 0 <span class="badge bg-success">Free!</span></td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th>
                        Rp 
                        @if($totalQty == 3 && $today == 6)
                            {{ number_format($totalPrice, 0, ',', '.') }}
                        @else
                            {{ number_format($totalPrice, 0, ',', '.') }}
                        @endif
                    </th>
                </tr>
            </tfoot>
        </table>

        <form action="{{ route('checkout.proses') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="no_hp">No HP</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="metode_pembayaran">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="Cash">Cash</option>
                    <option value="Transfer">Transfer</option>
                    <option value="QRIS">QRIS</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Metode Pengantaran</label>
                <select name="delivery_method" id="deliveryMethod" class="form-select" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="pickup">Pickup</option>
                    <option value="delivery">Delivery</option>
                </select>
            </div>

            <div class="mb-3" id="alamatField" style="display: none;">
                <label class="form-label">Alamat (Jika Delivery)</label>
                <textarea name="alamat" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Bayar & Cetak Invoice</button>
        </form>
    @endif
</div>

<script>
    const methodSelect = document.getElementById('deliveryMethod');
    const alamatField = document.getElementById('alamatField');

    methodSelect.addEventListener('change', function () {
        alamatField.style.display = methodSelect.value === "delivery" ? 'block' : 'none';
    });
</script>
@endsection
