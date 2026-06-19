<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar Kanji N3 - Watashi no Nihongo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #f8fafc;
            --bg-card: rgba(255, 255, 255, 0.95);
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: rgba(226, 232, 240, 0.8);
            --primary: #f43f5e;
            --primary-hover: #e11d48;
            --primary-light: #fff1f2;
            --indigo: #6366f1;
            --indigo-hover: #4f46e5;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Noto Sans JP', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            position: relative;
            overflow-x: hidden;
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            user-select: none;
        }

        body::before, body::after {
            content: '';
            position: absolute;
            width: 40vw; height: 40vw;
            border-radius: 50%;
            filter: blur(100px);
            z-index: 0; opacity: 0.5;
            animation: pulse-blob 10s infinite alternate;
        }
        body::before { top: -10vw; left: -10vw; background: rgba(244, 63, 94, 0.15); }
        body::after  { bottom: -10vw; right: -10vw; background: rgba(99, 102, 241, 0.12); animation-delay: -5s; }
        @keyframes pulse-blob {
            0%   { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.1) translate(20px, 20px); }
        }

        .container {
            width: 100%;
            max-width: 600px;
            z-index: 10;
        }

        .nav-header {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 1.5rem;
        }

        .nav-back {
            display: inline-flex;
            align-items: center;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s;
        }
        .nav-back:hover { color: var(--indigo); }
        .nav-back svg { margin-right: 6px; }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        h1 { font-size: 1.5rem; font-weight: 700; letter-spacing: -0.5px; }

        .level-badge {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            background-color: #ffe4e6;
            padding: 4px 10px;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Empty state */
        .empty-state {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .empty-state h3 { font-size: 1.25rem; margin-bottom: 0.75rem; }
        .empty-state p  { color: var(--text-muted); font-size: 0.95rem; margin-bottom: 1.5rem; }
        .btn-link {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: var(--indigo);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background-color 0.2s;
        }
        .btn-link:hover { background-color: var(--indigo-hover); }

        /* ── FLASHCARD (no flip) ── */
        .flashcard-container {
            width: 100%;
            margin-bottom: 2rem;
        }

        .flashcard {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 2.5rem 2.5rem 2rem;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.05), 0 10px 15px -5px rgba(0, 0, 0, 0.02);
            position: relative;
            text-align: center;
            cursor: pointer;
            transition: box-shadow 0.2s;
        }
        .flashcard:hover {
            box-shadow: 0 20px 40px -8px rgba(0, 0, 0, 0.08);
        }

        /* Top accent line */
        .flashcard::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--primary);
            border-radius: 20px 20px 0 0;
        }

        .kanji-char {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 7.5rem;
            font-weight: 900;
            color: var(--text-main);
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .tap-hint {
            font-size: 0.75rem;
            color: #cbd5e1;
            font-weight: 500;
            margin-bottom: 1.5rem;
            letter-spacing: 0.3px;
        }

        /* ── ANSWER AREA (fade in/out) ── */
        .answer-area {
            overflow: hidden;
            max-height: 0;
            opacity: 0;
            transition: max-height 0.35s ease, opacity 0.3s ease, margin-top 0.35s ease;
            margin-top: 0;
        }
        .answer-area.visible {
            max-height: 300px;
            opacity: 1;
            margin-top: 0.5rem;
        }

        .readings-box {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            width: 100%;
            margin-bottom: 1.25rem;
            border-top: 1px solid var(--border-color);
            padding-top: 1.25rem;
        }

        .reading-row {
            display: flex;
            align-items: baseline;
            gap: 1.25rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #f1f5f9;
        }
        .reading-row:last-child { border-bottom: none; padding-bottom: 0; }

        .reading-label {
            font-size: 0.72rem;
            color: var(--text-muted);
            width: 72px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            flex-shrink: 0;
        }

        .reading-val {
            font-size: 1.2rem;
            color: var(--text-main);
            font-weight: 700;
            font-family: 'Noto Sans JP', sans-serif;
            text-align: left;
        }

        .meaning {
            font-size: 1.15rem;
            color: var(--primary);
            font-weight: 700;
            padding: 0.65rem 1.25rem;
            background: var(--primary-light);
            border-radius: 10px;
            width: 100%;
            text-align: center;
        }

        /* Ingat button */
        .btn-master {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 1rem;
            font-size: 0.75rem;
            color: #ffffff;
            background: var(--indigo);
            border: none;
            padding: 6px 16px;
            border-radius: 9999px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.2s;
            font-family: inherit;
        }
        .btn-master:hover { background-color: var(--indigo-hover); }

        /* ── CONTROLS ── */
        .controls {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            gap: 1rem;
            width: 100%;
        }

        .btn-action {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 0.875rem;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }
        .btn-action:hover { border-color: var(--primary); background: #fafafa; }

        .btn-reveal { background: var(--primary); color: #fff; border: none; }
        .btn-reveal:hover { background: var(--primary-hover); }

        /* ── PROGRESS ── */
        .progress-section {
            margin-top: 2rem;
            width: 100%;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 8px;
            font-weight: 600;
        }

        .reset-link { color: var(--indigo); cursor: pointer; text-decoration: underline; }
        .reset-link:hover { color: var(--indigo-hover); }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e2e8f0;
            border-radius: 9999px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        @media (max-width: 600px) {
            .kanji-char { font-size: 5.5rem; }
            .flashcard  { padding: 2rem 1.5rem 1.5rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="nav-header">
            <a href="{{ route('home') }}" class="nav-back">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Kembali ke Dashboard
            </a>
        </nav>

        <div class="header-section">
            <h1>Belajar Kanji N3</h1>
            <span class="level-badge">JLPT N3</span>
        </div>

        @if(count($kanjis) === 0)
            <div class="empty-state">
                <h3>Belum ada Kanji N3</h3>
                <p>Data Kanji N3 di database masih kosong. Silakan tambahkan beberapa Kanji N3 terlebih dahulu melalui dashboard input.</p>
                <a href="{{ route('n3.input') }}" class="btn-link">Input Kanji N3</a>
            </div>
        @else
            <!-- Flashcard (single-face, no flip) -->
            <div class="flashcard-container">
                <div class="flashcard" id="flashcard" onclick="toggleReveal()">
                    <div class="kanji-char" id="kanjiDisplay">---</div>
                    <div class="tap-hint" id="tapHint">Ketuk untuk melihat jawaban</div>

                    <!-- Answer area: fade in/out -->
                    <div class="answer-area" id="answerArea">
                        <div class="readings-box">
                            <div class="reading-row">
                                <span class="reading-label">Onyomi</span>
                                <span class="reading-val" id="onyomiVal">—</span>
                            </div>
                            <div class="reading-row">
                                <span class="reading-label">Kunyomi</span>
                                <span class="reading-val" id="kunyomiVal">—</span>
                            </div>
                            <div class="reading-row">
                                <span class="reading-label">Arti</span>
                                <span class="reading-val" id="artiVal">—</span>
                            </div>
                        </div>
                        <div class="meaning" id="meaningVal">—</div>
                        <button class="btn-master" onclick="event.stopPropagation(); markAsMastered()">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Tandai Ingat
                        </button>
                    </div>
                </div>
            </div>

            <div class="controls">
                <button class="btn-action" onclick="prevCard()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right:4px;">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Prev
                </button>
                <button class="btn-action btn-reveal" id="btnReveal" onclick="toggleReveal()">Tampilkan</button>
                <button class="btn-action" onclick="nextCard()">
                    Next
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left:4px;">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </div>

            <div class="progress-section">
                <div class="progress-info">
                    <span>Progres Hafalan</span>
                    <span class="reset-link" onclick="resetMastery()">Reset Progres</span>
                    <span id="progressCounter">00 / 00</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill" style="width: 0%"></div>
                </div>
            </div>
        @endif
    </div>

    @if(count($kanjis) > 0)
    <script>
        const allKanjis = @json($kanjis);
        let kanjis = [];
        let masteredIds = JSON.parse(localStorage.getItem('mastered_kanji_n3') || '[]');
        let currentIndex = 0;
        let isRevealed = false;

        const answerArea      = document.getElementById('answerArea');
        const kanjiDisplay    = document.getElementById('kanjiDisplay');
        const onyomiVal       = document.getElementById('onyomiVal');
        const kunyomiVal      = document.getElementById('kunyomiVal');
        const artiVal         = document.getElementById('artiVal');
        const meaningVal      = document.getElementById('meaningVal');
        const progressFill    = document.getElementById('progressFill');
        const progressCounter = document.getElementById('progressCounter');
        const btnReveal       = document.getElementById('btnReveal');
        const tapHint         = document.getElementById('tapHint');

        function shuffleArray(arr) {
            for (let i = arr.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [arr[i], arr[j]] = [arr[j], arr[i]];
            }
        }

        function applyFilter() {
            let remaining = allKanjis.filter(k => !masteredIds.includes(k.id));
            if (remaining.length === 0 && allKanjis.length > 0) {
                alert('Selamat! Semua kanji N3 telah diingat. Progress akan direset.');
                masteredIds = [];
                localStorage.removeItem('mastered_kanji_n3');
                remaining = [...allKanjis];
            }
            kanjis = remaining;
            shuffleArray(kanjis);
            currentIndex = 0;
            hideAnswer();
            updateCardContent();
        }

        function updateCardContent() {
            if (kanjis.length === 0) {
                kanjiDisplay.textContent = 'DONE';
                progressCounter.textContent = '0 / 0';
                progressFill.style.width = '0%';
                return;
            }
            const k = kanjis[currentIndex];
            kanjiDisplay.textContent = k.kanji;
            onyomiVal.textContent  = k.onyomi  || '—';
            kunyomiVal.textContent = k.kunyomi || '—';
            artiVal.textContent    = k.arti    || '—';
            meaningVal.textContent = k.arti    || '—';
            const total = kanjis.length;
            progressCounter.textContent = `${currentIndex + 1} / ${total}`;
            progressFill.style.width = `${((currentIndex + 1) / total) * 100}%`;
        }

        function showAnswer() {
            isRevealed = true;
            answerArea.classList.add('visible');
            btnReveal.textContent = 'Sembunyikan';
            tapHint.textContent = 'Ketuk untuk menyembunyikan';
        }

        function hideAnswer() {
            isRevealed = false;
            answerArea.classList.remove('visible');
            btnReveal.textContent = 'Tampilkan';
            tapHint.textContent = 'Ketuk untuk melihat jawaban';
        }

        function toggleReveal() {
            isRevealed ? hideAnswer() : showAnswer();
        }

        function nextCard() {
            hideAnswer();
            currentIndex = (currentIndex + 1) % kanjis.length;
            updateCardContent();
        }

        function prevCard() {
            hideAnswer();
            currentIndex = (currentIndex - 1 + kanjis.length) % kanjis.length;
            updateCardContent();
        }

        function markAsMastered() {
            const current = kanjis[currentIndex];
            if (!current) return;
            masteredIds.push(current.id);
            localStorage.setItem('mastered_kanji_n3', JSON.stringify(masteredIds));
            applyFilter();
        }

        function resetMastery() {
            if (confirm('Reset semua progress hafalan di modul ini?')) {
                masteredIds = [];
                localStorage.removeItem('mastered_kanji_n3');
                applyFilter();
            }
        }

        document.addEventListener('keydown', e => {
            if (e.code === 'Space')      { e.preventDefault(); toggleReveal(); }
            if (e.code === 'ArrowRight') nextCard();
            if (e.code === 'ArrowLeft')  prevCard();
        });

        window.onload = applyFilter;
    </script>
    @endif
</body>
</html>
