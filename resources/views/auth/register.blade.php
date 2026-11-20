<x-guest-layout>
    <h2 class="auth-title">Daftar</h2>
    <p class="auth-sub">Buat akun untuk mengelola resep.</p>

    <form class="auth-form" method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name">Nama</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
        @error('name')<div class="error">{{ $message }}</div>@enderror

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username">
        @error('email')<div class="error">{{ $message }}</div>@enderror

        <label for="password">Kata sandi</label>
        <input type="password" id="password" name="password" required autocomplete="new-password">
        @error('password')<div class="error">{{ $message }}</div>@enderror

        <label for="password_confirmation">Ulangi kata sandi</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
        @error('password_confirmation')<div class="error">{{ $message }}</div>@enderror

        <button class="btn btn-primary" type="submit">Daftar</button>
    </form>

    <p class="auth-foot">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
</x-guest-layout>
