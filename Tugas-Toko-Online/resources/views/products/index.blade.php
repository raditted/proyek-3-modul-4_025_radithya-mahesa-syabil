@extends('layouts.app')

@section('content')
<h2 style="margin-bottom:1rem;font-size:1.1rem;color:#374151">Daftar Barang</h2>

<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem">
    @foreach ($products as $p)
    <div style="background:white;border-radius:8px;box-shadow:0 1px 4px rgba(0,0,0,.07);overflow:hidden">
        <div style="width:100%;height:140px;background:#e2e8f0;"></div>
        <div style="padding:.9rem">
            <div style="font-weight:600;margin-bottom:.25rem;font-size:.95rem">{{ $p->nama_barang }}</div>
            <div style="color:#6b7280;font-size:.8rem;margin-bottom:.5rem">{{ Str::limit($p->deskripsi, 50) }}</div>
            <div style="font-weight:700;color:#1e293b;margin-bottom:.25rem">
                Rp {{ number_format($p->harga, 0, ',', '.') }}
            </div>
            <div style="font-size:.8rem;margin-bottom:.75rem;color:{{ $p->stok > 0 ? '#059669' : '#dc2626' }}">
                Stok: {{ $p->stok > 0 ? $p->stok : 'Habis' }}
            </div>

            @if ($p->stok > 0)
                @auth
                    <form method="POST" action="/keranjang/tambah">
                        @csrf
                        <input type="hidden" name="id_barang" value="{{ $p->id_barang }}">
                        <button type="submit"
                            style="width:100%;padding:.45rem;background:#10b981;color:white;border:none;border-radius:5px;cursor:pointer;font-size:.85rem;font-weight:600">
                            Tambah ke Keranjang
                        </button>
                    </form>
                @else
                    <a href="/login"
                        style="display:block;text-align:center;padding:.45rem;background:#e2e8f0;color:#475569;border-radius:5px;font-size:.85rem;text-decoration:none">
                        Login untuk beli
                    </a>
                @endauth
            @else
                <button disabled
                    style="width:100%;padding:.45rem;background:#e2e8f0;color:#9ca3af;border:none;border-radius:5px;font-size:.85rem">
                    Stok Habis
                </button>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection
