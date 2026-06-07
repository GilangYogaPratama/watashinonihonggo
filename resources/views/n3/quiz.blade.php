<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Kanji N3 - Watashi no Nihongo</title>
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
            background-color: var(--bg-main);
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
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
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

        .empty-state {
            text-align: center;
            padding: 2rem 0;
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
            background-color: var(--primary);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background-color 0.2s;
        }

        .btn-link:hover {
            background-color: var(--primary-hover);
        }

        /* Config / Setup Screen */
        .config-label {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-main);
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
            background: var(--primary);
            color: #ffffff;
            border: none;
            padding: 1rem;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
            text-align: center;
            width: 100%;
            margin-top: auto;
        }

        .btn-launch:hover {
            background-color: var(--primary-hover);
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
            grid-template-columns: repeat(2, 1fr);
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
            <h2 class="title">Setup Latihan N3</h2>
            
            @if(count($kanjis) === 0)
                <div class="empty-state">
                    <h3>Belum ada Kanji N3</h3>
                    <p>Silakan input Kanji N3 terlebih dahulu secara manual agar dapat memulai latihan kuis.</p>
                    <a href="{{ route('n3.input') }}" class="btn-link">Input Kanji N3</a>
                </div>
            @else
                <div style="margin-bottom: 2rem;">
                    <span class="config-label">Jumlah Soal</span>
                    <div class="selector-group">
                        <button class="selector-btn active" onclick="selectLimit(10, this)">10 SOAL</button>
                        <button class="selector-btn" onclick="selectLimit(20, this)">20 SOAL</button>
                        <button class="selector-btn" onclick="selectLimit(30, this)">30 SOAL</button>
                    </div>
                </div>

                <button class="btn-launch" onclick="initializeQuiz()">Mulai Kuis</button>
            @endif
        </div>

        <!-- Gameplay Screen -->
        <div id="gameplayScreen" class="panel" style="display: none;">
            <div class="hud-row">
                <div>SOAL: <span id="currentNum" class="hud-value">01</span> / <span id="totalNum" class="hud-value">10</span></div>
                <div>LEVEL: <span class="hud-value" style="color: var(--primary);">N3</span></div>
                <div>SKOR: <span id="currentScore" class="hud-value">0</span></div>
            </div>

            <div class="target-box">
                <span id="targetChar" class="target-char">活</span>
                <span id="targetPrompt" class="target-prompt">Pilih arti atau cara baca yang benar</span>
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
            <h2 class="title" style="margin-bottom: 2rem;">Hasil Latihan N3</h2>

            <div class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-label">Skor Akhir</div>
                    <div id="finalScore" class="metric-value">000</div>
                </div>
                <div class="metric-card">
                    <div class="metric-label">Akurasi Jawaban</div>
                    <div id="finalAccuracy" class="metric-value">0%</div>
                </div>
            </div>

            <div class="telemetry-container">
                <table class="telemetry-table">
                    <thead>
                        <tr>
                            <th>Kanji</th>
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
                <button class="btn-action-quiz" onclick="returnToSetup()">Ulangi Latihan</button>
                <a href="{{ route('home') }}" class="btn-action-quiz btn-purple">Kembali ke Home</a>
            </div>
        </div>
    </div>

    @if(count($kanjis) > 0)
        <script>
            const rawKanjis = @json($kanjis);
            const distractorKanjis = @json($allKanjis);

            let questionLimit = 10;
            let activeQuestions = [];
            let currentQuestionIndex = 0;
            let score = 0;
            let telemetryLog = [];
            let hasAnswered = false;

            function selectLimit(limit, element) {
                questionLimit = limit;
                document.querySelectorAll('.selector-btn').forEach(btn => btn.classList.remove('active'));
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
                activeQuestions = [];
                currentQuestionIndex = 0;
                score = 0;
                telemetryLog = [];
                hasAnswered = false;

                const pool = shuffle([...rawKanjis]);
                const count = Math.min(questionLimit, pool.length);

                for (let i = 0; i < count; i++) {
                    const k = pool[i];
                    
                    // Randomly decide if we quiz on Meaning (Arti) or Reading (Onyomi/Kunyomi)
                    const isQuizMeaning = Math.random() > 0.5 && k.arti;
                    
                    let questionTarget = k.kanji;
                    let correctAnswer = '';
                    let clue = '';
                    let distractorPool = [];

                    if (isQuizMeaning) {
                        correctAnswer = k.arti;
                        clue = "Apa arti dari kanji ini?";
                        distractorPool = distractorKanjis
                            .map(item => item.arti)
                            .filter(val => val && val.trim() !== '' && val !== correctAnswer);
                    } else {
                        const onyomi = k.onyomi && k.onyomi.trim() !== '—' && k.onyomi.trim() !== '-' ? k.onyomi.trim() : '';
                        const kunyomi = k.kunyomi && k.kunyomi.trim() !== '—' && k.kunyomi.trim() !== '-' ? k.kunyomi.trim() : '';
                        
                        if (onyomi && kunyomi) {
                            correctAnswer = `${onyomi} / ${kunyomi}`;
                        } else {
                            correctAnswer = onyomi || kunyomi || '—';
                        }
                        clue = "Apa cara baca (Onyomi / Kunyomi) dari kanji ini?";
                        
                        distractorPool = distractorKanjis.map(item => {
                            const o = item.onyomi && item.onyomi.trim() !== '—' && item.onyomi.trim() !== '-' ? item.onyomi.trim() : '';
                            const ku = item.kunyomi && item.kunyomi.trim() !== '—' && item.kunyomi.trim() !== '-' ? item.kunyomi.trim() : '';
                            return (o && ku) ? `${o} / ${ku}` : (o || ku || '');
                        }).filter(val => val && val.trim() !== '' && val !== correctAnswer);
                    }

                    activeQuestions.push({
                        target: questionTarget,
                        clue: clue,
                        correctAnswer: correctAnswer,
                        distractorPool: distractorPool
                    });
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
                document.getElementById('currentScore').textContent = String(score);

                document.getElementById('targetChar').textContent = q.target;
                document.getElementById('targetPrompt').textContent = q.clue;

                // Make choices
                let uniqueDistractors = [...new Set(q.distractorPool)];
                shuffle(uniqueDistractors);
                
                let choices = [q.correctAnswer];
                for (let i = 0; i < Math.min(3, uniqueDistractors.length); i++) {
                    choices.push(uniqueDistractors[i]);
                }
                
                while (choices.length < 4) {
                    choices.push('—');
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

                if (isCorrect) {
                    score += 10;
                    optionBtns[selectedIndex].classList.add('correct');
                } else {
                    optionBtns[selectedIndex].classList.add('incorrect');
                    optionBtns.forEach((btn, index) => {
                        if (q.choices[index] === q.correctAnswer) {
                            btn.classList.add('correct');
                        }
                    });
                }

                document.getElementById('currentScore').textContent = String(score);

                telemetryLog.push({
                    target: q.target,
                    userInput: selectedText,
                    correct: q.correctAnswer,
                    status: isCorrect ? 'CORRECT' : 'INCORRECT'
                });

                document.getElementById('btnNext').style.display = 'block';
            }

            function nextQuestion() {
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

                document.getElementById('finalScore').textContent = String(score);
                document.getElementById('finalAccuracy').textContent = `${accuracy}%`;

                const tbody = document.getElementById('telemetryRows');
                tbody.innerHTML = '';
                
                telemetryLog.forEach(row => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td style="font-weight: 700; font-family: 'Noto Sans JP', sans-serif;">${row.target}</td>
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
                document.getElementById('summaryScreen').style.display = 'none';
                document.getElementById('setupScreen').style.display = 'flex';
            }
        </script>
    @endif
</body>
</html>
