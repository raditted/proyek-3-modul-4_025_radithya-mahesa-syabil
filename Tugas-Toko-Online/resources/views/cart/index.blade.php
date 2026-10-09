@extends('layouts.app')

@section('content')
<h2 style="margin-bottom:1rem;font-size:1.1rem">Keranjang Belanja</h2>

@if (empty($cart))
    <div style="text-align:center;color:#9ca3af;padding:3rem 0">
        <p>Keranjang kosong. <a href="/produk" style="color:#4f46e5">Belanja sekarang</a></p>
    </div>
@else
    @foreach ($cart as $id => $qty)
        @if (isset($products[$id]))
        @php $p = $products[$id]; @endphp
        <div style="background:white;border-radius:8px;padding:1rem 1.25rem;margin-bottom:.75rem;box-shadow:0 1px 4px rgba(0,0,0,.06);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:.75rem">
            <div>
                <div style="font-weight:600">{{ $p->nama_barang }}</div>
                <div style="color:#6b7280;font-size:.9rem">
                    Rp {{ number_format($p->harga, 0, ',', '.') }} x {{ $qty }} =
                    <strong>Rp {{ number_format($p->harga * $qty, 0, ',', '.') }}</strong>
                </div>
            </div>
            <div style="display:flex;align-items:center;gap:.4rem">
                <form method="POST" action="/keranjang/update">
                    @csrf
                    <input type="hidden" name="id_barang" value="{{ $id }}">
                    <input type="hidden" name="aksi" value="minus">
                    <button style="background:#e5e7eb;border:none;padding:.3rem .7rem;border-radius:5px;cursor:pointer;font-weight:700">−</button>
                </form>
                <span style="min-width:2rem;text-align:center;font-weight:700">{{ $qty }}</span>
                <form method="POST" action="/keranjang/update">
                    @csrf
                    <input type="hidden" name="id_barang" value="{{ $id }}">
                    <input type="hidden" name="aksi" value="plus">
                    <button style="background:#e5e7eb;border:none;padding:.3rem .7rem;border-radius:5px;cursor:pointer;font-weight:700">+</button>
                </form>
                <form method="POST" action="/keranjang/hapus">
                    @csrf
                    <input type="hidden" name="id_barang" value="{{ $id }}">
                    <button style="background:#fee2e2;color:#b91c1c;border:none;padding:.3rem .75rem;border-radius:5px;cursor:pointer">Hapus</button>
                </form>
            </div>
        </div>
        @endif
    @endforeach

    <hr style="border:none;border-top:1px solid #e5e7eb;margin:1.25rem 0">
    <div style="display:flex;justify-content:space-between;font-weight:700;font-size:1.1rem;margin-bottom:1rem">
        <span>Total</span>
        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
    </div>

    <div style="display:flex;gap:.75rem;flex-wrap:wrap">
        <a href="/checkout"
            style="flex:1;text-align:center;padding:.7rem;background:#10b981;color:white;border-radius:6px;text-decoration:none;font-weight:600">
            Checkout
        </a>
        <form method="POST" action="/keranjang/kosongkan" style="flex:1">
            @csrf
            <button type="submit"
                style="width:100%;padding:.7rem;background:#ef4444;color:white;border:none;border-radius:6px;cursor:pointer;font-weight:600">
                Kosongkan Keranjang
            </button>
        </form>
    </div>
@endif
@endsection
