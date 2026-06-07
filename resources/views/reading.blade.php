<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N4 Reading Practice HUD</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=JetBrains+Mono:wght@400;700&family=Noto+Sans+JP:wght@500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #fcfcfc;
            --bg-grid: #eeeeee;
            --primary: #06b6d4; /* High-tech Cyan/Teal */
            --primary-glow: rgba(6, 182, 212, 0.15);
            --primary-green: #22c55e;
            --primary-red: #ef4444;
            --primary-purple: #a855f7;
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
            max-width: 1100px;
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

        /* Responsive Columns Grid */
        .workspace-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 2rem;
            width: 100%;
            align-items: start;
        }

        .right-reader-col {
            grid-row: span 2;
        }

        @media (max-width: 900px) {
            .workspace-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .right-reader-col { grid-row: auto; order: 2; }
            .left-controls-top { order: 1; }
            .left-legend-box { order: 3; }
        }

        @media (max-width: 600px) {
            .container { padding: 1rem; }
            .panel { padding: 1.5rem 1rem; }
            .paragraph-text { font-size: 1.25rem; line-height: 2.2rem; }
            .timer-val { font-size: 1.8rem; }
            .btn-control { padding: 6px; font-size: 0.6rem; }
            .question-card { padding: 1.2rem 1rem; }
            .timer-hud { padding: 1rem; }
        }

        /* Panels styling */
        .panel {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 2rem;
            position: relative;
            box-shadow: 10px 10px 0 rgba(0, 0, 0, 0.02);
            width: 100%;
        }

        /* Tech Accents */
        .accent-tl { position: absolute; top: 15px; left: 15px; width: 15px; height: 15px; border-top: 3px solid var(--accent-gray); border-left: 3px solid var(--accent-gray); }
        .accent-br { position: absolute; bottom: 15px; right: 15px; width: 15px; height: 15px; border-bottom: 3px solid var(--accent-gray); border-right: 3px solid var(--accent-gray); }
        .accent-top-bar { position: absolute; top: 0; left: 10%; width: 60px; height: 6px; background: var(--accent-yellow); }

        /* Left Control Panel elements */
        .section-label {
            font-size: 0.6rem;
            color: var(--accent-gray);
            letter-spacing: 2px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 0.8rem;
            display: block;
        }

        .feed-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 2rem;
        }

        .feed-btn {
            background: #fff;
            border: 1px solid var(--accent-gray);
            padding: 12px;
            font-family: 'Orbitron', monospace;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.25s ease;
            text-align: left;
            position: relative;
            letter-spacing: 1px;
        }

        .feed-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateX(4px);
        }

        .feed-btn.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            border-left: 6px solid var(--accent-yellow);
        }

        .btn-dynamic {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 1rem;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.7rem;
            letter-spacing: 2px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
            text-align: center;
            border-bottom: 4px solid #0891b2;
            margin-bottom: 2rem;
            display: block;
            text-decoration: none;
        }

        .btn-dynamic:hover {
            background: #0891b2;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.2);
        }

        /* Stopwatch HUD */
        .timer-hud {
            border: 1px solid #cbd5e1;
            padding: 1.5rem 1rem;
            margin-bottom: 2rem;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .timer-val {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--text-main);
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .timer-val.active {
            color: var(--primary);
        }

        .cpm-val {
            font-size: 0.65rem;
            color: var(--text-muted);
            font-weight: 700;
            letter-spacing: 1px;
            display: flex;
            justify-content: space-between;
            width: 100%;
            border-top: 1px dashed #cbd5e1;
            padding-top: 6px;
            margin-top: 6px;
        }

        .timer-controls {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            width: 100%;
            margin-bottom: 2rem;
        }

        .btn-control {
            background: #fff;
            border: 1px solid var(--text-main);
            color: var(--text-main);
            padding: 8px;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.65rem;
            letter-spacing: 1px;
            cursor: pointer;
            font-weight: 700;
            transition: all 0.2s;
            text-align: center;
        }

        .btn-control:hover:not(:disabled) {
            background: #fafafa;
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-control:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .btn-control.btn-start { background: var(--primary); color: #fff; border: none; }
        .btn-control.btn-start:hover:not(:disabled) { background: #0891b2; color: #fff; }
        .btn-control.btn-stop { background: var(--primary-red); color: #fff; border: none; }
        .btn-control.btn-stop:hover:not(:disabled) { background: #dc2626; color: #fff; }

        /* Toggles */
        .toggle-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 2rem;
        }

        .btn-toggle {
            background: #fff;
            border: 1px solid var(--accent-gray);
            padding: 10px;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.7rem;
            letter-spacing: 1.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-toggle:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-toggle.active {
            border-color: var(--primary);
            background: var(--primary-glow);
            color: var(--primary);
        }

        /* Lexical Highlighter Legend Panel */
        .legend-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 6px 12px;
            border: 1px solid transparent;
            cursor: help;
            transition: all 0.2s ease;
        }

        .legend-item:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        .color-dot {
            width: 10px;
            height: 10px;
            border-radius: 2px;
            margin-right: 10px;
        }

        /* Dim filters triggered via JavaScript hover on legend */
        .legend-item.dimmed-hint {
            opacity: 0.4;
        }

        /* Right Reader display panel */
        .reader-panel {
            min-height: 480px;
            display: flex;
            flex-direction: column;
        }

        .paragraph-wrapper {
            position: relative;
            flex: 1;
            width: 100%;
            margin-bottom: 2rem;
        }

        .paragraph-text {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 1.6rem;
            line-height: 2.8rem;
            color: var(--text-main);
            transition: all 0.3s ease;
            text-align: justify;
        }

        /* Encryption blur overlay */
        .paragraph-text.encrypted {
            filter: blur(10px);
            opacity: 0.08;
            pointer-events: none;
            user-select: none;
        }

        .decrypt-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 20;
            background: rgba(255, 255, 255, 0.4);
            border: 1px dashed var(--accent-gray);
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .overlay-icon { font-size: 2.5rem; margin-bottom: 1rem; color: var(--primary); }
        .overlay-title { font-family: 'Orbitron', sans-serif; font-size: 0.9rem; font-weight: 700; letter-spacing: 2px; margin-bottom: 6px; color: var(--text-main); }
        .overlay-desc { font-size: 0.7rem; color: var(--text-muted); max-width: 280px; line-height: 1.2rem; }

        /* Lexical highlighters core CSS overrides */
        .paragraph-text span {
            padding: 1px 4px;
            border-radius: 2px;
            transition: all 0.25s ease;
        }

        /* Accent classes matching colors requested */
        .highlight-noun { color: #b45309 !important; border-bottom: 2px solid var(--accent-yellow); font-weight: 700; }
        .highlight-verb { color: #15803d !important; border-bottom: 2px solid var(--primary-green); font-weight: 700; }
        .highlight-adj-i { color: #b91c1c !important; border-bottom: 2px solid var(--primary-red); font-weight: 700; }
        .highlight-adj-na { color: #7e22ce !important; border-bottom: 2px solid var(--primary-purple); font-weight: 700; }
        .highlight-bunpo { color: #0e7490 !important; border-bottom: 2px solid var(--primary); font-weight: 700; }

        /* Dimming animations for Holographic diagnostic mode */
        .paragraph-text.filter-noun span:not(.highlight-noun) { opacity: 0.15; filter: blur(0.5px); }
        .paragraph-text.filter-verb span:not(.highlight-verb) { opacity: 0.15; filter: blur(0.5px); }
        .paragraph-text.filter-adj-i span:not(.highlight-adj-i) { opacity: 0.15; filter: blur(0.5px); }
        .paragraph-text.filter-adj-na span:not(.highlight-adj-na) { opacity: 0.15; filter: blur(0.5px); }
        .paragraph-text.filter-bunpo span:not(.highlight-bunpo) { opacity: 0.15; filter: blur(0.5px); }

        /* Furigana toggle visibility control */
        .hide-furigana rt {
            display: none !important;
        }

        /* Translation Drawer */
        .translation-panel {
            border-top: 1px dashed #cbd5e1;
            padding-top: 2rem;
            display: none;
            animation: slideDown 0.3s ease-out forwards;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .translation-text {
            font-size: 0.95rem;
            line-height: 1.6rem;
            color: var(--text-main);
            font-weight: 500;
        }

        /* Questions/Comprehension Section */
        .comprehension-panel {
            margin-top: 2.5rem;
            border-top: 4px solid var(--primary);
            padding-top: 2rem;
            display: none; /* revealed once read is stopped */
        }

        .question-card {
            border: 1px solid #cbd5e1;
            padding: 1.5rem;
            margin-bottom: 2rem;
            background: #fff;
            position: relative;
        }

        .question-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1.2rem;
            line-height: 1.4rem;
        }

        .q-choices-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            width: 100%;
        }

        @media (max-width: 600px) {
            .q-choices-grid {
                grid-template-columns: 1fr;
            }
        }

        .q-choice-btn {
            background: #fff;
            border: 1px solid #cbd5e1;
            padding: 12px 15px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-main);
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: left;
            display: flex;
            align-items: center;
        }

        .q-choice-btn:hover:not(:disabled) {
            border-color: var(--primary);
            background: #fafafa;
        }

        .q-choice-btn .letter-indicator {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.65rem;
            color: var(--accent-gray);
            margin-right: 10px;
            border-right: 1px solid #cbd5e1;
            padding-right: 8px;
        }

        /* Correct / Incorrect Option lights */
        .q-choice-btn.correct {
            border-color: var(--primary-green) !important;
            background: rgba(34, 197, 94, 0.08) !important;
            color: var(--primary-green) !important;
        }

        .q-choice-btn.correct .letter-indicator {
            color: var(--primary-green) !important;
            border-color: rgba(34, 197, 94, 0.2) !important;
        }

        .q-choice-btn.incorrect {
            border-color: var(--primary-red) !important;
            background: rgba(239, 68, 68, 0.08) !important;
            color: var(--primary-red) !important;
        }

        .q-choice-btn.incorrect .letter-indicator {
            color: var(--primary-red) !important;
            border-color: rgba(239, 68, 68, 0.2) !important;
        }

        .explanation-box {
            margin-top: 1rem;
            padding: 10px 15px;
            background: rgba(6, 182, 212, 0.05);
            border-left: 4px solid var(--primary);
            font-size: 0.75rem;
            color: var(--text-muted);
            line-height: 1.1rem;
            display: none;
        }
    </style>
</head>
<body>
    <div class="background-grid"></div>

    <div class="container">
        
        <nav class="nav-header">
            <a href="{{ route('home') }}" class="nav-back">← KEMBALI KE HOME</a>
            <div style="font-size: 0.6rem; letter-spacing: 1px; color: var(--text-muted); font-weight: 700; font-family: 'Orbitron';">READING COMPREHENSION_v2.0</div>
        </nav>

        <div class="header-section">
            <h1 style="font-family: 'Orbitron';">N4 READING SYSTEM</h1>
            <div style="font-size: 0.6rem; letter-spacing: 1px; color: var(--text-muted); font-family: 'Orbitron'; font-weight: 700;">
                {{ request('mode') === 'dynamic' ? 'DYNAMIC GENERATION MODE' : 'STATIC MODE' }}
            </div>
        </div>

        <div class="workspace-grid">
            
            <!-- Left Controls Column Top -->
            <div class="left-controls-top" style="display: flex; flex-direction: column;">
                
                <!-- Feed Selector -->
                <span class="section-label">Pilih Mode Latihan</span>
                <div class="feed-group" id="feedGroup" style="margin-bottom: 1rem;">
                    @foreach($paragraphs as $index => $p)
                        <button class="feed-btn {{ $index === 0 ? 'active' : '' }}" onclick="selectFeed({{ $index }}, this)">
                            {{ str_starts_with($p->title, 'DYNAMIC') ? 'FEED ACAK' : 'FEED 0'.($index + 1) }} // MODUL {{ $index + 1 }}
                        </button>
                    @endforeach
                </div>

                <a href="{{ route('reading', ['mode' => 'dynamic']) }}" class="btn-dynamic" style="font-family: 'Orbitron'; font-weight: 700;">
                    [ GENERATE DYNAMIC FEED ]
                </a>

                <!-- Timer Stopwatch HUD -->
                <span class="section-label">Stopwatch</span>
                <div class="timer-hud">
                    <span class="timer-val" id="timerDisplay">00:00.00</span>
                    <div class="cpm-val">
                        <span>Kecepatan:</span>
                        <span id="cpmDisplay">000 CPM (文字/分)</span>
                    </div>
                </div>

                <!-- Timer controls -->
                <div class="timer-controls">
                    <button class="btn-control btn-start" id="btnStart" onclick="startTimer()">START</button>
                    <button class="btn-control btn-stop" id="btnStop" onclick="stopTimer()" disabled>STOP</button>
                    <button class="btn-control" id="btnReset" onclick="resetTimer()">RESET</button>
                </div>

                <!-- Toggles Panel -->
                <span class="section-label">Display Toggles</span>
                <div class="toggle-group">
                    <button class="btn-toggle active" id="btnFurigana" onclick="toggleFurigana()">
                        <span>Furigana Overlay</span>
                        <span id="fStatus">[ ON ]</span>
                    </button>
                    <button class="btn-toggle" id="btnTranslation" onclick="toggleTranslation()">
                        <span>Terjemahan (ID)</span>
                        <span id="tStatus">[ OFF ]</span>
                    </button>
                </div>

            </div>

            <!-- Right Reader Display Column -->
            <div class="right-reader-col" style="display: flex; flex-direction: column;">
                
                <!-- Main Reader Panel -->
                <div class="panel reader-panel">
                    <div class="accent-tl"></div><div class="accent-br"></div>
                    <div class="accent-top-bar"></div>

                    <!-- Paragraph wrapper with Encryption Overlay -->
                    <div class="paragraph-wrapper">
                        
                        <!-- Static Overlay -->
                        <div class="decrypt-overlay" id="decryptOverlay">
                            <div class="overlay-icon">🔒</div>
                            <span class="overlay-title">ENCRYPTED SECURE TELEMETRY</span>
                            <span class="overlay-desc">Akses modul ini dengan menekan START<br>pada stopwatch.</span>
                        </div>

                        <!-- Japanese HTML Paragraph -->
                        <div class="paragraph-text encrypted" id="paragraphBox">
                            <!-- Loaded via JS -->
                        </div>

                    </div>

                    <!-- Indonesian Translation Panel -->
                    <div class="translation-panel" id="translationBox">
                        <span class="section-label" style="margin-bottom: 0.5rem;">Terjemahan</span>
                        <p class="translation-text" id="translationText">
                            <!-- Loaded via JS -->
                        </p>
                    </div>

                </div>

                <!-- Comprehension board -->
                <div class="panel comprehension-panel" id="comprehensionBox">
                    <div class="accent-tl"></div><div class="accent-br"></div>
                    
                    <nav class="nav-header" style="margin-bottom: 1.5rem;">
                        <div style="font-family: 'Orbitron'; font-size: 1rem; letter-spacing: 2px; font-weight: 900; color: var(--primary);">COMPREHENSION CHECK</div>
                        <div style="font-size: 0.55rem; color: var(--accent-gray); font-weight:700; letter-spacing:1px; font-family: 'Orbitron';" id="comprehensionScore">SCORE: 0 / 0</div>
                    </nav>

                    <div id="questionsContainer">
                        <!-- Loaded dynamically -->
                    </div>
                </div>

            </div>

            <!-- Highlight Legend Dimming Controller (Moved to separate grid child) -->
            <div class="left-legend-box" style="display: flex; flex-direction: column;">
                <span class="section-label">Highlighter Legend</span>
                <div class="panel">
                    <div class="accent-tl"></div><div class="accent-br"></div>
                    <div class="legend-list">
                        <div class="legend-item" onmouseenter="setHighlighterFilter('bunpo')" onmouseleave="clearHighlighterFilter()">
                            <div class="color-dot" style="background: var(--primary);"></div>
                            <span style="font-weight: 700;">Tata Bahasa</span>
                        </div>
                        <div class="legend-item" onmouseenter="setHighlighterFilter('verb')" onmouseleave="clearHighlighterFilter()">
                            <div class="color-dot" style="background: var(--primary-green);"></div>
                            <span style="font-weight: 700;">Kata Kerja</span>
                        </div>
                        <div class="legend-item" onmouseenter="setHighlighterFilter('noun')" onmouseleave="clearHighlighterFilter()">
                            <div class="color-dot" style="background: var(--accent-yellow);"></div>
                            <span style="font-weight: 700;">Kata Benda</span>
                        </div>
                        <div class="legend-item" onmouseenter="setHighlighterFilter('adj-na')" onmouseleave="clearHighlighterFilter()">
                            <div class="color-dot" style="background: var(--primary-purple);"></div>
                            <span style="font-weight: 700;">Na-adj</span>
                        </div>
                        <div class="legend-item" onmouseenter="setHighlighterFilter('adj-i')" onmouseleave="clearHighlighterFilter()">
                            <div class="color-dot" style="background: var(--primary-red);"></div>
                            <span style="font-weight: 700;">I-adj</span>
                        </div>
                    </div>
                    <div style="font-size: 0.52rem; color: var(--text-muted); margin-top: 15px; letter-spacing: 0.5px;">Hover kursor untuk isolasi visual</div>
                </div>
            </div>

        </div>

    </div>

    <script>
        // Seeded paragraph datasets from Laravel PHP
        const paragraphs = @json($paragraphs);

        // Core App States
        let currentFeedIndex = 0;
        let isTimerRunning = false;
        let isFuriganaOn = true;
        let isTranslationOn = false;
        
        // Timer elements & trackers
        let timerInterval = null;
        let startTime = 0;
        let elapsedMs = 0;

        // Audio synth engine
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
                const gain = audioCtx.createGain();
                osc.connect(gain);
                gain.connect(audioCtx.destination);

                const now = audioCtx.currentTime;

                if (type === 'correct') {
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(520, now);
                    osc.frequency.exponentialRampToValueAtTime(1040, now + 0.12);
                    
                    gain.gain.setValueAtTime(0.12, now);
                    gain.gain.exponentialRampToValueAtTime(0.005, now + 0.12);
                    
                    osc.start(now);
                    osc.stop(now + 0.13);
                } else if (type === 'incorrect') {
                    osc.type = 'sawtooth';
                    osc.frequency.setValueAtTime(130, now);
                    osc.frequency.linearRampToValueAtTime(70, now + 0.22);
                    
                    gain.gain.setValueAtTime(0.15, now);
                    gain.gain.linearRampToValueAtTime(0.005, now + 0.22);
                    
                    osc.start(now);
                    osc.stop(now + 0.23);
                } else if (type === 'click') {
                    osc.type = 'triangle';
                    osc.frequency.setValueAtTime(650, now);
                    osc.frequency.exponentialRampToValueAtTime(320, now + 0.04);
                    
                    gain.gain.setValueAtTime(0.08, now);
                    gain.gain.exponentialRampToValueAtTime(0.005, now + 0.04);
                    
                    osc.start(now);
                    osc.stop(now + 0.05);
                }
            } catch(e) {
                console.warn('AudioContext failed:', e);
            }
        }

        // Initialize display content
        function initApp() {
            loadParagraphData();
        }

        // Load targeted paragraph and reset HUD panels
        function loadParagraphData() {
            const p = paragraphs[currentFeedIndex];
            if (!p) return;

            // Load texts
            const pBox = document.getElementById('paragraphBox');
            pBox.innerHTML = p.content_html;
            
            document.getElementById('translationText').textContent = p.translation;

            // Reset encryption classes
            pBox.className = 'paragraph-text encrypted';
            if (!isFuriganaOn) {
                pBox.classList.add('hide-furigana');
            }
            document.getElementById('decryptOverlay').style.display = 'flex';

            // Reset translation panel
            isTranslationOn = false;
            document.getElementById('translationBox').style.display = 'none';
            document.getElementById('btnTranslation').classList.remove('active');
            document.getElementById('tStatus').textContent = '[ OFF ]';

            // Reset timer indicators
            resetTimerStats();

            // Clear comprehension questions
            document.getElementById('comprehensionBox').style.display = 'none';
        }

        // Helper to strip HTML tags and calculate raw Japanese character count
        function getRawJapaneseCharCount(htmlContent) {
            // Strip tags
            let temp = document.createElement('div');
            temp.innerHTML = htmlContent;
            
            // Remove rt tags (Furigana readings) completely so we only count raw character spellings
            const rts = temp.querySelectorAll('rt');
            rts.forEach(rt => rt.remove());

            const cleanText = temp.textContent || temp.innerText || "";
            
            // Exclude whitespaces, commas, full-stops
            const filtered = cleanText.replace(/[\s、。,.?!：\-\[\]]/g, '');
            return filtered.length;
        }

        // Select active study feed
        function selectFeed(index, element) {
            triggerSound('click');
            currentFeedIndex = index;
            
            document.querySelectorAll('.feed-btn').forEach(btn => btn.classList.remove('active'));
            element.classList.add('active');

            loadParagraphData();
        }

        // Timer Stopwatch Actions
        function startTimer() {
            if (isTimerRunning) return;
            triggerSound('click');
            
            isTimerRunning = true;
            document.getElementById('btnStart').disabled = true;
            document.getElementById('btnStop').disabled = false;

            // Lift Encryption
            document.getElementById('decryptOverlay').style.display = 'none';
            document.getElementById('paragraphBox').classList.remove('encrypted');

            // Hide previous quiz if reset wasn't hit
            document.getElementById('comprehensionBox').style.display = 'none';

            // Calculate start tick
            startTime = Date.now() - elapsedMs;
            timerInterval = setInterval(updateTimerTick, 10);
        }

        function updateTimerTick() {
            elapsedMs = Date.now() - startTime;

            // Render text
            document.getElementById('timerDisplay').textContent = formatElapsedTime(elapsedMs);

            // Calculate live CPM
            const p = paragraphs[currentFeedIndex];
            const charCount = getRawJapaneseCharCount(p.content_html);
            const elapsedSec = elapsedMs / 1000;
            
            if (elapsedSec > 0.5) { // wait brief moment to avoid infinite rate divisions
                const cpm = Math.round((charCount / elapsedSec) * 60);
                document.getElementById('cpmDisplay').textContent = `${cpm} CPM (Ch/Min)`;
            }
        }

        function formatElapsedTime(ms) {
            const minutes = Math.floor((ms / 60000) % 60);
            const seconds = Math.floor((ms / 1000) % 60);
            const centiseconds = Math.floor((ms % 1000) / 10);

            return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}.${String(centiseconds).padStart(2, '0')}`;
        }

        function stopTimer() {
            if (!isTimerRunning) return;
            triggerSound('click');
            
            isTimerRunning = false;
            clearInterval(timerInterval);

            document.getElementById('btnStart').disabled = false;
            document.getElementById('btnStop').disabled = true;

            // Finalize Speed calculations
            const p = paragraphs[currentFeedIndex];
            const charCount = getRawJapaneseCharCount(p.content_html);
            const elapsedSec = elapsedMs / 1000;
            const cpm = Math.round((charCount / elapsedSec) * 60);
            document.getElementById('cpmDisplay').textContent = `${cpm} CPM [RECORDED]`;

            // Initialize Reading Questions
            loadQuestions();
        }

        function resetTimer() {
            triggerSound('click');
            isTimerRunning = false;
            clearInterval(timerInterval);

            elapsedMs = 0;
            document.getElementById('timerDisplay').textContent = '00:00.00';
            document.getElementById('cpmDisplay').textContent = '000 CPM (Ch/Min)';

            document.getElementById('btnStart').disabled = false;
            document.getElementById('btnStop').disabled = true;

            // Blurs paragraph back to secure state
            document.getElementById('paragraphBox').classList.add('encrypted');
            document.getElementById('decryptOverlay').style.display = 'flex';

            // Hide questions
            document.getElementById('comprehensionBox').style.display = 'none';
        }

        function resetTimerStats() {
            clearInterval(timerInterval);
            isTimerRunning = false;
            elapsedMs = 0;
            document.getElementById('timerDisplay').textContent = '00:00.00';
            document.getElementById('cpmDisplay').textContent = '000 CPM (Ch/Min)';
            
            document.getElementById('btnStart').disabled = false;
            document.getElementById('btnStop').disabled = true;
        }

        // Toggles
        function toggleFurigana() {
            triggerSound('click');
            isFuriganaOn = !isFuriganaOn;
            
            const btn = document.getElementById('btnFurigana');
            const status = document.getElementById('fStatus');
            const pBox = document.getElementById('paragraphBox');

            if (isFuriganaOn) {
                btn.classList.add('active');
                status.textContent = '[ ON ]';
                pBox.classList.remove('hide-furigana');
            } else {
                btn.classList.remove('active');
                status.textContent = '[ OFF ]';
                pBox.classList.add('hide-furigana');
            }
        }

        function toggleTranslation() {
            triggerSound('click');
            isTranslationOn = !isTranslationOn;

            const btn = document.getElementById('btnTranslation');
            const status = document.getElementById('tStatus');
            const tBox = document.getElementById('translationBox');

            if (isTranslationOn) {
                btn.classList.add('active');
                status.textContent = '[ ON ]';
                tBox.style.display = 'block';
            } else {
                btn.classList.remove('active');
                status.textContent = '[ OFF ]';
                tBox.style.display = 'none';
            }
        }

        // Lexical Color Legend Focus Filters
        function setHighlighterFilter(wordClass) {
            // Apply blur filter onto active box
            const pBox = document.getElementById('paragraphBox');
            pBox.className = 'paragraph-text'; // clear old filters
            if (!isFuriganaOn) pBox.classList.add('hide-furigana');

            pBox.classList.add(`filter-${wordClass}`);

            // Dim inactive legend markers visually in sidebar
            document.querySelectorAll('.legend-item').forEach(item => {
                const text = item.querySelector('span').textContent;
                if (!text.toLowerCase().includes(wordClass.replace('adj-', 'sifat '))) {
                    item.classList.add('dimmed-hint');
                }
            });
        }

        function clearHighlighterFilter() {
            const pBox = document.getElementById('paragraphBox');
            pBox.className = 'paragraph-text';
            if (!isFuriganaOn) pBox.classList.add('hide-furigana');

            // Restore legend item transparencies
            document.querySelectorAll('.legend-item').forEach(item => {
                item.classList.remove('dimmed-hint');
            });
        }

        // Comprehension Quiz Engine
        let questionStates = [];

        function loadQuestions() {
            const p = paragraphs[currentFeedIndex];
            if (!p || !p.questions || p.questions.length === 0) return;

            const container = document.getElementById('questionsContainer');
            container.innerHTML = '';

            questionStates = [];

            p.questions.forEach((q, qIndex) => {
                questionStates.push({
                    hasAnswered: false,
                    correctIndex: q.correct_index
                });

                const qCard = document.createElement('div');
                qCard.className = 'question-card';
                qCard.innerHTML = `
                    <div class="question-title">PERTANYAAN 0${qIndex + 1}: ${q.question_text}</div>
                    <div class="q-choices-grid">
                        ${q.options.map((opt, optIndex) => `
                            <button class="q-choice-btn" id="q_${qIndex}_choice_${optIndex}" onclick="submitQuestionAnswer(${qIndex}, ${optIndex})">
                                <span class="letter-indicator">${String.fromCharCode(65 + optIndex)} //</span>
                                <span>${opt}</span>
                            </button>
                        `).join('')}
                    </div>
                    <div class="explanation-box" id="explanation_${qIndex}">
                        <strong>Evaluasi Diagnostik:</strong> ${q.explanation}
                    </div>
                `;
                container.appendChild(qCard);
            });

            // Update score indicators
            updateComprehensionScoreHUD();

            // Reveal panel
            document.getElementById('comprehensionBox').style.display = 'block';
            
            // Auto smooth scroll down
            document.getElementById('comprehensionBox').scrollIntoView({ behavior: 'smooth' });
        }

        function submitQuestionAnswer(qIndex, selectedIndex) {
            const state = questionStates[qIndex];
            if (state.hasAnswered) return;
            state.hasAnswered = true;
            state.userSelected = selectedIndex;

            const isCorrect = (selectedIndex === state.correctIndex);

            // Lock and color buttons
            const choicesCount = 4;
            for (let i = 0; i < choicesCount; i++) {
                const btn = document.getElementById(`q_${qIndex}_choice_${i}`);
                btn.disabled = true;

                if (i === state.correctIndex) {
                    btn.classList.add('correct');
                } else if (i === selectedIndex) {
                    btn.classList.add('incorrect');
                }
            }

            // Audio cues & values
            if (isCorrect) {
                triggerSound('correct');
            } else {
                triggerSound('incorrect');
            }

            // Reveal explanation
            const expl = document.getElementById(`explanation_${qIndex}`);
            expl.style.display = 'block';

            // Re-render score
            updateComprehensionScoreHUD();
        }

        function updateComprehensionScoreHUD() {
            const answeredCount = questionStates.filter(s => s.hasAnswered).length;
            const correctCount = questionStates.filter(s => s.hasAnswered && s.userSelected === s.correctIndex).length;
            
            document.getElementById('comprehensionScore').textContent = `SCORE: ${correctCount} / ${questionStates.length} BENAR (${answeredCount}/${questionStates.length} SELESAI)`;
        }

        window.onload = initApp;
    </script>
</body>
</html>
