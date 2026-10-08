<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // GET /index
    public function index()
    {
        $barang = Barang::all();
        $totalItem = array_sum(session('cart', []));
        return view('index', compact('barang', 'totalItem'));
    }

    // GET /keranjang
    public function keranjang()
    {
        $cart = session('cart', []);
        $ids = array_keys($cart);
        $barang = Barang::whereIn('id', $ids)->get()->keyBy('id');

        $total = 0;
        foreach ($cart as $id => $qty) {
            if (isset($barang[$id])) {
                $total += $barang[$id]->harga * $qty;
            }
        }

        return view('keranjang', compact('cart', 'barang', 'total'));
    }

    // POST /keranjang/tambah
    public function tambah(Request $request)
    {
        $id = $request->id;
        $cart = session('cart', []);
        $cart[$id] = ($cart[$id] ?? 0) + 1;
        session(['cart' => $cart]);
        return back();
    }

    // POST /keranjang/update
    public function update(Request $request)
    {
        $id = $request->id;
        $aksi = $request->aksi;
        $cart = session('cart', []);

        if ($aksi === 'plus') {
            $cart[$id] = ($cart[$id] ?? 0) + 1;
        } else {
            $cart[$id] = ($cart[$id] ?? 1) - 1;
            if ($cart[$id] <= 0) {
                unset($cart[$id]);
            }
        }

        session(['cart' => $cart]);
        return back();
    }

    // POST /keranjang/hapus
    public function hapus(Request $request)
    {
        $id = $request->id;
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return back();
    }

    // POST /keranjang/kosongkan
    public function kosongkan()
    {
        session()->forget('cart');
        return back();
    }
}
