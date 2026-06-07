<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Kanji N3 - Watashi no Nihongo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --primary: #6366f1; /* Minimal Indigo */
            --primary-hover: #4f46e5;
            --success: #10b981;
            --error: #ef4444;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Noto Sans JP', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .container {
            width: 100%;
            max-width: 550px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 2.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }

        .header {
            margin-bottom: 2rem;
        }

        .nav-back {
            display: inline-flex;
            align-items: center;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1rem;
            transition: color 0.2s;
        }

        .nav-back:hover {
            color: var(--primary);
        }

        .nav-back svg {
            margin-right: 6px;
        }

        h1 {
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 0.5rem;
        }

        p.subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: var(--success);
            border: 1px solid #d1fae5;
        }

        .alert-error {
            background-color: #fef2f2;
            color: var(--error);
            border: 1px solid #fee2e2;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        label .required {
            color: var(--error);
            margin-left: 2px;
        }

        label .optional {
            color: var(--text-muted);
            font-weight: 400;
            font-size: 0.75rem;
            margin-left: 4px;
        }

        input[type="text"] {
            width: 100%;
            padding: 0.75rem 1rem;
            font-family: inherit;
            font-size: 0.95rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            outline: none;
            transition: all 0.2s;
            color: var(--text-main);
            background-color: #f8fafc;
        }

        input[type="text"]:focus {
            border-color: var(--primary);
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 0.875rem;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 600;
            color: #ffffff;
            background-color: var(--primary);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 2rem;
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
        }

        @media (max-width: 600px) {
            .container {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ route('home') }}" class="nav-back">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Kembali ke Dashboard
            </a>
            <h1>Input Kanji N3</h1>
            <p class="subtitle">Tambahkan data karakter Kanji N3 baru secara manual ke dalam sistem.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('n3.input.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="kanji">Karakter Kanji <span class="required">*</span></label>
                <input type="text" id="kanji" name="kanji" placeholder="Contoh: 活" required value="{{ old('kanji') }}">
            </div>

            <div class="form-group">
                <label for="onyomi">Onyomi <span class="optional">(Opsional)</span></label>
                <input type="text" id="onyomi" name="onyomi" placeholder="Contoh: カツ" value="{{ old('onyomi') }}">
            </div>

            <div class="form-group">
                <label for="kunyomi">Kunyomi <span class="optional">(Opsional)</span></label>
                <input type="text" id="kunyomi" name="kunyomi" placeholder="Contoh: い.きる" value="{{ old('kunyomi') }}">
            </div>

            <div class="form-group">
                <label for="arti">Arti Kanji <span class="optional">(Opsional)</span></label>
                <input type="text" id="arti" name="arti" placeholder="Contoh: hidup, aktif" value="{{ old('arti') }}">
            </div>

            <button type="submit" class="btn-submit">Simpan Kanji N3</button>
        </form>
    </div>
</body>
</html>
