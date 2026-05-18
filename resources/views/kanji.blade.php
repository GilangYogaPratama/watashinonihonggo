<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N4 Kanji</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=JetBrains+Mono:wght@400;700&family=Noto+Sans+JP:wght@500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #fcfcfc;
            --bg-grid: #eeeeee;
            --primary: #ef4444;
            --accent-yellow: #facc15;
            --accent-gray: #94a3b8;
            --text-main: #334155;
            --text-muted: #64748b;
        }

        * { 
            box-sizing: border-box; 
            margin: 0; 
            padding: 0; 
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: 'JetBrains Mono', monospace;
            background-color: var(--bg-main);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
            touch-action: manipulation;
            user-select: none;
        }

        .background-grid {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: 
                linear-gradient(var(--bg-grid) 1px, transparent 1px),
                linear-gradient(90deg, var(--bg-grid) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: -1;
        }

        .container {
            width: 100%;
            max-width: 700px;
            padding: 2rem;
            z-index: 10;
        }

        .nav-header {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 2rem;
        }

        .nav-back {
            color: var(--accent-gray);
            text-decoration: none;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .nav-back:hover { color: var(--primary); }

        .header-section {
            border-bottom: 4px solid var(--primary);
            padding-bottom: 0.8rem;
            margin-bottom: 3rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        h1 { font-family: 'Orbitron', sans-serif; font-size: 1.5rem; letter-spacing: 2px; color: var(--primary); }

        .flashcard-container {
            perspective: 1500px;
            width: 100%;
            height: 420px;
            margin-bottom: 2rem;
        }

        @media (max-height: 700px) {
            .flashcard-container { height: 350px; }
            .kanji-char { font-size: 5rem !important; }
        }

        .flashcard {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .flashcard.is-flipped { transform: rotateY(180deg); }

        .card-face {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            background: #fff;
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            box-shadow: 10px 10px 0 rgba(0, 0, 0, 0.02);
        }

        .card-face.back { transform: rotateY(180deg); }

        .accent-tl { position: absolute; top: 15px; left: 15px; width: 15px; height: 15px; border-top: 3px solid var(--accent-gray); border-left: 3px solid var(--accent-gray); }
        .accent-br { position: absolute; bottom: 15px; right: 15px; width: 15px; height: 15px; border-bottom: 3px solid var(--accent-gray); border-right: 3px solid var(--accent-gray); }
        .accent-yellow-top { position: absolute; top: 0; left: 10%; width: 50px; height: 6px; background: var(--accent-yellow); }

        .kanji-char {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 7rem;
            font-weight: 900;
            color: var(--text-main);
            text-align: center;
        }

        .readings-box {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            margin-bottom: 2rem;
        }

        .reading-row {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .reading-label {
            font-size: 0.65rem;
            color: var(--accent-gray);
            width: 60px;
            text-align: right;
            letter-spacing: 2px;
            font-weight: 700;
        }

        .reading-val {
            font-size: 1.3rem;
            color: var(--primary);
            font-weight: 700;
            font-family: 'Noto Sans JP', sans-serif;
        }

        .meaning {
            font-size: 1.4rem;
            color: var(--text-main);
            font-weight: 700;
            padding: 1rem 2rem;
            background: rgba(239, 68, 68, 0.05);
            border-left: 6px solid var(--accent-yellow);
            width: 100%;
            text-align: center;
        }

        .controls {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            gap: 1.5rem;
            width: 100%;
        }

        .btn-action {
            background: #fff;
            border: 1px solid var(--text-main);
            color: var(--text-main);
            padding: 1rem;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.75rem;
            letter-spacing: 2px;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.2s;
        }

        .btn-action:hover { border-color: var(--primary); background: #f8fafc; }
        .btn-reveal { background: var(--primary); color: #fff; border: none; }

        .progress-section {
            margin-top: 3rem;
            width: 100%;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.7rem;
            color: var(--accent-gray);
            margin-bottom: 8px;
            font-weight: 700;
        }

        .reset-link {
            color: var(--primary);
            cursor: pointer;
            text-decoration: underline;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .progress-bar { width: 100%; height: 6px; background: #f1f5f9; position: relative; }
        .progress-fill { position: absolute; top: 0; left: 0; height: 100%; background: var(--primary); transition: width 0.3s; }

        .btn-master {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            font-size: 0.7rem;
            color: #fff;
            background: var(--primary);
            border: none;
            padding: 5px 12px;
            cursor: pointer;
            font-weight: 700;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-master:hover { opacity: 0.9; transform: scale(1.05); }

        @media (max-width: 600px) {
            .container { padding: 1rem; }
            .header-section { margin-bottom: 1.5rem; }
            .flashcard-container { height: 360px; margin-bottom: 1.5rem; }
            .card-face { padding: 1.5rem; }
            .kanji-char { font-size: 4.5rem; }
            .reading-val { font-size: 1.1rem; }
            .reading-row { gap: 1rem; }
            .meaning { font-size: 1.1rem; padding: 0.8rem 1rem; }
            .controls { gap: 0.5rem; }
            .btn-action { padding: 0.8rem 0.5rem; font-size: 0.65rem; }
            .btn-master { bottom: 1rem; left: 1rem; font-size: 0.65rem; padding: 4px 10px; }
            .progress-section { margin-top: 2rem; }
        }
    </style>
</head>
<body>
    <div class="background-grid"></div>
    <div class="container">
        <nav class="nav-header">
            <a href="{{ route('home') }}" class="nav-back"><- BACK_TO_SYNC</a>
        </nav>
        <div class="header-section">
            <h1 style="font-family: 'Orbitron';">KANJI_N4</h1>
            <div style="font-size: 0.6rem; letter-spacing: 1px; color: var(--text-muted); font-family: 'Orbitron'; font-weight: 700;">ANALYSIS_ONGOING</div>
        </div>
        <div class="flashcard-container">
            <div class="flashcard" id="flashcard" onclick="toggleReveal()">
                <!-- Front -->
                <div class="card-face front">
                    <div class="accent-tl"></div><div class="accent-br"></div>
                    <div class="accent-yellow-top"></div>
                    <div class="kanji-char" id="kanjiFront">---</div>
                </div>
                <!-- Back -->
                <div class="card-face back">
                    <div class="accent-tl"></div><div class="accent-br"></div>
                    <div class="accent-yellow-top"></div>
                    <div class="readings-box">
                        <div class="reading-row"><span class="reading-label">ONYOMI</span><span class="reading-val" id="onyomiBack">---</span></div>
                        <div class="reading-row"><span class="reading-label">KUNYOMI</span><span class="reading-val" id="kunyomiBack">---</span></div>
                    </div>
                    <div class="meaning" id="meaningBack">---</div>
                    <button class="btn-master" onclick="event.stopPropagation(); markAsMastered()">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        INGAT
                    </button>
                </div>
            </div>
        </div>
        <div class="controls">
            <button class="btn-action" style="font-family: 'Orbitron';" onclick="prevCard()">PREV</button>
            <button class="btn-action btn-reveal" style="font-family: 'Orbitron';" id="btnReveal" onclick="toggleReveal()">REVEAL</button>
            <button class="btn-action" style="font-family: 'Orbitron';" onclick="nextCard()">NEXT</button>
        </div>
        <div class="progress-section">
            <div class="progress-info">
                <span>PROGRESS_STATUS</span>
                <span class="reset-link" onclick="resetMastery()">RESET PROGRESS</span>
                <span id="progressCounter">000 / 000</span>
            </div>
            <div class="progress-bar"><div class="progress-fill" id="progressFill" style="width: 0%"></div></div>
        </div>
    </div>

    <script>
        const allKanjis = @json($kanjis);
        let kanjis = [];
        let masteredIds = JSON.parse(localStorage.getItem('mastered_kanji_n4') || '[]');

        function shuffleArray(array) { for (let i = array.length - 1; i > 0; i--) { const j = Math.floor(Math.random() * (i + 1)); [array[i], array[j]] = [array[j], array[i]]; } }
        
        let currentIndex = 0; let isFlipped = false;
        const flashcard = document.getElementById('flashcard');
        const kanjiFront = document.getElementById('kanjiFront');
        const onyomiBack = document.getElementById('onyomiBack');
        const kunyomiBack = document.getElementById('kunyomiBack');
        const meaningBack = document.getElementById('meaningBack');
        const progressFill = document.getElementById('progressFill');
        const progressCounter = document.getElementById('progressCounter');
        const btnReveal = document.getElementById('btnReveal');

        function applyFilter() {
            let remaining = allKanjis.filter(k => !masteredIds.includes(k.id));

            if (remaining.length === 0 && allKanjis.length > 0) {
                alert("Selamat! Semua kanji telah diingat. Progress akan direset.");
                masteredIds = [];
                localStorage.removeItem('mastered_kanji_n4');
                remaining = [...allKanjis];
            }

            kanjis = remaining;
            shuffleArray(kanjis);
            currentIndex = 0;
            isFlipped = false;
            flashcard.classList.remove('is-flipped');
            btnReveal.textContent = 'REVEAL';
            updateCardContent();
        }

        function markAsMastered() {
            const current = kanjis[currentIndex];
            if (!current) return;
            
            masteredIds.push(current.id);
            localStorage.setItem('mastered_kanji_n4', JSON.stringify(masteredIds));
            applyFilter();
        }

        function resetMastery() {
            if (confirm("Reset semua progress hafalan di modul ini?")) {
                masteredIds = [];
                localStorage.removeItem('mastered_kanji_n4');
                applyFilter();
            }
        }

        function updateCardContent() {
            if (kanjis.length === 0) {
                kanjiFront.textContent = "DONE";
                progressCounter.textContent = "0 / 0";
                progressFill.style.width = "0%";
                return;
            }
            const current = kanjis[currentIndex];
            kanjiFront.textContent = current.kanji;
            onyomiBack.textContent = current.onyomi || '---';
            kunyomiBack.textContent = current.kunyomi || '---';
            meaningBack.textContent = current.arti;
            
            const total = kanjis.length;
            const currentNum = currentIndex + 1;
            progressCounter.textContent = `${currentNum} / ${total}`;
            progressFill.style.width = `${(currentNum / total) * 100}%`;
        }

        function toggleReveal() { isFlipped = !isFlipped; flashcard.classList.toggle('is-flipped', isFlipped); btnReveal.textContent = isFlipped ? 'SECURE' : 'REVEAL'; }
        function nextCard() { isFlipped = false; flashcard.classList.remove('is-flipped'); btnReveal.textContent = 'REVEAL'; currentIndex = (currentIndex + 1) % kanjis.length; updateCardContent(); }
        function prevCard() { isFlipped = false; flashcard.classList.remove('is-flipped'); btnReveal.textContent = 'REVEAL'; currentIndex = (currentIndex - 1 + kanjis.length) % kanjis.length; updateCardContent(); }

        document.addEventListener('keydown', (e) => {
            if (e.code === 'Space') { e.preventDefault(); toggleReveal(); }
            if (e.code === 'ArrowRight') nextCard();
            if (e.code === 'ArrowLeft') prevCard();
        });
        
        window.onload = applyFilter;
    </script>
</body>
</html>
