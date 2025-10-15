<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <style>
        :root{
            --bg:#0b0d12; --panel:#12141b; --muted:#8b93a7; --border:#262a33;
            --input:#1a1e27; --white:#e5e7eb; --primary:#5c8df6; --primary-press:#4c7aed;
        }
        *{box-sizing:border-box}
        body{margin:0; font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,"Apple Color Emoji","Segoe UI Emoji"; background:var(--bg); color:var(--white)}
        .screen{min-height:100vh; display:flex}
        .visual{flex:1 1 55%; background:
            radial-gradient(60% 60% at 30% 30%, #192036 0%, rgba(11,13,18,0) 70%),
            radial-gradient(50% 50% at 70% 70%, #111931 0%, rgba(11,13,18,0) 70%),
            linear-gradient(120deg, #0b0d12 0%, #0d1016 100%);
            position:relative;
        }
        .visual::after{content:""; position:absolute; inset:27% 17% 27% 17%; border-radius:24px; box-shadow:0 40px 120px rgba(74,118,255,0.25) inset, 0 10px 30px rgba(0,0,0,0.4);
            background-image: linear-gradient(180deg, rgba(86,115,255,0.15), rgba(86,115,255,0)), url('/images/ai-travel-hero.jpg'), url('/images/ai-travel-hero.png'), url('/images/travel-hero.jpg'), url('/images/travel-hero.png');
            background-size: cover, contain, contain, contain, contain;
            background-position: center, center, center, center, center;
        }
        .panel{flex:1 1 45%; display:flex; align-items:center; justify-content:center; padding:6vh 4vw}
        .card{width:100%; max-width:520px; background:var(--panel); border:1px solid var(--border); border-radius:16px; padding:32px 28px; box-shadow:0 20px 60px rgba(0,0,0,0.35)}
        .title{font-size:32px; font-weight:700; margin:0 0 8px}
        .subtitle{color:var(--muted); font-size:14px; line-height:1.5; margin-bottom:24px}
        .form{display:flex; flex-direction:column; gap:18px}
        .field label{display:block; font-weight:600; margin-bottom:8px}
        .input{width:100%; padding:12px 14px; border:1px solid var(--border); background:var(--input); border-radius:10px; color:var(--white)}
        .input::placeholder{color:#9aa3b2}
        .actions{display:flex; flex-direction:column; gap:12px}
        .btn{width:100%; padding:12px 14px; border:none; border-radius:10px; background:var(--primary); color:#fff; font-weight:700; cursor:pointer}
        .btn:active{background:var(--primary-press)}
        .alt{color:var(--muted); font-size:14px; text-align:right}
        .alt a{color:#99b2ff; text-decoration:none}
        .error{color:#fb7185; font-size:13px; margin-top:6px}
        .flash{background:#0f172a; border:1px solid #334155; color:#cbd5e1; padding:10px 12px; border-radius:8px; margin-bottom:16px}
    </style>
    </head>
<body>
    <div class="screen">
        <div class="visual"></div>
        <div class="panel">
            <div class="card">
                <h1 class="title">Masuk</h1>
                <p class="subtitle">Silakan masuk untuk melanjutkan ke Smart Travel System.</p>
                @if(session('status'))
                    <div class="flash">{{ session('status') }}</div>
                @endif
                @if ($errors->any())
                    <div class="error">{{ $errors->first() }}</div>
                @endif
                <form class="form" method="POST" action="{{ url('/login') }}">
                    @csrf
                    <div class="field">
                        <label for="email">E-mail</label>
                        <input class="input" type="email" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required autocomplete="username">
                    </div>
                    <div class="field">
                        <label for="password">Kata Sandi</label>
                        <input class="input" type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
                    </div>
                    <div class="actions">
                        <button class="btn" type="submit">Masuk</button>
                        <div class="alt">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
    </html>