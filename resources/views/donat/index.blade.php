@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Donat</h3>
    <a href="{{ route('donat.create') }}" class="btn btn-primary">+ Tambah Donat</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($donat as $d)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama }}</td>
            <td>Rp {{ number_format($d->harga) }}</td>
            <td>{{ $d->stok }}</td>
            <td>
                @if($d->foto)
                <img src="{{ asset('uploads/donat/'.$d->foto) }}" width="100" alt="{{ $d->nama }}">
                @endif
            </td>
            <td>
                {{-- Tambah ke Cart --}}
                <form action="{{ route('cart.add', $d->id) }}" method="POST" style="display:inline-block">
                    @csrf
                    <input type="number" name="qty" value="1" min="1" max="{{ $d->stok }}" 
                        class="form-control mb-1" style="width:70px;display:inline-block">
                    <button class="btn btn-success btn-sm">Tambah ke Cart</button>
                </form>

                {{-- Edit --}}
                <a href="{{ route('donat.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>

                {{-- Hapus --}}
                <form action="{{ route('donat.delete', $d->id) }}" method="POST" style="display:inline-block;" 
                    onsubmit="return confirm('Hapus item ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection