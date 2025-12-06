<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donat;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class CartController extends Controller
{
    // Tampilkan cart
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Tambah donat ke cart
    public function add(Request $request, $id)
    {
        $donat = Donat::findOrFail($id);
        $cart = session()->get('cart', []);
        $qty = $request->input('qty', 1);

        if(isset($cart[$id])) {
            $cart[$id]['qty'] += $qty;
        } else {
            $cart[$id] = [
                'nama' => $donat->nama,
                'harga' => $donat->harga,
                'qty' => $qty
            ];
        }

        // Kurangi stok saat masuk cart
        if($donat->stok >= $qty){
            $donat->decrement('stok', $qty);
        } else {
            return redirect()->back()->with('error', 'Stok tidak cukup!');
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Donat berhasil ditambahkan ke keranjang!');
    }

    // Hapus item dari cart
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            // Tambah stok kembali saat item dihapus dari cart
            $donat = Donat::find($id);
            if($donat){
                $donat->increment('stok', $cart[$id]['qty']);
            }

            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    // Checkout
    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('checkout.index', compact('cart'));
    }

    // Proses checkout
    public function prosesCheckout(Request $request)
    {
        $cart = session()->get('cart', []);
        if(!$cart) return redirect()->back()->with('error', 'Keranjang kosong!');

        $total = 0;
        $totalQty = array_sum(array_column($cart, 'qty'));

        $promoGratis = false;
        if ($totalQty == 3 && date('N') == 6) { // Hari Sabtu
            $promoGratis = true;
        }

        // Hitung total harga
        foreach($cart as $item){
            $total += $item['harga'] * $item['qty'];
        }

        $transaksi = Transaksi::create([
            'kode_transaksi' => 'TRX' . time(),
            'nama_pelanggan' => $request->input('nama_pelanggan', 'Guest'),
            'no_hp' => $request->input('no_hp', '-'),
            'metode_pembayaran' => $request->input('metode_pembayaran', 'Cash'),
            'total' => $total
        ]);

        foreach($cart as $id => $item) {
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'donat_id' => $id,
                'qty' => $item['qty'],
                'harga' => $item['harga'],
                'subtotal' => $item['qty'] * $item['harga']
            ]);
        }

        // Tambahkan donat gratis jika promo berlaku
        if($promoGratis){
            // Ambil donat yang paling murah sebagai gratis
            $minDonatId = array_search(min(array_column($cart, 'harga')), array_column($cart, 'harga'));
            $freeDonatId = array_keys($cart)[$minDonatId] ?? null;

            if($freeDonatId){
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'donat_id' => $freeDonatId,
                    'qty' => 1,
                    'harga' => 0,
                    'subtotal' => 0
                ]);
            }
        }

        session()->forget('cart');
        return redirect()->route('transaksi.invoice', $transaksi->id)->with('success', 'Transaksi berhasil! Promo ' . ($promoGratis ? 'berhasil diterapkan' : 'tidak berlaku'));
    }
}
