<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect('/keranjang')->with('error', 'Keranjang kosong.');
        }

        $ids      = array_keys($cart);
        $products = Product::whereIn('id_barang', $ids)->get()->keyBy('id_barang');
        $total    = 0;
        foreach ($cart as $id => $qty) {
            if (isset($products[$id])) {
                $total += $products[$id]->harga * $qty;
            }
        }

        return view('orders.checkout', compact('cart', 'products', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required|string|min:5',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect('/keranjang')->with('error', 'Keranjang kosong.');
        }

        $ids      = array_keys($cart);
        $products = Product::whereIn('id_barang', $ids)->get()->keyBy('id_barang');

        $total = 0;
        foreach ($cart as $id => $qty) {
            if (isset($products[$id])) {
                $total += $products[$id]->harga * $qty;
            }
        }

        DB::transaction(function () use ($cart, $products, $total, $request) {
            $idOrder = 'ORD' . date('ymdHis');

            Order::create([
                'id_order'           => $idOrder,
                'id_user'            => Auth::id(),
                'tanggal_order'      => now(),
                'total_harga'        => $total,
                'alamat_pengiriman'  => $request->alamat_pengiriman,
            ]);

            foreach ($cart as $id => $qty) {
                if (!isset($products[$id])) continue;

                OrderDetail::create([
                    'id_order'    => $idOrder,
                    'id_barang'   => $id,
                    'harga_satuan'=> $products[$id]->harga,
                    'jumlah_beli' => $qty,
                ]);

                $products[$id]->decrement('stok', $qty);
            }

            session()->forget('cart');
        });

        return redirect('/pesanan')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function index()
    {
        $orders = Order::where('id_user', Auth::id())
                       ->orderBy('tanggal_order', 'desc')
                       ->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('id_order', $id)
                      ->where('id_user', Auth::id())
                      ->with('details.product')
                      ->firstOrFail();
        return view('orders.show', compact('order'));
    }
}
