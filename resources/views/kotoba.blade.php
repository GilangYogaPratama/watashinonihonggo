<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N4 Kotoba</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=JetBrains+Mono:wght@400;700&family=Noto+Sans+JP:wght@500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #fcfcfc;
            --bg-grid: #eeeeee;
            --primary: #22c55e;
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
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            position: relative;
            overflow-x: hidden;
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
            justify-content: space-between;
            align-items: center;
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

        .mode-toggle {
            display: flex;
            align-items: center;
            background: #fff;
            padding: 6px 15px;
            border: 1px solid var(--accent-gray);
            cursor: pointer;
            font-size: 0.7rem;
            color: var(--text-main);
            font-weight: 700;
        }

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
            height: 380px;
            margin-bottom: 2rem;
        }

        @media (max-height: 700px) {
            .flashcard-container { height: 320px; }
            .japanese-word { font-size: 3rem !important; }
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

        .japanese-word {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 4rem;
            font-weight: 900;
            color: var(--text-main);
            text-align: center;
        }

        .reading {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .meaning {
            font-size: 1.2rem;
            color: var(--text-main);
            margin-top: 2rem;
            font-weight: 700;
            padding: 1rem 2rem;
            background: rgba(34, 197, 94, 0.05);
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

        .bab-filter-section {
            margin-top: 2rem;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .bab-filter-label {
            font-size: 0.6rem;
            color: var(--accent-gray);
            letter-spacing: 2px;
            font-weight: 700;
            text-transform: uppercase;
            display: flex;
            justify-content: space-between;
        }

        .reset-link {
            color: var(--primary);
            cursor: pointer;
            text-decoration: underline;
        }

        .bab-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .bab-btn {
            background: #fff;
            border: 1px solid var(--accent-gray);
            padding: 4px 10px;
            font-size: 0.65rem;
            font-family: 'JetBrains Mono', monospace;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--text-muted);
        }

        .bab-btn:hover { border-color: var(--primary); color: var(--primary); }
        .bab-btn.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

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

        .bab-tag {
            position: absolute;
            top: 2rem;
            left: 2rem;
            font-size: 0.7rem;
            background: var(--text-main);
            color: #fff;
            padding: 4px 10px;
            font-weight: 700;
            border-bottom: 4px solid var(--accent-yellow);
        }

        @media (max-width: 600px) {
            .container { padding: 1rem; }
            .header-section { margin-bottom: 1.5rem; }
            .flashcard-container { height: 330px; margin-bottom: 1.5rem; }
            .card-face { padding: 1.5rem; }
            .japanese-word { font-size: 2.5rem !important; }
            .reading { font-size: 1.2rem; }
            .meaning { font-size: 1rem; padding: 0.8rem 1rem; margin-top: 1rem; }
            .controls { gap: 0.5rem; }
            .btn-action { padding: 0.8rem 0.5rem; font-size: 0.65rem; }
            .btn-master { bottom: 1rem; left: 1rem; font-size: 0.65rem; padding: 4px 10px; }
            .bab-tag { top: 1rem; left: 1rem; font-size: 0.65rem; padding: 3px 8px; }
            .bab-filter-section { margin-top: 1.5rem; }
            .bab-btn { padding: 4px 8px; font-size: 0.6rem; }
        }
    </style>
</head>
<body>
    <div class="background-grid"></div>
    <div class="container">
        <nav class="nav-header">
            <a href="{{ route('home') }}" class="nav-back"><- BACK_TO_SYNC</a>
            <div class="mode-toggle" style="font-family: 'Orbitron';" onclick="toggleMode()">
                <span id="modeText">MODE: JP -> ID</span>
            </div>
        </nav>
        <div class="header-section">
            <h1 style="font-family: 'Orbitron';">KOTOBA_N4</h1>
            <div style="font-size: 0.6rem; letter-spacing: 1px; color: var(--text-muted); font-family: 'Orbitron'; font-weight: 700;">ANALYSIS_ONGOING</div>
        </div>
        <div class="flashcard-container">
            <div class="flashcard" id="flashcard" onclick="toggleReveal()">
                <div class="card-face front">
                    <div class="accent-tl"></div><div class="accent-br"></div>
                    <div class="accent-yellow-top"></div>
                    <div class="bab-tag" id="babTagFront" style="font-family: 'Orbitron';">BAB 00</div>
                    <div class="japanese-word" id="wordFront">---</div>
                </div>
                <div class="card-face back">
                    <div class="accent-tl"></div><div class="accent-br"></div>
                    <div class="accent-yellow-top"></div>
                    <div class="bab-tag" id="babTagBack" style="font-family: 'Orbitron';">BAB 00</div>
                    <div class="reading" id="readingBack">---</div>
                    <div class="japanese-word" id="wordBack" style="font-size: 2.5rem; color: var(--primary);">---</div>
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
                <span id="progressCounter">00 / 00</span>
            </div>
            <div class="progress-bar"><div class="progress-fill" id="progressFill" style="width: 0%"></div></div>
        </div>

        <div class="bab-filter-section">
            <div class="bab-filter-label">
                <span>Pilih Bab/Modul</span>
                <span class="reset-link" onclick="resetMastery()">RESET PROGRESS</span>
            </div>
            <div class="bab-grid" id="babGrid">
                <!-- Injected via JS -->
            </div>
        </div>
    </div>

    <script>
        const allKotobas = @json($kotobas);
        let kotobas = [];
        let selectedBab = 'all';
        let masteredIds = JSON.parse(localStorage.getItem('mastered_kotoba_n4') || '[]');

        function shuffleArray(array) { for (let i = array.length - 1; i > 0; i--) { const j = Math.floor(Math.random() * (i + 1)); [array[i], array[j]] = [array[j], array[i]]; } }
        
        let currentIndex = 0; let isFlipped = false; let isJpToId = true;
        const flashcard = document.getElementById('flashcard');
        const wordFront = document.getElementById('wordFront');
        const wordBack = document.getElementById('wordBack');
        const readingBack = document.getElementById('readingBack');
        const meaningBack = document.getElementById('meaningBack');
        const babTagFront = document.getElementById('babTagFront');
        const babTagBack = document.getElementById('babTagBack');
        const progressFill = document.getElementById('progressFill');
        const progressCounter = document.getElementById('progressCounter');
        const btnReveal = document.getElementById('btnReveal');
        const modeText = document.getElementById('modeText');
        const babGrid = document.getElementById('babGrid');

        function initBabSelector() {
            const babs = [...new Set(allKotobas.map(k => k.bab))].sort((a, b) => a - b);
            
            const allBtn = document.createElement('button');
            allBtn.className = 'bab-btn active';
            allBtn.textContent = 'Semua';
            allBtn.onclick = () => filterByBab('all');
            babGrid.appendChild(allBtn);

            babs.forEach(bab => {
                const btn = document.createElement('button');
                btn.className = 'bab-btn';
                btn.textContent = `BAB ${bab}`;
                btn.onclick = () => filterByBab(bab);
                babGrid.appendChild(btn);
            });
        }

        function filterByBab(bab) {
            selectedBab = bab;
            const btns = document.querySelectorAll('.bab-btn');
            btns.forEach(b => b.classList.remove('active'));

            if (bab === 'all') {
                btns[0].classList.add('active');
            } else {
                btns.forEach(b => { if (b.textContent === `BAB ${bab}`) b.classList.add('active'); });
            }
            
            applyFilter();
        }

        function applyFilter() {
            let filtered = (selectedBab === 'all') 
                ? [...allKotobas] 
                : allKotobas.filter(k => k.bab === selectedBab);
            
            // Filter out mastered ones
            let remaining = filtered.filter(k => !masteredIds.includes(k.id));

            if (remaining.length === 0 && filtered.length > 0) {
                // All mastered in this set, auto-reset for this set
                alert("Selamat! Semua kosakata di bab ini telah diingat. Progress akan direset.");
                masteredIds = masteredIds.filter(id => !filtered.map(f => f.id).includes(id));
                localStorage.setItem('mastered_kotoba_n4', JSON.stringify(masteredIds));
                remaining = filtered;
            }

            kotobas = remaining;
            shuffleArray(kotobas);
            currentIndex = 0;
            isFlipped = false;
            flashcard.classList.remove('is-flipped');
            btnReveal.textContent = 'REVEAL';
            updateCardContent();
        }

        function markAsMastered() {
            const current = kotobas[currentIndex];
            if (!current) return;
            
            masteredIds.push(current.id);
            localStorage.setItem('mastered_kotoba_n4', JSON.stringify(masteredIds));
            
            // Re-apply filter and keep place
            applyFilter();
        }

        function resetMastery() {
            if (confirm("Reset semua progress hafalan di modul ini?")) {
                masteredIds = [];
                localStorage.removeItem('mastered_kotoba_n4');
                applyFilter();
            }
        }

        function toggleMode() {
            isJpToId = !isJpToId;
            modeText.textContent = `MODE: ${isJpToId ? 'JP -> ID' : 'ID -> JP'}`;
            if (isFlipped) toggleReveal();
            updateCardContent();
        }

        function updateCardContent() {
            if (kotobas.length === 0) {
                wordFront.textContent = "DONE";
                progressCounter.textContent = "0 / 0";
                progressFill.style.width = "0%";
                return;
            }
            const current = kotobas[currentIndex];
            const invalidKanji = !current.kanji || ['-', '—', '–', 'ー', '_'].includes(current.kanji.trim());
            const displayJp = invalidKanji ? current.japanese : current.kanji;
            if (isJpToId) {
                wordFront.textContent = displayJp;
                wordFront.style.fontSize = displayJp.length > 8 ? '2.5rem' : '4rem';
                wordBack.textContent = displayJp;
                readingBack.textContent = current.japanese;
                readingBack.style.display = (displayJp === current.japanese) ? 'none' : 'block';
                meaningBack.textContent = current.arti_indonesia;
                meaningBack.style.display = 'block';
            } else {
                wordFront.textContent = current.arti_indonesia;
                wordFront.style.fontSize = current.arti_indonesia.length > 15 ? '1.5rem' : '2.5rem';
                wordBack.textContent = displayJp;
                readingBack.textContent = current.japanese;
                readingBack.style.display = (displayJp === current.japanese) ? 'none' : 'block';
                meaningBack.style.display = 'none';
            }
            babTagFront.textContent = `BAB ${current.bab || '??'}`;
            babTagBack.textContent = `BAB ${current.bab || '??'}`;
            
            const total = kotobas.length;
            const currentNum = currentIndex + 1;
            progressCounter.textContent = `${currentNum} / ${total}`;
            progressFill.style.width = `${(currentNum / total) * 100}%`;
        }

        function toggleReveal() { isFlipped = !isFlipped; flashcard.classList.toggle('is-flipped', isFlipped); btnReveal.textContent = isFlipped ? 'SECURE' : 'REVEAL'; }
        function nextCard() { isFlipped = false; flashcard.classList.remove('is-flipped'); btnReveal.textContent = 'REVEAL'; currentIndex = (currentIndex + 1) % kotobas.length; updateCardContent(); }
        function prevCard() { isFlipped = false; flashcard.classList.remove('is-flipped'); btnReveal.textContent = 'REVEAL'; currentIndex = (currentIndex - 1 + kotobas.length) % kotobas.length; updateCardContent(); }

        document.addEventListener('keydown', (e) => {
            if (e.code === 'Space') { e.preventDefault(); toggleReveal(); }
            if (e.code === 'ArrowRight') nextCard();
            if (e.code === 'ArrowLeft') prevCard();
        });
        
        window.onload = () => {
            initBabSelector();
            applyFilter();
        };
    </script>
</body>
</html>
