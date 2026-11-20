<x-guest-layout>
    <h2 class="auth-title">Masuk</h2>
    <p class="auth-sub">Masuk untuk mengelola resep.</p>

    @if (session('status'))
        <div class="alert">{{ session('status') }}</div>
    @endif

    <form class="auth-form" method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
        @error('email')<div class="error">{{ $message }}</div>@enderror

        <label for="password">Kata sandi</label>
        <input type="password" id="password" name="password" required autocomplete="current-password">
        @error('password')<div class="error">{{ $message }}</div>@enderror

        <label class="check" for="remember_me">
            <input type="checkbox" id="remember_me" name="remember"> Ingat saya
        </label>

        <button class="btn btn-primary" type="submit">Masuk</button>
    </form>

    <p class="auth-foot">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
</x-guest-layout>
