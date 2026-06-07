<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tata Bahasa N3 - Watashi no Nihongo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #f8fafc;
            --bg-card: rgba(255, 255, 255, 0.95);
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: rgba(226, 232, 240, 0.8);
            --primary: #3b82f6; /* Blue accent for Bunpo */
            --primary-hover: #2563eb;
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

        .nav-back:hover {
            color: var(--indigo);
        }

        .nav-back svg {
            margin-right: 6px;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .level-badge {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary);
            background-color: #eff6ff;
            padding: 4px 10px;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .empty-state {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .empty-state h3 {
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }

        .empty-state p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

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

        .btn-link:hover {
            background-color: var(--indigo-hover);
        }

        .flashcard-container {
            perspective: 1500px;
            width: 100%;
            height: 420px;
            margin-bottom: 2rem;
        }

        .flashcard {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .flashcard.is-flipped {
            transform: rotateY(180deg);
        }

        .card-face {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2.5rem;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.05), 0 10px 15px -5px rgba(0, 0, 0, 0.02);
        }

        .card-face.back {
            transform: rotateY(180deg);
        }

        .pattern-char {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 3.5rem;
            font-weight: 900;
            color: var(--text-main);
            text-align: center;
            line-height: 1.3;
        }

        .meaning {
            font-size: 1.25rem;
            color: var(--primary);
            font-weight: 700;
            padding: 0.75rem 1.5rem;
            background: #eff6ff;
            border-radius: 8px;
            width: 100%;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .example-box {
            width: 100%;
            text-align: center;
        }

        .example-jp {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 1.2rem;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            line-height: 1.6;
        }

        .example-id {
            font-size: 0.95rem;
            color: var(--text-muted);
            font-style: italic;
        }

        ruby rt { color: var(--primary); display: ruby-text; }

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
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-action:hover {
            border-color: var(--primary);
            background: #fafafa;
        }

        .btn-reveal {
            background: var(--primary);
            color: #fff;
            border: none;
        }

        .btn-reveal:hover {
            background: var(--primary-hover);
        }

        .btn-master {
            position: absolute;
            bottom: 1.5rem;
            right: 1.5rem;
            font-size: 0.75rem;
            color: #ffffff;
            background: var(--indigo);
            border: none;
            padding: 6px 14px;
            border-radius: 9999px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: background-color 0.2s;
        }

        .btn-master:hover {
            background-color: var(--indigo-hover);
        }

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

        .reset-link {
            color: var(--indigo);
            cursor: pointer;
            text-decoration: underline;
        }

        .reset-link:hover {
            color: var(--indigo-hover);
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e2e8f0;
            border-radius: 9999px;
            position: relative;
            overflow: hidden;
        }

        .progress-fill {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background: var(--primary);
            transition: width 0.3s;
        }

        @media (max-width: 600px) {
            .flashcard-container {
                height: 380px;
            }
            .pattern-char {
                font-size: 2.5rem;
            }
            .card-face {
                padding: 1.5rem;
            }
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
            <h1>Tata Bahasa N3</h1>
            <span class="level-badge">JLPT N3</span>
        </div>

        @if(count($bunpos) === 0)
            <div class="empty-state">
                <h3>Belum ada Tata Bahasa N3</h3>
                <p>Data Tata Bahasa N3 di database masih kosong.</p>
                <a href="{{ route('home') }}" class="btn-link">Kembali</a>
            </div>
        @else
            <div class="flashcard-container">
                <div class="flashcard" id="flashcard" onclick="toggleReveal()">
                    <!-- Front -->
                    <div class="card-face front">
                        <div class="pattern-char" id="patternFront">---</div>
                    </div>
                    <!-- Back -->
                    <div class="card-face back">
                        <div class="pattern-char" id="patternBack" style="font-size: 2rem; color: var(--primary); margin-bottom: 1rem;">---</div>
                        <div class="meaning" id="meaningBack">---</div>
                        <div class="example-box">
                            <div class="example-jp" id="exampleJp"></div>
                            <div class="example-id" id="exampleId"></div>
                        </div>
                        <button class="btn-master" onclick="event.stopPropagation(); markAsMastered()">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            Ingat
                        </button>
                    </div>
                </div>
            </div>

            <div class="controls">
                <button class="btn-action" onclick="prevCard()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px;">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Prev
                </button>
                <button class="btn-action btn-reveal" id="btnReveal" onclick="toggleReveal()">Reveal</button>
                <button class="btn-action" onclick="nextCard()">
                    Next
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px;">
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

    @if(count($bunpos) > 0)
        <script>
            const allBunpos = @json($bunpos);
            let bunpos = [];
            let masteredIds = JSON.parse(localStorage.getItem('mastered_bunpo_n3') || '[]');

            function shuffleArray(array) { 
                for (let i = array.length - 1; i > 0; i--) { 
                    const j = Math.floor(Math.random() * (i + 1)); 
                    [array[i], array[j]] = [array[j], array[i]]; 
                } 
            }
            
            let currentIndex = 0; 
            let isFlipped = false;
            
            const flashcard = document.getElementById('flashcard');
            const patternFront = document.getElementById('patternFront');
            const patternBack = document.getElementById('patternBack');
            const meaningBack = document.getElementById('meaningBack');
            const exampleJp = document.getElementById('exampleJp');
            const exampleId = document.getElementById('exampleId');
            const progressFill = document.getElementById('progressFill');
            const progressCounter = document.getElementById('progressCounter');
            const btnReveal = document.getElementById('btnReveal');

            function applyFilter() {
                let remaining = allBunpos.filter(b => !masteredIds.includes(b.id));

                if (remaining.length === 0 && allBunpos.length > 0) {
                    alert("Selamat! Semua tata bahasa N3 telah diingat. Progress akan direset.");
                    masteredIds = [];
                    localStorage.removeItem('mastered_bunpo_n3');
                    remaining = [...allBunpos];
                }

                bunpos = remaining;
                shuffleArray(bunpos);
                currentIndex = 0;
                isFlipped = false;
                flashcard.classList.remove('is-flipped');
                btnReveal.textContent = 'Reveal';
                updateCardContent();
            }

            function markAsMastered() {
                const current = bunpos[currentIndex];
                if (!current) return;
                
                masteredIds.push(current.id);
                localStorage.setItem('mastered_bunpo_n3', JSON.stringify(masteredIds));
                applyFilter();
            }

            function resetMastery() {
                if (confirm("Reset semua progress hafalan di modul ini?")) {
                    masteredIds = [];
                    localStorage.removeItem('mastered_bunpo_n3');
                    applyFilter();
                }
            }

            function updateCardContent() {
                if (bunpos.length === 0) {
                    patternFront.textContent = "DONE";
                    progressCounter.textContent = "0 / 0";
                    progressFill.style.width = "0%";
                    return;
                }
                const current = bunpos[currentIndex];
                patternFront.textContent = current.pattern;
                patternBack.textContent = current.pattern;
                meaningBack.textContent = current.meaning || '—';
                
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
                btnReveal.textContent = isFlipped ? 'Hide' : 'Reveal'; 
            }
            
            function nextCard() { 
                isFlipped = false; 
                flashcard.classList.remove('is-flipped'); 
                btnReveal.textContent = 'Reveal'; 
                currentIndex = (currentIndex + 1) % bunpos.length; 
                updateCardContent(); 
            }
            
            function prevCard() { 
                isFlipped = false; 
                flashcard.classList.remove('is-flipped'); 
                btnReveal.textContent = 'Reveal'; 
                currentIndex = (currentIndex - 1 + bunpos.length) % bunpos.length; 
                updateCardContent(); 
            }

            document.addEventListener('keydown', (e) => {
                if (e.code === 'Space') { e.preventDefault(); toggleReveal(); }
                if (e.code === 'ArrowRight') nextCard();
                if (e.code === 'ArrowLeft') prevCard();
            });
            
            window.onload = applyFilter;
        </script>
    @endif
</body>
</html>
