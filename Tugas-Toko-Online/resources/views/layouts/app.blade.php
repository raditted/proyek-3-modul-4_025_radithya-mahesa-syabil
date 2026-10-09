<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
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
        header h1 { font-size: 1.25rem; margin: 0; color: #111827; }
        header h1 a { text-decoration: none; color: inherit; }
        header .links { display: flex; gap: 1rem; align-items: center; }
        header .links a {
            color: #374151;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
        }
        header .links a:hover { color: #111827; }
        header .links .btn {
            background: #4f46e5;
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
            font-size: 0.9rem;
        }
        header .links .btn:hover { background: #4338ca; color: white; }
        .container { max-width: 900px; margin: 2rem auto; padding: 0 1rem; }
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .alert-success { background: #10b981; color: white; }
        .alert-error   { background: #ef4444; color: white; }
        form.inline { display: inline; }
    </style>
</head>
<body>
    <header>
        <h1><a href="/produk">Toko Online</a></h1>
        <div class="links">
            <a href="/produk">Produk</a>
            @auth
                <a href="/keranjang" class="btn">Keranjang ({{ array_sum(session('cart', [])) }})</a>
                <a href="/pesanan">Pesanan Saya</a>
                <span style="color:#6b7280;font-size:0.9rem">| {{ Auth::user()->nama_lengkap }}</span>
                <form class="inline" method="POST" action="/logout">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:#ef4444;cursor:pointer;font-size:0.95rem;font-weight:600">Logout</button>
                </form>
            @else
                <a href="/login" class="btn">Login</a>
            @endauth
        </div>
    </header>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
