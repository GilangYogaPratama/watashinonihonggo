<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tebak {{ $type === 'onyomi' ? 'Onyomi' : 'Kunyomi' }} {{ strtoupper($level) }} — Watashi no Nihongo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #f8fafc;
            --bg-card: rgba(255, 255, 255, 0.95);
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: rgba(226, 232, 240, 0.8);
            @if ($type === 'onyomi')
            --primary: #f97316;
            --primary-hover: #ea580c;
            --primary-light: #fff7ed;
            --primary-soft: rgba(249, 115, 22, 0.12);
            --blob1: rgba(249, 115, 22, 0.18);
            --blob2: rgba(239, 68, 68, 0.1);
            @else
            --primary: #ec4899;
            --primary-hover: #db2777;
            --primary-light: #fdf2f8;
            --primary-soft: rgba(236, 72, 153, 0.12);
            --blob1: rgba(236, 72, 153, 0.18);
            --blob2: rgba(168, 85, 247, 0.12);
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
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1.5rem;
            position: relative;
            overflow-x: hidden;
            user-select: none;
        }

        body::before, body::after {
            content: '';
            position: absolute;
            width: 40vw; height: 40vw;
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0; opacity: 0.6;
            animation: blob 10s infinite alternate;
        }
        body::before { top: -10vw; left: -10vw; background: var(--blob1); }
        body::after { bottom: -10vw; right: -10vw; background: var(--blob2); animation-delay: -5s; }
        @keyframes blob { 0%{transform:scale(1) translate(0,0)} 100%{transform:scale(1.1) translate(20px,20px)} }

        .container { width: 100%; max-width: 620px; z-index: 10; }

        /* Nav */
        .nav-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .nav-back {
            display: inline-flex; align-items: center; gap: 6px;
            color: var(--text-muted); text-decoration: none;
            font-size: 0.875rem; font-weight: 500; transition: color 0.2s;
        }
        .nav-back:hover { color: var(--primary); }
        .nav-badges { display: flex; gap: 8px; align-items: center; }
        .badge {
            padding: 4px 12px; border-radius: 9999px;
            font-size: 0.72rem; font-weight: 700; letter-spacing: 0.5px;
        }
        .badge-level { background: #f1f5f9; color: var(--text-muted); border: 1px solid var(--border-color); }
        .badge-type { background: var(--primary-light); color: var(--primary); border: 1px solid var(--primary); }

        /* Header */
        .header-section {
            display: flex; justify-content: space-between; align-items: flex-end;
            margin-bottom: 1.5rem; padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }
        h1 { font-size: 1.4rem; font-weight: 800; letter-spacing: -0.5px; }
        .score-row { display: flex; gap: 16px; align-items: center; }
        .score-item { text-align: right; }
        .score-val { font-size: 1.3rem; font-weight: 800; color: var(--primary); line-height: 1; }
        .score-lbl { font-size: 0.6rem; color: var(--text-muted); font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase; }
        .score-sep { width: 1px; height: 28px; background: var(--border-color); }

        /* Progress */
        .progress-section { margin-bottom: 1.5rem; }
        .progress-info {
            display: flex; justify-content: space-between;
            font-size: 0.75rem; color: var(--text-muted); font-weight: 600; margin-bottom: 6px;
        }
        .progress-bar { height: 6px; background: #e2e8f0; border-radius: 9999px; overflow: hidden; }
        .progress-fill {
            height: 100%; background: var(--primary);
            border-radius: 9999px; transition: width 0.4s ease;
        }

        /* Streak dots */
        .streak-row { display: flex; justify-content: center; gap: 6px; margin-bottom: 1.25rem; }
        .s-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: #e2e8f0; transition: all 0.25s;
        }
        .s-dot.on { background: var(--primary); transform: scale(1.2); box-shadow: 0 0 6px var(--primary-soft); }

        /* Kanji Card */
        .kanji-card {
            background: var(--bg-card);
            backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            text-align: center;
            margin-bottom: 1.25rem;
            box-shadow: 0 15px 35px -5px rgba(0,0,0,0.05), 0 10px 15px -5px rgba(0,0,0,0.02);
            position: relative; overflow: hidden;
            transition: opacity 0.25s;
        }
        .kanji-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 3px;
            background: var(--primary); border-radius: 20px 20px 0 0;
        }
        .kanji-char {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 6rem; font-weight: 900;
            color: var(--text-main); line-height: 1;
            margin-bottom: 1rem;
        }
        .kanji-arti {
            font-size: 1rem; color: var(--text-muted); font-weight: 500;
        }
        .question-hint {
            display: inline-block; margin-top: 0.75rem;
            font-size: 0.72rem; font-weight: 700; color: var(--primary);
            background: var(--primary-light);
            padding: 4px 12px; border-radius: 9999px;
            letter-spacing: 0.4px; text-transform: uppercase;
        }

        /* Choices */
        .choices-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 0.85rem; margin-bottom: 1.25rem;
        }
        .choice-btn {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.1rem 1rem;
            font-family: 'Noto Sans JP', 'Plus Jakarta Sans', sans-serif;
            font-size: 1.05rem; font-weight: 700;
            color: var(--text-main); cursor: pointer;
            transition: all 0.2s;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            opacity: 0;
            animation: slideUp 0.3s ease forwards;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .choice-btn:hover:not(:disabled) {
            border-color: var(--primary); background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.06);
        }
        .choice-btn.correct {
            border-color: var(--success) !important;
            background: var(--success-light) !important;
            color: var(--success) !important;
            animation: pulseOk 0.35s ease;
        }
        .choice-btn.wrong {
            border-color: var(--error) !important;
            background: var(--error-light) !important;
            color: var(--error) !important;
            animation: shake 0.35s ease;
        }
        .choice-btn.reveal {
            border-color: var(--success) !important;
            background: #f0fdf4 !important;
            color: var(--success) !important;
        }
        .choice-btn:disabled { cursor: default; }
        @keyframes pulseOk { 0%,100%{transform:scale(1)} 50%{transform:scale(1.03)} }
        @keyframes shake { 0%,100%{transform:translateX(0)} 25%{transform:translateX(-5px)} 75%{transform:translateX(5px)} }

        /* Feedback toast */
        .toast {
            position: fixed; top: 40%; left: 50%;
            transform: translate(-50%, -50%) scale(0.5);
            font-size: 2.5rem; opacity: 0; pointer-events: none;
            transition: all 0.15s; z-index: 100;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
        }
        .toast.show { opacity: 1; transform: translate(-50%, -60%) scale(1); }

        /* Result Panel */
        .result-overlay {
            position: fixed; inset: 0;
            background: rgba(248, 250, 252, 0.92);
            backdrop-filter: blur(12px);
            display: none; align-items: center; justify-content: center;
            z-index: 50; padding: 2rem;
        }
        .result-overlay.show { display: flex; }
        .result-panel {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            text-align: center; max-width: 420px; width: 100%;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1);
            animation: slideUp 0.4s ease;
        }
        .result-panel::before {
            content: '';
            display: block; height: 4px;
            background: var(--primary);
            margin: -2.5rem -2rem 2rem;
            border-radius: 24px 24px 0 0;
        }
        .r-emoji { font-size: 3rem; display: block; margin-bottom: 0.5rem; }
        .r-title { font-size: 1.5rem; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 0.3rem; color: var(--text-main); }
        .r-sub { font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem; font-weight: 500; }

        .stars { display: flex; justify-content: center; gap: 6px; margin-bottom: 1.5rem; }
        .star { font-size: 1.8rem; filter: grayscale(1) opacity(0.25); transition: all 0.3s; }
        .star.on { filter: none; animation: popStar 0.35s ease; }
        @keyframes popStar { from{transform:scale(0)} 70%{transform:scale(1.3)} to{transform:scale(1)} }

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

        /* Log table (review results) */
        .log-wrap {
            width: 100%; max-height: 180px; overflow-y: auto;
            border: 1px solid var(--border-color); border-radius: 10px;
            margin-bottom: 1.5rem;
        }
        .log-table { width: 100%; border-collapse: collapse; font-size: 0.82rem; }
        .log-table th {
            font-size: 0.7rem; color: var(--text-muted); font-weight: 700;
            background: #f8fafc; padding: 8px 10px;
            border-bottom: 1px solid var(--border-color);
            position: sticky; top: 0; text-align: left;
        }
        .log-table td { padding: 8px 10px; border-bottom: 1px solid #f1f5f9; font-family: 'Noto Sans JP', sans-serif; }
        .ok-badge, .no-badge {
            font-size: 0.68rem; padding: 2px 7px; border-radius: 4px;
            font-weight: 700; color: white; display: inline-block;
        }
        .ok-badge { background: var(--success); }
        .no-badge { background: var(--error); }

        @media (max-width: 480px) {
            .kanji-char { font-size: 4.5rem; }
            .choices-grid { gap: 0.65rem; }
            .choice-btn { font-size: 0.95rem; padding: 0.9rem; }
            h1 { font-size: 1.1rem; }
        }
    </style>
</head>
<body>
    <div class="toast" id="toast"></div>

    <div class="container">
        <!-- Nav -->
        <nav class="nav-header">
            <a href="{{ route('home') }}" class="nav-back">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
                </svg>
                Kembali ke Dashboard
            </a>
            <div class="nav-badges">
                <span class="badge badge-level">{{ strtoupper($level) }}</span>
                <span class="badge badge-type">{{ $type === 'onyomi' ? "ON'YOMI 音" : "KUN'YOMI 訓" }}</span>
            </div>
        </nav>

        <!-- Header -->
        <div class="header-section">
            <div>
                <h1>Tebak {{ $type === 'onyomi' ? 'Onyomi' : 'Kunyomi' }}</h1>
                <div style="font-size:0.8rem;color:var(--text-muted);margin-top:2px;font-weight:500;">
                    Pilih bacaan yang benar dari 4 pilihan
                </div>
            </div>
            <div class="score-row">
                <div class="score-item">
                    <div class="score-val" id="scoreVal">0</div>
                    <div class="score-lbl">Skor</div>
                </div>
                <div class="score-sep"></div>
                <div class="score-item">
                    <div class="score-val" id="streakVal">0</div>
                    <div class="score-lbl">Streak</div>
                </div>
            </div>
        </div>

        <!-- Progress -->
        <div class="progress-section">
            <div class="progress-info">
                <span id="progTxt">Soal 1</span>
                <span id="progPct">0%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" id="progFill" style="width:0%"></div>
            </div>
        </div>

        <!-- Streak Dots -->
        <div class="streak-row" id="streakRow"></div>

        <!-- Kanji Display -->
        <div class="kanji-card" id="kanjiCard">
            <div class="kanji-char" id="kanjiChar">？</div>
            <div class="kanji-arti" id="kanjiArti">Memuat...</div>
            <span class="question-hint">
                {{ $type === 'onyomi' ? 'Pilih onyomi (音読み)' : 'Pilih kunyomi (訓読み)' }}
            </span>
        </div>

        <!-- Choices -->
        <div class="choices-grid" id="choicesGrid"></div>
    </div>

    <!-- Result Overlay -->
    <div class="result-overlay" id="resultOverlay">
        <div class="result-panel">
            <span class="r-emoji" id="rEmoji">🎉</span>
            <div class="r-title" id="rTitle">Selesai!</div>
            <div class="r-sub" id="rSub"></div>
            <div class="stars">
                <span class="star" id="s1">⭐</span>
                <span class="star" id="s2">⭐</span>
                <span class="star" id="s3">⭐</span>
            </div>
            <div class="r-stats">
                <div class="r-stat"><div class="r-stat-v" id="rBenar">0</div><div class="r-stat-l">Benar</div></div>
                <div class="r-stat"><div class="r-stat-v" id="rSalah">0</div><div class="r-stat-l">Salah</div></div>
                <div class="r-stat"><div class="r-stat-v" id="rStreak">0</div><div class="r-stat-l">Streak Max</div></div>
            </div>
            <div class="log-wrap">
                <table class="log-table">
                    <thead><tr><th>Kanji</th><th>Jawaban</th><th>Benar</th><th>Status</th></tr></thead>
                    <tbody id="logBody"></tbody>
                </table>
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

    let qs=[], qi=0, score=0, streak=0, best=0, done=false, log=[];

    function init() {
        if (!ALL.length) {
            document.getElementById('kanjiChar').textContent = '！';
            document.getElementById('kanjiArti').textContent = 'Tidak ada data kanji';
            return;
        }
        buildDots();
        startGame();
    }

    function startGame() {
        // Use ALL kanji — no limit
        qs = [...ALL].sort(() => Math.random() - 0.5);
        qi=0; score=0; streak=0; best=0; done=false; log=[];
        updateHUD();
        showQ();
    }

    function buildDots() {
        document.getElementById('streakRow').innerHTML =
            Array.from({length:5},(_,i)=>`<div class="s-dot" id="d${i}"></div>`).join('');
    }

    function showQ() {
        if (qi >= qs.length) { showResult(); return; }
        done = false;
        const q = qs[qi];
        const correct = q[TYPE];
        const pct = Math.round(qi / qs.length * 100);

        document.getElementById('progTxt').textContent = `Soal ${qi+1} / ${qs.length}`;
        document.getElementById('progPct').textContent = pct + '%';
        document.getElementById('progFill').style.width = pct + '%';

        const card = document.getElementById('kanjiCard');
        card.style.opacity = '0';
        setTimeout(() => {
            document.getElementById('kanjiChar').textContent = q.kanji;
            document.getElementById('kanjiArti').textContent = q.arti || '—';
            card.style.opacity = '1';
        }, 130);

        // Build 4 choices
        let wrong = ALL.filter(k => k.id !== q.id && k[TYPE] && k[TYPE] !== '—')
                       .sort(() => Math.random() - 0.5).slice(0, 3);
        let choices = [{text: correct, ok: true}, ...wrong.map(k=>({text:k[TYPE],ok:false}))]
                       .sort(() => Math.random() - 0.5);

        const grid = document.getElementById('choicesGrid');
        grid.style.opacity = '0';
        setTimeout(() => {
            grid.innerHTML = choices.map((c,i) =>
                `<button class="choice-btn" style="animation-delay:${i*55}ms"
                    data-ok="${c.ok}" onclick="pick(this,${c.ok},'${esc(correct)}','${esc(q.kanji)}')">${c.text}</button>`
            ).join('');
            grid.style.opacity = '1';
        }, 130);
    }

    function esc(s) { return (s||'').replace(/'/g, "\\'"); }

    function pick(btn, ok, correct, kanji) {
        if (done) return;
        done = true;
        const btns = document.querySelectorAll('.choice-btn');
        btns.forEach(b => b.disabled = true);

        if (ok) {
            score++; streak++; if (streak > best) best = streak;
            btn.classList.add('correct'); toast('✨');
        } else {
            streak = 0; btn.classList.add('wrong'); toast('💔');
            btns.forEach(b => { if (b.dataset.ok === 'true') b.classList.add('reveal'); });
        }

        // Log for review
        log.push({ kanji, answer: btn.textContent, correct, ok });

        updateHUD();
        updateDots();
        setTimeout(() => { qi++; showQ(); }, 1000);
    }

    function toast(e) {
        const t = document.getElementById('toast');
        t.textContent = e; t.classList.add('show');
        setTimeout(() => t.classList.remove('show'), 550);
    }

    function updateHUD() {
        document.getElementById('scoreVal').textContent = score;
        document.getElementById('streakVal').textContent = streak;
    }

    function updateDots() {
        for (let i = 0; i < 5; i++) {
            const d = document.getElementById('d'+i);
            if (d) d.classList.toggle('on', i < streak);
        }
    }

    function showResult() {
        const total = qs.length;
        const pct = Math.round(score / total * 100);
        const stars = pct >= 90 ? 3 : pct >= 60 ? 2 : pct >= 30 ? 1 : 0;
        const emoji = pct >= 90 ? '🏆' : pct >= 60 ? '🎯' : pct >= 30 ? '📖' : '💪';
        const title = pct >= 90 ? 'Luar Biasa!' : pct >= 60 ? 'Bagus Sekali!' : pct >= 30 ? 'Terus Berlatih!' : 'Jangan Menyerah!';

        document.getElementById('rEmoji').textContent = emoji;
        document.getElementById('rTitle').textContent = title;
        document.getElementById('rSub').textContent = `${score} dari ${total} benar (${pct}%)`;
        document.getElementById('rBenar').textContent = score;
        document.getElementById('rSalah').textContent = total - score;
        document.getElementById('rStreak').textContent = best;
        document.getElementById('progFill').style.width = '100%';
        document.getElementById('progPct').textContent = '100%';

        // Build log table
        document.getElementById('logBody').innerHTML = log.map(l => `
            <tr>
                <td style="font-size:1.1rem;font-weight:900">${l.kanji}</td>
                <td>${l.answer}</td>
                <td>${l.correct}</td>
                <td>${l.ok ? '<span class="ok-badge">✓ Benar</span>' : '<span class="no-badge">✗ Salah</span>'}</td>
            </tr>`).join('');

        document.getElementById('resultOverlay').classList.add('show');
        [1,2,3].forEach((n,i) => {
            if (n <= stars) setTimeout(() => document.getElementById('s'+n).classList.add('on'), 300+i*200);
        });
    }

    function restart() {
        document.getElementById('resultOverlay').classList.remove('show');
        [1,2,3].forEach(n => document.getElementById('s'+n).classList.remove('on'));
        startGame();
    }

    init();
</script>
</body>
</html>
