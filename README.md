# Apple & Co 🍎

**Apple & Co** adalah sistem manajemen donat berbasis **Laravel** yang dirancang untuk kasir atau admin. Sistem ini memudahkan pengelolaan donat, stok, keranjang, checkout, promo, dan cetak invoice.

---

## Fitur

1. **Manajemen Donat**

   * Tambah, edit, hapus donat
   * Upload foto donat
   * Monitoring stok otomatis

2. **Keranjang & Checkout**

   * Tambah donat ke keranjang dengan jumlah (qty)
   * Checkout dengan input nama pelanggan, no HP, metode pembayaran, dan metode pengantaran (pickup/delivery)
   * Promo khusus **Sabtu**: beli 3 donat gratis 1 (hanya berlaku jumlah tepat 3)

3. **Promo & Invoice**

   * Promo otomatis berlaku sesuai ketentuan
   * Cetak invoice, termasuk keterangan donat gratis jika promo aktif
   * Detail transaksi lengkap dengan subtotal dan total

4. **Role Pengguna**

   * Akses untuk kasir/admin
   * Tidak diperuntukkan untuk pembeli langsung

---

## Struktur Folder Penting

* `app/Http/Controllers` → Berisi semua controller (DonatController, CartController, CheckoutController)
* `resources/views/donat` → Halaman untuk manajemen donat
* `resources/views/cart` → Halaman keranjang
* `resources/views/checkout` → Halaman checkout dan invoice

---

## Cara Penggunaan

1. Login sebagai kasir/admin
2. Tambah donat beserta stok dan foto
3. Pilih donat dan masukkan ke keranjang
4. Checkout donat, sistem otomatis menghitung total dan promo (jika berlaku)
5. Cetak invoice sebagai bukti transaksi

---

## Catatan

* Promo hanya berlaku pada hari Sabtu dan untuk jumlah pembelian **tepat 3 donat**.
* Sistem ini dirancang untuk **kasir/admin**, bukan untuk pembeli online.

---
