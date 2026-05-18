<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N4 Quiz Terminal</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=JetBrains+Mono:wght@400;700&family=Noto+Sans+JP:wght@500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #fcfcfc;
            --bg-grid: #eeeeee;
            --primary: #a855f7; /* High-tech Purple */
            --primary-glow: rgba(168, 85, 247, 0.15);
            --primary-green: #22c55e;
            --primary-red: #ef4444;
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
            max-width: 750px;
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
            cursor: pointer;
            transition: color 0.2s;
        }

        .nav-back:hover {
            color: var(--primary);
        }

        .header-section {
            border-bottom: 4px solid var(--primary);
            padding-bottom: 0.8rem;
            margin-bottom: 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        h1 { 
            font-family: 'Orbitron', sans-serif; 
            font-size: 1.5rem; 
            letter-spacing: 2px; 
            color: var(--primary); 
            text-transform: uppercase;
        }

        /* Card panels */
        .panel {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 3rem 2rem;
            position: relative;
            box-shadow: 10px 10px 0 rgba(0, 0, 0, 0.02);
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 400px;
        }

        /* Tech Accents */
        .accent-tl { position: absolute; top: 15px; left: 15px; width: 15px; height: 15px; border-top: 3px solid var(--accent-gray); border-left: 3px solid var(--accent-gray); }
        .accent-br { position: absolute; bottom: 15px; right: 15px; width: 15px; height: 15px; border-bottom: 3px solid var(--accent-gray); border-right: 3px solid var(--accent-gray); }
        .accent-top-bar { position: absolute; top: 0; left: 10%; width: 60px; height: 6px; background: var(--accent-yellow); }

        /* Setup Screen styles */
        .setup-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            letter-spacing: 3px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .menu-options {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            margin-bottom: 2.5rem;
        }

        .option-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 1.2rem 2rem;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .option-card:hover {
            border-color: var(--primary);
            background: #fafafa;
            transform: translateX(4px);
        }

        .option-card.active {
            border-color: var(--primary);
            background: var(--primary-glow);
            border-left: 6px solid var(--primary);
        }

        .option-details {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .option-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .option-desc {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .option-badge {
            font-size: 0.6rem;
            padding: 2px 8px;
            background: var(--text-main);
            color: #fff;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .option-card.active .option-badge {
            background: var(--primary);
        }

        /* Config Grid */
        .config-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            width: 100%;
            margin-bottom: 2.5rem;
            padding-top: 1rem;
            border-top: 1px dashed #e2e8f0;
        }

        .config-label {
            font-size: 0.65rem;
            color: var(--accent-gray);
            letter-spacing: 2px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 0.6rem;
            display: block;
        }

        .selector-group {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            width: 100%;
        }

        .selector-btn {
            background: #fff;
            border: 1px solid var(--accent-gray);
            padding: 10px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
        }

        .selector-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .selector-btn.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        /* Action Buttons */
        .btn-launch {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 1.2rem 2.5rem;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.9rem;
            letter-spacing: 3px;
            font-weight: 900;
            cursor: pointer;
            transition: all 0.25s ease;
            width: 100%;
            text-align: center;
            border-bottom: 4px solid #7e22ce;
        }

        .btn-launch:hover {
            background: #9333ea;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(168, 85, 247, 0.2);
        }

        .btn-launch:active {
            transform: translateY(0);
        }

        /* Game Board Styles */
        .hud-row {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 2.5rem;
            font-size: 0.65rem;
            color: var(--accent-gray);
            letter-spacing: 2px;
            font-weight: 700;
            border-bottom: 1px dashed #e2e8f0;
            padding-bottom: 0.8rem;
        }

        .hud-value {
            color: var(--text-main);
            font-weight: 700;
        }

        .hud-value.glow-purple {
            color: var(--primary);
        }

        /* Target Display */
        .target-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 3rem;
            width: 100%;
            min-height: 140px;
        }

        .target-char {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 4.5rem;
            font-weight: 900;
            color: var(--text-main);
            text-align: center;
            line-height: 1.2;
        }

        .target-clue {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-top: 1.2rem;
            font-weight: 700;
            padding: 8px 24px;
            background: rgba(168, 85, 247, 0.05);
            border-left: 4px solid var(--accent-yellow);
            border-radius: 2px;
        }

        /* Choices Grid */
        .choices-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            width: 100%;
            margin-bottom: 2.5rem;
        }

        @media (max-width: 600px) {
            .container { padding: 1rem; }
            .panel { padding: 1.5rem 1rem; min-height: 350px; }
            .choices-grid { grid-template-columns: 1fr; gap: 1rem; }
            .target-char { font-size: 3.5rem; }
            .choice-btn { padding: 1rem 1.2rem; font-size: 0.85rem; }
            .selector-btn { padding: 8px; font-size: 0.75rem; }
            .btn-launch { padding: 1rem 1.5rem; font-size: 0.8rem; }
            .telemetry-table { font-size: 0.65rem; }
            .telemetry-table th, .telemetry-table td { padding: 6px; }
            .setup-title { font-size: 1rem; margin-bottom: 1.5rem; }
            .menu-options { margin-bottom: 1.5rem; }
            .option-card { padding: 1rem 1.2rem; }
        }

        .choice-btn {
            background: #fff;
            border: 1px solid #cbd5e1;
            padding: 1.2rem 1.5rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-main);
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: left;
            display: flex;
            align-items: center;
            position: relative;
        }

        .choice-btn:hover:not(:disabled) {
            border-color: var(--primary);
            background: #fafafa;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        }

        .choice-letter {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.75rem;
            color: var(--accent-gray);
            margin-right: 12px;
            letter-spacing: 1px;
            border-right: 1px solid #e2e8f0;
            padding-right: 10px;
        }

        .choice-btn:disabled {
            cursor: default;
        }

        /* State color indicators */
        .choice-btn.correct {
            border-color: var(--primary-green) !important;
            background: rgba(34, 197, 94, 0.08) !important;
            color: var(--primary-green) !important;
            border-left: 6px solid var(--primary-green) !important;
        }

        .choice-btn.correct .choice-letter {
            color: var(--primary-green) !important;
            border-color: rgba(34, 197, 94, 0.2) !important;
        }

        .choice-btn.incorrect {
            border-color: var(--primary-red) !important;
            background: rgba(239, 68, 68, 0.08) !important;
            color: var(--primary-red) !important;
            border-left: 6px solid var(--primary-red) !important;
        }

        .choice-btn.incorrect .choice-letter {
            color: var(--primary-red) !important;
            border-color: rgba(239, 68, 68, 0.2) !important;
        }

        /* Progress HUD section */
        .progress-section {
            width: 100%;
            margin-top: 1.5rem;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.6rem;
            color: var(--accent-gray);
            letter-spacing: 2px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: #e2e8f0;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background: var(--primary);
            width: 0%;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Next Button Section */
        .action-row {
            width: 100%;
            margin-top: 1rem;
            min-height: 60px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-next {
            background: var(--text-main);
            color: #fff;
            border: none;
            padding: 1rem 2rem;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.8rem;
            letter-spacing: 2px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: none;
        }

        .btn-next:hover {
            background: var(--primary);
            box-shadow: 0 4px 10px rgba(168, 85, 247, 0.2);
        }

        /* Summary Screen styles */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            width: 100%;
            margin-bottom: 3rem;
        }

        @media (max-width: 600px) {
            .metrics-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        .metric-card {
            border: 1px solid #e2e8f0;
            padding: 1.5rem 1rem;
            text-align: center;
            background: #fff;
            position: relative;
        }

        .metric-label {
            font-size: 0.55rem;
            color: var(--accent-gray);
            letter-spacing: 2px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .metric-value {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--text-main);
        }

        .metric-card.sync-status {
            border-top: 4px solid var(--accent-yellow);
        }
        
        .metric-card.score-val {
            border-top: 4px solid var(--primary);
        }

        .metric-card.accuracy-val {
            border-top: 4px solid var(--primary-green);
        }

        .summary-header {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.7rem;
            color: var(--accent-gray);
            letter-spacing: 2px;
            font-weight: 700;
            text-transform: uppercase;
            align-self: flex-start;
            margin-bottom: 0.8rem;
            border-bottom: 1px solid #cbd5e1;
            width: 100%;
            padding-bottom: 5px;
        }

        /* Telemetry table styling */
        .telemetry-container {
            width: 100%;
            max-height: 250px;
            overflow-y: auto;
            border: 1px solid #e2e8f0;
            margin-bottom: 3rem;
        }

        .telemetry-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.75rem;
            text-align: left;
        }

        .telemetry-table th {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.6rem;
            color: var(--text-muted);
            letter-spacing: 1px;
            text-transform: uppercase;
            background: #f8fafc;
            padding: 10px;
            border-bottom: 1px solid #cbd5e1;
            position: sticky;
            top: 0;
            z-index: 5;
        }

        .telemetry-table td {
            padding: 10px;
            border-bottom: 1px solid #f1f5f9;
            font-family: 'JetBrains Mono', monospace;
        }

        .telemetry-table tr:hover {
            background: #fdfdfd;
        }

        .status-badge {
            font-size: 0.55rem;
            padding: 2px 6px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #fff;
            display: inline-block;
        }

        .status-badge.correct { background: var(--primary-green); }
        .status-badge.incorrect { background: var(--primary-red); }

        .btn-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            width: 100%;
        }

        @media (max-width: 500px) {
            .btn-group {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        .btn-action {
            background: #fff;
            border: 1px solid var(--text-main);
            color: var(--text-main);
            padding: 1.2rem;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.8rem;
            letter-spacing: 2px;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.2s;
            text-align: center;
        }

        .btn-action:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: #fafafa;
        }

        .btn-action.btn-purple {
            background: var(--primary);
            color: #fff;
            border: none;
            border-bottom: 4px solid #7e22ce;
        }

        .btn-action.btn-purple:hover {
            background: #9333ea;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="background-grid"></div>

    <div class="container">
        
        <!-- Setup Screen -->
        <div id="setupScreen" class="panel">
            <div class="accent-tl"></div><div class="accent-br"></div>
            <div class="accent-top-bar"></div>
            
            <nav class="nav-header" style="width:100%; margin-bottom: 2rem;">
                <a href="{{ route('home') }}" class="nav-back">← KEMBALI KE HOME</a>
                <div style="font-size: 0.55rem; color: var(--accent-gray); font-weight: 700; letter-spacing: 2px;">SYSTEM SECURE</div>
            </nav>

            <h2 class="setup-title" style="font-family: 'Orbitron';">SETUP EVALUASI</h2>

            <!-- Mode Selection Card -->
            <label class="config-label" style="align-self: flex-start;">Pilih Tipe Evaluasi</label>
            <div class="menu-options">
                <div class="option-card active" onclick="selectMode('kanji', this)">
                    <div class="option-details">
                        <span class="option-title">Membaca Kanji</span>
                        <span class="option-desc">Tebak cara membaca karakter Kanji (onyomi/kunyomi).</span>
                    </div>
                    <span class="option-badge">MODULE 01</span>
                </div>

                <div class="option-card" onclick="selectMode('kotoba', this)">
                    <div class="option-details">
                        <span class="option-title">Membaca Kotoba</span>
                        <span class="option-desc">Tebak cara membaca kosakata ke dalam bentuk hiragana.</span>
                    </div>
                    <span class="option-badge">MODULE 02</span>
                </div>

                <div class="option-card" onclick="selectMode('mixed', this)">
                    <div class="option-details">
                        <span class="option-title">Evaluasi Gabungan</span>
                        <span class="option-desc">Evaluasi acak gabungan dari kosakata dan kanji.</span>
                    </div>
                    <span class="option-badge">MODULE 03</span>
                </div>
            </div>

            <!-- Configuration Options -->
            <div class="config-grid">
                <div>
                    <span class="config-label">Jumlah Soal</span>
                    <div class="selector-group">
                        <button class="selector-btn active" onclick="selectLimit(10, this)">10 SOAL</button>
                        <button class="selector-btn" onclick="selectLimit(20, this)">20 SOAL</button>
                        <button class="selector-btn" onclick="selectLimit(30, this)">30 SOAL</button>
                    </div>
                </div>
            </div>

            <!-- Launch Button -->
            <button class="btn-launch" style="font-family: 'Orbitron';" onclick="initializeQuiz()">INISIALISASI KUIS</button>
        </div>

        <!-- Gameplay Screen -->
        <div id="gameplayScreen" class="panel" style="display: none;">
            <div class="accent-tl"></div><div class="accent-br"></div>
            <div class="accent-top-bar"></div>

            <nav class="hud-row">
                <div>FEED ID: <span id="currentNum" class="hud-value">01</span> / <span id="totalNum" class="hud-value">10</span></div>
                <div>MODE: <span id="activeMode" class="hud-value glow-purple">KANJI</span></div>
                <div>SCORE: <span id="currentScore" class="hud-value">000</span> PTS</div>
            </nav>

            <!-- Question/Target Box -->
            <div class="target-box">
                <span id="targetChar" class="target-char">漢</span>
                <span id="targetClue" class="target-clue">意味: Mandarin / Chinese character</span>
            </div>

            <!-- Choices Grid -->
            <div class="choices-grid">
                <button class="choice-btn" onclick="submitAnswer(0)">
                    <span class="choice-letter">A //</span>
                    <span class="choice-text" id="choice0">--</span>
                </button>
                <button class="choice-btn" onclick="submitAnswer(1)">
                    <span class="choice-letter">B //</span>
                    <span class="choice-text" id="choice1">--</span>
                </button>
                <button class="choice-btn" onclick="submitAnswer(2)">
                    <span class="choice-letter">C //</span>
                    <span class="choice-text" id="choice2">--</span>
                </button>
                <button class="choice-btn" onclick="submitAnswer(3)">
                    <span class="choice-letter">D //</span>
                    <span class="choice-text" id="choice3">--</span>
                </button>
            </div>

            <!-- Action / Navigation Row -->
            <div class="action-row">
                <button id="btnNext" class="btn-next" style="font-family: 'Orbitron';" onclick="nextQuestion()">NEXT SEQUENCE</button>
            </div>

            <!-- Progress HUD -->
            <div class="progress-section">
                <div class="progress-info">
                    <span>PROGRES</span>
                    <span id="progressPercent">0%</span>
                </div>
                <div class="progress-bar">
                    <div id="progressBarFill" class="progress-fill" style="width: 0%"></div>
                </div>
            </div>
        </div>

        <!-- Summary Screen -->
        <div id="summaryScreen" class="panel" style="display: none;">
            <div class="accent-tl"></div><div class="accent-br"></div>
            <div class="accent-top-bar"></div>

            <nav class="nav-header" style="width:100%; margin-bottom: 2rem;">
                <div style="font-family: 'Orbitron'; font-size: 1.1rem; letter-spacing: 2px; font-weight: 700; color: var(--primary);">HASIL DIAGNOSTIK</div>
                <div style="font-size: 0.55rem; color: var(--accent-gray); font-weight: 700; letter-spacing: 2px;">EVALUASI SELESAI</div>
            </nav>

            <!-- Metrics Grid -->
            <div class="metrics-grid">
                <div class="metric-card score-val">
                    <div class="metric-label">FINAL SCORE</div>
                    <div id="finalScore" class="metric-value">000</div>
                </div>
                <div class="metric-card accuracy-val">
                    <div class="metric-label">AKURASI</div>
                    <div id="finalAccuracy" class="metric-value">0%</div>
                </div>
                <div class="metric-card sync-status">
                    <div class="metric-label">RATING</div>
                    <div id="syncRating" class="metric-value">D</div>
                </div>
            </div>

            <!-- Telemetry Log -->
            <h3 class="summary-header" style="font-family: 'Orbitron';">TELEMETRY LOG</h3>
            <div class="telemetry-container">
                <table class="telemetry-table">
                    <thead style="font-family: 'Orbitron';">
                        <tr>
                            <th>ID</th>
                            <th>TARGET</th>
                            <th>ARTI</th>
                            <th>JAWABANMU</th>
                            <th>JAWABAN BENAR</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody id="telemetryRows">
                        <!-- Instantiated dynamically -->
                    </tbody>
                </table>
            </div>

            <!-- Navigation Group -->
            <div class="btn-group">
                <button class="btn-action" style="font-family: 'Orbitron';" onclick="returnToSetup()">ULANGI KUIS</button>
                <a href="{{ route('home') }}" class="btn-action btn-purple" style="font-family: 'Orbitron'; text-decoration:none;">KEMBALI KE HOME</a>
            </div>
        </div>

    </div>

    <script>
        // Datasets passed from Laravel PHP
        const rawKanjis = @json($kanjis);
        const rawKotobas = @json($kotobas);

        // Core Game Engine State variables
        let selectedMode = 'kanji';
        let questionLimit = 10;
        let activeQuestions = [];
        let currentQuestionIndex = 0;
        let score = 0;
        let telemetryLog = [];
        let hasAnswered = false;

        // Sound Engine synthesizer using Web Audio API
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
                    // Retro sci-fi correct blip
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(480, now);
                    osc.frequency.exponentialRampToValueAtTime(960, now + 0.12);
                    
                    gainNode.gain.setValueAtTime(0.12, now);
                    gainNode.gain.exponentialRampToValueAtTime(0.005, now + 0.12);
                    
                    osc.start(now);
                    osc.stop(now + 0.13);
                } else if (type === 'incorrect') {
                    // Low synth hum warning
                    osc.type = 'sawtooth';
                    osc.frequency.setValueAtTime(140, now);
                    osc.frequency.linearRampToValueAtTime(80, now + 0.22);
                    
                    gainNode.gain.setValueAtTime(0.15, now);
                    gainNode.gain.linearRampToValueAtTime(0.005, now + 0.22);
                    
                    osc.start(now);
                    osc.stop(now + 0.23);
                } else if (type === 'click') {
                    // Soft UI select click
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

        // Setup Screen interaction functions
        function selectMode(mode, element) {
            triggerSound('click');
            selectedMode = mode;
            document.querySelectorAll('.option-card').forEach(card => card.classList.remove('active'));
            element.classList.add('active');
        }

        function selectLimit(limit, element) {
            triggerSound('click');
            questionLimit = limit;
            document.querySelectorAll('.selector-btn').forEach(btn => btn.classList.remove('active'));
            element.classList.add('active');
            
            // Format button texts so the user sees count instead of seconds if desired
            // In Indonesian: tebak-tebakan kanji/kotoba, let's change text from "X SEC" to "X SOAL"
            element.parentElement.querySelectorAll('.selector-btn').forEach((btn, index) => {
                const val = (index + 1) * 10;
                btn.textContent = `${val} SOAL`;
            });
        }
        
        // Initialize limit buttons text on load
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.selector-btn').forEach((btn, index) => {
                const val = (index + 1) * 10;
                btn.textContent = `${val} SOAL`;
            });
        });

        // Initialize and shuffle array helper
        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        // Initialize quiz questions
        function initializeQuiz() {
            triggerSound('click');
            activeQuestions = [];
            currentQuestionIndex = 0;
            score = 0;
            telemetryLog = [];
            hasAnswered = false;

            // Generate question pool based on mode selection
            if (selectedMode === 'kanji') {
                if (rawKanjis.length === 0) {
                    alert("Data Kanji kosong! Jalankan seeder database terlebih dahulu.");
                    return;
                }
                const pool = shuffle([...rawKanjis]);
                for (let i = 0; i < Math.min(questionLimit, pool.length); i++) {
                    const k = pool[i];
                    // Correct answer Onyomi / Kunyomi combination
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
                        clue: `Arti: ${k.arti}`,
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
                    alert("Data Kotoba kosong! Jalankan seeder database terlebih dahulu.");
                    return;
                }
                const pool = shuffle([...rawKotobas]);
                for (let i = 0; i < Math.min(questionLimit, pool.length); i++) {
                    const kt = pool[i];
                    activeQuestions.push({
                        type: 'kotoba',
                        item: kt,
                        target: kt.kanji && kt.kanji.trim() !== '—' && kt.kanji.trim() !== '-' ? kt.kanji : kt.japanese,
                        clue: `Arti: ${kt.arti_indonesia}`,
                        meaning: kt.arti_indonesia,
                        correctAnswer: kt.japanese,
                        distractorPool: rawKotobas.map(item => item.japanese).filter(j => j !== kt.japanese)
                    });
                }
            } else { // Mixed mode
                const kanjiPool = shuffle([...rawKanjis]);
                const kotobaPool = shuffle([...rawKotobas]);
                
                let kanjiIndex = 0;
                let kotobaIndex = 0;

                for (let i = 0; i < questionLimit; i++) {
                    // Alternating types randomly
                    if ((Math.random() > 0.5 && kanjiIndex < kanjiPool.length) || kotobaIndex >= kotobaPool.length) {
                        if (kanjiIndex < kanjiPool.length) {
                            const k = kanjiPool[kanjiIndex++];
                            const o = k.onyomi && k.onyomi.trim() !== '—' && k.onyomi.trim() !== '-' ? k.onyomi.trim() : '';
                            const ku = k.kunyomi && k.kunyomi.trim() !== '—' && k.kunyomi.trim() !== '-' ? k.kunyomi.trim() : '';
                            let reading = (o && ku) ? `${o} / ${ku}` : (o || ku || '???');

                            activeQuestions.push({
                                type: 'kanji',
                                item: k,
                                target: k.kanji,
                                clue: `Kanji (Arti: ${k.arti})`,
                                meaning: k.arti,
                                correctAnswer: reading,
                                distractorPool: rawKanjis.map(item => {
                                    const o_i = item.onyomi && item.onyomi.trim() !== '—' && item.onyomi.trim() !== '-' ? item.onyomi.trim() : '';
                                    const ku_i = item.kunyomi && item.kunyomi.trim() !== '—' && item.kunyomi.trim() !== '-' ? item.kunyomi.trim() : '';
                                    return (o_i && ku_i) ? `${o_i} / ${ku_i}` : (o_i || ku_i || '');
                                }).filter(r => r !== '' && r !== reading)
                            });
                        }
                    } else {
                        if (kotobaIndex < kotobaPool.length) {
                            const kt = kotobaPool[kotobaIndex++];
                            activeQuestions.push({
                                type: 'kotoba',
                                item: kt,
                                target: kt.kanji && kt.kanji.trim() !== '—' && kt.kanji.trim() !== '-' ? kt.kanji : kt.japanese,
                                clue: `Kosakata (Arti: ${kt.arti_indonesia})`,
                                meaning: kt.arti_indonesia,
                                correctAnswer: kt.japanese,
                                distractorPool: rawKotobas.map(item => item.japanese).filter(j => j !== kt.japanese)
                            });
                        }
                    }
                }
            }

            // Hide setup, show gameplay screen
            document.getElementById('setupScreen').style.display = 'none';
            document.getElementById('gameplayScreen').style.display = 'flex';
            
            loadQuestion();
        }

        // Load current active question
        function loadQuestion() {
            hasAnswered = false;
            document.getElementById('btnNext').style.display = 'none';
            
            // Enable choices and reset colors
            const optionBtns = document.querySelectorAll('.choice-btn');
            optionBtns.forEach(btn => {
                btn.disabled = false;
                btn.className = 'choice-btn';
            });

            const q = activeQuestions[currentQuestionIndex];
            
            // Update HUD values
            document.getElementById('currentNum').textContent = String(currentQuestionIndex + 1).padStart(2, '0');
            document.getElementById('totalNum').textContent = String(activeQuestions.length).padStart(2, '0');
            document.getElementById('activeMode').textContent = q.type.toUpperCase();
            document.getElementById('currentScore').textContent = String(score).padStart(3, '0');

            // Set main target and clues
            document.getElementById('targetChar').textContent = q.target;
            document.getElementById('targetChar').style.fontSize = q.target.length > 5 ? '2.5rem' : '4.5rem';
            document.getElementById('targetClue').textContent = q.clue;

            // Generate option choices (1 correct + 3 unique random distractors)
            let uniqueDistractors = [...new Set(q.distractorPool)];
            shuffle(uniqueDistractors);
            
            let choices = [q.correctAnswer];
            for (let i = 0; i < Math.min(3, uniqueDistractors.length); i++) {
                choices.push(uniqueDistractors[i]);
            }
            
            // If distractors are empty or missing, fill up with dummy readings
            while (choices.length < 4) {
                choices.push('---');
            }

            // Shuffle option positions
            shuffle(choices);

            // Bind values to UI buttons
            q.choices = choices;
            for (let i = 0; i < 4; i++) {
                document.getElementById(`choice${i}`).textContent = choices[i];
            }

            // Update Progress Bar
            const total = activeQuestions.length;
            const progressVal = (currentQuestionIndex / total) * 100;
            document.getElementById('progressBarFill').style.width = `${progressVal}%`;
            document.getElementById('progressPercent').textContent = `${Math.round(progressVal)}%`;
        }

        // Process answer submittal
        function submitAnswer(selectedIndex) {
            if (hasAnswered) return;
            hasAnswered = true;

            const q = activeQuestions[currentQuestionIndex];
            const selectedText = q.choices[selectedIndex];
            const isCorrect = (selectedText === q.correctAnswer);

            const optionBtns = document.querySelectorAll('.choice-btn');
            
            // Disable all options
            optionBtns.forEach(btn => btn.disabled = true);

            if (isCorrect) {
                triggerSound('correct');
                score += 10;
                optionBtns[selectedIndex].classList.add('correct');
            } else {
                triggerSound('incorrect');
                optionBtns[selectedIndex].classList.add('incorrect');
                // Highlight the correct one
                optionBtns.forEach((btn, index) => {
                    if (q.choices[index] === q.correctAnswer) {
                        btn.classList.add('correct');
                    }
                });
            }

            // Update score display in real time
            document.getElementById('currentScore').textContent = String(score).padStart(3, '0');

            // Log telemetry data
            telemetryLog.push({
                feedId: String(currentQuestionIndex + 1).padStart(2, '0'),
                target: q.target,
                meaning: q.meaning,
                userInput: selectedText,
                correct: q.correctAnswer,
                status: isCorrect ? 'CORRECT' : 'INCORRECT'
            });

            // Reveal Next Sequence button
            document.getElementById('btnNext').style.display = 'block';
        }

        // Navigate to next question
        function nextQuestion() {
            triggerSound('click');
            currentQuestionIndex++;
            
            if (currentQuestionIndex < activeQuestions.length) {
                loadQuestion();
            } else {
                showSummary();
            }
        }

        // Render evaluation summary screen
        function showSummary() {
            // Update Progress bar to 100%
            document.getElementById('progressBarFill').style.width = '100%';
            document.getElementById('progressPercent').textContent = '100%';

            // Calculate metrics
            const totalQ = activeQuestions.length;
            const correctCount = telemetryLog.filter(t => t.status === 'CORRECT').length;
            const accuracy = Math.round((correctCount / totalQ) * 100);

            let rating = 'D_CLASS';
            if (accuracy === 100) rating = 'S_CLASS';
            else if (accuracy >= 80) rating = 'A_CLASS';
            else if (accuracy >= 60) rating = 'B_CLASS';
            else if (accuracy >= 40) rating = 'C_CLASS';

            // Set metric texts
            document.getElementById('finalScore').textContent = String(score).padStart(3, '0');
            document.getElementById('finalAccuracy').textContent = `${accuracy}%`;
            document.getElementById('syncRating').textContent = rating;

            // Render telemetry table rows
            const tbody = document.getElementById('telemetryRows');
            tbody.innerHTML = '';
            
            telemetryLog.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.feedId}</td>
                    <td style="font-weight: 700; font-family: 'Noto Sans JP', sans-serif;">${row.target}</td>
                    <td>${row.meaning}</td>
                    <td style="color: ${row.status === 'CORRECT' ? 'var(--primary-green)' : 'var(--primary-red)'}; font-weight:700;">${row.userInput}</td>
                    <td style="color: var(--primary-green); font-weight: 700;">${row.correct}</td>
                    <td><span class="status-badge ${row.status.toLowerCase()}">${row.status}</span></td>
                `;
                tbody.appendChild(tr);
            });

            // Transition panels
            document.getElementById('gameplayScreen').style.display = 'none';
            document.getElementById('summaryScreen').style.display = 'flex';
        }

        // Reset state and return to setup screen
        function returnToSetup() {
            triggerSound('click');
            document.getElementById('summaryScreen').style.display = 'none';
            document.getElementById('setupScreen').style.display = 'flex';
        }
    </script>
</body>
</html>
