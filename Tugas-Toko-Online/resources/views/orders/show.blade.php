@extends('layouts.app')

@section('content')
<a href="/pesanan" style="color:#4f46e5;font-size:.9rem;text-decoration:none">← Kembali ke Riwayat</a>

<h2 style="margin:1rem 0 .5rem;font-size:1.1rem">Detail Pesanan</h2>

<div style="background:white;border-radius:8px;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.07);margin-bottom:1rem">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:.4rem;font-size:.9rem">
        <div style="color:#6b7280">ID Pesanan</div>    <div style="font-weight:600">{{ $order->id_order }}</div>
        <div style="color:#6b7280">Tanggal</div>       <div>{{ \Carbon\Carbon::parse($order->tanggal_order)->format('d M Y, H:i') }}</div>
        <div style="color:#6b7280">Alamat Kirim</div>  <div>{{ $order->alamat_pengiriman }}</div>
    </div>
</div>

<div style="background:white;border-radius:8px;padding:1.25rem;box-shadow:0 1px 4px rgba(0,0,0,.07)">
    <h3 style="margin-bottom:.75rem;font-size:1rem">Barang yang Dibeli</h3>
    @foreach ($order->details as $detail)
    <div style="display:flex;justify-content:space-between;padding:.5rem 0;border-bottom:1px solid #f1f5f9;font-size:.9rem">
        <span>{{ $detail->product->nama_barang ?? '-' }} x {{ $detail->jumlah_beli }}</span>
        <span>Rp {{ number_format($detail->harga_satuan * $detail->jumlah_beli, 0, ',', '.') }}</span>
    </div>
    @endforeach
    <div style="display:flex;justify-content:space-between;font-weight:700;margin-top:.75rem">
        <span>Total</span>
        <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
    </div>
</div>
@endsection
