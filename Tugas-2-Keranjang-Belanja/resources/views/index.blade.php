<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Alat Tulis</title>
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
            background: #4f46e5;
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }
        header a:hover { background: #4338ca; }
        .container { max-width: 700px; margin: 2rem auto; padding: 0 1rem; }
        h2 { margin-bottom: 1rem; font-size: 1.1rem; color: #374151; }
        .card {
            background: white;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            margin-bottom: 0.75rem;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card .info .nama { font-weight: 600; margin-bottom: 0.2rem; }
        .card .info .harga { color: #6b7280; font-size: 0.9rem; }
        .card form button {
            background: #10b981;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .card form button:hover { background: #059669; }
    </style>
</head>
<body>
    <header>
        <h1>Toko Alat Tulis</h1>
        <a href="/keranjang">Keranjang ({{ $totalItem }})</a>
    </header>

    <div class="container">
        <h2>Daftar Barang</h2>

        @foreach ($barang as $item)
        <div class="card">
            <div class="info">
                <div class="nama">{{ $item->nama }}</div>
                <div class="harga">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
            </div>
            <form method="POST" action="/keranjang/tambah">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <button type="submit">Masukkan ke keranjang</button>
            </form>
        </div>
        @endforeach
    </div>
</body>
</html>
