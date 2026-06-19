<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cocokkan {{ $type === 'onyomi' ? 'Onyomi' : 'Kunyomi' }} {{ strtoupper($level) }} — Watashi no Nihongo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #f8fafc;
            --bg-card: rgba(255, 255, 255, 0.95);
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: rgba(226, 232, 240, 0.8);
            @if ($type === 'onyomi')
            --primary: #8b5cf6;
            --primary-hover: #7c3aed;
            --primary-light: #f5f3ff;
            --primary-soft: rgba(139,92,246,0.12);
            --blob1: rgba(139, 92, 246, 0.18);
            --blob2: rgba(99, 102, 241, 0.12);
            @else
            --primary: #06b6d4;
            --primary-hover: #0891b2;
            --primary-light: #ecfeff;
            --primary-soft: rgba(6,182,212,0.12);
            --blob1: rgba(6, 182, 212, 0.18);
            --blob2: rgba(14, 165, 233, 0.12);
            @endif
            --success: #10b981;
            --success-light: #ecfdf5;
            --error: #ef4444;
            --error-light: #fef2f2;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Plus Jakarta Sans', 'Noto Sans JP', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex; flex-direction: column; align-items: center;
            padding: 2rem 1.5rem;
            position: relative; overflow-x: hidden; user-select: none;
        }
        body::before, body::after {
            content: ''; position: absolute;
            width: 40vw; height: 40vw; border-radius: 50%;
            filter: blur(100px); z-index: 0; opacity: 0.55;
            animation: blob 10s infinite alternate;
        }
        body::before { top: -10vw; left: -10vw; background: var(--blob1); }
        body::after { bottom: -10vw; right: -10vw; background: var(--blob2); animation-delay: -5s; }
        @keyframes blob { 0%{transform:scale(1) translate(0,0)} 100%{transform:scale(1.1) translate(20px,20px)} }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .container { width: 100%; max-width: 860px; z-index: 10; }

        /* Nav */
        .nav-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .nav-back {
            display: inline-flex; align-items: center; gap: 6px;
            color: var(--text-muted); text-decoration: none;
            font-size: 0.875rem; font-weight: 500; transition: color 0.2s;
        }
        .nav-back:hover { color: var(--primary); }
        .nav-badges { display: flex; gap: 8px; }
        .badge { padding: 4px 12px; border-radius: 9999px; font-size: 0.72rem; font-weight: 700; letter-spacing: 0.5px; }
        .badge-level { background: #f1f5f9; color: var(--text-muted); border: 1px solid var(--border-color); }
        .badge-type { background: var(--primary-light); color: var(--primary); border: 1px solid var(--primary); }

        /* Header */
        .header-section {
            display: flex; justify-content: space-between; align-items: flex-end;
            margin-bottom: 1.5rem; padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }
        h1 { font-size: 1.4rem; font-weight: 800; letter-spacing: -0.5px; }

        /* Stats row */
        .stats-row { display: flex; gap: 16px; align-items: center; }
        .stat-item { text-align: right; }
        .stat-val { font-size: 1.25rem; font-weight: 800; color: var(--primary); line-height: 1; }
        .stat-lbl { font-size: 0.6rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-sep { width: 1px; height: 26px; background: var(--border-color); }

        /* Progress */
        .progress-section { margin-bottom: 1.25rem; }
        .progress-info {
            display: flex; justify-content: space-between;
            font-size: 0.75rem; color: var(--text-muted); font-weight: 600; margin-bottom: 6px;
        }
        .progress-bar { height: 6px; background: #e2e8f0; border-radius: 9999px; overflow: hidden; }
        .progress-fill { height: 100%; background: var(--primary); border-radius: 9999px; transition: width 0.4s ease; }

        /* Round info */
        .round-info {
            background: var(--primary-light);
            border: 1px solid var(--primary);
            border-radius: 10px;
            padding: 0.6rem 1rem;
            font-size: 0.8rem; font-weight: 700; color: var(--primary);
            text-align: center; margin-bottom: 1.25rem;
            letter-spacing: 0.3px;
        }

        /* Match grid */
        .match-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 1.25rem; margin-bottom: 1.25rem;
        }
        .match-col { display: flex; flex-direction: column; gap: 0.7rem; }
        .col-label {
            font-size: 0.68rem; font-weight: 700; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.8px;
            margin-bottom: 2px;
        }

        /* Match Card */
        .match-card {
            background: var(--bg-card);
            border: 1.5px solid var(--border-color);
            border-radius: 14px;
            padding: 0.9rem 1.1rem;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            animation: slideUp 0.3s ease forwards;
            opacity: 0;
        }
        .match-card:hover { border-color: var(--primary); transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.06); }

        .match-card.selected {
            border-color: var(--primary);
            background: var(--primary-light);
            box-shadow: 0 0 0 3px var(--primary-soft);
        }

        .match-card.matched {
            border-color: var(--success) !important;
            background: var(--success-light) !important;
            opacity: 0 !important;
            transform: scale(0.9) !important;
            pointer-events: none;
            transition: all 0.35s ease;
        }

        .match-card.wrong-shake {
            border-color: var(--error) !important;
            background: var(--error-light) !important;
            animation: shakeCard 0.35s ease;
        }
        @keyframes shakeCard { 0%,100%{transform:translateX(0)} 25%{transform:translateX(-5px)} 75%{transform:translateX(5px)} }

        /* Kanji card content */
        .kanji-main {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 1.7rem; font-weight: 900; color: var(--text-main);
            display: block; line-height: 1;
        }
        .kanji-sub { font-size: 0.72rem; color: var(--text-muted); font-weight: 500; margin-top: 4px; display: block; }
        /* Reading card */
        .reading-main {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 1.1rem; font-weight: 700; color: var(--text-main);
            text-align: center; display: block;
        }

        /* Instruction */
        .instruction {
            text-align: center; font-size: 0.8rem; color: var(--text-muted);
            font-weight: 500; font-style: italic; margin-bottom: 0.5rem;
        }

        /* Round complete toast */
        .round-toast {
            position: fixed; top: 50%; left: 50%;
            transform: translate(-50%, -50%) scale(0.8);
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem 2rem;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            opacity: 0; pointer-events: none;
            transition: all 0.2s; z-index: 60;
        }
        .round-toast.show { opacity: 1; transform: translate(-50%, -50%) scale(1); }
        .round-toast-emoji { font-size: 2.5rem; display: block; margin-bottom: 4px; }
        .round-toast-text { font-size: 1rem; font-weight: 800; color: var(--text-main); }
        .round-toast-sub { font-size: 0.78rem; color: var(--text-muted); font-weight: 500; margin-top: 2px; }

        /* Result */
        .result-overlay {
            position: fixed; inset: 0;
            background: rgba(248,250,252,0.92);
            backdrop-filter: blur(12px);
            display: none; align-items: center; justify-content: center;
            z-index: 50; padding: 2rem;
        }
        .result-overlay.show { display: flex; }
        .result-panel {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 24px; padding: 2.5rem 2rem;
            text-align: center; max-width: 420px; width: 100%;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1);
            animation: slideUp 0.4s ease;
        }
        .result-panel::before {
            content: ''; display: block; height: 4px;
            background: var(--primary);
            margin: -2.5rem -2rem 2rem;
            border-radius: 24px 24px 0 0;
        }
        .r-emoji { font-size: 3rem; display: block; margin-bottom: 0.5rem; }
        .r-title { font-size: 1.5rem; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 0.3rem; }
        .r-sub { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem; font-weight: 500; }
        .r-stats { display: grid; grid-template-columns: repeat(3,1fr); gap: 0.75rem; margin-bottom: 1.75rem; }
        .r-stat { background: #f8fafc; border: 1px solid var(--border-color); border-radius: 12px; padding: 1rem 0.5rem; }
        .r-stat-v { font-size: 1.7rem; font-weight: 800; color: var(--primary); }
        .r-stat-l { font-size: 0.62rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .r-btns { display: flex; gap: 10px; }
        .btn-primary, .btn-secondary {
            flex: 1; padding: 0.85rem; border-radius: 10px;
            font-size: 0.875rem; font-weight: 700; cursor: pointer; border: none;
            font-family: inherit; text-decoration: none;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-hover); transform: translateY(-1px); }
        .btn-secondary { background: #f1f5f9; color: var(--text-muted); border: 1px solid var(--border-color); }
        .btn-secondary:hover { background: #e2e8f0; color: var(--text-main); }

        @media (max-width: 600px) {
            .match-grid { gap: 0.75rem; }
            .kanji-main { font-size: 1.4rem; }
            .reading-main { font-size: 0.95rem; }
            h1 { font-size: 1.1rem; }
        }
    </style>
</head>
<body>
    <!-- Round toast -->
    <div class="round-toast" id="roundToast">
        <span class="round-toast-emoji" id="rtEmoji">✅</span>
        <div class="round-toast-text" id="rtText">Ronde Selesai!</div>
        <div class="round-toast-sub" id="rtSub">Melanjutkan...</div>
    </div>

    <div class="container">
        <nav class="nav-header">
            <a href="{{ route('home') }}" class="nav-back">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
                </svg>
                Kembali ke Dashboard
            </a>
            <div class="nav-badges">
                <span class="badge badge-level">{{ strtoupper($level) }}</span>
                <span class="badge badge-type">{{ $type === 'onyomi' ? "COCOK ON'YOMI" : "COCOK KUN'YOMI" }}</span>
            </div>
        </nav>

        <div class="header-section">
            <div>
                <h1>Cocokkan {{ $type === 'onyomi' ? 'Onyomi' : 'Kunyomi' }}</h1>
                <div style="font-size:0.8rem;color:var(--text-muted);margin-top:2px;font-weight:500;">
                    Pasangkan kanji dengan bacaan yang tepat
                </div>
            </div>
            <div class="stats-row">
                <div class="stat-item">
                    <div class="stat-val" id="matchedVal">0</div>
                    <div class="stat-lbl">Cocok</div>
                </div>
                <div class="stat-sep"></div>
                <div class="stat-item">
                    <div class="stat-val" id="wrongVal">0</div>
                    <div class="stat-lbl">Salah</div>
                </div>
                <div class="stat-sep"></div>
                <div class="stat-item">
                    <div class="stat-val" id="totalVal">0</div>
                    <div class="stat-lbl">Total</div>
                </div>
            </div>
        </div>

        <div class="progress-section">
            <div class="progress-info">
                <span id="progTxt">Ronde 1</span>
                <span id="progPct">0%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" id="progFill" style="width:0%"></div>
            </div>
        </div>

        <div class="round-info" id="roundInfo">Pilih kanji, lalu klik bacaan yang cocok 🔗</div>

        <div class="match-grid">
            <div class="match-col">
                <div class="col-label">Kanji</div>
                <div id="kanjiCol"></div>
            </div>
            <div class="match-col">
                <div class="col-label">{{ $type === 'onyomi' ? 'Onyomi (音読み)' : 'Kunyomi (訓読み)' }}</div>
                <div id="readingCol"></div>
            </div>
        </div>

        <p class="instruction">Klik kartu kanji → klik bacaan yang sesuai untuk mencocokkan</p>
    </div>

    <!-- Result -->
    <div class="result-overlay" id="resultOverlay">
        <div class="result-panel">
            <span class="r-emoji" id="rEmoji">🏆</span>
            <div class="r-title" id="rTitle">Selesai!</div>
            <div class="r-sub" id="rSub"></div>
            <div class="r-stats">
                <div class="r-stat"><div class="r-stat-v" id="rTotal">0</div><div class="r-stat-l">Total Pasang</div></div>
                <div class="r-stat"><div class="r-stat-v" id="rSalah">0</div><div class="r-stat-l">Kesalahan</div></div>
                <div class="r-stat"><div class="r-stat-v" id="rRonde">0</div><div class="r-stat-l">Ronde</div></div>
            </div>
            <div class="r-btns">
                <button class="btn-primary" onclick="restart()">🔄 Main Lagi</button>
                <a href="{{ route('home') }}" class="btn-secondary">🏠 Beranda</a>
            </div>
        </div>
    </div>

<script>
    const ALL = {!! json_encode($kanjis->values()) !!};
    const TYPE = '{{ $type }}';
    const PAIRS = 6; // cards per round

    let pool=[], roundPairs=[], selK=null, selR=null;
    let matched=0, wrong=0, roundN=1, roundMatched=0;

    function init() {
        if (!ALL.length) {
            document.getElementById('roundInfo').textContent = 'Tidak ada data kanji';
            return;
        }
        document.getElementById('totalVal').textContent = ALL.length;
        restart();
    }

    function restart() {
        pool = [...ALL].sort(() => Math.random() - 0.5);
        matched=0; wrong=0; roundN=1; selK=null; selR=null;
        document.getElementById('matchedVal').textContent = 0;
        document.getElementById('wrongVal').textContent = 0;
        document.getElementById('resultOverlay').classList.remove('show');
        loadRound();
    }

    function loadRound() {
        if (!pool.length) { showResult(); return; }
        roundPairs = pool.splice(0, Math.min(PAIRS, pool.length));
        roundMatched = 0; selK = null; selR = null;
        updateProgress();
        document.getElementById('roundInfo').textContent =
            `Ronde ${roundN} — Cocokkan ${roundPairs.length} pasang kanji`;
        renderRound();
        roundN++;
    }

    function updateProgress() {
        const pct = Math.round(matched / ALL.length * 100);
        document.getElementById('progTxt').textContent = `Ronde ${roundN} — ${matched}/${ALL.length} selesai`;
        document.getElementById('progPct').textContent = pct + '%';
        document.getElementById('progFill').style.width = pct + '%';
    }

    function renderRound() {
        const kCol = document.getElementById('kanjiCol');
        const rCol = document.getElementById('readingCol');
        let ks = [...roundPairs].sort(() => Math.random() - 0.5);
        let rs = [...roundPairs].sort(() => Math.random() - 0.5);

        kCol.innerHTML = ks.map((k, i) => `
            <div class="match-card" id="k${k.id}" data-id="${k.id}" style="animation-delay:${i*60}ms"
                onclick="pickKanji(this, ${k.id})">
                <span class="kanji-main">${k.kanji}</span>
                <span class="kanji-sub">${k.arti || '—'}</span>
            </div>`).join('');

        rCol.innerHTML = rs.map((k, i) => `
            <div class="match-card" id="r${k.id}" data-id="${k.id}" style="animation-delay:${i*60+25}ms"
                onclick="pickReading(this, ${k.id})">
                <span class="reading-main">${k[TYPE]}</span>
            </div>`).join('');
    }

    function pickKanji(el, id) {
        if (el.classList.contains('matched')) return;
        document.querySelectorAll('[id^="k"]').forEach(c => c.classList.remove('selected'));
        selK = { el, id };
        el.classList.add('selected');
        if (selR) checkPair();
    }

    function pickReading(el, id) {
        if (el.classList.contains('matched')) return;
        document.querySelectorAll('[id^="r"]').forEach(c => c.classList.remove('selected'));
        selR = { el, id };
        el.classList.add('selected');
        if (selK) checkPair();
    }

    function checkPair() {
        const kEl=selK.el, rEl=selR.el, kId=selK.id, rId=selR.id;
        selK=null; selR=null;

        if (kId === rId) {
            // Correct match
            kEl.classList.remove('selected'); rEl.classList.remove('selected');
            // brief green flash then fade out
            kEl.style.borderColor = 'var(--success)';
            kEl.style.background = 'var(--success-light)';
            rEl.style.borderColor = 'var(--success)';
            rEl.style.background = 'var(--success-light)';
            matched++; roundMatched++;
            document.getElementById('matchedVal').textContent = matched;
            updateProgress();
            setTimeout(() => {
                kEl.classList.add('matched'); rEl.classList.add('matched');
                if (roundMatched === roundPairs.length) {
                    showRoundToast();
                }
            }, 300);
        } else {
            // Wrong match
            wrong++; document.getElementById('wrongVal').textContent = wrong;
            kEl.classList.add('wrong-shake'); rEl.classList.add('wrong-shake');
            setTimeout(() => {
                kEl.classList.remove('wrong-shake','selected');
                rEl.classList.remove('wrong-shake','selected');
            }, 400);
        }
    }

    function showRoundToast() {
        if (!pool.length) { setTimeout(showResult, 600); return; }
        const rt = document.getElementById('roundToast');
        document.getElementById('rtEmoji').textContent = '✅';
        document.getElementById('rtText').textContent = `Ronde ${roundN-1} Selesai! +${roundPairs.length}`;
        document.getElementById('rtSub').textContent = `${pool.length} kanji lagi tersisa...`;
        rt.classList.add('show');
        setTimeout(() => { rt.classList.remove('show'); loadRound(); }, 1500);
    }

    function showResult() {
        const acc = matched + wrong > 0 ? Math.round(matched / (matched + wrong) * 100) : 100;
        document.getElementById('rEmoji').textContent = acc >= 90 ? '🏆' : acc >= 70 ? '🎯' : '💪';
        document.getElementById('rTitle').textContent = acc >= 90 ? 'Sempurna!' : acc >= 70 ? 'Bagus!' : 'Terus Berlatih!';
        document.getElementById('rSub').textContent = `${matched} pasang dicocokkan, ${wrong} kesalahan`;
        document.getElementById('rTotal').textContent = matched;
        document.getElementById('rSalah').textContent = wrong;
        document.getElementById('rRonde').textContent = roundN - 1;
        document.getElementById('progFill').style.width = '100%';
        document.getElementById('progPct').textContent = '100%';
        document.getElementById('resultOverlay').classList.add('show');
    }

    init();
</script>
</body>
</html>
