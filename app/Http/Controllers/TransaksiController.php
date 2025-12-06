<?php

namespace App\Http\Controllers;

use App\Models\Donat;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('details.donat')
            ->orderBy('id', 'DESC')
            ->get();

        return view('transaksi.index', compact('transaksi'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('checkout.index', compact('cart'));
    }

    public function prosesCheckout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        // Validasi input checkout
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'metode_pembayaran' => 'required|string|max:50',
            'delivery_method' => 'required|string',

            // alamat wajib hanya jika delivery
            'alamat' => $request->delivery_method == 'delivery' ? 'required|string|max:255' : 'nullable'
        ]);

        // Hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['qty'];
        }

        // Simpan transaksi
       // Generate kode transaksi
        $kode = 'TRX' . time();

        // Hitung total (biar sama logikanya dengan form)
        $totalCalculated = $total;

        $alamat = $request->delivery_method === 'delivery' 
        ? $request->alamat 
        : '-';

        // Simpan transaksi
        $transaksi = Transaksi::create([
            'kode_transaksi' => $kode,
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total' => $totalCalculated,
            'delivery_method' => $request->delivery_method,
            'alamat' => $alamat,
        ]);

        // Simpan detail transaksi
        foreach ($cart as $id => $item) {
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'donat_id' => $id,
                'qty' => $item['qty'],
                'harga' => $item['harga'],
                'subtotal' => $item['harga'] * $item['qty']
            ]);
        }

        // Kosongkan cart
        session()->forget('cart');

        return redirect()->route('donat.index')->with('success', 'Transaksi berhasil! Silakan cetak invoice.');
    }

        public function invoice($id)
    {
        $transaksi = Transaksi::with('details.donat')->findOrFail($id);

        return view('transaksi.invoice', compact('transaksi'));
    }

        public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        DetailTransaksi::where('transaksi_id', $id)->delete();

        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
