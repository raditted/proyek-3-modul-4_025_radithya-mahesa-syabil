<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #f3f4f6; min-height: 100vh; }
        header {
            background: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }
        header h1 { font-size: 1.25rem; }
        form button {
            padding: 0.5rem 1.25rem;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
        }
        form button:hover { background: #dc2626; }
        .content {
            max-width: 600px;
            margin: 2rem auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .content p { margin-bottom: 0.5rem; color: #374151; line-height: 1.6; }
        .content .username { font-weight: 600; color: #4f46e5; }
    </style>
</head>
<body>
    <header>
        <h1>Dashboard</h1>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </header>

    <div class="content">
        <p>Selamat datang, <span class="username">{{ Auth::user()->nama_lengkap }}!</span></p>
        <p>Halaman ini hanya bisa dibuka setelah login.</p>
        <p>Username: {{ Auth::user()->username }}</p>
        <p>Role: {{ Auth::user()->role }}</p>

        @if (session('status'))
            <p>{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <h3>Role Management</h3>
        @foreach (\App\Models\User::all() as $u)
            <form method="POST" action="/admin/users/{{ $u->id }}/role">
                @csrf
                @method('PATCH')
                <span>{{ $u->username }} ({{ $u->role }}):</span>
                <select name="role">
                    <option value="customer" {{ $u->role === 'customer' ? 'selected' : '' }}>customer</option>
                    <option value="staff" {{ $u->role === 'staff' ? 'selected' : '' }}>staff</option>
                    <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>admin</option>
                </select>
                <button type="submit">Ubah</button>
            </form>
        @endforeach
    </div>
</body>
</html>
