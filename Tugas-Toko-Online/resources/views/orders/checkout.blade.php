@extends('layouts.app')

@section('content')
<h2 style="margin-bottom:1rem;font-size:1.1rem">Checkout</h2>

<div style="background:white;border-radius:8px;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,.07);margin-bottom:1rem">
    <h3 style="margin-bottom:.75rem;font-size:1rem;color:#374151">Ringkasan Pesanan</h3>
    @foreach ($cart as $id => $qty)
        @if (isset($products[$id]))
        <div style="display:flex;justify-content:space-between;padding:.4rem 0;border-bottom:1px solid #f1f5f9;font-size:.9rem">
            <span>{{ $products[$id]->nama_barang }} x {{ $qty }}</span>
            <span>Rp {{ number_format($products[$id]->harga * $qty, 0, ',', '.') }}</span>
        </div>
        @endif
    @endforeach
    <div style="display:flex;justify-content:space-between;font-weight:700;margin-top:.75rem">
        <span>Total</span>
        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
    </div>
</div>

<form method="POST" action="/checkout/proses">
    @csrf
    <div style="background:white;border-radius:8px;padding:1.5rem;box-shadow:0 1px 4px rgba(0,0,0,.07)">
        <label style="display:block;font-weight:600;margin-bottom:.4rem">Alamat Pengiriman</label>
        <textarea name="alamat_pengiriman" rows="3" required
            style="width:100%;padding:.6rem .75rem;border:1px solid #d1d5db;border-radius:6px;font-size:.95rem;resize:vertical"
            >{{ Auth::user()->alamat }}</textarea>
        @error('alamat_pengiriman')
            <div style="color:#dc2626;font-size:.85rem;margin-top:.3rem">{{ $message }}</div>
        @enderror

        <button type="submit"
            style="width:100%;margin-top:1rem;padding:.75rem;background:#10b981;color:white;border:none;border-radius:6px;font-size:1rem;font-weight:600;cursor:pointer">
            Konfirmasi Pesanan
        </button>
    </div>
</form>
@endsection
