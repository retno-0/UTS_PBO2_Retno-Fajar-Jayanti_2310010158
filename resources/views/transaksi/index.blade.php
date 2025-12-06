@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Daftar Transaksi</h2>

    @if($transaksi->isEmpty())
        <p>Belum ada transaksi.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $t)
                <tr>
                    <td>{{ $t->kode_transaksi }}</td>
                    <td>{{ $t->nama_pelanggan }}</td>
                    <td>Rp {{ number_format($t->total,0,',','.') }}</td>
                    <td>{{ $t->created_at }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('transaksi.invoice', $t->id) }}" class="btn btn-primary btn-sm">
                            Cetak Invoice
                        </a>

                        <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
