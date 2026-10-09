@extends('layouts.app')

@section('content')
<h2 style="margin-bottom:1rem;font-size:1.1rem">Riwayat Pesanan</h2>

@if ($orders->isEmpty())
    <div style="text-align:center;color:#9ca3af;padding:3rem 0">Belum ada pesanan.</div>
@else
    @foreach ($orders as $order)
    <a href="/pesanan/{{ $order->id_order }}" style="text-decoration:none;color:inherit">
        <div style="background:white;border-radius:8px;padding:1rem 1.25rem;margin-bottom:.75rem;box-shadow:0 1px 4px rgba(0,0,0,.06);display:flex;justify-content:space-between;align-items:center">
            <div>
                <div style="font-weight:600;font-size:.95rem">{{ $order->id_order }}</div>
                <div style="color:#6b7280;font-size:.85rem">{{ \Carbon\Carbon::parse($order->tanggal_order)->format('d M Y, H:i') }}</div>
            </div>
            <div style="font-weight:700;color:#1e293b">
                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
            </div>
        </div>
    </a>
    @endforeach
@endif
@endsection
