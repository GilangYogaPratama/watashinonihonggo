<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N4 Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #fcfcfc;
            --bg-grid: #eeeeee;
            --primary-blue: #3b82f6;
            --primary-green: #22c55e;
            --primary-red: #ef4444;
            --primary-purple: #a855f7;
            --primary-cyan: #06b6d4;
            --primary-orange: #f97316;
            --accent-yellow: #facc15;
            --accent-gray: #94a3b8;
            --text-main: #334155;
            --text-muted: #64748b;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Noto Sans JP', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
            position: relative;
            overflow-x: hidden;
        }

        .background-grid {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: 
                linear-gradient(var(--bg-grid) 1px, transparent 1px),
                linear-gradient(90deg, var(--bg-grid) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: -1;
        }

        .dashboard-container {
            width: 100%;
            max-width: 1200px;
            position: relative;
            z-index: 10;
            padding-top: 2rem;
        }

        /* Header Styles */
        .header-wrapper {
            margin-bottom: 3rem;
            border-left: 4px solid var(--accent-yellow);
            padding-left: 1rem;
        }

        h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            letter-spacing: 4px;
            color: var(--text-main);
            margin-bottom: 0.2rem;
        }

        .system-status {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 0.75rem;
            color: var(--text-muted);
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* Dashboard Sections */
        .dashboard-section {
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--text-main);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .section-title::before {
            content: '';
            display: inline-block;
            width: 12px;
            height: 12px;
            background-color: var(--text-main);
            margin-right: 12px;
        }

        /* Menu Grid */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        @media (max-width: 1024px) {
            .menu-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 600px) {
            body { padding: 1.2rem; }
            h1 { font-size: 1.8rem; letter-spacing: 2px; }
            .menu-grid { grid-template-columns: 1fr; gap: 1.2rem; }
            .card { padding: 1.8rem 1.2rem; }
            .card-icon { font-size: 3.5rem; margin-bottom: 0.5rem; }
            .header-wrapper { margin-bottom: 2rem; }
            .dashboard-section { margin-bottom: 2.5rem; }
        }

        /* Card Styles */
        .card {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 2.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: var(--text-main);
            position: relative;
            transition: all 0.3s ease;
            box-shadow: 10px 10px 0 rgba(0, 0, 0, 0.02);
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(135deg, transparent, rgba(0,0,0,0.01));
            z-index: 1;
        }

        .card:hover {
            transform: translateY(-5px) translateX(-5px);
            box-shadow: 15px 15px 0 rgba(0, 0, 0, 0.04);
            border-color: var(--card-color);
        }

        /* Module Colors */
        .card.kanji { --card-color: var(--primary-red); }
        .card.kotoba { --card-color: var(--primary-green); }
        .card.bunpo { --card-color: var(--primary-blue); }
        .card.kana { --card-color: var(--primary-orange); }
        .card.quiz { --card-color: var(--primary-purple); }
        .card.reading { --card-color: var(--primary-cyan); }

        /* Techy Accents */
        .accent-corner {
            position: absolute;
            width: 10px; height: 10px;
            border: 2px solid var(--accent-gray);
            transition: all 0.3s ease;
            z-index: 2;
        }

        .tl { top: 10px; left: 10px; border-right: none; border-bottom: none; }
        .tr { top: 10px; right: 10px; border-left: none; border-bottom: none; }
        .bl { bottom: 10px; left: 10px; border-right: none; border-top: none; }
        .br { bottom: 10px; right: 10px; border-left: none; border-top: none; }

        .card:hover .accent-corner {
            border-color: var(--card-color);
        }

        .accent-bar {
            position: absolute;
            top: 0;
            width: 40px;
            height: 4px;
            background: var(--card-color);
            transition: width 0.3s ease;
            z-index: 2;
        }

        .card:hover .accent-bar {
            width: 100%;
        }

        /* Content */
        .card-icon {
            font-size: 4.5rem;
            font-weight: 900;
            color: var(--card-color);
            margin-bottom: 1rem;
            z-index: 2;
        }

        .card-title {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 2px;
            z-index: 2;
        }

        .status-badge {
            margin-top: 1rem;
            padding: 4px 10px;
            background: var(--bg-grid);
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--card-color);
            letter-spacing: 1px;
            z-index: 2;
        }

        .card:hover .status-badge {
            background: var(--card-color);
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="background-grid"></div>

    <div class="dashboard-container">
        <div class="header-wrapper">
            <h1>Sistem N4</h1>
            <span class="system-status">Sinkronisasi Sistem Selesai</span>
        </div>

        <!-- Section 1: Study -->
        <section class="dashboard-section">
            <h2 class="section-title">Belajar</h2>
            <div class="menu-grid">
                <a href="{{ route('kanji') }}" class="card kanji">
                    <div class="accent-corner tl"></div><div class="accent-corner tr"></div>
                    <div class="accent-corner bl"></div><div class="accent-corner br"></div>
                    <div class="accent-bar"></div>
                    <div class="card-icon">漢</div>
                    <h2 class="card-title">Kanji</h2>
                    <div class="status-badge">Modul</div>
                </a>

                <a href="{{ route('kotoba') }}" class="card kotoba">
                    <div class="accent-corner tl"></div><div class="accent-corner tr"></div>
                    <div class="accent-corner bl"></div><div class="accent-corner br"></div>
                    <div class="accent-bar"></div>
                    <div class="card-icon">言</div>
                    <h2 class="card-title">Kosakata</h2>
                    <div class="status-badge">Modul</div>
                </a>

                <a href="{{ route('bunpo') }}" class="card bunpo">
                    <div class="accent-corner tl"></div><div class="accent-corner tr"></div>
                    <div class="accent-corner bl"></div><div class="accent-corner br"></div>
                    <div class="accent-bar"></div>
                    <div class="card-icon">文</div>
                    <h2 class="card-title">Tata Bahasa</h2>
                    <div class="status-badge">Modul</div>
                </a>
            </div>
        </section>

        <!-- Section 2: Practice -->
        <section class="dashboard-section">
            <h2 class="section-title">Latihan</h2>
            <div class="menu-grid">
                <a href="{{ route('kana') }}" class="card kana">
                    <div class="accent-corner tl"></div><div class="accent-corner tr"></div>
                    <div class="accent-corner bl"></div><div class="accent-corner br"></div>
                    <div class="accent-bar"></div>
                    <div class="card-icon">あ</div>
                    <h2 class="card-title">Huruf & Pelafalan</h2>
                    <div class="status-badge">Modul</div>
                </a>

                <a href="{{ route('quiz') }}" class="card quiz">
                    <div class="accent-corner tl"></div><div class="accent-corner tr"></div>
                    <div class="accent-corner bl"></div><div class="accent-corner br"></div>
                    <div class="accent-bar"></div>
                    <div class="card-icon">問</div>
                    <h2 class="card-title">Ulasan</h2>
                    <div class="status-badge">Modul</div>
                </a>

                <a href="{{ route('reading') }}" class="card reading">
                    <div class="accent-corner tl"></div><div class="accent-corner tr"></div>
                    <div class="accent-corner bl"></div><div class="accent-corner br"></div>
                    <div class="accent-bar"></div>
                    <div class="card-icon">読</div>
                    <h2 class="card-title">Membaca</h2>
                    <div class="status-badge">Modul</div>
                </a>
            </div>
        </section>

    </div>
</body>
</html>
