<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertanyaan Awal – Preferensi Liburan</title>
    <style>
        :root{ --bg:#0b0d12; --panel:#12141b; --muted:#8b93a7; --border:#262a33; --input:#1a1e27; --white:#e5e7eb; --primary:#5c8df6; --primary-press:#4c7aed; }
        *{box-sizing:border-box}
        body{margin:0; font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,"Apple Color Emoji","Segoe UI Emoji"; background:var(--bg); color:var(--white)}
        .screen{min-height:100vh; display:flex; align-items:center; justify-content:center; padding:6vh 4vw}
        .panel{width:100%; display:flex; align-items:center; justify-content:center}
        .card{width:100%; max-width:640px; background:var(--panel); border:1px solid var(--border); border-radius:16px; padding:28px; box-shadow:0 20px 60px rgba(0,0,0,0.35)}
        .title{font-size:28px; font-weight:700; margin:0 0 8px}
        .subtitle{color:var(--muted); font-size:14px; line-height:1.5; margin-bottom:20px}
        .form{display:flex; flex-direction:column; gap:16px}
        .field label{display:block; font-weight:600; margin-bottom:8px}
        .input, select{width:100%; padding:12px 14px; border:1px solid var(--border); background:var(--input); border-radius:10px; color:var(--white)}
        .input::placeholder{color:#9aa3b2}
        .row{display:grid; grid-template-columns:1fr 1fr; gap:16px}
        .checkboxes{display:flex; flex-wrap:wrap; gap:10px}
        .checkboxes label{display:flex; align-items:center; gap:8px; background:#0f1320; border:1px solid var(--border); padding:8px 10px; border-radius:10px}
        .actions{display:flex; flex-direction:column; gap:12px; margin-top:8px}
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
        <div class="panel">
            <div class="card">
                <h1 class="title">Preferensi Liburan</h1>
                <p class="subtitle">Jawab beberapa pertanyaan agar kami dapat memberi rekomendasi tujuan dan rencana perjalanan yang sesuai.</p>

                @if(session('status'))
                    <div class="flash">{{ session('status') }}</div>
                @endif

                <form class="form" method="POST" action="{{ route('preferensi.store') }}">
                    @csrf
                    <div class="field">
                        <label for="lokasi_tujuan">Lokasi Tujuan</label>
                        <input class="input" type="text" id="lokasi_tujuan" name="lokasi_tujuan" list="lokasiOps" placeholder="Misal: Bali, Tokyo, Singapura" value="{{ old('lokasi_tujuan') }}" required>
                        <datalist id="lokasiOps">
                            <option value="Bali"></option>
                            <option value="Yogyakarta"></option>
                            <option value="Labuan Bajo"></option>
                            <option value="Tokyo"></option>
                            <option value="Singapura"></option>
                            <option value="Bangkok"></option>
                        </datalist>
                        @error('lokasi_tujuan')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="field">
                            <label for="budget_maksimum">Budget Maksimum (Rp)</label>
                            <input class="input" type="number" id="budget_maksimum" name="budget_maksimum" min="0" step="100000" placeholder="Contoh: 5000000" value="{{ old('budget_maksimum') }}" required>
                            @error('budget_maksimum')<div class="error">{{ $message }}</div>@enderror
                        </div>
                        <div class="field">
                            <label for="durasi_liburan_hari">Durasi Liburan (hari)</label>
                            <input class="input" type="number" id="durasi_liburan_hari" name="durasi_liburan_hari" min="1" max="30" step="1" placeholder="Contoh: 5" value="{{ old('durasi_liburan_hari') }}" required>
                            @error('durasi_liburan_hari')<div class="error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="field">
                        <label for="jenis_liburan">Jenis Liburan</label>
                        <select id="jenis_liburan" name="jenis_liburan" class="input" required>
                            <option value="" disabled selected>Pilih jenis liburan</option>
                            @php $ops = ['pantai'=>'Pantai','gunung'=>'Gunung','kota'=>'Kota','budaya'=>'Budaya','alam'=>'Alam','kuliner'=>'Kuliner']; @endphp
                            @foreach($ops as $k=>$v)
                                <option value="{{ $k }}" {{ old('jenis_liburan')===$k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                        @error('jenis_liburan')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label>Aktivitas Favorit</label>
                        @php $acts = ['kuliner'=>'Kuliner','adventure'=>'Adventure','belanja'=>'Belanja','budaya'=>'Budaya','hiking'=>'Hiking','snorkeling'=>'Snorkeling']; @endphp
                        <div class="checkboxes">
                            @foreach($acts as $k=>$v)
                                <label><input type="checkbox" name="aktivitas_favorit[]" value="{{ $k }}" {{ in_array($k, (array) old('aktivitas_favorit', [])) ? 'checked' : '' }}> <span>{{ $v }}</span></label>
                            @endforeach
                        </div>
                        @error('aktivitas_favorit')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="jumlah_orang">Jumlah Orang</label>
                        <input class="input" type="number" id="jumlah_orang" name="jumlah_orang" min="1" max="20" step="1" placeholder="Contoh: 2" value="{{ old('jumlah_orang') }}" required>
                        @error('jumlah_orang')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="actions">
                        <button class="btn" type="submit">Lihat Rekomendasi</button>
                        <div class="alt">Kembali ke <a href="{{ route('login') }}">Masuk</a> atau <a href="{{ route('register') }}">Daftar</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
    </html>