<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Kana & Pelafalan</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #fcfcfc;
            --bg-grid: #eeeeee;
            --primary: #f97316; /* Orange Theme */
            --primary-glow: rgba(249, 115, 22, 0.15);
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
            font-family: 'Noto Sans JP', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow-x: hidden;
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
            max-width: 1000px;
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
            font-size: 0.8rem;
            font-weight: 700;
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
        }

        /* Work Grid */
        .workspace-grid {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 2rem;
            align-items: start;
        }

        @media (max-width: 800px) {
            .workspace-grid { grid-template-columns: 1fr; }
        }

        .panel {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 2rem;
            position: relative;
            box-shadow: 10px 10px 0 rgba(0, 0, 0, 0.02);
            width: 100%;
        }

        .accent-tl { position: absolute; top: 15px; left: 15px; width: 15px; height: 15px; border-top: 3px solid var(--accent-gray); border-left: 3px solid var(--accent-gray); }
        .accent-br { position: absolute; bottom: 15px; right: 15px; width: 15px; height: 15px; border-bottom: 3px solid var(--accent-gray); border-right: 3px solid var(--accent-gray); }
        .accent-top-bar { position: absolute; top: 0; left: 10%; width: 60px; height: 6px; background: var(--accent-yellow); }

        .section-label {
            font-size: 0.75rem;
            color: var(--accent-gray);
            font-weight: 700;
            margin-bottom: 0.8rem;
            display: block;
        }

        .config-btn {
            background: #fff;
            border: 1px solid var(--accent-gray);
            padding: 12px;
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.25s ease;
            text-align: left;
            margin-bottom: 10px;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .config-btn::before {
            content: '';
            display: inline-block;
            width: 8px; height: 8px;
            background: var(--accent-gray);
            margin-right: 12px;
            transition: all 0.25s;
        }

        .config-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateX(4px);
        }

        .config-btn.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            border-left: 6px solid var(--accent-yellow);
        }

        .config-btn.active::before {
            background: #fff;
        }

        .btn-launch {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 15px;
            font-size: 0.9rem;
            font-weight: 900;
            cursor: pointer;
            text-align: center;
            width: 100%;
            margin-top: 1rem;
            border-bottom: 4px solid #c2410c;
            transition: all 0.2s;
        }

        .btn-launch:hover {
            background: #ea580c;
            transform: translateY(-2px);
        }

        .btn-launch:disabled {
            background: #cbd5e1;
            border-bottom-color: #94a3b8;
            cursor: not-allowed;
            transform: none;
        }

        /* Quiz UI */
        .quiz-container {
            display: none;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .progress-hud {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 1rem;
        }

        .progress-text { font-size: 1.2rem; font-weight: 900; color: var(--primary); }
        .score-text { font-size: 0.9rem; font-weight: 700; color: var(--text-muted); }

        .question-display {
            font-size: 6rem;
            font-weight: 900;
            color: var(--text-main);
            margin: 2rem 0;
            min-height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        /* Audio Play Button */
        .btn-audio {
            background: rgba(249, 115, 22, 0.1);
            border: 2px solid var(--primary);
            color: var(--primary);
            width: 80px; height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            cursor: pointer;
            transition: all 0.2s;
            margin: 2rem 0;
        }

        .btn-audio:hover {
            background: var(--primary);
            color: #fff;
            transform: scale(1.1);
        }

        .btn-audio.playing {
            animation: pulseAudio 1s infinite;
            background: var(--primary);
            color: #fff;
        }

        @keyframes pulseAudio {
            0% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.7); }
            70% { box-shadow: 0 0 0 20px rgba(249, 115, 22, 0); }
            100% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0); }
        }

        .options-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            width: 100%;
            margin-bottom: 2rem;
        }

        .option-btn {
            background: #fff;
            border: 2px solid #e2e8f0;
            padding: 20px;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-main);
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .option-btn:hover:not(:disabled) {
            border-color: var(--primary);
            background: #fafafa;
        }

        .option-btn.correct { background: var(--primary-green) !important; color: #fff !important; border-color: var(--primary-green) !important; }
        .option-btn.incorrect { background: var(--primary-red) !important; color: #fff !important; border-color: var(--primary-red) !important; }

        .btn-next {
            background: var(--text-main);
            color: #fff;
            border: none;
            padding: 12px 30px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            display: none;
            transition: all 0.2s;
        }

        .btn-next:hover { background: #1e293b; }

        /* Results Screen */
        .results-container {
            display: none;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .final-score { font-size: 4rem; font-weight: 900; color: var(--primary); margin: 1rem 0; }
        .final-eval { font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 2rem; }

        .btn-home {
            background: #fff; border: 2px solid var(--text-main); color: var(--text-main);
            padding: 12px 25px; font-weight: 700; cursor: pointer; text-decoration: none;
            transition: all 0.2s;
        }

        .btn-home:hover { background: var(--text-main); color: #fff; }

        @media (max-width: 600px) {
            .container { padding: 1rem; }
            .header-section { margin-bottom: 1.5rem; }
            .panel { padding: 1.5rem; }
            .question-display { font-size: 4rem; min-height: 90px; margin: 1rem 0; }
            .btn-audio { width: 65px; height: 65px; font-size: 1.5rem; margin: 1rem 0; }
            .options-grid { grid-template-columns: 1fr; gap: 10px; }
            .option-btn { padding: 15px; font-size: 1.4rem; }
            .final-score { font-size: 3rem; }
            .final-eval { font-size: 1.2rem; margin-bottom: 1.5rem; }
        }

    </style>
</head>
<body>
    <div class="background-grid"></div>

    <div class="container">
        
        <nav class="nav-header">
            <a href="{{ route('home') }}" class="nav-back">← KEMBALI KE DASHBOARD</a>
            <div style="font-size: 0.65rem; font-weight: 700; color: var(--text-muted);">Sistem Kana & Pelafalan</div>
        </nav>

        <div class="header-section">
            <h1 style="font-family: 'Orbitron';">KANA & PELAFALAN</h1>
            <div style="font-size: 0.65rem; color: var(--text-muted); font-weight: 700;">STATUS: STANDBY</div>
        </div>

        <div class="workspace-grid" id="setupWorkspace">
            
            <div style="display: flex; flex-direction: column;">
                <span class="section-label">Pilih Mode Latihan</span>
                <button class="config-btn active" onclick="setMode('hiragana', this)">Hiragana (ひらがな)</button>
                <button class="config-btn" onclick="setMode('katakana', this)">Katakana (カタカナ)</button>
                <button class="config-btn" onclick="setMode('hatsuon', this)">Hatsuon (Listening Audio)</button>

                <span class="section-label" style="margin-top: 1.5rem;">Jumlah Soal</span>
                <button class="config-btn active" onclick="setCount(10, this)">10 Soal</button>
                <button class="config-btn" onclick="setCount(20, this)">20 Soal</button>
            </div>

            <div class="panel">
                <div class="accent-tl"></div><div class="accent-br"></div>
                <div class="accent-top-bar"></div>
                
                <h2 style="font-size: 1.2rem; margin-bottom: 1rem;">Pengaturan Latihan</h2>
                <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 2rem;">
                    Silakan atur mode dan jumlah soal yang diinginkan.<br>
                    <strong>Hiragana</strong>：Tebak penulisan Hiragana dari karakter Katakana yang ditampilkan.<br>
                    <strong>Katakana</strong>：Tebak penulisan Katakana dari karakter Hiragana yang ditampilkan.<br>
                    <strong>Hatsuon</strong>：Dengarkan vokal suara dan tebak kata yang paling tepat.
                </p>

                <button class="btn-launch" onclick="startQuiz()">MULAI LATIHAN</button>
            </div>

        </div>

        <!-- Quiz Interface -->
        <div class="panel" id="quizWorkspace" style="display: none;">
            <div class="accent-tl"></div><div class="accent-br"></div>
            
            <div class="quiz-container" id="quizContainer">
                <div class="progress-hud">
                    <span class="progress-text" id="progressText">Soal 1</span>
                    <span class="score-text" id="scoreText">Skor: 0</span>
                </div>

                <!-- Visual Mode -->
                <div class="question-display" id="questionText"></div>

                <!-- Audio Mode (Hidden by default) -->
                <button class="btn-audio" id="btnPlayAudio" style="display: none;" onclick="playCurrentAudio()">
                    🔊
                </button>

                <div class="options-grid" id="optionsGrid">
                    <!-- Options injected here -->
                </div>

                <button class="btn-next" id="btnNext" onclick="nextQuestion()">SOAL BERIKUTNYA</button>
            </div>

            <div class="results-container" id="resultsContainer">
                <h2 style="font-size: 1.2rem; color: var(--text-muted);">HASIL EVALUASI</h2>
                <div class="final-score" id="finalScoreText">10 / 10</div>
                <div class="final-eval" id="finalEvalText">Sempurna!</div>
                
                <div style="display: flex; gap: 15px; margin-top: 2rem;">
                    <button class="btn-launch" style="width: auto; padding: 12px 30px; margin: 0;" onclick="location.reload()">COBA LAGI</button>
                    <a href="{{ route('home') }}" class="btn-home">KEMBALI</a>
                </div>
            </div>

        </div>

    </div>

    <script>
        const hiraganaSet = @json($hiraganaSet);
        const katakanaSet = @json($katakanaSet);
        const hatsuonWords = @json($hatsuonWords);

        let currentMode = 'hiragana';
        let targetCount = 10;
        
        let questions = [];
        let currentQIndex = 0;
        let score = 0;
        let isAnswered = false;

        // UI Selections
        function setMode(mode, el) {
            currentMode = mode;
            document.querySelectorAll('.config-btn').forEach((btn, idx) => {
                if(idx < 3) btn.classList.remove('active');
            });
            el.classList.add('active');
        }

        function setCount(count, el) {
            targetCount = count;
            document.querySelectorAll('.config-btn').forEach((btn, idx) => {
                if(idx >= 3) btn.classList.remove('active');
            });
            el.classList.add('active');
        }

        // Web Speech API wrapper
        function speakJapanese(text) {
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel(); // clear queue
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = 'ja-JP';
                utterance.rate = 0.85; // Slightly slower for clarity
                
                const btn = document.getElementById('btnPlayAudio');
                utterance.onstart = () => btn.classList.add('playing');
                utterance.onend = () => btn.classList.remove('playing');
                utterance.onerror = () => btn.classList.remove('playing');

                window.speechSynthesis.speak(utterance);
            } else {
                alert("Browser Anda tidak mendukung Web Speech API untuk mensintesis suara.");
            }
        }

        // Engine
        function startQuiz() {
            document.getElementById('setupWorkspace').style.display = 'none';
            document.getElementById('quizWorkspace').style.display = 'block';
            document.getElementById('quizContainer').style.display = 'flex';

            generateQuestions();
            currentQIndex = 0;
            score = 0;
            showQuestion();
        }

        function generateQuestions() {
            questions = [];
            for (let i = 0; i < targetCount; i++) {
                if (currentMode === 'hiragana') {
                    let rIdx = Math.floor(Math.random() * hiraganaSet.length);
                    let q = {
                        display: katakanaSet[rIdx],
                        correct: hiraganaSet[rIdx],
                        options: generateOptions(hiraganaSet, hiraganaSet[rIdx])
                    };
                    questions.push(q);
                } else if (currentMode === 'katakana') {
                    let rIdx = Math.floor(Math.random() * katakanaSet.length);
                    let q = {
                        display: hiraganaSet[rIdx],
                        correct: katakanaSet[rIdx],
                        options: generateOptions(katakanaSet, katakanaSet[rIdx])
                    };
                    questions.push(q);
                } else if (currentMode === 'hatsuon') {
                    let rIdx = Math.floor(Math.random() * hatsuonWords.length);
                    let q = {
                        audioText: hatsuonWords[rIdx],
                        correct: hatsuonWords[rIdx],
                        options: generateOptions(hatsuonWords, hatsuonWords[rIdx])
                    };
                    questions.push(q);
                }
            }
        }

        function generateOptions(pool, correctItem) {
            let opts = [correctItem];
            while(opts.length < 4) {
                let r = pool[Math.floor(Math.random() * pool.length)];
                if(!opts.includes(r)) {
                    opts.push(r);
                }
            }
            return opts.sort(() => Math.random() - 0.5);
        }

        function showQuestion() {
            isAnswered = false;
            document.getElementById('btnNext').style.display = 'none';
            document.getElementById('progressText').textContent = `Soal ${currentQIndex + 1}`;
            document.getElementById('scoreText').textContent = `Skor: ${score}`;

            const q = questions[currentQIndex];

            // Adjust UI for Hatsuon vs Visual
            const qText = document.getElementById('questionText');
            const btnAudio = document.getElementById('btnPlayAudio');

            if (currentMode === 'hatsuon') {
                qText.style.display = 'none';
                btnAudio.style.display = 'flex';
                // Auto play on show
                setTimeout(() => speakJapanese(q.audioText), 300);
            } else {
                btnAudio.style.display = 'none';
                qText.style.display = 'flex';
                qText.textContent = q.display;
            }

            // Render Options
            const grid = document.getElementById('optionsGrid');
            grid.innerHTML = '';
            
            q.options.forEach((opt, idx) => {
                const btn = document.createElement('button');
                btn.className = 'option-btn';
                // Make text smaller for full words
                if(currentMode === 'hatsuon') btn.style.fontSize = '1.2rem';
                btn.textContent = opt;
                btn.onclick = () => selectAnswer(opt, btn);
                grid.appendChild(btn);
            });
        }

        function playCurrentAudio() {
            const q = questions[currentQIndex];
            if(q && currentMode === 'hatsuon') {
                speakJapanese(q.audioText);
            }
        }

        function selectAnswer(selected, btnElement) {
            if (isAnswered) return;
            isAnswered = true;

            const q = questions[currentQIndex];
            const isCorrect = (selected === q.correct);

            const allBtns = document.querySelectorAll('.option-btn');
            allBtns.forEach(btn => {
                btn.disabled = true;
                if (btn.textContent === q.correct) {
                    btn.classList.add('correct');
                } else if (btn === btnElement && !isCorrect) {
                    btn.classList.add('incorrect');
                }
            });

            if (isCorrect) score++;
            document.getElementById('scoreText').textContent = `Skor: ${score}`;
            document.getElementById('btnNext').style.display = 'block';
        }

        function nextQuestion() {
            currentQIndex++;
            if (currentQIndex >= questions.length) {
                showResults();
            } else {
                showQuestion();
            }
        }

        function showResults() {
            document.getElementById('quizContainer').style.display = 'none';
            document.getElementById('resultsContainer').style.display = 'flex';

            document.getElementById('finalScoreText').textContent = `${score} / ${questions.length}`;
            
            const perc = score / questions.length;
            let eval = "Terus Belajar!";
            if(perc === 1) eval = "Luar Biasa! (PERFECT)";
            else if(perc >= 0.8) eval = "Hebat! (GREAT)";
            else if(perc >= 0.6) eval = "Lulus! (GOOD)";

            document.getElementById('finalEvalText').textContent = eval;
        }

    </script>
</body>
</html>
