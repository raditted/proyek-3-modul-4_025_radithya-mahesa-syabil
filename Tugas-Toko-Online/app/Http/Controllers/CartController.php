<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart    = session('cart', []);
        $ids     = array_keys($cart);
        $products = Product::whereIn('id_barang', $ids)->get()->keyBy('id_barang');
        $total   = 0;
        foreach ($cart as $id => $qty) {
            if (isset($products[$id])) {
                $total += $products[$id]->harga * $qty;
            }
        }
        return view('cart.index', compact('cart', 'products', 'total'));
    }

    public function tambah(Request $request)
    {
        $id      = $request->id_barang;
        $product = Product::findOrFail($id);
        $cart    = session('cart', []);
        $qtyBaru = ($cart[$id] ?? 0) + 1;

        if ($qtyBaru > $product->stok) {
            return back()->with('error', 'Jumlah melebihi stok tersedia.');
        }

        $cart[$id] = $qtyBaru;
        session(['cart' => $cart]);
        return back()->with('success', $product->nama_barang . ' ditambahkan ke keranjang.');
    }

    public function update(Request $request)
    {
        $id      = $request->id_barang;
        $aksi    = $request->aksi;
        $product = Product::findOrFail($id);
        $cart    = session('cart', []);

        if ($aksi === 'plus') {
            $baru = ($cart[$id] ?? 0) + 1;
            if ($baru > $product->stok) {
                return back()->with('error', 'Jumlah melebihi stok tersedia.');
            }
            $cart[$id] = $baru;
        } else {
            $cart[$id] = ($cart[$id] ?? 1) - 1;
            if ($cart[$id] <= 0) {
                unset($cart[$id]);
            }
        }

        session(['cart' => $cart]);
        return back();
    }

    public function hapus(Request $request)
    {
        $cart = session('cart', []);
        unset($cart[$request->id_barang]);
        session(['cart' => $cart]);
        return back();
    }

    public function kosongkan()
    {
        session()->forget('cart');
        return back();
    }
}
