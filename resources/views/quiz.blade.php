<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Kanji & Kosakata {{ $level }} - Watashi no Nihongo</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --primary: #8b5cf6; /* Violet/Purple for Quiz */
            --primary-hover: #7c3aed;
            --primary-light: #f5f3ff;
            --success: #10b981;
            --success-light: #ecfdf5;
            --error: #ef4444;
            --error-light: #fef2f2;
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
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            user-select: none;
            position: relative;
            overflow-x: hidden;
        }

        body::before, body::after {
            content: '';
            position: absolute;
            width: 40vw;
            height: 40vw;
            border-radius: 50%;
            filter: blur(100px);
            z-index: -1;
            opacity: 0.5;
            animation: pulse-blob 10s infinite alternate;
        }

        body::before {
            top: -10vw;
            left: -10vw;
            background: rgba(139, 92, 246, 0.2);
        }

        body::after {
            bottom: -10vw;
            right: -10vw;
            background: rgba(16, 185, 129, 0.15);
            animation-delay: -5s;
        }

        @keyframes pulse-blob {
            0% { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.1) translate(20px, 20px); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .container {
            width: 100%;
            max-width: 650px;
            z-index: 10;
        }

        .nav-header {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 1.5rem;
            width: 100%;
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
            color: var(--primary);
        }

        .nav-back svg {
            margin-right: 6px;
        }

        .panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.05), 0 10px 15px -5px rgba(0, 0, 0, 0.02);
            width: 100%;
            min-height: 380px;
            display: flex;
            flex-direction: column;
        }

        h2.title {
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* Config / Setup Screen */
        .config-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--text-main);
        }

        .menu-options {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .option-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            padding: 1rem 1.25rem;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .option-card:hover {
            border-color: var(--primary);
            background-color: #fafafa;
        }

        .option-card.active {
            border-color: var(--primary);
            background-color: var(--primary-light);
            border-left: 4px solid var(--primary);
        }

        .option-details {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .option-title {
            font-size: 0.95rem;
            font-weight: 700;
        }

        .option-desc {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .option-badge {
            font-size: 0.7rem;
            padding: 2px 8px;
            background: #f1f5f9;
            color: var(--text-muted);
            border-radius: 4px;
            font-weight: 600;
        }

        .option-card.active .option-badge {
            background: var(--primary);
            color: #ffffff;
        }

        .selector-group {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            width: 100%;
            margin-bottom: 2rem;
        }

        .selector-btn {
            background: #ffffff;
            border: 1px solid var(--border-color);
            padding: 10px;
            font-family: inherit;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s;
            text-align: center;
        }

        .selector-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .selector-btn.active {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
        }

        .btn-launch {
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            color: #ffffff;
            border: none;
            padding: 1rem;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 700;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
            width: 100%;
            margin-top: auto;
            box-shadow: 0 4px 6px -1px rgba(139, 92, 246, 0.3);
        }

        .btn-launch:hover {
            box-shadow: 0 10px 15px -3px rgba(139, 92, 246, 0.4);
            transform: translateY(-2px);
        }

        /* Gameplay Screen */
        .hud-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 2rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border-color);
        }

        .hud-value {
            color: var(--text-main);
            font-weight: 700;
        }

        .target-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .target-char {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 5rem;
            font-weight: 900;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .target-prompt {
            font-size: 0.95rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .meaning-reveal {
            display: none;
            margin-top: 1.5rem;
            font-size: 1.1rem;
            color: var(--text-main);
            font-weight: 700;
            background: var(--primary-light);
            padding: 10px 20px;
            border-radius: 8px;
            border: 1px solid rgba(139, 92, 246, 0.2);
            animation: fadeIn 0.5s ease;
        }

        .choices-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            width: 100%;
            margin-bottom: 1.5rem;
        }

        .choice-btn {
            background: #ffffff;
            border: 1px solid var(--border-color);
            padding: 1rem 1.25rem;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-main);
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s;
            text-align: left;
            display: flex;
            align-items: center;
        }

        .choice-btn:hover:not(:disabled) {
            border-color: var(--primary);
            background-color: #fafafa;
        }

        .choice-btn:disabled {
            cursor: default;
        }

        .choice-label {
            color: var(--text-muted);
            font-size: 0.75rem;
            margin-right: 8px;
            font-weight: 700;
            background: #f1f5f9;
            padding: 2px 6px;
            border-radius: 4px;
        }

        /* Gameplay Colors */
        .choice-btn.correct {
            border-color: var(--success) !important;
            background-color: var(--success-light) !important;
            color: var(--success) !important;
        }

        .choice-btn.incorrect {
            border-color: var(--error) !important;
            background-color: var(--error-light) !important;
            color: var(--error) !important;
        }

        .progress-section {
            width: 100%;
            margin-top: auto;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 6px;
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
            height: 100%;
            background: var(--primary);
            width: 0%;
            transition: width 0.3s;
        }

        .action-row {
            width: 100%;
            margin-top: 1rem;
            display: flex;
            justify-content: flex-end;
            min-height: 45px;
        }

        .btn-next {
            background: var(--text-main);
            color: #ffffff;
            border: none;
            padding: 0.65rem 1.5rem;
            font-family: inherit;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s;
            display: none;
        }

        .btn-next:hover {
            background-color: var(--primary);
        }

        /* Summary Screen */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            width: 100%;
            margin-bottom: 2rem;
        }

        .metric-card {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 1.25rem;
            text-align: center;
        }

        .metric-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .metric-value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .telemetry-container {
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .telemetry-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
            text-align: left;
        }

        .telemetry-table th {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 600;
            background: #f8fafc;
            padding: 10px;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 5;
        }

        .telemetry-table td {
            padding: 10px;
            border-bottom: 1px solid #f1f5f9;
        }

        .status-badge {
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
            color: #ffffff;
            display: inline-block;
        }

        .status-badge.correct { background: var(--success); }
        .status-badge.incorrect { background: var(--error); }

        .btn-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            width: 100%;
            margin-top: auto;
        }

        .btn-action-quiz {
            background: #ffffff;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 0.875rem;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
            text-decoration: none;
        }

        .btn-action-quiz:hover {
            border-color: var(--primary);
            background: #fafafa;
        }

        .btn-action-quiz.btn-purple {
            background: var(--primary);
            color: #ffffff;
            border: none;
        }

        .btn-action-quiz.btn-purple:hover {
            background-color: var(--primary-hover);
        }

        @media (max-width: 600px) {
            .choices-grid {
                grid-template-columns: 1fr;
            }
            .metrics-grid {
                grid-template-columns: 1fr;
            }
            .btn-group {
                grid-template-columns: 1fr;
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

        <!-- Setup Screen -->
        <div id="setupScreen" class="panel">
            <h2 class="title">Setup Evaluasi {{ $level }}</h2>
            
            <div style="margin-bottom: 1.5rem;">
                <span class="config-label">Pilih Tipe Evaluasi</span>
                <div class="menu-options">
                    <div class="option-card active" onclick="selectMode('kanji', this)">
                        <div class="option-details">
                            <span class="option-title">Membaca Kanji</span>
                            <span class="option-desc">Tebak cara membaca karakter Kanji (onyomi/kunyomi).</span>
                        </div>
                        <span class="option-badge">Modul 1</span>
                    </div>

                    <div class="option-card" onclick="selectMode('kotoba', this)">
                        <div class="option-details">
                            <span class="option-title">Membaca Kotoba</span>
                            <span class="option-desc">Tebak cara membaca kosakata ke dalam bentuk hiragana.</span>
                        </div>
                        <span class="option-badge">Modul 2</span>
                    </div>

                    <div class="option-card" onclick="selectMode('bunpo', this)">
                        <div class="option-details">
                            <span class="option-title">Tata Bahasa (Bunpo)</span>
                            <span class="option-desc">Pilih arti/makna yang tepat untuk pola tata bahasa.</span>
                        </div>
                        <span class="option-badge">Modul 3</span>
                    </div>

                    <div class="option-card" onclick="selectMode('mixed', this)">
                        <div class="option-details">
                            <span class="option-title">Evaluasi Gabungan</span>
                            <span class="option-desc">Evaluasi acak gabungan dari kanji, kosakata, dan tata bahasa.</span>
                        </div>
                        <span class="option-badge">Gabungan</span>
                    </div>
                </div>
            </div>

            <button class="btn-launch" onclick="initializeQuiz()">Mulai Evaluasi</button>
        </div>

        <!-- Gameplay Screen -->
        <div id="gameplayScreen" class="panel" style="display: none;">
            <div class="hud-row">
                <div>SOAL: <span id="currentNum" class="hud-value">01</span> / <span id="totalNum" class="hud-value">10</span></div>
                <div>MODE: <span id="activeMode" class="hud-value" style="color: var(--primary);">KANJI</span></div>
                <div>SKOR: <span id="currentScore" class="hud-value">0</span></div>
            </div>

            <div class="target-box">
                <span id="targetChar" class="target-char">漢</span>
                <span id="targetClue" class="target-prompt">Pilih arti atau cara baca yang benar</span>
                <div id="meaningReveal" class="meaning-reveal"></div>
            </div>

            <div class="choices-grid">
                <button class="choice-btn" onclick="submitAnswer(0)">
                    <span class="choice-label">A</span>
                    <span id="choice0">--</span>
                </button>
                <button class="choice-btn" onclick="submitAnswer(1)">
                    <span class="choice-label">B</span>
                    <span id="choice1">--</span>
                </button>
                <button class="choice-btn" onclick="submitAnswer(2)">
                    <span class="choice-label">C</span>
                    <span id="choice2">--</span>
                </button>
                <button class="choice-btn" onclick="submitAnswer(3)">
                    <span class="choice-label">D</span>
                    <span id="choice3">--</span>
                </button>
            </div>

            <div class="action-row">
                <button id="btnNext" class="btn-next" onclick="nextQuestion()">Next Soal</button>
            </div>

            <div class="progress-section">
                <div class="progress-info">
                    <span>Progres Kuis</span>
                    <span id="progressPercent">0%</span>
                </div>
                <div class="progress-bar">
                    <div id="progressBarFill" class="progress-fill" style="width: 0%"></div>
                </div>
            </div>
        </div>

        <!-- Summary Screen -->
        <div id="summaryScreen" class="panel" style="display: none;">
            <h2 class="title" style="margin-bottom: 2rem;">Hasil Diagnostik {{ $level }}</h2>

            <div class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-label">Skor Akhir</div>
                    <div id="finalScore" class="metric-value">000</div>
                </div>
                <div class="metric-card">
                    <div class="metric-label">Akurasi</div>
                    <div id="finalAccuracy" class="metric-value">0%</div>
                </div>
                <div class="metric-card">
                    <div class="metric-label">Rating</div>
                    <div id="syncRating" class="metric-value">D</div>
                </div>
            </div>

            <div class="telemetry-container">
                <table class="telemetry-table">
                    <thead>
                        <tr>
                            <th>Target</th>
                            <th>Arti</th>
                            <th>Jawabanmu</th>
                            <th>Jawaban Benar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="telemetryRows">
                        <!-- Instantiated dynamically -->
                    </tbody>
                </table>
            </div>

            <div class="btn-group">
                <button class="btn-action-quiz" onclick="returnToSetup()">Ulangi Kuis</button>
                <a href="{{ route('home') }}" class="btn-action-quiz btn-purple">Kembali ke Home</a>
            </div>
        </div>
    </div>

    <script>
        const rawKanjis = @json($kanjis);
        const rawKotobas = @json($kotobas);
        const rawBunpos = @json($bunpos ?? []);

        let selectedMode = 'kanji';
        let activeQuestions = [];
        let currentQuestionIndex = 0;
        let score = 0;
        let telemetryLog = [];
        let hasAnswered = false;

        let audioCtx = null;
        function triggerSound(type) {
            try {
                if (!audioCtx) {
                    audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                }
                if (audioCtx.state === 'suspended') {
                    audioCtx.resume();
                }

                const osc = audioCtx.createOscillator();
                const gainNode = audioCtx.createGain();
                osc.connect(gainNode);
                gainNode.connect(audioCtx.destination);

                const now = audioCtx.currentTime;

                if (type === 'correct') {
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(480, now);
                    osc.frequency.exponentialRampToValueAtTime(960, now + 0.12);
                    gainNode.gain.setValueAtTime(0.12, now);
                    gainNode.gain.exponentialRampToValueAtTime(0.005, now + 0.12);
                    osc.start(now);
                    osc.stop(now + 0.13);
                } else if (type === 'incorrect') {
                    osc.type = 'sawtooth';
                    osc.frequency.setValueAtTime(140, now);
                    osc.frequency.linearRampToValueAtTime(80, now + 0.22);
                    gainNode.gain.setValueAtTime(0.15, now);
                    gainNode.gain.linearRampToValueAtTime(0.005, now + 0.22);
                    osc.start(now);
                    osc.stop(now + 0.23);
                } else if (type === 'click') {
                    osc.type = 'triangle';
                    osc.frequency.setValueAtTime(600, now);
                    osc.frequency.exponentialRampToValueAtTime(300, now + 0.04);
                    gainNode.gain.setValueAtTime(0.08, now);
                    gainNode.gain.exponentialRampToValueAtTime(0.005, now + 0.04);
                    osc.start(now);
                    osc.stop(now + 0.05);
                }
            } catch (err) {
                console.warn('AudioContext failed:', err);
            }
        }

        function selectMode(mode, element) {
            triggerSound('click');
            selectedMode = mode;
            document.querySelectorAll('.option-card').forEach(card => card.classList.remove('active'));
            element.classList.add('active');
        }

        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        function initializeQuiz() {
            triggerSound('click');
            activeQuestions = [];
            currentQuestionIndex = 0;
            score = 0;
            telemetryLog = [];
            hasAnswered = false;

            if (selectedMode === 'kanji') {
                if (rawKanjis.length === 0) {
                    alert("Data Kanji kosong!");
                    return;
                }
                const pool = shuffle([...rawKanjis]);
                for (let i = 0; i < pool.length; i++) {
                    const k = pool[i];
                    const onyomi = k.onyomi && k.onyomi.trim() !== '—' && k.onyomi.trim() !== '-' ? k.onyomi.trim() : '';
                    const kunyomi = k.kunyomi && k.kunyomi.trim() !== '—' && k.kunyomi.trim() !== '-' ? k.kunyomi.trim() : '';
                    
                    let reading = '';
                    if (onyomi && kunyomi) {
                        reading = `${onyomi} / ${kunyomi}`;
                    } else {
                        reading = onyomi || kunyomi || '???';
                    }

                    activeQuestions.push({
                        type: 'kanji',
                        item: k,
                        target: k.kanji,
                        clue: `Pilih cara baca yang tepat`,
                        meaning: k.arti,
                        correctAnswer: reading,
                        distractorPool: rawKanjis.map(item => {
                            const o = item.onyomi && item.onyomi.trim() !== '—' && item.onyomi.trim() !== '-' ? item.onyomi.trim() : '';
                            const ku = item.kunyomi && item.kunyomi.trim() !== '—' && item.kunyomi.trim() !== '-' ? item.kunyomi.trim() : '';
                            return (o && ku) ? `${o} / ${ku}` : (o || ku || '');
                        }).filter(r => r !== '' && r !== reading)
                    });
                }
            } else if (selectedMode === 'kotoba') {
                if (rawKotobas.length === 0) {
                    alert("Data Kotoba kosong!");
                    return;
                }
                const pool = shuffle([...rawKotobas]);
                for (let i = 0; i < pool.length; i++) {
                    const kt = pool[i];
                    activeQuestions.push({
                        type: 'kotoba',
                        item: kt,
                        target: kt.kanji && kt.kanji.trim() !== '—' && kt.kanji.trim() !== '-' ? kt.kanji : kt.japanese,
                        clue: `Pilih cara baca yang tepat`,
                        meaning: kt.arti_indonesia,
                        correctAnswer: kt.japanese,
                        distractorPool: rawKotobas.map(item => item.japanese).filter(j => j !== kt.japanese)
                    });
                }
            } else if (selectedMode === 'bunpo') {
                if (rawBunpos.length === 0) {
                    alert("Data Tata Bahasa kosong!");
                    return;
                }
                const pool = shuffle([...rawBunpos]);
                for (let i = 0; i < pool.length; i++) {
                    const b = pool[i];
                    activeQuestions.push({
                        type: 'bunpo',
                        item: b,
                        target: b.pattern,
                        clue: `Pilih arti atau makna yang tepat`,
                        meaning: b.meaning,
                        correctAnswer: b.meaning,
                        distractorPool: rawBunpos.map(item => item.meaning).filter(m => m !== b.meaning)
                    });
                }
            } else {
                const kanjiPool = shuffle([...rawKanjis]);
                const kotobaPool = shuffle([...rawKotobas]);
                const bunpoPool = shuffle([...rawBunpos]);
                const totalMixed = kanjiPool.length + kotobaPool.length + bunpoPool.length;
                
                let kanjiIndex = 0;
                let kotobaIndex = 0;
                let bunpoIndex = 0;

                for (let i = 0; i < totalMixed; i++) {
                    const available = [];
                    if (kanjiIndex < kanjiPool.length) available.push('kanji');
                    if (kotobaIndex < kotobaPool.length) available.push('kotoba');
                    if (bunpoIndex < bunpoPool.length) available.push('bunpo');
                    
                    if (available.length === 0) break;
                    
                    const pick = available[Math.floor(Math.random() * available.length)];
                    
                    if (pick === 'kanji') {
                        const k = kanjiPool[kanjiIndex++];
                        const o = k.onyomi && k.onyomi.trim() !== '—' && k.onyomi.trim() !== '-' ? k.onyomi.trim() : '';
                        const ku = k.kunyomi && k.kunyomi.trim() !== '—' && k.kunyomi.trim() !== '-' ? k.kunyomi.trim() : '';
                        let reading = (o && ku) ? `${o} / ${ku}` : (o || ku || '???');

                        activeQuestions.push({
                            type: 'kanji',
                            item: k,
                            target: k.kanji,
                            clue: `Pilih cara baca yang tepat`,
                            meaning: k.arti,
                            correctAnswer: reading,
                            distractorPool: rawKanjis.map(item => {
                                const o_i = item.onyomi && item.onyomi.trim() !== '—' && item.onyomi.trim() !== '-' ? item.onyomi.trim() : '';
                                const ku_i = item.kunyomi && item.kunyomi.trim() !== '—' && item.kunyomi.trim() !== '-' ? item.kunyomi.trim() : '';
                                return (o_i && ku_i) ? `${o_i} / ${ku_i}` : (o_i || ku_i || '');
                            }).filter(r => r !== '' && r !== reading)
                        });
                    } else if (pick === 'kotoba') {
                        const kt = kotobaPool[kotobaIndex++];
                        activeQuestions.push({
                            type: 'kotoba',
                            item: kt,
                            target: kt.kanji && kt.kanji.trim() !== '—' && kt.kanji.trim() !== '-' ? kt.kanji : kt.japanese,
                            clue: `Pilih cara baca yang tepat`,
                            meaning: kt.arti_indonesia,
                            correctAnswer: kt.japanese,
                            distractorPool: rawKotobas.map(item => item.japanese).filter(j => j !== kt.japanese)
                        });
                    } else if (pick === 'bunpo') {
                        const b = bunpoPool[bunpoIndex++];
                        activeQuestions.push({
                            type: 'bunpo',
                            item: b,
                            target: b.pattern,
                            clue: `Tata Bahasa`,
                            meaning: b.meaning,
                            correctAnswer: b.meaning,
                            distractorPool: rawBunpos.map(item => item.meaning).filter(m => m !== b.meaning)
                        });
                    }
                }
            }

            document.getElementById('setupScreen').style.display = 'none';
            document.getElementById('gameplayScreen').style.display = 'flex';
            loadQuestion();
        }

        function loadQuestion() {
            hasAnswered = false;
            document.getElementById('btnNext').style.display = 'none';
            
            const optionBtns = document.querySelectorAll('.choice-btn');
            optionBtns.forEach(btn => {
                btn.disabled = false;
                btn.className = 'choice-btn';
            });

            const q = activeQuestions[currentQuestionIndex];
            
            document.getElementById('currentNum').textContent = String(currentQuestionIndex + 1).padStart(2, '0');
            document.getElementById('totalNum').textContent = String(activeQuestions.length).padStart(2, '0');
            document.getElementById('activeMode').textContent = q.type.toUpperCase();
            document.getElementById('currentScore').textContent = String(score);

            document.getElementById('targetChar').textContent = q.target;
            document.getElementById('targetChar').style.fontSize = q.target.length > 5 ? '2.5rem' : '5rem';
            document.getElementById('targetClue').textContent = q.clue;
            document.getElementById('meaningReveal').style.display = 'none';
            document.getElementById('meaningReveal').innerHTML = '';

            let uniqueDistractors = [...new Set(q.distractorPool)];
            shuffle(uniqueDistractors);
            
            let choices = [q.correctAnswer];
            for (let i = 0; i < Math.min(3, uniqueDistractors.length); i++) {
                choices.push(uniqueDistractors[i]);
            }
            
            while (choices.length < 4) {
                choices.push('---');
            }

            shuffle(choices);
            q.choices = choices;

            for (let i = 0; i < 4; i++) {
                document.getElementById(`choice${i}`).textContent = choices[i];
            }

            const total = activeQuestions.length;
            const progressVal = (currentQuestionIndex / total) * 100;
            document.getElementById('progressBarFill').style.width = `${progressVal}%`;
            document.getElementById('progressPercent').textContent = `${Math.round(progressVal)}%`;
        }

        function submitAnswer(selectedIndex) {
            if (hasAnswered) return;
            hasAnswered = true;

            const q = activeQuestions[currentQuestionIndex];
            const selectedText = q.choices[selectedIndex];
            const isCorrect = (selectedText === q.correctAnswer);
            const optionBtns = document.querySelectorAll('.choice-btn');
            
            optionBtns.forEach(btn => btn.disabled = true);

            // Munculkan furigana/jawaban benar di atas kanjinya
            let displayHTML = q.target;
            
            if (q.type === 'kotoba' || q.type === 'kanji') {
                let t = q.target;
                let r = q.correctAnswer;
                
                if (t !== r) {
                    let sLen = 0;
                    let mLen = Math.min(t.length, r.length);
                    for (let i = 1; i <= mLen; i++) {
                        if (t[t.length - i] === r[r.length - i]) {
                            sLen = i;
                        } else {
                            break;
                        }
                    }
                    
                    let pLen = 0;
                    for (let i = 0; i < mLen - sLen; i++) {
                        if (t[i] === r[i]) {
                            pLen++;
                        } else {
                            break;
                        }
                    }
                    
                    let bTarget = t.substring(pLen, t.length - sLen);
                    let bReading = r.substring(pLen, r.length - sLen);
                    let pref = t.substring(0, pLen);
                    let suff = t.substring(t.length - sLen);
                    
                    if (bTarget.length > 0 && bReading.length > 0) {
                        displayHTML = `${pref}<ruby>${bTarget}<rt style="color: var(--primary); font-size: 0.25em; font-weight: 600; padding-bottom: 8px;">${bReading}</rt></ruby>${suff}`;
                    } else {
                        displayHTML = `<ruby>${t}<rt style="color: var(--primary); font-size: 0.25em; font-weight: 600; padding-bottom: 8px;">${r}</rt></ruby>`;
                    }
                }
            }

            document.getElementById('targetChar').innerHTML = displayHTML;

            const meaningReveal = document.getElementById('meaningReveal');
            meaningReveal.innerHTML = `Arti: <span style="color: var(--primary);">${q.meaning}</span>`;
            meaningReveal.style.display = 'inline-block';

            if (isCorrect) {
                triggerSound('correct');
                score += 10;
                optionBtns[selectedIndex].classList.add('correct');
            } else {
                triggerSound('incorrect');
                optionBtns[selectedIndex].classList.add('incorrect');
                optionBtns.forEach((btn, index) => {
                    if (q.choices[index] === q.correctAnswer) {
                        btn.classList.add('correct');
                    }
                });
            }

            document.getElementById('currentScore').textContent = String(score);

            telemetryLog.push({
                feedId: String(currentQuestionIndex + 1).padStart(2, '0'),
                target: q.target,
                meaning: q.meaning,
                userInput: selectedText,
                correct: q.correctAnswer,
                status: isCorrect ? 'CORRECT' : 'INCORRECT'
            });

            document.getElementById('btnNext').style.display = 'block';
        }

        function nextQuestion() {
            triggerSound('click');
            currentQuestionIndex++;
            if (currentQuestionIndex < activeQuestions.length) {
                loadQuestion();
            } else {
                showSummary();
            }
        }

        function showSummary() {
            document.getElementById('progressBarFill').style.width = '100%';
            document.getElementById('progressPercent').textContent = '100%';

            const totalQ = activeQuestions.length;
            const correctCount = telemetryLog.filter(t => t.status === 'CORRECT').length;
            const accuracy = totalQ > 0 ? Math.round((correctCount / totalQ) * 100) : 0;

            let rating = 'D';
            if (accuracy === 100) rating = 'S';
            else if (accuracy >= 80) rating = 'A';
            else if (accuracy >= 60) rating = 'B';
            else if (accuracy >= 40) rating = 'C';

            document.getElementById('finalScore').textContent = String(score);
            document.getElementById('finalAccuracy').textContent = `${accuracy}%`;
            document.getElementById('syncRating').textContent = rating;

            const tbody = document.getElementById('telemetryRows');
            tbody.innerHTML = '';
            
            telemetryLog.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td style="font-weight: 700; font-family: 'Noto Sans JP', sans-serif;">${row.target}</td>
                    <td>${row.meaning}</td>
                    <td style="color: ${row.status === 'CORRECT' ? 'var(--success)' : 'var(--error)'}; font-weight:600;">${row.userInput}</td>
                    <td style="color: var(--success); font-weight: 600;">${row.correct}</td>
                    <td><span class="status-badge ${row.status === 'CORRECT' ? 'correct' : 'incorrect'}">${row.status === 'CORRECT' ? 'BENAR' : 'SALAH'}</span></td>
                `;
                tbody.appendChild(tr);
            });

            document.getElementById('gameplayScreen').style.display = 'none';
            document.getElementById('summaryScreen').style.display = 'flex';
        }

        function returnToSetup() {
            triggerSound('click');
            document.getElementById('summaryScreen').style.display = 'none';
            document.getElementById('setupScreen').style.display = 'flex';
        }
    </script>
</body>
</html>
