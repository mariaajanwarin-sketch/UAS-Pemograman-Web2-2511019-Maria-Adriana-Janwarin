<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Katalog Resep') }}</title>
    <link rel="stylesheet" href="{{ asset('css/katalog.css') }}">
    <style>
        :root{
            --bg:#f3f5ef; --surface:#fff; --ink:#18261f; --muted:#5f6f66; --line:#dfe5da;
            --green:#1d5c42; --green-dark:#13412e; --green-soft:#e3efe6;
            --gold:#f0a30a; --gold-soft:#fff1cf; --chili:#c2392b; --radius:18px;
            --font-body:'Plus Jakarta Sans','Inter',system-ui,sans-serif;
            --font-display:'Fraunces',Georgia,serif;
        }
        body.auth-body{margin:0;background:#fff;color:var(--ink);font-family:var(--font-body)}
        .auth-layout{display:grid;grid-template-columns:1.05fr 1fr;min-height:100vh}

        /* Panel kiri */
        .auth-side{
            position:relative;display:flex;flex-direction:column;justify-content:space-between;gap:2rem;
            padding:3rem 3.5rem;color:#fff;overflow:hidden;
            background:
                radial-gradient(circle at 12% 8%, rgba(240,163,10,.22), transparent 38%),
                var(--green-dark);
        }
        .auth-logo{display:flex;align-items:center;gap:.65rem;font-family:var(--font-display);font-weight:700;font-size:1.6rem;color:#fff}
        .auth-logo::before{content:"";width:14px;height:14px;border-radius:50%;background:var(--gold);box-shadow:0 0 0 4px rgba(240,163,10,.28)}
        .auth-hero h2{font-family:var(--font-display);font-size:2.7rem;line-height:1.12;font-weight:700;margin:0 0 1rem;max-width:15ch}
        .auth-hero p{margin:0;font-size:1.05rem;line-height:1.7;color:#cfe3d6;max-width:40ch}
        .auth-tiles{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;max-width:420px}
        .auth-tiles span{
            aspect-ratio:1;border-radius:22px;display:flex;align-items:center;justify-content:center;
            font-size:2.8rem;box-shadow:0 14px 24px -14px rgba(0,0,0,.5)
        }
        .auth-tiles span:nth-child(3n+1){background:linear-gradient(135deg,#cfe4d3,#e7f0dc)}
        .auth-tiles span:nth-child(3n+2){background:linear-gradient(135deg,#fbe3a6,#fff1cf);transform:translateY(14px)}
        .auth-tiles span:nth-child(3n+3){background:linear-gradient(135deg,#f4c9bd,#fbe4da)}

        /* Panel kanan */
        .auth-main{display:flex;align-items:center;justify-content:center;padding:3rem 1.5rem;background:var(--bg)}
        .auth-box{width:100%;max-width:430px;background:var(--surface);border-radius:24px;padding:2.6rem 2.5rem 2.3rem;
            box-shadow:0 1px 2px rgba(24,38,31,.06),0 24px 48px -24px rgba(24,38,31,.3)}
        .auth-brand-m{display:none}
        .auth-back{display:inline-block;margin-bottom:1.6rem;font-size:.9rem;font-weight:600;color:var(--muted)}
        .auth-back:hover{color:var(--green)}
        .auth-title{font-family:var(--font-display);font-size:2.2rem;line-height:1.1;font-weight:700;margin:0 0 .4rem}
        .auth-sub{margin:0 0 1.5rem;color:var(--muted)}

        .auth-form label{display:block;font-size:.88rem;font-weight:600;margin:1.15rem 0 .45rem}
        .auth-form input[type=email],.auth-form input[type=password],.auth-form input[type=text]{
            display:block;width:100%;padding:.95rem 1.15rem;border:1.5px solid var(--line);border-radius:14px;
            background:#fff;font:inherit;color:var(--ink);transition:border-color .15s,box-shadow .15s
        }
        .auth-form input:focus{outline:none;border-color:var(--green);box-shadow:0 0 0 4px rgba(29,92,66,.14)}
        .auth-form .check{display:flex;align-items:center;gap:.6rem;margin:1.2rem 0 0;font-weight:500;color:var(--muted);cursor:pointer}
        .auth-form .check input{width:18px;height:18px;margin:0;accent-color:var(--green)}
        .auth-form .btn{display:flex;width:100%;margin-top:1.7rem;padding:1rem 1.6rem}
        .auth-form .error{color:var(--chili);font-size:.85rem;font-weight:500;margin-top:.4rem}
        .auth-box .alert{background:var(--green-soft);border:1px solid #b7d6c0;color:var(--green-dark);padding:.8rem 1rem;border-radius:12px;margin-bottom:1rem;font-weight:500}
        .auth-foot{margin:1.7rem 0 0;text-align:center;color:var(--muted);font-size:.95rem}
        .auth-foot a{color:var(--green);font-weight:700}
        .auth-foot a:hover{text-decoration:underline}

        @media (max-width:900px){
            .auth-layout{grid-template-columns:1fr}
            .auth-side{display:none}
            .auth-main{min-height:100vh;padding:2rem 1rem}
            .auth-brand-m{display:flex;align-items:center;gap:.6rem;font-family:var(--font-display);font-weight:700;font-size:1.4rem;color:var(--green);margin-bottom:1.2rem}
            .auth-brand-m::before{content:"";width:12px;height:12px;border-radius:50%;background:var(--gold);box-shadow:0 0 0 4px var(--gold-soft)}
            .auth-box{padding:2rem 1.6rem}
        }
    </style>
</head>
<body class="auth-body">
<div class="auth-layout">
    <aside class="auth-side">
        <a class="auth-logo" href="{{ route('recipes.index') }}">Katalog Resep</a>

        <div class="auth-hero">
            <h2>Semua resep favorit, rapi dalam satu tempat.</h2>
            <p>Tambah, ubah, dan kelola koleksi resep makanan Anda dengan mudah.</p>
        </div>

        <div class="auth-tiles" aria-hidden="true">
            <span>🍛</span><span>🍲</span><span>🍢</span>
            <span>🥗</span><span>🥤</span><span>🍧</span>
        </div>
    </aside>

    <main class="auth-main">
        <div class="auth-box">
            <a class="auth-brand-m" href="{{ route('recipes.index') }}">Katalog Resep</a>
            <a class="auth-back" href="{{ route('recipes.index') }}">Kembali ke beranda</a>
            {{ $slot }}
        </div>
    </main>
</div>
</body>
</html>
