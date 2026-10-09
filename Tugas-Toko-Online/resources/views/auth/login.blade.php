@extends('layouts.app')

@section('content')
<div style="max-width:400px;margin:0 auto;background:white;padding:2rem;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.1)">
    <h1 style="margin-bottom:.25rem;font-size:1.4rem">Login</h1>
    <p style="color:#6b7280;margin-bottom:1.5rem;font-size:.9rem">Masuk ke akun kamu</p>

    @if ($errors->has('login'))
        <div class="alert alert-error">{{ $errors->first('login') }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <div style="margin-bottom:1rem">
            <label style="display:block;font-weight:600;font-size:.9rem;margin-bottom:.3rem">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required autofocus
                style="width:100%;padding:.6rem .75rem;border:1px solid #d1d5db;border-radius:6px;font-size:1rem">
        </div>
        <div style="margin-bottom:1.5rem">
            <label style="display:block;font-weight:600;font-size:.9rem;margin-bottom:.3rem">Password</label>
            <input type="password" name="password" required
                style="width:100%;padding:.6rem .75rem;border:1px solid #d1d5db;border-radius:6px;font-size:1rem">
        </div>
        <button type="submit"
            style="width:100%;padding:.7rem;background:#4f46e5;color:white;border:none;border-radius:6px;font-size:1rem;font-weight:600;cursor:pointer">
            Masuk
        </button>
    </form>
</div>
@endsection
