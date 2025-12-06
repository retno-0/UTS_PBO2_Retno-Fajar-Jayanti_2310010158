<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Donat;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index()
    {
        $donat = Donat::all();
        $cart = session('cart', []);
        return view('checkout.index', compact('donat', 'cart'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:191',
            'no_hp' => 'required|string|max:30',
            'metode_pembayaran' => 'required|string',
            'donat_id' => 'required|array|min:1',
            'qty' => 'required|array',
            'total' => 'required|numeric',
            'delivery_method' => 'required|string|in:pickup,delivery',
            'alamat' => 'required_if:delivery_method,delivery|max:255',
        ]);

        $donatIds = $request->input('donat_id', []);
        $qtys = $request->input('qty', []);

        if (count($donatIds) !== count($qtys)) {
            return back()->with('error', 'Data produk tidak valid.');
        }

        $donats = Donat::whereIn('id', $donatIds)->get()->keyBy('id');

        $hariIni = Carbon::now()->format('l'); // "Saturday" = promo hari Sabtu
        $isPromoDay = $hariIni === 'Saturday';

        DB::beginTransaction();
        try {
            $totalCalculated = 0;
            $totalQty = 0;

            foreach ($donatIds as $index => $id) {
                $id = (int) $id;
                $qty = (int) $qtys[$index];

                if (!isset($donats[$id])) {
                    throw new \Exception("Donat dengan ID {$id} tidak ditemukan.");
                }

                $don = $donats[$id];

                if ($don->stok < $qty) {
                    throw new \Exception("Stok untuk '{$don->nama}' tidak cukup. (tersisa: {$don->stok})");
                }

                $subtotal = $don->harga * $qty;
                $totalCalculated += $subtotal;
                $totalQty += $qty;
            }

            if ((int) $request->input('total') !== (int) $totalCalculated) {
                throw new \Exception("Total tidak sesuai. Perbarui halaman dan coba lagi.");
            }

            $promoGratis = $isPromoDay ? intdiv($totalQty, 3) : 0;

            $kode = 'TRX-' . now()->format('YmdHis') . '-' . rand(100, 999);

            $transaksi = Transaksi::create([
                'kode_transaksi' => $kode,
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_hp' => $request->no_hp,
                'metode_pembayaran' => $request->metode_pembayaran,
                'total' => $totalCalculated,
                'delivery_method' => $request->delivery_method,
                'alamat' => $request->delivery_method == 'delivery' ? $request->alamat : null,
            ]);

            foreach ($donatIds as $index => $id) {
                $id = (int) $id;
                $qty = (int) $qtys[$index];
                $don = $donats[$id];

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'donat_id' => $id,
                    'qty' => $qty,
                    'harga' => $don->harga,
                    'subtotal' => $don->harga * $qty,
                ]);

                Donat::where('id', $id)->decrement('stok', $qty);
            }

            DB::commit();

            return redirect()->route('transaksi.show', $transaksi->id)
                             ->with('success', "Transaksi berhasil dibuat. Promo gratis: $promoGratis donat")
                             ->with('promoGratis', $promoGratis);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
