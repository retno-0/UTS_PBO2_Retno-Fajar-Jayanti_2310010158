@extends('layouts.master')

@section('content')
<h3>Keranjang Anda</h3>

@if(session('cart') && count(session('cart')) > 0)
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Nama Donat</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @foreach(session('cart') as $id => $item)
        @php $subtotal = $item['harga'] * $item['qty']; $total += $subtotal; @endphp
        <tr>
            <td>{{ $item['nama'] }}</td>
            <td>Rp {{ number_format($item['harga']) }}</td>
            <td>{{ $item['qty'] }}</td>
            <td>Rp {{ number_format($subtotal) }}</td>
            <td>
                <form action="{{ route('cart.remove', $id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" 
                        onclick="return confirm('Hapus item ini dari keranjang?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total</th>
            <th>Rp {{ number_format($total) }}</th>
            <th>
                <form action="{{ route('checkout') }}" method="GET">
                    <button class="btn btn-primary">Checkout</button>
                </form>
            </th>
        </tr>
    </tfoot>
</table>
@else
<p>Keranjang kosong.</p>
@endif

@endsection
