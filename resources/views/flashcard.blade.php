<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N4 Bunpo</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=JetBrains+Mono:wght@400;700&family=Noto+Sans+JP:wght@500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #fcfcfc;
            --bg-grid: #eeeeee;
            --primary: #3b82f6;
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
            border-bottom: 1px solid transparent;
        }

        .nav-back:hover { color: var(--primary); border-bottom-color: var(--primary); }

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
            transition: all 0.2s;
        }

        .mode-toggle:hover { border-color: var(--accent-yellow); background: #fafafa; }

        .header-section {
            border-bottom: 4px solid var(--primary);
            padding-bottom: 0.8rem;
            margin-bottom: 2.5rem;
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
            .japanese-pattern { font-size: 2.5rem !important; }
        }

        .flashcard {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .flashcard.is-flipped { transform: rotateX(180deg); }

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

        .card-face.back { transform: rotateX(180deg); }

        /* Matte Accents */
        .accent-tl { position: absolute; top: 15px; left: 15px; width: 15px; height: 15px; border-top: 3px solid var(--accent-gray); border-left: 3px solid var(--accent-gray); }
        .accent-br { position: absolute; bottom: 15px; right: 15px; width: 15px; height: 15px; border-bottom: 3px solid var(--accent-gray); border-right: 3px solid var(--accent-gray); }
        .accent-yellow-top { position: absolute; top: 0; left: 10%; width: 50px; height: 6px; background: var(--accent-yellow); }

        .japanese-pattern {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 3.5rem;
            font-weight: 900;
            color: var(--text-main);
            text-align: center;
        }

        .meaning {
            font-size: 1.2rem;
            color: var(--primary);
            margin-top: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .example-jp {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 1.4rem;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            line-height: 1.8;
        }

        .example-id { font-size: 0.95rem; color: var(--text-muted); font-style: italic; }

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

        .btn-action:hover {
            border-color: var(--primary);
            background: #f8fafc;
        }

        .btn-reveal {
            background: var(--primary);
            color: #fff;
            border: none;
        }

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

        .furi-toggle {
            position: absolute;
            bottom: 2rem;
            right: 2rem;
            font-size: 0.7rem;
            color: var(--text-main);
            border: 1px solid var(--text-main);
            padding: 4px 10px;
            cursor: pointer;
            font-weight: 700;
            background: #fff;
        }

        .furi-toggle.active { background: var(--accent-yellow); border-color: var(--accent-yellow); }

        ruby rt { color: var(--primary); display: none; }
        .show-furigana ruby rt { display: ruby-text; }

        @media (max-width: 600px) {
            .container { padding: 1rem; }
            .header-section { margin-bottom: 1.5rem; }
            .flashcard-container { height: 380px; margin-bottom: 1.5rem; }
            .card-face { padding: 1.5rem; }
            .japanese-pattern { font-size: 1.8rem !important; }
            .meaning { font-size: 1rem; margin-top: 1rem; }
            .example-jp { font-size: 1.1rem; }
            .example-id { font-size: 0.85rem; }
            .controls { gap: 0.5rem; }
            .btn-action { padding: 0.8rem 0.5rem; font-size: 0.65rem; }
            .btn-master { bottom: 1rem; left: 1rem; font-size: 0.65rem; padding: 4px 10px; }
            .furi-toggle { bottom: 1rem; right: 1rem; font-size: 0.65rem; padding: 4px 10px; }
            .progress-section { margin-top: 2rem; }
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
            <h1 style="font-family: 'Orbitron';">BUNPO_N4</h1>
            <div style="font-size: 0.6rem; letter-spacing: 1px; color: var(--text-muted); font-family: 'Orbitron'; font-weight: 700;">ANALYSIS_ONGOING</div>
        </div>
        <div class="flashcard-container">
            <div class="flashcard" id="flashcard" onclick="toggleReveal()">
                <div class="card-face front">
                    <div class="accent-tl"></div><div class="accent-br"></div>
                    <div class="accent-yellow-top"></div>
                    <div class="japanese-pattern" id="patternText">---</div>
                </div>
                <div class="card-face back">
                    <div class="accent-tl"></div><div class="accent-br"></div>
                    <div class="accent-yellow-top"></div>
                    <div class="japanese-pattern" id="patternTextBack" style="font-size: 2.2rem; color: var(--primary);">---</div>
                    <div class="meaning" id="meaningText">---</div>
                    <div style="margin-top: 2rem; text-align: center; width: 100%;">
                        <div class="example-jp" id="exampleJp"></div>
                        <div class="example-id" id="exampleId"></div>
                    </div>
                    <button class="btn-master" onclick="event.stopPropagation(); markAsMastered()">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        INGAT
                    </button>
                    <div class="furi-toggle" id="furiBtn" style="font-family: 'Orbitron';" onclick="event.stopPropagation(); toggleFurigana()">FURIGANA: OFF</div>
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
                <span id="progressCounter">00 / 00</span>
            </div>
            <div class="progress-bar"><div class="progress-fill" id="progressFill" style="width: 0%"></div></div>
        </div>
    </div>

    <script>
        const allBunpos = @json($bunpos);
        let bunpos = [];
        let masteredIds = JSON.parse(localStorage.getItem('mastered_bunpo_n4') || '[]');

        function shuffleArray(array) { for (let i = array.length - 1; i > 0; i--) { const j = Math.floor(Math.random() * (i + 1)); [array[i], array[j]] = [array[j], array[i]]; } }
        
        let currentIndex = 0; let isFlipped = false; let isJpToId = true; let showFurigana = false;
        
        const flashcard = document.getElementById('flashcard');
        const patternText = document.getElementById('patternText');
        const patternTextBack = document.getElementById('patternTextBack');
        const meaningText = document.getElementById('meaningText');
        const exampleJp = document.getElementById('exampleJp');
        const exampleId = document.getElementById('exampleId');
        const progressFill = document.getElementById('progressFill');
        const progressCounter = document.getElementById('progressCounter');
        const btnReveal = document.getElementById('btnReveal');
        const modeText = document.getElementById('modeText');
        const furiBtn = document.getElementById('furiBtn');

        function applyFilter() {
            let remaining = allBunpos.filter(b => !masteredIds.includes(b.id));

            if (remaining.length === 0 && allBunpos.length > 0) {
                alert("Selamat! Semua tata bahasa telah diingat. Progress akan direset.");
                masteredIds = [];
                localStorage.removeItem('mastered_bunpo_n4');
                remaining = [...allBunpos];
            }

            bunpos = remaining;
            shuffleArray(bunpos);
            currentIndex = 0;
            isFlipped = false;
            flashcard.classList.remove('is-flipped');
            btnReveal.textContent = 'REVEAL';
            updateCardContent();
        }

        function markAsMastered() {
            const current = bunpos[currentIndex];
            if (!current) return;
            
            masteredIds.push(current.id);
            localStorage.setItem('mastered_bunpo_n4', JSON.stringify(masteredIds));
            applyFilter();
        }

        function resetMastery() {
            if (confirm("Reset semua progress hafalan di modul ini?")) {
                masteredIds = [];
                localStorage.removeItem('mastered_bunpo_n4');
                applyFilter();
            }
        }

        function toggleMode() {
            isJpToId = !isJpToId;
            modeText.textContent = `MODE: ${isJpToId ? 'JP -> ID' : 'ID -> JP'}`;
            if (isFlipped) toggleReveal();
            updateCardContent();
        }

        function toggleFurigana() {
            showFurigana = !showFurigana;
            furiBtn.textContent = `FURIGANA: ${showFurigana ? 'ON' : 'OFF'}`;
            furiBtn.classList.toggle('active', showFurigana);
            exampleJp.classList.toggle('show-furigana', showFurigana);
        }

        function updateCardContent() {
            if (bunpos.length === 0) {
                patternText.textContent = "DONE";
                progressCounter.textContent = "0 / 0";
                progressFill.style.width = "0%";
                return;
            }
            const current = bunpos[currentIndex];
            if (isJpToId) {
                patternText.textContent = current.pattern;
                patternText.style.fontSize = '3.5rem';
                patternTextBack.textContent = current.pattern;
                meaningText.textContent = current.meaning;
                meaningText.style.display = 'block';
            } else {
                patternText.textContent = current.meaning;
                patternText.style.fontSize = '2rem';
                patternTextBack.textContent = current.pattern;
                meaningText.style.display = 'none';
            }
            
            let fullExample = current.example || '';
            let jpPart = fullExample;
            let idPart = current.example_arti || '';

            if (fullExample.includes('(') && fullExample.includes(')')) {
                const match = fullExample.match(/(.*)\((.*)\)/);
                if (match) {
                    jpPart = match[1].trim();
                    idPart = match[2].trim();
                }
            }

            let jpProcessed = jpPart.replace(/\{(.*?)\|(.*?)\}/g, '<ruby>$1<rt>$2</rt></ruby>');
            exampleJp.innerHTML = jpProcessed;
            exampleId.textContent = idPart ? `[ ${idPart} ]` : '';
            
            const total = bunpos.length;
            const currentNum = currentIndex + 1;
            progressCounter.textContent = `${currentNum} / ${total}`;
            progressFill.style.width = `${(currentNum / total) * 100}%`;
        }

        function toggleReveal() {
            isFlipped = !isFlipped;
            flashcard.classList.toggle('is-flipped', isFlipped);
            btnReveal.textContent = isFlipped ? 'SECURE' : 'REVEAL';
        }

        function nextCard() { isFlipped = false; flashcard.classList.remove('is-flipped'); btnReveal.textContent = 'REVEAL'; currentIndex = (currentIndex + 1) % bunpos.length; updateCardContent(); }
        function prevCard() { isFlipped = false; flashcard.classList.remove('is-flipped'); btnReveal.textContent = 'REVEAL'; currentIndex = (currentIndex - 1 + bunpos.length) % bunpos.length; updateCardContent(); }

        document.addEventListener('keydown', (e) => {
            if (e.code === 'Space') { e.preventDefault(); toggleReveal(); }
            if (e.code === 'ArrowRight') nextCard();
            if (e.code === 'ArrowLeft') prevCard();
        });
        
        window.onload = applyFilter;
    </script>
</body>
</html>
