@extends('layouts.master')

@section('content')

<style>
@media print {
    body {
        background: white !important;
        color: black !important;
        font-size: 14px;
    }

    .navbar, .btn, .alert, .footer {
        display: none !important;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    table th, table td {
        border: 1px solid #000;
        padding: 6px;
    }

    h3, h4 {
        text-align: center;
    }
}
</style>

<h3>Invoice Transaksi</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>Kode Transaksi</th>
        <td>{{ $transaksi->kode_transaksi }}</td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <td>{{ $transaksi->created_at }}</td>
    </tr>
    <tr>
        <th>Nama Pelanggan</th>
        <td>{{ $transaksi->nama_pelanggan }}</td>
    </tr>
    <tr>
        <th>No HP</th>
        <td>{{ $transaksi->no_hp }}</td>
    </tr>
    <tr>
        <th>Metode Pembayaran</th>
        <td>{{ ucfirst($transaksi->metode_pembayaran) }}</td>
    </tr>
</table>

<h4>Detail Donat</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Donat</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @php 
            $no = 1; 
            $total = 0; 
            $totalQty = $transaksi->details->sum('qty');
            $today = \Carbon\Carbon::parse($transaksi->created_at)->format('N'); // 6 = Sabtu
        @endphp

        @foreach($transaksi->details as $item)
            @php
                $subtotal = $item->harga * $item->qty;
                $total += $subtotal;
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->donat->nama }}</td>
                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach

        {{-- Tambahkan donat gratis jika promo --}}
        @if($totalQty == 3 && $today == 6)
            <tr>
                <td>{{ $no }}</td>
                <td>Donat Gratis (Promo Sabtu!)</td>
                <td>Rp 0</td>
                <td>1</td>
                <td>Rp 0 <span class="badge bg-success">Free!</span></td>
            </tr>
        @endif
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Total</th>
            <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
        </tr>
    </tfoot>
</table>

<a href="{{ route('donat.index') }}" class="btn btn-primary">Kembali ke Donat</a>
<button onclick="window.print()" class="btn btn-success">Cetak Invoice</button>

@endsection
