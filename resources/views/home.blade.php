<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watashi no Nihongo - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #f8fafc;
            --bg-card: rgba(255, 255, 255, 0.95);
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: rgba(226, 232, 240, 0.8);
            
            /* Clean vibrant palette */
            --color-kanji: #f43f5e;     /* Rose */
            --color-kotoba: #10b981;    /* Emerald */
            --color-bunpo: #3b82f6;     /* Blue */
            --color-kana: #f59e0b;      /* Amber */
            --color-quiz: #8b5cf6;      /* Violet */
            --color-reading: #06b6d4;   /* Cyan */
            --color-n3-input: #6366f1;  /* Indigo */
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Noto Sans JP', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 4rem 2rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Decorative background blobs */
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
            background: rgba(59, 130, 246, 0.2);
        }

        body::after {
            bottom: -10vw;
            right: -10vw;
            background: rgba(244, 63, 94, 0.15);
            animation-delay: -5s;
        }

        @keyframes pulse-blob {
            0% { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.1) translate(20px, 20px); }
        }

        .dashboard-container {
            width: 100%;
            max-width: 1100px;
            z-index: 10;
        }

        /* Header */
        .header-wrapper {
            margin-bottom: 4rem;
            text-align: center;
        }

        h1 {
            font-size: 2.75rem;
            font-weight: 800;
            letter-spacing: -1.5px;
            color: var(--text-main);
            margin-bottom: 0.75rem;
            background: linear-gradient(to right, #0f172a, #334155);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .system-status {
            font-size: 1rem;
            color: var(--text-muted);
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        /* Sections */
        .dashboard-section {
            margin-bottom: 4.5rem;
        }

        .section-title {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            letter-spacing: -0.5px;
        }

        .section-title::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 24px;
            background: linear-gradient(to bottom, #6366f1, #3b82f6);
            border-radius: 8px;
            margin-right: 12px;
        }

        /* Grid Layout */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        @media (max-width: 900px) {
            .menu-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 600px) {
            body { padding: 2rem 1.5rem; }
            h1 { font-size: 2rem; }
            .menu-grid { grid-template-columns: 1fr; gap: 1.5rem; }
        }

        /* Minimalist Card Design */
        .card {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: var(--text-main);
            position: relative;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--card-color);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1), 0 10px 20px -10px rgba(0, 0, 0, 0.05);
            border-color: transparent;
        }

        .card:hover::before {
            transform: scaleX(1);
        }

        /* Card color variables */
        .card.kanji { --card-color: var(--color-kanji); }
        .card.kotoba { --card-color: var(--color-kotoba); }
        .card.bunpo { --card-color: var(--color-bunpo); }
        .card.kana { --card-color: var(--color-kana); }
        .card.quiz { --card-color: var(--color-quiz); }
        .card.reading { --card-color: var(--color-reading); }
        .card.n3input { --card-color: var(--color-n3-input); }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0px); }
        }

        .card-icon {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 4rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--card-color), #0f172a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1.25rem;
            transition: transform 0.4s;
            animation: float 4s ease-in-out infinite;
        }

        /* Stagger animation delays */
        .card:nth-child(2n) .card-icon { animation-delay: 0.5s; }
        .card:nth-child(3n) .card-icon { animation-delay: 1s; }
        .card:nth-child(4n) .card-icon { animation-delay: 1.5s; }

        .card:hover .card-icon {
            transform: scale(1.1) translateY(-5px);
            animation-play-state: paused;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
            letter-spacing: -0.3px;
        }

        .status-badge {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--card-color);
            background: rgba(255,255,255, 0.5);
            border: 1px solid rgba(0,0,0,0.05);
            padding: 6px 14px;
            border-radius: 9999px;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card:hover .status-badge {
            background: var(--card-color);
            color: #ffffff;
            border-color: transparent;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        
        <div class="header-wrapper">
            <h1>Watashi no Nihongo</h1>
            <span class="system-status">Media Pembelajaran Bahasa Jepang Mandiri</span>
        </div>

        <!-- Section N3 -->
        <section class="dashboard-section">
            <h2 class="section-title">JLPT N3</h2>
            <div class="menu-grid">
                <a href="{{ route('n3.kanji') }}" class="card kanji">
                    <div class="card-icon">漢</div>
                    <h2 class="card-title">Kanji N3</h2>
                    <div class="status-badge">Belajar</div>
                </a>

                <a href="{{ route('n3.kotoba') }}" class="card kotoba">
                    <div class="card-icon">言</div>
                    <h2 class="card-title">Kosakata N3</h2>
                    <div class="status-badge">Belajar</div>
                </a>

                <a href="{{ route('n3.bunpo') }}" class="card bunpo">
                    <div class="card-icon">文</div>
                    <h2 class="card-title">Tata Bahasa N3</h2>
                    <div class="status-badge">Belajar</div>
                </a>

                <a href="{{ route('n3.input') }}" class="card n3input">
                    <div class="card-icon">筆</div>
                    <h2 class="card-title">Input N3</h2>
                    <div class="status-badge">Dashboard</div>
                </a>

                <a href="{{ route('quiz', ['level' => 'N3']) }}" class="card quiz">
                    <div class="card-icon">考</div>
                    <h2 class="card-title">Latihan N3</h2>
                    <div class="status-badge">Latihan</div>
                </a>
            </div>
        </section>

        <!-- Section N4 -->
        <section class="dashboard-section">
            <h2 class="section-title">JLPT N4</h2>
            <div class="menu-grid">
                <a href="{{ route('kanji') }}" class="card kanji">
                    <div class="card-icon">漢</div>
                    <h2 class="card-title">Kanji N4</h2>
                    <div class="status-badge">Belajar</div>
                </a>

                <a href="{{ route('kotoba') }}" class="card kotoba">
                    <div class="card-icon">言</div>
                    <h2 class="card-title">Kosakata N4</h2>
                    <div class="status-badge">Belajar</div>
                </a>

                <a href="{{ route('bunpo') }}" class="card bunpo">
                    <div class="card-icon">文</div>
                    <h2 class="card-title">Tata Bahasa N4</h2>
                    <div class="status-badge">Belajar</div>
                </a>

                <a href="{{ route('kana') }}" class="card kana">
                    <div class="card-icon">あ</div>
                    <h2 class="card-title">Hiragana & Katakana</h2>
                    <div class="status-badge">Belajar</div>
                </a>

                <a href="{{ route('reading') }}" class="card reading">
                    <div class="card-icon">読</div>
                    <h2 class="card-title">Membaca</h2>
                    <div class="status-badge">Belajar</div>
                </a>

                <a href="{{ route('quiz', ['level' => 'N4']) }}" class="card quiz">
                    <div class="card-icon">問</div>
                    <h2 class="card-title">Latihan N4</h2>
                    <div class="status-badge">Latihan</div>
                </a>
            </div>
        </section>

    </div>
</body>
</html>
