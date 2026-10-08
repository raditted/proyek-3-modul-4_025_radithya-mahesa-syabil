<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #f3f4f6; }
        header {
            background: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }
        header h1 { font-size: 1.25rem; }
        header a {
            color: #4f46e5;
            text-decoration: none;
            font-size: 0.9rem;
        }
        header a:hover { text-decoration: underline; }
        .container { max-width: 700px; margin: 2rem auto; padding: 0 1rem; }
        h2 { margin-bottom: 1rem; font-size: 1.1rem; color: #374151; }
        .empty { text-align: center; color: #9ca3af; padding: 3rem 0; }
        .card {
            background: white;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            margin-bottom: 0.75rem;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }
        .card .nama { font-weight: 600; margin-bottom: 0.5rem; }
        .card .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .card .subtotal { color: #374151; }
        .card .actions { display: flex; align-items: center; gap: 0.4rem; }
        .btn {
            border: none;
            padding: 0.35rem 0.75rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .btn-qty   { background: #e5e7eb; color: #374151; }
        .btn-qty:hover { background: #d1d5db; }
        .btn-hapus { background: #f01414; color: white; }
        .btn-hapus:hover { background: #fecaca; }
        .qty { min-width: 2rem; text-align: center; font-weight: 600; }
        .divider { border: none; border-top: 1px solid #e5e7eb; margin: 1rem 0; }
        .total-row {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }
        .btn-kosongkan {
            width: 100%;
            padding: 0.7rem;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
        }
        .btn-kosongkan:hover { background: #dc2626; }
    </style>
</head>
<body>
    <header>
        <h1>Keranjang Belanja</h1>
        <a href="/index">Lanjut Belanja</a>
    </header>

    <div class="container">
        <h2>Keranjang Belanja Tanpa Login</h2>

        @if (empty($cart))
            <div class="empty">
                <p>Keranjang masih kosong.</p>
            </div>
        @else
            @foreach ($cart as $id => $qty)
                @if (isset($barang[$id]))
                <div class="card">
                    <div class="nama">{{ $barang[$id]->nama }}</div>
                    <div class="row">
                        <div class="subtotal">
                            Rp {{ number_format($barang[$id]->harga, 0, ',', '.') }}
                            x {{ $qty }} =
                            Rp {{ number_format($barang[$id]->harga * $qty, 0, ',', '.') }}
                        </div>
                        <div class="actions">
                            {{-- Tombol minus --}}
                            <form method="POST" action="/keranjang/update">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="aksi" value="minus">
                                <button class="btn btn-qty" type="submit">−</button>
                            </form>

                            <span class="qty">{{ $qty }}</span>

                            {{-- Tombol plus --}}
                            <form method="POST" action="/keranjang/update">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="aksi" value="plus">
                                <button class="btn btn-qty" type="submit">+</button>
                            </form>

                            {{-- Tombol hapus --}}
                            <form method="POST" action="/keranjang/hapus">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button class="btn btn-hapus" type="submit">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach

            <hr class="divider">

            <div class="total-row">
                <span>Total</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <form method="POST" action="/keranjang/kosongkan">
                @csrf
                <button class="btn-kosongkan" type="submit">Kosongkan Keranjang</button>
            </form>
        @endif
    </div>
</body>
</html>
