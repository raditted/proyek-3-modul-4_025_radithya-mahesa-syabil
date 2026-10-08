<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 { font-size: 1.5rem; margin-bottom: 0.25rem; }
        .subtitle { color: #6b7280; margin-bottom: 1.5rem; font-size: 0.9rem; }
        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        label { display: block; font-size: 0.9rem; font-weight: 600; margin-bottom: 0.3rem; }
        input {
            width: 100%;
            padding: 0.6rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        input:focus { outline: none; border-color: #4f46e5; box-shadow: 0 0 0 2px #e0e7ff; }
        button {
            width: 100%;
            padding: 0.7rem;
            background: #4f46e5;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: 600;
        }
        button:hover { background: #4338ca; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Login</h1>
        <p class="subtitle">Masuk untuk membuka dashboard</p>

        {{-- Tampilkan pesan error kalau ada --}}
        @if ($errors->has('login'))
            <div class="error">{{ $errors->first('login') }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                value="{{ old('username') }}"
                placeholder="Masukkan username"
                required
                autofocus
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>
